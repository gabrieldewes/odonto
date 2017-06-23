<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AccountController extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model("Service/UserService");
    $this->load->model("Service/MailService");
    $this->load->model("Util/AlertHelper");
    $this->load->library("form_validation");
  }

  function create($data = null) {
    $data["extraScripts"] = ["scripts/account/account-register.js"];
    $this->template->load("layouts/template", "account/register", $data);
  }

  function index() {
    if ( !$this->AuthService->isAuthenticated())
      redirect("/");

    $principal = $this->AuthService->getPrincipal();
    $data["principal"] = $principal;
    $this->template->load("layouts/template", "account/me", $data);
  }

  function registerAccount() {
    $this->form_validation->set_rules("first_name", "nome", "required|max_length[75]");
    $this->form_validation->set_rules("email", "e-mail", "required|trim|valid_email|is_unique[user.email]|max_length[75]");
    $this->form_validation->set_rules("username", "usuário", "required|trim|strtolower|alpha_numeric|is_unique[user.username]|min_length[3]|max_length[75]");
    $this->form_validation->set_rules("password", "senha", "required|trim|alpha_numeric|min_length[3]|max_length[75]");
    $this->form_validation->set_rules("password_confirm", "confirmação de senha", "required|matches[password]");
    if ($this->form_validation->run()) {
      $user = $this->input->post();
      if ( ($user = $this->UserService->createUser($user["first_name"],
                                            $user["last_name"],
                                            $user["email"],
                                            $user["username"],
                                            $user["password"])) != null) {
        $this->MailService->sendActivationEmail($user);
        $this->AlertHelper->createRegisterAccountAlert();
      }
      else {
        $this->AlertHelper->createRegisterAccountErrorAlert();
      }
    }
    else {
      $this->AlertHelper->unsetAlert();
    }
    $this->create();
  }

  function activateAccount() {
    $activationKey = $this->input->get("key");
    if ($activationKey != null)
      $user = $this->UserService->activeRegistration($activationKey);

    if ($user && $user != null) {
      $this->AlertHelper->createActivateAccountAlert();
    }
    else {
      $this->AlertHelper->createActivateAccountErrorAlert();
    }
    $this->template->load("layouts/template", "account/login");
  }

}

?>
