<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

  function __construct() {
    parent::__construct();
    if ( !$this->AuthService->hasRole("ROLE_ADMIN"))
      redirect("/");

    $this->load->library("pagination");
    $this->load->helper("pagination");
    $this->load->model("Service/UserService");
  }

  function index() {
    $limit = 10;
    $page = $this->UserService->findAll($this->input->get("page"), $limit);
    $data["users"] = $page;
    $data["pagination"] = PaginationLinks($page->count(), $limit, "users");
    $this->template->load("layouts/template", "admin/user/list", $data);
  }

  function delete($userId) {
    if ($userId)
      $this->UserService->delete($id);
  }
}

?>
