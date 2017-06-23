<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AttachmentController extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model("Service/AttachmentService");
    $this->load->library("pagination");
    $this->load->helper("pagination");
  }

  function index() {
    //$this->AttachmentService->createThumb();
  }

  function findAll() {
    if (!$this->AuthService->hasRole("ROLE_ADMIN"))
      redirect("/");
    $limit = 10;
    $page = $this->AttachmentService->findAll($this->input->get("page"), $limit);
    $data["attachments"] = $page;
    $data["pagination"] = PaginationLinks($page->count(), $limit, "admin/attachments");
    $this->template->load("layouts/template", "admin/attachment/list", $data);
  }

  function imageLink($attachmentId) {
    $attach = $this->AttachmentService->findById($attachmentId);
    if (!$attach) throw new Exception("Attachment not found with id {$attachmentId}.");
    $image = new StdClass();
    if ($attach->getIsImage()) {
      $image->src = $attach->getUrl();
      $image->w = $attach->getImageWidth();
      $image->h = $attach->getImageHeight();
      $image->title = $attach->getAlt();
    }
    header("Content-Type: application/json");
    echo json_encode($image);
  }

  function detailedAttachment($attachmentId) {
    $attach = $this->AttachmentService->findById($attachmentId);
    if (!$attach) throw new Exception("Attachment not found with id {$attachmentId}.");
    $data["attach"] = $attach;
    $this->template->load("layouts/template", "attachment/detail", $data);
  }

  function downloadAttachment($attachmentId) {
    $this->load->helper('download');
    $attach = $this->AttachmentService->findById($attachmentId);
    if (!$attach) throw new Exception("Attachment not found with id {$attachmentId}.");
    force_download($attach->getOriginalName(),
              file_get_contents($attach->getFullPath()));
  }

}

?>
