<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH ."/libraries/REST_Controller.php";
use Domain\Status;

class AuthResource extends REST_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model("Repository/TokenRepository");
  }

  function token_post() {
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

    if ( ($token = $this->TokenRepository->getTokenIfExists($user->getId())) != null) {
      $this->response(
        new Status("already_connected", "Account already authenticated", $token),
        REST_Controller::HTTP_OK);
    }

    if (($token = $this->TokenRepository->createToken($user->getId(), 0, 1)) != null) {
      $this->response(
        new Status("connected", "Account authenticated successfully", ["token" => $token]),
        REST_Controller::HTTP_CREATED);
    }
    else {
      $this->response(
        new Status("error_create_token", "An error ocurred while creating access token", null),
        REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    }

  }

  function revoke_delete() {
    $userId = $this->_apiuser->user_id;
    if ($this->TokenRepository->destroyToken($userId)) {
      $this->response(
        new Status("revoke_token", "Account revoked successfully", null),
        REST_Controller::HTTP_OK);
    }
    else {
      $this->response(
        new Status("error_revoke_token", "Account has no tokens", null),
        REST_Controller::HTTP_OK);
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
