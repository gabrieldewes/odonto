<?php

namespace Domain;

class Principal implements \JsonSerializable {
  private $id;
  private $firstName;
  private $lastName;
  private $email;
  private $username;
  private $avatarUrl;
  private $bio;
  private $roles;

  public function __construct($id=null, $firstName=null, $lastName=null, $email=null, $username=null, $avatarUrl=null, $bio=null, $roles=null) {
    $this->id = $id;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->email = $email;
    $this->username = $username;
    $this->avatarUrl = $avatarUrl;
    $this->bio = $bio;
    $this->roles = $roles;
  }

  public function jsonSerialize() {
    $vars = get_object_vars($this);
    return $vars;
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  public function getFirstName() {
    return $this->firstName;
  }

  public function setFirstName($firstName) {
    $this->firstName = $firstName;
    return $this;
  }

  public function getLastName() {
    return $this->lastName;
  }

  public function setLastName($lastName) {
    $this->lastName = $lastName;
    return $this;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setEmail($email) {
    $this->email = $email;
    return $this;
  }

  public function getUsername() {
    return $this->username;
  }

  public function setUsername($username) {
    $this->username = $username;
    return $this;
  }

  public function getAvatarUrl() {
    return $this->avatarUrl;
  }

  public function setAvatarUrl($avatarUrl) {
    $this->avatarUrl = $avatarUrl;
    return $this;
  }

  public function getBio() {
    return $this->bio;
  }

  public function setBio($bio) {
    $this->bio = $bio;
    return $this;
  }

  public function addRole($role) {
    $this->roles[] = $role;
    return $this;
  }

  public function getRoles() {
    return $this->roles;
  }

  public function setRoles($roles) {
    $this->roles = $roles;
    return $this;
  }

}

?>
