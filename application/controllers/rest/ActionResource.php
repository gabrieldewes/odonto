<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH ."/libraries/REST_Controller.php";
use Domain\Status;

class ActionResource extends REST_Controller {

  function __construct() {
    parent::__construct();
  }

  function index_get($cardId) {
    $userId = $this->_apiuser->user_id;
    $limit = 5;
    $page = $this->input->get("page");
    $offset = $page == 0 ? $page : ($page-1) * $limit;
    $dql = "SELECT a FROM Domain\Action a JOIN a.card c JOIN c.user u WHERE c.id = :cardId AND u.id = :userId ORDER BY a.id DESC";
    $query = $this->doctrine->em
            ->createQuery($dql)
            ->setParameter("cardId", $cardId)
            ->setParameter("userId", $userId)
            ->setFirstResult($offset)
            ->setMaxResults($limit);
    $actions = $this->_toArray($query->getResult());
    $this->response($actions, REST_Controller::HTTP_OK);
  }

  function actions_get($cardId, $actionId) {
    /*
    $this->load->model("Service/ActionService");
    $action = $this->ActionService->findById($actionId);
    if (!$action)
      $this->response(
        new Status("action_not_found", "Action not found with id {$actionId}.", null), 400);
    */
    $userId = $this->_apiuser->user_id;
    $dql = "SELECT a FROM Domain\Action a JOIN a.card c JOIN c.user u WHERE a.id = :actionId AND c.id = :cardId AND u.id = :userId";
    $query = $this->doctrine->em
            ->createQuery($dql)
            ->setParameter("actionId", $actionId)
            ->setParameter("cardId", $cardId)
            ->setParameter("userId", $userId);
    try {
      $action = $query->getsingleResult();
      $this->response($action->toArray(), REST_Controller::HTTP_OK);
    }
    catch (\Doctrine\ORM\NoResultException $e) {
      $this->response(
        new Status("action_not_found", "Action not found with id {$actionId} for card with id {$cardId}", null),
        REST_Controller::HTTP_OK);
    }
  }

  function attachments_get($actionId) {
    $dql = "SELECT a FROM Domain\Attachment a JOIN a.action c WHERE c.id = :id";
    $query = $this->doctrine->em
            ->createQuery($dql)
            ->setParameter("id", $actionId);
    $attachments = $this->_toArray($query->getResult());
    $this->response($attachments, REST_Controller::HTTP_OK);
  }

  private function _toArray($result) {
    $array=[];
    foreach ($result as $key => $domain) {
      $array[] = $domain->toArray();
    }
    return $array;
  }

}


?>
