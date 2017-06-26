<?php defined('BASEPATH') OR exit('No direct script access allowed');

class LogsController extends CI_Controller {

  function __construct() {
    parent::__construct();
    if (!$this->AuthService->hasRole("ROLE_ADMIN"))
      redirect("/");

    $this->load->library("pagination");
    $this->load->helper("pagination");
  }

  function logs() {
    $limit = 10;
    $page = $this->input->get("page");
    $offset = $page == 0 ? $page : ($page-1) * $limit;
    $this->db->order_by("id", "desc");
    $page = $this->db->get("logs", $limit, $offset)->result();
    $count = $this->db->count_all_results('logs');
    $data["logs"] = $page;
    $data["pagination"] = PaginationLinks($count, $limit, "logs");
    $this->template->load("layouts/template", "admin/rest/logs", $data);
  }

  function tokens() {
    $limit = 10;
    $page = $this->input->get("page");
    $offset = $page == 0 ? $page : ($page-1) * $limit;
    $this->db->order_by("id", "desc");
    $page = $this->db->get("tokens", $limit, $offset)->result();
    $count = $this->db->count_all_results('tokens');
    $data["tokens"] = $page;
    $data["pagination"] = PaginationLinks($count, $limit, "tokens");
    $this->template->load("layouts/template", "admin/rest/tokens", $data);
  }

}

?>
