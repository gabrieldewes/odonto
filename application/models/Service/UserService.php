<?php

use Domain\User,
    Domain\Authority;
use Doctrine\ORM\Tools\Pagination\Paginator;

class UserService extends CI_Model {

  var $repo;
  var $em;

  function __construct() {
    parent::__construct();
    $this->em = $this->doctrine->em;
    $this->repo = $this->em->getRepository("Domain\User");
  }

  public function findAll($page, $limit) {
    $offset = $page == 0 ? $page : ($page-1) * $limit;
    $query = $this->em->createQuery("SELECT u FROM Domain\User u")
                       ->setFirstResult($offset)
                       ->setMaxResults($limit);
    return new Paginator($query, $fetchJoinCollection = true);
  }

  public function createUser($firstName, $lastName, $email, $username, $password) {
    $this->load->model("Repository/AuthorityRepository");
    $user = new User();
    $encriptedPassword = password_hash($password, PASSWORD_BCRYPT);
    $authority = $this->AuthorityRepository->findOneByName("ROLE_USER");
    $currUserUsername = "system";
    $g=["women","men"];
    $user->setFirstName($this->titleCase($firstName))
         ->setLastName($this->titleCase($lastName))
         ->setEmail(strtolower($email))
         ->setUsername(strtolower($username))
         ->setPassword($encriptedPassword)
         ->setActivationKey(uniqid())
         ->setActive(false)
         ->addAuthority($authority)
         ->setAvatarUrl("https://randomuser.me/api/portraits/". $g[rand(0,1)] ."/". rand(0,99) .".jpg")
         ->setBio("")
         ->setCreatedBy($currUserUsername)
         ->setCreatedAt()
         ->setLastModifiedBy($currUserUsername)
         ->setLastModifiedAt()
         ->setDeleted(false);
    $this->em->persist($user);
    $this->em->flush();
    return $user;
  }

  public function findOneByLogin($login) {
    $qb = $this->repo->createQueryBuilder('u');
    $qb->select('u')
      ->where($qb->expr()->orX(
          $qb->expr()->eq('u.email', ':login'),
          $qb->expr()->eq('u.username', ':login'))
      )->setParameter('login', $login);
    try {
      return $qb->getQuery()->getSingleResult();
    }
    catch(\Doctrine\ORM\NoResultException $e) {
      return null;
    }
  }

  public function findById($id) {
    return $this->repo->find($id);
  }

  public function activeRegistration($activationKey) {
    $user = $this->repo->findOneBy(array("activationKey" => $activationKey));
    if ($user != null) {
      $user->setActive(true)
           ->setActivationKey(null);
      $this->em->persist($user);
      $this->em->flush();
      return $user;
    }
    else
      throw new Exception("User not found with activationKey \"{$activationKey}\".");
    return null;
  }

  public function delete($id) {
    $user = $this->findById($id);
    if ($user) {
      $this->em->remove($user);
      $this->em->flush();
      return true;
    }
    return false;
  }

  function titleCase($string,
                $delimiters = array(" ", "-", ".", "'", "O'", "Mc"),
                $exceptions = array(
                  "de", "da", "dos", "das", "do",
                  "I", "II", "III", "IV", "V", "VI")) {

    $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
    foreach ($delimiters as $dlnr => $delimiter) {
      $words = explode($delimiter, $string);
      $newwords = array();
      foreach ($words as $wordnr => $word) {
        if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
          $word = mb_strtoupper($word, "UTF-8");
        }
        elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
          $word = mb_strtolower($word, "UTF-8");
        }
        elseif (!in_array($word, $exceptions)) {
          $word = ucfirst($word);
        }
        array_push($newwords, $word);
      }
      $string = join($delimiter, $newwords);
    }
    return $string;
  }

}

?>
