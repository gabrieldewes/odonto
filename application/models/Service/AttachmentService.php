<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Domain\Attachment;
use Doctrine\ORM\Tools\Pagination\Paginator;

class AttachmentService extends CI_Model {

  var $em;
  var $repo;

  function __construct() {
    parent::__construct();
    $this->em = $this->doctrine->em;
    $this->repo = $this->em->getRepository("Domain\Attachment");
  }

  public function findById($id) {
    return $this->repo->find($id);
  }

  public function findAll($page, $limit) {
    $offset = $page == 0 ? $page : ($page-1) * $limit;
    $query = $this->em->createQuery("SELECT a FROM Domain\Attachment a ORDER BY a.id DESC")
                       ->setFirstResult($offset)
                       ->setMaxResults($limit);
    return new Paginator($query, $fetchJoinCollection = false);
  }

  function createAttachments(Domain\User $user, $domain) {
    if ( !isset($_FILES["attachments"])) {
      throw new Exception("Attachments empty");
    }
    $path = "uploads/usercontent/{$user->getId()}/";
    if ($domain instanceof Domain\Card) {
      $path .= "cardcontent/";
    }
    else if ($domain instanceof Domain\Action) {
      $path .= "actioncontent/";
    }
    $path .= $domain->getId();

    $files = $this->multiple_upload("attachments", $path, $config=array(), $resize_configs=null);
    $attachs = [];
    $batchSize = 20;
    var_dump($files);
    foreach ($files as $i => $file) {
      $attachment = new Attachment();
      $attachment->setUrl(base_url() ."{$path}/{$file["file_name"]}")
                 ->setThumbUrl( ($file["is_image"]===true ? base_url() ."{$path}/{$file["raw_name"]}_thumb{$file["file_ext"]}" : null))
                 ->setAlt($file["client_name"])
                 ->setFileName($file["file_name"])
                 ->setMimeType($file["file_type"])
                 ->setFullPath($file["full_path"])
                 ->setOriginalName($file["client_name"])
                 ->setFileExt($file["file_ext"])
                 ->setFileSize($file["file_size"])
                 ->setIsImage($file["is_image"])
                 ->setImageWidth($file["image_width"])
                 ->setImageHeight($file["image_height"])
                 ->setCreatedBy($user->getUsername())
                 ->setCreatedAt()
                 ->setLastModifiedBy($user->getUsername())
                 ->setLastModifiedAt()
                 ->setDeleted(false);
      /*
      $this->em->persist($attachment);
      if (($i % $batchSize) === 0) {
        $this->em->flush();
        $this->em->clear();
      }
      */
      $attachs[] = $attachment;
    }
    /*
    $this->em->flush();
    $this->em->clear();
    */
    return $attachs;
  }

  /**
    * @param string $file_input_name
    * @param string $path
    * @param array $config
    * @param array $resize_configs
    * @return array
    */
  protected function multiple_upload($file_input_name, $path,
                              $config=array(),
                              $resize_configs=array()) {
    $rootPath = "./{$path}/";
    if (!is_dir($rootPath))
      mkdir($rootPath, 0755, true);
    $conf['upload_path'] = $rootPath;
    $conf['allowed_types'] = '*';
    $conf['max_size'] = 104857600;
    //$conf['max_width'] = 3600;
    //$conf['max_height'] = 1800;
    //$conf['encrypt_name'] = TRUE;
    $conf['remove_spaces'] = TRUE;

    foreach ($config as $item => $val) {
      $conf[$item] = $val;
    }

    $this->load->library('upload', $conf);
    $fileData = array();
    $files = $_FILES;
    $cpt = sizeof($_FILES[$file_input_name]['name']);
    for ($i=0; $i<$cpt; $i++) {
      $_FILES['userfile']['name']     = $files[$file_input_name]['name'][$i];
      $_FILES['userfile']['type']     = $files[$file_input_name]['type'][$i];
      $_FILES['userfile']['tmp_name'] = $files[$file_input_name]['tmp_name'][$i];
      $_FILES['userfile']['error']    = $files[$file_input_name]['error'][$i];
      $_FILES['userfile']['size']     = $files[$file_input_name]['size'][$i];

      if ($this->upload->do_upload()) {
        $fileData[] = $this->upload->data();

        if ($this->upload->data("is_image")) {
          $path = $this->upload->data("full_path");
          $this->createThumbnail($path, $resize_configs=array());
        }
      }
      else {
        echo $this->upload->display_errors();
      }
    }
    return $fileData;
  }

  function createThumbnail($path, $resize_configs=array()) {
    $this->load->library('image_lib');
    $img_config = array(
      'image_library'  => 'gd2',
      'source_image'   => $path,
      'maintain_ratio' => TRUE,
      'create_thumb'   => TRUE,
      'thumb_marker'   => '_thumb',
      'width'          => 150,
      'height'         => 150
    );
    foreach($resize_configs as $key => $value) {
      $img_config[$key] = $value;
    }
    $this->image_lib->initialize($img_config);
    if (!$this->image_lib->resize()) {
      echo $this->image_lib->display_errors();
    }
    $this->image_lib->clear();
  }


}

?>
