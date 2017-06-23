<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model("Service/AuthService");
    $this->load->model("Util/AlertHelper");
  }

  public function login($data=null) {
    $data["extraScripts"] = ["scripts/account/account-login.js"];
    $this->template->load("layouts/template", "account/login", $data);
  }

  public function authenticate() {
    $this->load->library("form_validation");
    $this->form_validation->set_rules("login", "usuário ou e-mail", "trim|required|alpha_numeric|min_length[3]|max_length[75]");
    $this->form_validation->set_rules("password", "senha", "trim|required|alpha_numeric|min_length[3]|max_length[75]");

    if ($this->form_validation->run()) {
      $form = $this->input->post();
      if ( ($principal = $this->AuthService->authenticate($form["login"], $form["password"])) != null) {
        $this->AlertHelper->createWelcomeAlert($principal->getFirstName());
        redirect("/");
      }
      else {
        $this->AlertHelper->createLoginErrorAlert();
      }
    }
    redirect("/login");
  }

  public function logout() {
    if ($this->AuthService->logout()) {
      $this->AlertHelper->createLoggedOutAlert();
    }
    else {
      $this->AlertHelper->createAlreadyLoggedOutAlert();
    }
    $this->login();
  }


}

?>
