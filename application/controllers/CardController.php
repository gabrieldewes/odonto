<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH ."core/UploadException.php");

class CardController extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model("Service/CardService");
    $this->load->library("form_validation");
    $this->load->library("pagination");
    $this->load->helper("pagination");
  }

  function index() {
    $limit = 5;
    $page = $this->CardService->findByCurrentUser($this->input->get("page"), $limit);
    $data["cards"] = $page;
    $data["pagination"] = PaginationLinks($page->count(), $limit, "cards");
    $this->template->load("layouts/template", "card/list", $data);
  }

  function findAll() {
    if (!$this->AuthService->hasRole("ROLE_ADMIN"))
      redirect("/");
    $limit = 10;
    $page = $this->CardService->findAll($this->input->get("page"), $limit);
    $data["cards"] = $page;
    $data["pagination"] = PaginationLinks($page->count(), $limit, "admin/cards");
    $this->template->load("layouts/template", "admin/card/list", $data);
  }

  function findArchived() {
    $limit = 5;
    $page = $this->CardService->findArchivedByCurrentUser($this->input->get("page"), $limit);
    $data["cards"] = $page;
    $data["pagination"] = PaginationLinks($page->count(), $limit, "cards/archive");
    $this->template->load("layouts/template", "card/list", $data);
  }

  function createCard() {
    $this->form_validation->set_rules("whatafield", "qualquer coisa", "required");
    $this->form_validation->set_rules("attachments", "anexos", "callback_file_check");
    if ($this->form_validation->run()) {
      $card = $this->input->post();
      $this->CardService->createCard($card["whatafield"]);
      redirect("cards");
    }
    else {
      $this->create();
    }
  }

  function create() {
    $data["extraScripts"] = ["scripts/card/create-card.js"];
    $this->template->load("layouts/template", "card/create", $data);
  }

  function detailedCard($cardId) {
    $data["card"] = $this->loadCard($cardId);
    $data["extraStyles"] = ["lib/photoswipe/photoswipe.css","lib/photoswipe/default-skin/default-skin.css"];
    $data["extraScripts"] = ["scripts/attachment/gallery.js","lib/photoswipe/photoswipe.min.js","lib/photoswipe/photoswipe-ui-default.min.js"];
    $this->template->load("layouts/template", "card/detail", $data);
  }

  function findDiagnostics($cardId) {
    $card = $this->loadCard($cardId);
    $this->load->model("Service/ActionService");
    $data["diagnostics"] = $this->ActionService
        ->findByActionTypeAndCardId("ACTION_DIAGNOSTIC", $cardId);
    $this->template->load("layouts/template", "action/list", $data);
  }

  function detailedDiagnostic($cardId, $actionId) {
    $card = $this->loadCard($cardId);
    $this->load->model("Service/ActionService");
    $data["diagnostic"] = $this->ActionService->findByIdAndCardId($cardId, $actionId);
    $data["extraStyles"] = ["lib/photoswipe/photoswipe.css","lib/photoswipe/default-skin/default-skin.css"];
    $data["extraScripts"] = ["scripts/attachment/gallery.js","lib/photoswipe/photoswipe.min.js","lib/photoswipe/photoswipe-ui-default.min.js"];
    $this->template->load("layouts/template", "action/detail", $data);
  }

  public function archiveCard($cardId) {
    $card = $this->loadCard($cardId);
    $this->CardService->archiveCard($card);
    redirect("cards/archive");
  }

  public function recoverCard($cardId) {
    $card = $this->loadCard($cardId);
    $this->CardService->recoverCard($card);
    redirect("cards");
  }

  private function loadCard($cardId) {
    $card = $this->CardService->findById($cardId);
    if ($card == null) throw new Exception("Card not found with id {$cardId}.");
    if ($card->getUser()->getUsername() !== $this->AuthService->getCurrentUserUsername()
          && !$this->AuthService->hasRole("ROLE_CONTRIBUTOR"))
      throw new Exception("This card not belongs to {$this->AuthService->getCurrentUserUsername()}.");
    return $card;
  }

  public function file_check($str) {
    try {

      if (empty($_FILES) && empty($_POST) && isset($_SERVER['REQUEST_METHOD']) && strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
        $upload_max_filesize = ini_get("upload_max_filesize");
        throw new UploadException(UPLOAD_ERR_INI_SIZE, $name = "({$upload_max_filesize})");
      }

      $cpt = sizeof($_FILES["attachments"]["name"]);

      for ($i=0; $i<$cpt; $i++) {
        $error    = $_FILES["attachments"]["error"][$i];
        $name     = $_FILES["attachments"]["name"][$i];
        $type     = $_FILES["attachments"]["type"][$i];
        $tmp_name = $_FILES["attachments"]["tmp_name"][$i];
        $error    = $_FILES["attachments"]["error"][$i];
        $size     = $_FILES["attachments"]["size"][$i];

        if ($error !== UPLOAD_ERR_OK) {
          throw new UploadException($error, $name);
        }

        return true;
      }
    }
    catch (UploadException $ex) {
      $this->form_validation->set_message('file_check', $ex->getMessage());
      return false;
    }
    return false;
  }

}

?>
