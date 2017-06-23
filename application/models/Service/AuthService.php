<?php

use Domain\User,
    Domain\Authority,
    Domain\Principal;

class AuthService extends CI_Model {

  function __construct() {
    parent::__construct();
    $this->load->model("Service/UserService");
  }

  public function authenticate($login, $password) {
    $lowerCaseLogin = strtolower($login);
    $user = $this->UserService->findOneByLogin($lowerCaseLogin);
    if ($user == null)
      return null;

    if (!$user->getActive())
      return null;

    if ( !password_verify($password, $user->getPassword()))
      return null;

    $principal = new Principal();
    foreach ($user->getAuthority() as $i => $authority) {
      $principal->addRole($authority->getName());
    }
    $principal->setId($user->getId())
              ->setFirstName($user->getFirstName())
              ->setLastName($user->getLastName())
              ->setUsername($user->getUsername())
              ->setEmail($user->getEmail());
    $this->session->set_userdata("principal", $principal);
    return $principal;
  }

  public function logout() {
    if ($this->session->has_userdata("principal")) {
      $this->session->unset_userdata("principal");
      return true;
    }
    return false;
  }

  public function hasRole($role) {
    $principal = $this->getPrincipal();
    if ($principal != null) {
      foreach ($principal->getRoles() as $i => $r) {
        if ($r === $role)
          return true;
      }
    }
    return false;
  }

  public function getPrincipal() {
    if ($this->session->has_userdata("principal")) {
      return $this->session->userdata("principal");
    }
    return null;
  }

  public function isAuthenticated() {
    return $this->session->has_userdata("principal");
  }

  public function isAnnonymous() {
    return !$this->session->has_userdata("principal");
  }

  public function getCurrentUser() {
    return $this->UserService->findById($this->getCurrentUserId());
  }

  public function getCurrentUserUsername() {
    if ($this->session->has_userdata("principal")) {
      $principal = $this->session->userdata("principal");
      return $principal->getUsername();
    }
    return "annonymous";
  }

  public function getCurrentUserId() {
    if ($this->session->has_userdata("principal")) {
      $principal = $this->session->userdata("principal");
      return $principal->getId();
    }
    return -1;
  }
}

?>
