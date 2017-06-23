<?php

class AlertHelper extends CI_Model {

  public function unsetAlert() {
    $this->session->set_flashdata(null);
  }

  public function createWelcomeAlert($name) {
    $alert = self::createAlert("Bem vindo, ". $name ."!", "success");
    $this->session->set_flashdata("alert", $alert);
  }

  public function createLoginErrorAlert() {
    $alert = self::createAlert("Credenciais incorretas.", "danger");
    $this->session->set_flashdata("alert", $alert);
  }

  public function createLoggedOutAlert() {
    $alert = self::createAlert("Você foi desconectado.", "info");
    $this->session->set_flashdata("alert", $alert);
  }

  public function createAlreadyLoggedOutAlert() {
    $alert = self::createAlert("Não há sessão.", "info");
    $this->session->set_flashdata("alert", $alert);
  }

  public function createRegisterAccountAlert() {
    $alert = self::createAlert("Sua conta foi criada. Por favor, verifique seu e-mail.", "success");
    $this->session->set_flashdata("alert", $alert);
  }

  public function createRegisterAccountErrorAlert() {
    $alert = self::createAlert("Ocorreu algum problema ao criar sua conta.", "danger");
    $this->session->set_flashdata("alert", $alert);
  }

  public function createActivateAccountAlert() {
    $alert = self::createAlert("Sua conta foi ativada. Agora você pode fazer login.", "success");
    $this->session->set_flashdata("alert", $alert);
  }

  public function createActivateAccountErrorAlert() {
    $alert = self::createAlert("Ocorreu um problema ao ativar sua conta.", "danger");
    $this->session->set_flashdata("alert", $alert);
  }

  public static function createAlert($message, $type) {
    $alert = "<div class='alert alert-". $type ." alert-dismissible' role='alert'>"
                ."<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"
                . $message
            ."</div>";
    return $alert;
  }
}

?>
