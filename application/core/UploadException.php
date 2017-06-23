<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UploadException extends Exception {

  public function __construct($code, $name) {
    $message = $this->codeToMessage($code, $name);
    parent::__construct($message, $code, $previousException = null);
  }

  private function codeToMessage($code, $name)  {
    switch ($code) {
      case UPLOAD_ERR_INI_SIZE:
        $message = "Os arquivos excedem o tamanho máximo de upload do servidor. {$name}";
        break;
      case UPLOAD_ERR_FORM_SIZE:
        $message = "O arquivo \"{$name}\" ultrapassa o tamanho máximo de upload definido no formulário.";
        break;
      case UPLOAD_ERR_PARTIAL:
        $message = "The file \"{$name}\" was only partially uploaded";
        break;
      case UPLOAD_ERR_NO_FILE:
        $message = "Nenhum arquivo selecionado.";
        break;
      case UPLOAD_ERR_NO_TMP_DIR:
        $message = "Missing a temporary folder";
        break;
      case UPLOAD_ERR_CANT_WRITE:
        $message = "Failed to write file to disk";
        break;
      case UPLOAD_ERR_EXTENSION:
        $message = "File upload stopped by extension";
        break;
      case 9:
        $message = "O arquivo \"{$name}\" possui um formato não suportado. Por favor, escolha apenas arquivos do formato zip/rar/doc/docx/pdf/gif/jpg/png/mp4/wav.";
        break;
      default:
        $message = "Unknown upload error";
        break;
    }
    return $message;
  }
}

?>
