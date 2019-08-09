<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{


  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_login($username,$password)
  {
    return $this->db->query("SELECT * FROM tb_login WHERE username='$username' AND password = '$password'");
  }



}
