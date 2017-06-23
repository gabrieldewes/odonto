<?php

namespace Domain;

/**
 * Action
 *
 * @Table(name="action", indexes={@Index(name="fk_action_card1_idx", columns={"card_id"})})
 * @Entity
 */
class Action extends AbstractEntity
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
     * @Column(name="action_type", type="string", length=45, nullable=true)
     */
    private $actionType;

    /**
     * @var string
     *
     * @Column(name="whatafield", type="text", length=65535, nullable=true)
     */
    private $whatafield;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ManyToMany(targetEntity="Card", mappedBy="action")
     */
    private $card;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ManyToMany(targetEntity="User", mappedBy="action")
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ManyToMany(targetEntity="Attachment", inversedBy="action", cascade="persist")
     * @JoinTable(name="action_has_attachment",
     *   joinColumns={
     *     @JoinColumn(name="action_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @JoinColumn(name="attachment_id", referencedColumnName="id")
     *   }
     * )
     */
    private $attachment;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->attachment = new \Doctrine\Common\Collections\ArrayCollection();
        $this->card = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set actionType
     *
     * @param string $actionType
     *
     * @return Action
     */
    public function setActionType($actionType)
    {
        $this->actionType = $actionType;

        return $this;
    }

    /**
     * Get actionType
     *
     * @return string
     */
    public function getActionType()
    {
        return $this->actionType;
    }

    /**
     * Set whatafield
     *
     * @param string $whatafield
     *
     * @return Action
     */
    public function setWhatafield($whatafield)
    {
        $this->whatafield = $whatafield;

        return $this;
    }

    /**
     * Get whatafield
     *
     * @return string
     */
    public function getWhatafield()
    {
        return $this->whatafield;
    }

    /**
     * Add card
     *
     * @param Card $card
     *
     * @return Action
     */
    public function addCard(Card $card)
    {
        $card->addAction($this);
        $this->card[] = $card;

        return $this;
    }

    /**
     * Remove card
     *
     * @param Card $card
     */
    public function removeCard(Card $card)
    {
        $card->removeAction($this);
        $this->card->removeElement($card);
    }

    /**
     * Get card
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCard()
    {
        return $this->card;
    }
    /**
     * Add user
     *
     * @param \User $user
     *
     * @return Action
     */
    public function addUser(User $user)
    {
        $user->addAction($this);
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \User $user
     */
    public function removeUser(User $user)
    {
        $user->removeAction($this);
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add attachment
     *
     * @param \Attachment $attachment
     *
     * @return Action
     */
    public function addAttachment(Attachment $attachment)
    {
        $this->attachment[] = $attachment;

        return $this;
    }

    /**
     * Remove attachment
     *
     * @param \Attachment $attachment
     */
    public function removeAttachment(Attachment $attachment)
    {
        $this->attachment->removeElement($attachment);
    }

    /**
     * Get attachment
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    public function toArray() {
      return [
        'id' => $this->id,
        'actionType' => $this->actionType,
        'whatafield' => $this->whatafield,
        'user' => $this->user[0]->toArray(),
        'deleted' => $this->getDeleted(),
        'createdBy' => $this->getCreatedBy(),
        'createdAt' => $this->getCreatedAt(),
        'lastModifiedBy' => $this->getLastModifiedBy(),
        'lastModifiedAt' => $this->getLastModifiedAt()
      ];
    }
}
