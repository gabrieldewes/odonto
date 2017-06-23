<?php

namespace Domain;

/** @MappedSuperclass */
class AbstractEntity {

  /**
   * @var string
   * @Column(name="created_by", type="string", length=75, nullable=false)
   */
  private $createdBy;

  /**
   * @var \DateTime
   * @Column(name="created_at", type="datetime", nullable=false)
   */
  private $createdAt;

  /**
   * @var string
   * @Column(name="last_modified_by", type="string", length=75, nullable=false)
   */
  private $lastModifiedBy;

  /**
   * @var \DateTime
   * @Column(name="last_modified_at", type="datetime", nullable=false)
   */
  private $lastModifiedAt;

  /**
   * @var boolean
   * @Column(name="deleted", type="boolean", nullable=true)
   */
  private $deleted;

  /**
   * Constructor
   */
  function __construct() {

  }

  /**
   * Set createdBy
   * @param string $createdBy
   * @return User
   */
  public function setCreatedBy($createdBy) {
      $this->createdBy = $createdBy;
      return $this;
  }

  /**
   * Get createdBy
   * @return string
   */
  public function getCreatedBy() {
      return $this->createdBy;
  }

  /**
   * Set createdAt
   * @param \DateTime $createdAt
   * @return User
   */
  public function setCreatedAt() {
      $this->createdAt = new \DateTime("now");
      return $this;
  }

  /**
   * Get createdAt
   * @return \DateTime
   */
  public function getCreatedAt() {
      return $this->createdAt;
  }

  /**
   * Set lastModifiedBy
   * @param string $lastModifiedBy
   * @return User
   */
  public function setLastModifiedBy($lastModifiedBy) {
      $this->lastModifiedBy = $lastModifiedBy;
      return $this;
  }

  /**
   * Get lastModifiedBy
   * @return string
   */
  public function getLastModifiedBy() {
      return $this->lastModifiedBy;
  }

  /**
   * Set lastModifiedAt
   * @param \DateTime $lastModifiedAt
   * @return User
   */
  public function setLastModifiedAt() {
      $this->lastModifiedAt = new \DateTime("now");
      return $this;
  }

  /**
   * Get lastModifiedAt
   * @return \DateTime
   */
  public function getLastModifiedAt() {
      return $this->lastModifiedAt;
  }

  /**
   * Set deleted
   * @param boolean $deleted
   * @return User
   */
  public function setDeleted($deleted) {
      $this->deleted = $deleted;
      return $this;
  }

  /**
   * Get deleted
   * @return boolean
   */
  public function getDeleted() {
      return $this->deleted;
  }

}

?>
