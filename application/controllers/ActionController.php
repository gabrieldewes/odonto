<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH ."core/UploadException.php");

class ActionController extends CI_Controller {

  public function __construct() {
    parent::__construct();
    if ( !$this->AuthService->hasRole("ROLE_ADMIN"))
      redirect("/");

    $this->load->library("pagination");
    $this->load->helper("pagination");
    $this->load->model("Service/ActionService");
  }

  function index() {
    $limit = 10;
    $page = $this->ActionService->findAll($this->input->get("page"), $limit);
    $data["actions"] = $page;
    $data["pagination"] = PaginationLinks($page->count(), $limit, "actions");
    $this->template->load("layouts/template", "admin/action/list", $data);
  }

}

?>
