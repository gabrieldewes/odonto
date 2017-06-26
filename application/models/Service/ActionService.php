<?php

use Domain\Action;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ActionService extends CI_Model {

  var $em;
  var $repo;

  function __construct() {
    parent::__construct();
    $this->em = $this->doctrine->em;
    $this->repo = $this->em->getRepository("Domain\Action");
  }

  public function findAll($page, $limit) {
    $offset = $page == 0 ? $page : ($page-1) * $limit;
    $query = $this->em->createQuery("SELECT a FROM Domain\Action a")
                       ->setFirstResult($offset)
                       ->setMaxResults($limit);
    return new Paginator($query, $fetchJoinCollection = true);
  }

  public function findByIdAndCardId($cardId, $actionId) {
      $dql = "SELECT a FROM Domain\Action a
            JOIN a.card c
            WHERE c.id = :cardId
            AND a.id = :actionId
            ORDER BY a.id DESC";
      $query = $this->em->createQuery($dql)
                        ->setParameter("cardId", $cardId)
                        ->setParameter("actionId", $actionId);
      try {
        return $query->getSingleResult();
      }
      catch(\Doctrine\ORM\NoResultException $e) {
        throw new Exception("The action with id {$actionId} not belongs to card with id {$cardId}.");
      }
  }

  public function findByActionTypeAndCardId($actionType, $cardId) {
      $dql = "SELECT a FROM Domain\Action a
            JOIN a.card c
            WHERE a.actionType = 'ACTION_DIAGNOSTIC'
            AND c.id = :cardId
            ORDER BY a.id DESC";
      $query = $this->em->createQuery($dql)
                        ->setParameter("cardId", $cardId);
      return $query->getResult();
  }

  public function count() {
    return $this->db->count_all("action");
  }

  public function findByActionType($actionType) {
    return $this->repo->findBy(array("actionType" => $actionType));
  }

  public function findById($id) {
    return $this->repo->find($id);
  }

  public function createAction($whatafield, $actionType, $cardId) {
    $this->load->model("Service/UserService");
    $this->load->model("Service/AttachmentService");
    $currUser = $this->AuthService->getCurrentUser();
    $action = new Action();
    $action->setWhatafield(ucfirst($whatafield))
           ->setActionType($actionType)
           ->addCard($this->em->find("Domain\Card", $cardId))
           ->addUser($currUser)
           ->setCreatedBy($currUser->getUsername())
           ->setCreatedAt()
           ->setLastModifiedBy($currUser->getUsername())
           ->setLastModifiedAt()
           ->setDeleted(false);
    $this->em->persist($action);
    $this->em->flush();
    $attachs = $this->AttachmentService->createAttachments($currUser, $action);
    if (!empty($attachs)) {
      foreach ($attachs as $index => $attach) {
        $action->addAttachment($attach);
      }
      $this->em->persist($action);
      $this->em->flush();
    }
    return $action;
  }

  public function onCreateCard(Domain\Card $card) {
    $this->load->model("Service/UserService");
    $currUser = $this->AuthService->getCurrentUser();
    if (!$currUser) throw new Exception("Error retrieving current User.");
    $action = new Action();
    $action->setWhatafield("{$currUser->getFirstName()} criou uma nova consulta")
           ->setActionType("ACTION_CREATE_CARD")
           ->addCard($card)
           ->addUser($currUser)
           ->setCreatedBy($currUser->getUsername())
           ->setCreatedAt()
           ->setLastModifiedBy($currUser->getUsername())
           ->setLastModifiedAt()
           ->setDeleted(false);
    //$this->em->persist($action);
    //$this->em->flush();
    return $action;
  }

}

?>
