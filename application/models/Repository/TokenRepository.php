<?php defined('BASEPATH') OR exit('No direct script access allowed');

class TokenRepository extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  public function getTokenIfExists($user_id) {
    if (($key = $this->_get_key_by_user($user_id)) != null) {
      return ['token' => $key->token];
    }
    return null;
  }

  public function createToken($user_id, $level=0, $ignore_limits=1) {
    $key = $this->_generate_key();
    $data = [
      'user_id' => $user_id,
      'level' => $level,
      'ignore_limits' => $ignore_limits,
      'ip_addresses' => $this->input->ip_address()
    ];

    if ($this->_insert_key($key, $data)) {
      return $key;
    }
    else {
        return null;
    }
  }

  public function destroyToken($user_id) {
    if (!$this->_user_has_key($user_id)) {
      return false;
    }
    return $this->_delete_key_by_user($user_id);
  }

  private function _generate_key() {
    do {
      $salt = base_convert(bin2hex($this->security->get_random_bytes(64)), 16, 36);

      if ($salt === FALSE) {
        $salt = hash('sha256', time() . mt_rand());
      }

      $new_key = substr($salt, 0, 40);
    }
    while ($this->_key_exists($new_key));

    return $new_key;
  }

  private function _get_key($key) {
    return $this->db
        ->where("token", $key)
        ->get("tokens")
        ->row();
  }

  private function _get_key_by_user($user_id) {
    return $this->db
        ->where("user_id", $user_id)
        ->get("tokens")
        ->row();
  }

  private function _key_exists($key) {
    return $this->db
        ->where("token", $key)
        ->count_all_results("tokens") > 0;
  }

  private function _user_has_key($user_id) {
    return $this->db
        ->where("user_id", $user_id)
        ->count_all_results("tokens") > 0;
  }

  private function _insert_key($key, $data) {
    $data["token"] = $key;
    $data['created_at'] = time();

    return $this->db
        ->set($data)
        ->insert("tokens");
  }

  private function _update_key($key, $data) {
    return $this->db
        ->where("token", $key)
        ->update("tokens", $data);
  }

  private function _delete_key($key) {
    return $this->db
        ->where("token", $key)
        ->delete("tokens");
  }

  private function _delete_key_by_user($user_id) {
    return $this->db
        ->where("user_id", $user_id)
        ->delete("tokens");
  }

}

?>
