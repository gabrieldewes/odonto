<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH ."/libraries/REST_Controller.php";
use Domain\Status;

class DefaultResource extends REST_Controller {

  function __construct() {
    parent::__construct();
  }

  function index_get() {
    $proxy = $_SERVER["REMOTE_ADDR"];
    $host = gethostbyaddr($proxy);
    $this->response(
      new Status("greetings", "Hello {$host}"), REST_Controller::HTTP_OK);
  }

}

?>
