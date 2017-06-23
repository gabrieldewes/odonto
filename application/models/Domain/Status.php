<?php

namespace Domain;

class Status implements \JsonSerializable {
  private $status;
  private $message;
  private $data;

  public function __construct($status, $message, $data) {
    $this->status = $status;
    $this->message = $message;
    $this->data = $data;
  }

  public function jsonSerialize() {
    $vars = get_object_vars($this);
    return $vars;
  }

  public function getStatus() {
    return $this->status;
  }

  public function setStatus($status) {
    $this->status = $status;
    return $this;
  }

  public function getMessage() {
    return $this->message;
  }

  public function setMessage($message) {
    $this->message = $message;
    return $this;
  }

  public function getData() {
    return $this->data;
  }

  public function setData($data) {
    $this->data = $data;
    return $this;
  }

}

?>
