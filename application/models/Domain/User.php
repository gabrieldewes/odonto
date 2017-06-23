<?php

namespace Domain;

/**
 * User
 *
 * @Table(name="user")
 * @Entity
 */
class User extends AbstractEntity
{
    /**
     * @var integer
     *
     * @Column(name="id", type="bigint", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @Column(name="first_name", type="string", length=75, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @Column(name="last_name", type="string", length=75, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @Column(name="username", type="string", length=75, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @Column(name="email", type="string", length=75, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @Column(name="password", type="string", length=75, nullable=true)
     */
    private $password;

    /**
     * @var boolean
     *
     * @Column(name="active", type="boolean", nullable=true)
     */
    private $active;

    /**
     * @var string
     *
     * @Column(name="activation_key", type="string", length=75, nullable=true)
     */
    private $activationKey;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ManyToMany(targetEntity="Action", inversedBy="user")
     * @JoinTable(name="user_has_action",
     *   joinColumns={
     *     @JoinColumn(name="user_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @JoinColumn(name="action_id", referencedColumnName="id")
     *   }
     * )
     */
    private $action;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ManyToMany(targetEntity="Authority", inversedBy="user")
     * @JoinTable(name="user_has_authority",
     *   joinColumns={
     *     @JoinColumn(name="user_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @JoinColumn(name="authority_id", referencedColumnName="id")
     *   }
     * )
     */
    private $authority;

    /**
     * Constructor
     */
    public function __construct()
    {
      parent::__construct();
      $this->action = new \Doctrine\Common\Collections\ArrayCollection();
      $this->authority = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public static function fill($line) {
      $user = new User();
      $user->setId($line->id)
           ->setFirstName($line->first_name)
           ->setLastName($line->last_name)
           ->setUsername($line->username)
           ->setEmail($line->email)
           ->setCreatedBy($line->created_by)
           ->setCreatedAt($line->created_at)
           ->setLastModifiedBy($line->last_modified_by)
           ->setLastModifiedAt($line->last_modified_at)
           ->setDeleted($line->deleted)
           ->setActive($line->active);
       return $user;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Action
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set activationKey
     *
     * @param string $activationKey
     *
     * @return User
     */
    public function setActivationKey($activationKey)
    {
        $this->activationKey = $activationKey;

        return $this;
    }

    /**
     * Get activationKey
     *
     * @return string
     */
    public function getActivationKey()
    {
        return $this->activationKey;
    }

    /**
     * Add action
     *
     * @param \Action $action
     *
     * @return User
     */
    public function addAction(Action $action)
    {
        $this->action[] = $action;

        return $this;
    }

    /**
     * Remove action
     *
     * @param \Action $action
     */
    public function removeAction(Action $action)
    {
        $this->action->removeElement($action);
    }

    /**
     * Get action
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Add authority
     *
     * @param \Authority $authority
     *
     * @return User
     */
    public function addAuthority(Authority $authority)
    {
        $this->authority[] = $authority;

        return $this;
    }

    /**
     * Remove authority
     *
     * @param \Authority $authority
     */
    public function removeAuthority(Authority $authority)
    {
        $this->authority->removeElement($authority);
    }

    /**
     * Get authority
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuthority()
    {
        return $this->authority;
    }

    public function toArray() {
      return [
        'id' => $this->id,
        'firstName' => $this->firstName,
        'lastName' => $this->lastName,
        'email' => $this->email,
        'username' => $this->username,
        'password' => null,
        'deleted' => $this->getDeleted(),
        'createdBy' => $this->getCreatedBy(),
        'createdAt' => $this->getCreatedAt(),
        'lastModifiedBy' => $this->getLastModifiedBy(),
        'lastModifiedAt' => $this->getLastModifiedAt()
      ];
    }

}
