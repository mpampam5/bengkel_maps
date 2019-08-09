<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_where($table,$data)
  {
    return $this->db->where($data)
                    ->get($table);
  }


  function get_insert($table,$data)
  {
    return $this->db->insert($table,$data);
  }

  function get_update($table,$where,$data)
  {
    return $this->db->where($where)
                    ->update($table,$data);
  }

  function get_delete($table,$data)
  {
    return $this->db->where($data)
            ->delete($table);
  }

}
