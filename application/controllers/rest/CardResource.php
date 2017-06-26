<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH ."/libraries/REST_Controller.php";
use Domain\Status;

class CardResource extends REST_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model("Service/CardService");
  }

  function index_get() {
    $userId = $this->_apiuser->user_id;
    $limit = 5;
    $page = $this->input->get("page");
    $offset = $page == 0 ? $page : ($page-1) * $limit;
    $dql = "SELECT c FROM Domain\Card c JOIN c.user u WHERE c.deleted = 0 AND u.id = :userId ORDER BY c.id DESC";
    $query = $this->doctrine->em->createQuery($dql)
                       ->setParameter("userId", $userId)
                       ->setFirstResult($offset)
                       ->setMaxResults($limit);
    $this->response($query->getArrayResult(), REST_Controller::HTTP_OK);
  }

  function index_post() {
    $data = $this->post();
    $whatafield = $data['whatafield'];
    $userId = $this->_apiuser->user_id;

    if (!$whatafield || trim($whatafield) === '') {
      $this->response(new Status("error_empty_field_whatafield", "Whatafield can not be empty", null),
      REST_Controller::HTTP_OK);
    }

    if (($card = $this->CardService->createCardStateless($whatafield, $userId)) != null) {
      $this->response(new Status("create_card", "Card created successfully.", $card->toArray()),
      REST_Controller::HTTP_CREATED);
    }
    else {
      $this->response(
        new Status("error_create_card", "An error ocurred while creating card.", null),
        REST_Controller::HTTP_OK);
    }
    //var_dump($_FILES);
    //file_put_contents("dump.txt", ob_get_flush());
  }

  function archive_get() {
    $userId = $this->_apiuser->user_id;
    $limit = 5;
    $page = $this->input->get("page");
    $offset = $page == 0 ? $page : ($page-1) * $limit;
    $dql = "SELECT c FROM Domain\Card c JOIN c.user u WHERE c.deleted = 1 AND u.id = :userId ORDER BY c.id DESC";
    $query = $this->doctrine->em->createQuery($dql)
                       ->setParameter("userId", $userId)
                       ->setFirstResult($offset)
                       ->setMaxResults($limit);
    $this->response($query->getArrayResult(), REST_Controller::HTTP_OK);
  }

  function archive_put($cardId) {
    $card = $this->CardService->findById($cardId);
    if (!$card)
      $this->response(
          new Status("card_not_found", "Card not found with id \"{$cardId}\""),
          REST_Controller::HTTP_OK);

    $archive = $this->put()[0];

    if ($archive === true) {
      $card = $this->CardService->archiveCard($card);
      if ($card) {
        $this->response(
          new Status("archive_card", "Card archived", $card->toArray()),
          REST_Controller::HTTP_OK);
      }
      else {
        $this->response(
          new Status("error_archive_card", "An error ocurred while archiving the card", null),
          REST_Controller::HTTP_OK);
      }
    }
    else if ($archive === false) {
      $card = $this->CardService->recoverCard($card);
      if ($card) {
        $this->response(
          new Status("recover_card", "Card recovered", $card->toArray()),
          REST_Controller::HTTP_OK);
      }
      else {
        $this->response(
          new Status("error_recover_card", "An error ocurred while retrieving the card.", null),
          REST_Controller::HTTP_OK);
      }
    }

  }

  function cards_get($cardId) {
    $card = $this->CardService->findById($cardId);
    if (!$card)
      $this->response(
        new Status("card_not_found", "Card not found with id \"{$cardId}\"", null), REST_Controller::HTTP_OK);

    $this->response($card->toArray(), REST_Controller::HTTP_OK);
  }

  function attachments_get($cardId) {
    //$dql = "SELECT a FROM Domain\Attachment a JOIN a.card c JOIN c.user u WHERE c.id = :cardId AND u.id = :userId";
    $dql = "SELECT a FROM Domain\Attachment a JOIN a.card c WHERE c.id = :cardId";
    $query = $this->doctrine->em
            ->createQuery($dql)
            ->setParameter("cardId", $cardId)
            /*->setParameter("userId", $this->userId)*/;
    $this->response($query->getArrayResult(), REST_Controller::HTTP_OK);
  }

}


?>
