<?php

use Domain\Authority;

class AuthorityRepository extends CI_Model {
  var $repo;

  function __construct() {
    $this->repo = $this->doctrine->em->getRepository("Domain\Authority");
  }

  function findAll() {
    return $this->repo->findAll();
  }

  function findOneById($id) {
    return $this->repo->findOneBy(array("id" => $id));
  }

  function findOneByName($name) {
    return $this->repo->findOneBy(array("name" => $name));
  }
}

?>
