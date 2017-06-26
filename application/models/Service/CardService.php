<?php

use Domain\Card,
    Domain\Attachment;
use Doctrine\ORM\Tools\Pagination\Paginator;

class CardService extends CI_Model {

  var $em;
  var $repo;

  function __construct() {
    parent::__construct();
    $this->em = $this->doctrine->em;
    $this->repo = $this->em->getRepository("Domain\Card");
  }

  public function findAll($page, $limit) {
    $offset = $page == 0 ? $page : ($page-1) * $limit;
    $query = $this->em->createQuery("SELECT c FROM Domain\Card c ORDER BY c.id DESC")
                       ->setFirstResult($offset)
                       ->setMaxResults($limit);
    return new Paginator($query, $fetchJoinCollection = true);
  }

  public function findAllDiagnosedByCurrentUser($page, $limit) {
    $offset = $page == 0 ? $page : ($page-1) * $limit;
    $currUserId = $this->AuthService->getCurrentUserId();
    $dql = "SELECT c FROM Domain\Card c
              JOIN c.action a
              JOIN a.user u
              WHERE c.deleted = 0
              AND u.id = :userId
              AND a.actionType = 'ACTION_DIAGNOSTIC'
              ORDER BY c.id DESC";
    $query = $this->em->createQuery($dql)
                       ->setParameter("userId", $currUserId)
                       ->setFirstResult($offset)
                       ->setMaxResults($limit);
    return new Paginator($query, $fetchJoinCollection = true);
  }

  public function findAllPendingByCurrentUser($page, $limit) {
    $offset = $page == 0 ? $page : ($page-1) * $limit;
    $currUserId = $this->AuthService->getCurrentUserId();
    $dql = "SELECT c FROM Domain\Card c
              LEFT JOIN c.action a
              LEFT JOIN a.user u
              WHERE c.deleted = 0
              AND a.id IS NULL
              OR (a.id IS NOT NULL AND u.id != :userId)
              AND u.id = :userId
              ORDER BY c.id DESC";
    $query = $this->em->createQuery($dql)
                       ->setParameter("userId", $currUserId)
                       ->setFirstResult($offset)
                       ->setMaxResults($limit);
    return new Paginator($query, $fetchJoinCollection = true);
  }

  public function findByCurrentUser($page, $limit) {
    $offset = $page == 0 ? $page : ($page-1) * $limit;
    $currUserId = $this->AuthService->getCurrentUserId();
    $dql = "SELECT c FROM Domain\Card c
              JOIN c.user u
              WHERE c.deleted = 0
              AND u.id = :userId
              ORDER BY c.id DESC";
    $query = $this->em->createQuery($dql)
                       ->setParameter("userId", $currUserId)
                       ->setFirstResult($offset)
                       ->setMaxResults($limit);
    return new Paginator($query, $fetchJoinCollection = false);
  }

  public function findArchivedByCurrentUser($page, $limit) {
    $offset = $page == 0 ? $page : ($page-1) * $limit;
    $currUserId = $this->AuthService->getCurrentUserId();
    $dql = "SELECT c FROM Domain\Card c
              JOIN c.user u
              WHERE c.deleted = 1
              AND u.id = :userId
              ORDER BY c.id DESC";
    $query = $this->em->createQuery($dql)
                       ->setParameter("userId", $currUserId)
                       ->setFirstResult($offset)
                       ->setMaxResults($limit);
    return new Paginator($query, $fetchJoinCollection = false);
  }

  public function findById($id) {
    return $this->repo->find($id);
  }

  public function createCard($whatafield) {
    $this->load->model("Service/AttachmentService");
    //$this->load->model("Service/ActionService");
    $currUser = $this->AuthService->getCurrentUser();
    $card = new Card();
    $card->setWhatafield(ucfirst($whatafield))
         ->setUser($currUser)
         //->addAction($this->ActionService->onCreateCard($card))
         ->setCreatedBy($currUser->getUsername())
         ->setCreatedAt()
         ->setLastModifiedBy($currUser->getUsername())
         ->setLastModifiedAt()
         ->setDeleted(false);
    $this->em->persist($card);
    $this->em->flush();
    $attachs = $this->AttachmentService->createAttachments($currUser, $card);
    if (!empty($attachs)) {
      foreach ($attachs as $index => $attach) {
        $card->addAttachment($attach);
      }
      $this->em->persist($card);
      $this->em->flush();
    }
    return $card;
  }

  public function archiveCard(Domain\Card $card) {
    $card->setDeleted(true);

    foreach ($card->getAttachment() as $key => $attach) {
      $attach->setDeleted(true);
    }

    foreach ($card->getAction() as $key => $action) {
      $action->setDeleted(true);
    }

    $this->em->persist($card);
    $this->em->flush();
    return $card;
  }

  public function recoverCard(Domain\Card $card) {
    $card->setDeleted(false);

    foreach ($card->getAttachment() as $key => $attach) {
      $attach->setDeleted(false);
    }

    foreach ($card->getAction() as $key => $action) {
      $action->setDeleted(false);
    }

    $this->em->persist($card);
    $this->em->flush();
    return $card;
  }

  public function createCardStateless($whatafield, $userId) {
    //$this->load->model("Service/AttachmentService");
    $this->load->model("Service/UserService");
    //$this->load->model("Service/ActionService");
    $currUser = $this->UserService->findById($userId);
    if (!$currUser) return null;
    $card = new Card();
    $card->setWhatafield(ucfirst($whatafield))
         ->setUser($currUser)
         //->addAction($this->ActionService->onCreateCard($card))
         ->setCreatedBy($currUser->getUsername())
         ->setCreatedAt()
         ->setLastModifiedBy($currUser->getUsername())
         ->setLastModifiedAt()
         ->setDeleted(false);
    $this->em->persist($card);
    $this->em->flush();
    /*
    $attachs = $this->AttachmentService->createAttachments($currUser, $card);
    if (!empty($attachs)) {
      foreach ($attachs as $index => $attach) {
        $card->addAttachment($attach);
      }
      $this->em->persist($card);
      $this->em->flush();
    }
    */
    return $card;
  }

}

?>
