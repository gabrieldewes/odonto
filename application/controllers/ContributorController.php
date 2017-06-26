<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH ."core/UploadException.php");

class ContributorController extends CI_Controller {

  public function __construct() {
    parent::__construct();
    if ( !$this->AuthService->hasRole("ROLE_CONTRIBUTOR"))
      redirect("/");

    $this->load->model("Service/CardService");
    $this->load->library("form_validation");
    $this->load->library("pagination");
    $this->load->helper("pagination");
  }

  function index() {
    $this->template->load("layouts/template", "contributor/home");
  }

  function findAll() {
    $limit = 5;
    $page = $this->CardService->findAll($this->input->get("page"), $limit);
    $data["cards"] = $page;
    $data["pagination"] = PaginationLinks($page->count(), $limit, "contributor/cards");
    $this->template->load("layouts/template", "contributor/list", $data);
  }

  function diagnosedCards() {
    $limit = 5;
    $page = $this->CardService->findAllDiagnosedByCurrentUser($this->input->get("page"), $limit);
    $data["cards"] = $page;
    $data["pagination"] = PaginationLinks($page->count(), $limit, "contributor/cards/diagnosed");
    $this->template->load("layouts/template", "contributor/list", $data);
  }

  function pendingCards() {
    $limit = 5;
    $page = $this->CardService->findAllPendingByCurrentUser($this->input->get("page"), $limit);
    $data["cards"] = $page;
    $data["pagination"] = PaginationLinks($page->count(), $limit, "contributor/cards/pending");
    $this->template->load("layouts/template", "contributor/list", $data);
  }

  function create() {
    $data["extraScripts"] = ["scripts/action/create-action.js"];
    $this->template->load("layouts/template", "contributor/diagnostic", $data);
  }

  function createDiagnostic($cardId) {
    $this->form_validation->set_rules("whatafield", "qualquer coisa", "required");
    $this->form_validation->set_rules("attachments", "anexos", "callback_file_check");
    if ($this->form_validation->run()) {
      $action = $this->input->post();
      $this->load->model("Service/ActionService");

      if ( ($action = $this->ActionService->createAction($action["whatafield"], "ACTION_DIAGNOSTIC", $cardId)) != null) {
        $this->load->model("Service/MailService");
        $this->MailService->sendCreateDiagnosticEmail($action);
        redirect($this->input->get("returnUrl"));
      }

    }
    else
      $this->create();
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

        if ($name === "") return true;

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
