<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH ."/libraries/REST_Controller.php";
use Domain\Status;
use Domain\Principal;

class AccountResource extends REST_Controller {

  function __construct() {
    parent::__construct();
  }

  function me_get() {
    $userId = $this->_apiuser->user_id;
    $this->load->model("Service/UserService");
    $user = $this->UserService->findById($userId);

    $roles = array();
    foreach ($user->getAuthority() as $i => $authority) {
      array_push($roles, $authority->getName());
    }
    $principal = new Principal();
    $principal->setId($user->getId())
        ->setFirstName($user->getFirstName())
        ->setLastName($user->getLastName())
        ->setEmail($user->getEmail())
        ->setUsername($user->getUsername())
        ->setAvatarUrl($user->getAvatarUrl())
        ->setBio($user->getBio())
        ->setRoles($roles);
    $this->response($principal, REST_Controller::HTTP_OK);
  }

  function profile_get($login) {
    $userId = $this->_apiuser->user_id;
    $this->load->model("Service/UserService");
    $user = $this->UserService->findOneByLogin($login);

    if (!$user) {
      $this->response(
        new Status("profile_not_found", "Profile not found with login \"{$login}\"", null), REST_Controller::HTTP_OK);
    }

    $roles = array();
    foreach ($user->getAuthority() as $i => $authority) {
      array_push($roles, $authority->getName());
    }
    $principal = new Principal();
    $principal->setId($user->getId())
        ->setFirstName($user->getFirstName())
        ->setLastName($user->getLastName())
        ->setEmail($user->getEmail())
        ->setUsername($user->getUsername())
        ->setAvatarUrl($user->getAvatarUrl())
        ->setBio($user->getBio())
        ->setRoles($roles);
    $this->response($principal, REST_Controller::HTTP_OK);
  }

  function register_post() {
    $data = $this->post();
    $this->load->model("Service/UserService");
    $statuses = $this->validateUserRegisterInputPost($data);
    if ( !empty($statuses)) {
      $this->response(
        new Status("error_empty_fields", "The input has empty fields", $statuses),
        REST_Controller::HTTP_OK);
    }
    $firstName = $data['firstName'];
    $lastName  = $data['lastName'];
    $email     = $data['email'];
    $username  = $data['username'];
    $password  = $data['password'];

    if (($user = $this->UserService->createUser($firstName, $lastName, $email, $username, $password)) !== null) {
      $this->load->model("Service/MailService");
      $this->MailService->sendActivationEmail($user);
      //$user = $this->UserService->activeRegistration($user->getActivationKey());
      $userStatus[] =
        new Status("account_info", "Account information", $user->toArray());
      $this->response(
        new Status("success_create_account", "Account created successfully", $userStatus),
        REST_Controller::HTTP_CREATED);
    }
    else {
      $this->response(
        new Status("error_create_account", "An error ocurred while creating account", null),
        REST_Controller::HTTP_OK);
    }

  }

  private function validateUserRegisterInputPost($data) {
    $firstName = isset($data['firstName']) ? $data['firstName'] : "";
    $lastName  = isset($data['lastName'])  ? $data['lastName']  : "";
    $email     = isset($data['email'])     ? $data['email']     : "";
    $username  = isset($data['username'])  ? $data['username']  : "";
    $password  = isset($data['password'])  ? $data['password']  : "";
    $statuses = [];

    if (!$firstName || trim($firstName) === '') {
      $statuses[] =
        new Status("error_empty_field_firstName", "First name field can not be empty", null);
    }
    if (!$email || trim($email) === '') {
      $statuses[] =
        new Status("error_empty_field_email", "Email field can not be empty", null);
    }
    if (!$username || trim($username) === '') {
      $statuses[] =
        new Status("error_empty_field_username", "Username field can not be empty", null);
    }
    if (!$password || trim($password) === '') {
      $statuses[] =
        new Status("error_empty_field_password", "Password field can not be empty", null);
    }

    if ( !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $statuses[] =
        new Status("error_invalid_email", "{$email} is not a valid email address", null);
    }
    $user = $this->UserService->findOneByLogin($email);
    if ($user) {
      $statuses[] =
        new Status("error_already_in_use_email", "This email address {$email} is already in use", null);
    }

    $user = $this->UserService->findOneByLogin($username);
    if ($user) {
      $statuses[] =
        new Status("error_already_in_use_username", "This username {$username} is already in use", null);
    }
    return $statuses;
  }

}

?>
