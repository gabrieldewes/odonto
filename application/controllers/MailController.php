<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MailController extends CI_Controller {

  function __construct() {
    parent::__construct();
    if (!$this->AuthService->hasRole("ROLE_ADMIN"))
      redirect("/");
  }

  function seeTemplates() {
    echo "<b>Create account activation email</b><br>";
    $this->activeRegistrationEmail();
    echo "<br><b>Create diagnostic notification email</b><br>";
    $this->createDiagnosticEmail();
  }

  function activeRegistrationEmail() {
    $this->load->model("Service/UserService");
    $user = $this->UserService->findById(1);
    $data = array(
      'name' => trim("{$user->getFirstName()} {$user->getLastName()}"),
      'activationKey' => $user->getActivationKey()
    );
    $html = $this->load->view("emails/activationEmail", $data, true);
    echo $html;
  }

  function createDiagnosticEmail() {
    $this->load->model("Service/ActionService");
    $action = $this->ActionService->findById(1);
    $card = $action->getCard()[0];
    $user = $card->getUser();
    $data = array(
      "name" => trim("{$user->getFirstName()} {$user->getLastName()}"),
      "cardId" => $card->getId(),
      "actionId" => $action->getId(),
      "cardWhatafield" => $card->getWhatafield(),
      "actionWhatafield" => $action->getWhatafield()
    );
    $html = $this->load->view("emails/createDiagnosticEmail", $data, true);
    echo $html;
  }
}

?>
