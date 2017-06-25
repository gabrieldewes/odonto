<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH ."/libraries/REST_Controller.php";
use Domain\Status;

class AuthResource extends REST_Controller {

  function __construct() {
    parent::__construct();
  }

  function greetings_get() {
    $proxy = $_SERVER['REMOTE_ADDR'];
    $this->response(new Status("greetings", "Hello {$proxy}", null), REST_Controller::HTTP_OK);
  }

  function default_get() {
    $proxy = $_SERVER['REMOTE_ADDR'];
    $host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $this->response(new Status("greetings", "Hello {$host}", null), REST_Controller::HTTP_OK);
  }

  function get_token_post() {
    $userCredentials = $this->post();

    if ( ($status = $this->validateUserAuthInputPost($userCredentials)) != null) {
      $this->response($status, REST_Controller::HTTP_OK);
    }

    $this->load->model("Service/UserService");

    $login = $userCredentials["login"];
    $password = $userCredentials["password"];

    $lowerCaseLogin = strtolower($login);
    $user = $this->UserService->findOneByLogin($lowerCaseLogin);
    if ($user == null || ($user != null && !password_verify($password, $user->getPassword())))
      $this->response(
        new Status("invalid_credentials", "Invalid credentials", null),
        REST_Controller::HTTP_OK);

    if (!$user->getActive())
      $this->response(
        new Status("account_not_activated", "This account is not activated", null),
        REST_Controller::HTTP_OK);

    if ( ($token = $this->db->select("token")->from("tokens")->where(["user_id"=>$user->getId()])->get()->row()) != null) {
      $this->response(
        new Status("already_connected", "Account already connected", $token),
        REST_Controller::HTTP_OK);
    }

    $persistentToken = [
      "token" => bin2hex(random_bytes(16)),
      "user_id" => $user->getId(),
      "level" => "0",
      "ignore_limits" => TRUE,
      "is_private_key" => FALSE,
      "ip_addresses" => $this->input->ip_address(),
      "created_at" => date("Y:m:d H:m:s")
    ];

    if ($this->db->insert("tokens", $persistentToken)) {
      $this->response(
        new Status("connected", "Account logged successfully", ["token"=>$persistentToken['token']]),
        REST_Controller::HTTP_OK);
    }
    else {
      $this->response(
        new Status("error_create_token", "An error ocurred while creating access token", null),
        REST_Controller::HTTP_OK);
    }
  }

  function logout_post() {
    $userId = $this->_apiuser->user_id;
    if ($this->db->delete("tokens", ["user_id" => $userId])) {
      if ($this->db->affected_rows() != 0) {
        $this->response(
          new Status("logged_out", "Account logged out successfully", null),
          REST_Controller::HTTP_OK);
      }
      else {
        $this->response(
          new Status("already_logged_out", "Account already logged out", null),
          REST_Controller::HTTP_OK);
      }
    }
  }

  private function validateUserAuthInputPost($data) {
    $login = $data["login"];
    $password = $data["password"];

    if (!$login || trim($login) === '') {
      return new Status("error_empty_field_login", "Login field can not be empty", null);
    }
    if (!$password || trim($password) === '') {
      return new Status("error_empty_field_password", "Password field can not be empty", null);
    }
  }

}

?>
