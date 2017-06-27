<?php

namespace Domain;

/**
 * Attachment
 *
 * @Table(name="attachment")
 * @Entity
 */
class Attachment extends AbstractEntity
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
     * @Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @Column(name="thumb_url", type="string", length=255, nullable=true)
     */
    private $thumbUrl;

    /**
     * @var string
     *
     * @Column(name="alt", type="text", length=65535, nullable=true)
     */
    private $alt;

    /**
     * @var string
     *
     * @Column(name="file_name", type="string", length=100, nullable=true)
     */
    private $fileName;

    /**
     * @var string
     *
     * @Column(name="mime_type", type="string", length=100, nullable=true)
     */
    private $mimeType;

    /**
     * @var string
     *
     * @Column(name="full_path", type="string", length=255, nullable=true)
     */
    private $fullPath;

    /**
     * @var string
     *
     * @Column(name="original_name", type="text", length=65535, nullable=true)
     */
    private $originalName;

    /**
     * @var string
     *
     * @Column(name="file_ext", type="string", length=10, nullable=true)
     */
    private $fileExt;

    /**
     * @var float
     *
     * @Column(name="file_size", type="float", precision=10, scale=0, nullable=true)
     */
    private $fileSize;

    /**
     * @var boolean
     *
     * @Column(name="is_image", type="boolean", nullable=true)
     */
    private $isImage;

    /**
     * @var integer
     *
     * @Column(name="image_width", type="integer", nullable=true)
     */
    private $imageWidth;

    /**
     * @var integer
     *
     * @Column(name="image_height", type="integer", nullable=true)
     */
    private $imageHeight;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ManyToMany(targetEntity="Action", mappedBy="attachment")
     */
    private $action;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ManyToMany(targetEntity="Card", mappedBy="attachment")
     */
    private $card;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->action = new \Doctrine\Common\Collections\ArrayCollection();
        $this->card = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set url
     *
     * @param string $url
     *
     * @return Attachment
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set thumbUrl
     *
     * @param string $thumbUrl
     *
     * @return Attachment
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
     * Set alt
     *
     * @param string $alt
     *
     * @return Attachment
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     *
     * @return Attachment
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set mimeType
     *
     * @param string $mimeType
     *
     * @return Attachment
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get mimeType
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set fullPath
     *
     * @param string $fullPath
     *
     * @return Attachment
     */
    public function setFullPath($fullPath)
    {
        $this->fullPath = $fullPath;

        return $this;
    }

    /**
     * Get fullPath
     *
     * @return string
     */
    public function getFullPath()
    {
        return $this->fullPath;
    }

    /**
     * Set originalName
     *
     * @param string $originalName
     *
     * @return Attachment
     */
    public function setOriginalName($originalName)
    {
        $this->originalName = $originalName;

        return $this;
    }

    /**
     * Get originalName
     *
     * @return string
     */
    public function getOriginalName()
    {
        return $this->originalName;
    }

    /**
     * Set fileExt
     *
     * @param string $fileExt
     *
     * @return Attachment
     */
    public function setFileExt($fileExt)
    {
        $this->fileExt = $fileExt;

        return $this;
    }

    /**
     * Get fileExt
     *
     * @return string
     */
    public function getFileExt()
    {
        return $this->fileExt;
    }

    /**
     * Set fileSize
     *
     * @param float $fileSize
     *
     * @return Attachment
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    /**
     * Get fileSize
     *
     * @return float
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * Set isImage
     *
     * @param boolean $isImage
     *
     * @return Attachment
     */
    public function setIsImage($isImage)
    {
        $this->isImage = $isImage;

        return $this;
    }

    /**
     * Get isImage
     *
     * @return boolean
     */
    public function getIsImage()
    {
        return $this->isImage;
    }

    /**
     * Set imageWidth
     *
     * @param integer $imageWidth
     *
     * @return Attachment
     */
    public function setImageWidth($imageWidth)
    {
        $this->imageWidth = $imageWidth;

        return $this;
    }

    /**
     * Get imageWidth
     *
     * @return integer
     */
    public function getImageWidth()
    {
        return $this->imageWidth;
    }

    /**
     * Set imageHeight
     *
     * @param integer $imageHeight
     *
     * @return Attachment
     */
    public function setImageHeight($imageHeight)
    {
        $this->imageHeight = $imageHeight;

        return $this;
    }

    /**
     * Get imageHeight
     *
     * @return integer
     */
    public function getImageHeight()
    {
        return $this->imageHeight;
    }

    /**
     * Add action
     *
     * @param \Action $action
     *
     * @return Attachment
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
     * Add card
     *
     * @param \Card $card
     *
     * @return Attachment
     */
    public function addCard(Card $card)
    {
        $this->card[] = $card;

        return $this;
    }

    /**
     * Remove card
     *
     * @param \Card $card
     */
    public function removeCard(Card $card)
    {
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

    public function toArray() {
      return [
        'id' => $this->id,
        'url' => $this->url,
        'thumbUrl' => $this->thumbUrl,
        'alt' => $this->alt,
        'fileName' => $this->fileName,
        'mimeType' => $this->mimeType,
        'originalName' => $this->originalName,
        'fileExt' => $this->fileExt,
        'fileSize' => $this->fileSize,
        'isImage' => $this->isImage,
        'imageWidth' => $this->imageWidth,
        'imageHeight' => $this->imageHeight,
        'deleted' => $this->getDeleted(),
        'createdBy' => $this->getCreatedBy(),
        'createdAt' => $this->getCreatedAt()->format('c'),
        'lastModifiedBy' => $this->getLastModifiedBy(),
        'lastModifiedAt' => $this->getLastModifiedAt()->format('c')
      ];
    }

}
