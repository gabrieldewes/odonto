<?php

use Domain\User;

class MailService extends CI_Model {

  function __construct() {
    /*
    $config = Array(
      'protocol'  => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_port' => 465,
      'smtp_user' => getenv("APP_MAIL_DELIVERY_USER"),
      'smtp_pass' => getenv("APP_MAIL_DELIVERY_PASS"),
      'smtp_timeout' => '4',
      'mailtype'  => 'html',
      'charset'   => 'iso-8859-1'
    );
    */
    $config = array(
      'protocol' => 'smtp',
      'smtp_host' => 'smtp.sendgrid.net',
      'smtp_user' => getenv("APP_MAIL_DELIVERY_USER"),
      'smtp_pass' => getenv("APP_MAIL_DELIVERY_PASS"),
      'smtp_post' => 587,
      'smtp_timeout' => 7,
      'crlf' => "\r\n",
      'newline' => "\r\n",
      'mailtype' => 'html',
      'charset' => 'iso-8859-1'
    );
    $this->load->library('email', $config);
  }

  function sendEmail($to, $subject, $html) {
    $html = utf8_decode($html);
    $subject = utf8_decode($subject);
    $this->email->from("dewesapp@gmail.com", 'Dewes Mail Delivery');
    $this->email->to($to);
    $this->email->subject($subject);
    $this->email->message($html);
    $this->email->send();
    $this->email->print_debugger();
  }

  public function sendActivationEmail(User $user) {
    $data = array(
      'name' => trim("{$user->getFirstName()} {$user->getLastName()}"),
      'activationKey' => $user->getActivationKey()
    );
    $html = $this->load->view("emails/activationEmail", $data, true);
    $this->sendEmail($user->getEmail(), "Confirme sua conta", $html);
  }

  public function sendCreateDiagnosticEmail(Domain\Action $action) {
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
    $this->sendEmail($user->getEmail(), "Novo diagnóstico para você", $html);
  }

}

?>
