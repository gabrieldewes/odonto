<?php

namespace Domain;

/**
 * Card
 *
 * @Table(name="card")
 * @Entity
 */
class Card extends AbstractEntity
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
     * @Column(name="whatafield", type="text", length=65535, nullable=true)
     */
    private $whatafield;

    /**
     * @var string
     *
     * @Column(name="thumb_url", type="string", length=255, nullable=true)
     */
    private $thumbUrl;

    /**
     * @var \User
     *
     * @ManyToOne(targetEntity="User")
     * @JoinColumns({
     *   @JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ManyToMany(targetEntity="Action", inversedBy="card", cascade="persist")
     * @JoinTable(name="card_has_action",
     *   joinColumns={
     *     @JoinColumn(name="card_id", referencedColumnName="id")
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
     * @ManyToMany(targetEntity="Attachment", inversedBy="card", cascade="persist")
     * @JoinTable(name="card_has_attachment",
     *   joinColumns={
     *     @JoinColumn(name="card_id", referencedColumnName="id")
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
        $this->action = new \Doctrine\Common\Collections\ArrayCollection();
        $this->attachment = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set whatafield
     *
     * @param string $whatafield
     *
     * @return Card
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
     * Set thumbUrl
     *
     * @param string $thumbUrl
     *
     * @return Card
     */
    public function setThumbUrl($thumbUrl)
    {
        $this->thumbUrl = $thumbUrl;

        return $this;
    }

    /**
     * Get thumbUrl
     *
     * @return string
     */
    public function getThumbUrl()
    {
        return $this->thumbUrl;
    }

    /**
     * Set user
     *
     * @param \User $user
     *
     * @return Card
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add action
     *
     * @param Action $action
     *
     * @return Card
     */
    public function addAction(Action $action)
    {
        $this->action[] = $action;

        return $this;
    }

    /**
     * Remove action
     *
     * @param Action $action
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
     * Add attachment
     *
     * @param \Attachment $attachment
     *
     * @return Card
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
        'whatafield' => $this->whatafield,
        'thumbUrl' => $this->thumbUrl,
        'deleted' => $this->getDeleted(),
        'createdBy' => $this->getCreatedBy(),
        'createdAt' => $this->getCreatedAt(),
        'lastModifiedBy' => $this->getLastModifiedBy(),
        'lastModifiedAt' => $this->getLastModifiedAt()
      ];
    }

}
