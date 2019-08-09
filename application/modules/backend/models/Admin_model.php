<?php

if (!defined('BASEPATH'))exit('No direct script access allowed');



/* */
/* PENGEMBANG : MPAMPAM */
/* EMAIL : MPAMPAM5@GMAIL.COM */
/* FACEBOOK : https://www.facebook.com/mpampam */
/* http://mpampam.com */

 class Admin_model extends CI_Model{
  var $table = 'tb_login';
  var $id    = 'id_login';

    // datatables
      function json() {
          $this->datatables->select('id_login,nama,telepon,username,password');
          $this->datatables->from('tb_login');
          //add this line for join
          //$this->datatables->join('table2', 'tb_login.field = table2.field');
          $this->datatables->add_column('action',
          '<a href="'.site_url(config_item("cpanel")."admin/detail/$1").'" id="detail" data-toggle="tooltip" data-placement="top" title="Detail" class="text-primary"><i class="fa fa-file"></i></a>&nbsp;
           <a href="'.site_url(config_item("cpanel")."admin/edit/$1").'" id="edit" data-toggle="tooltip" data-placement="top" title="Edit" class="text-warning "><i class="fa fa-pencil"></i></a>&nbsp;
           <a href="'.site_url(config_item("cpanel")."admin/hapus/$1").'" id="hapus" data-toggle="tooltip" data-placement="top" title="Hapus" class="text-danger "><i class="fa fa-trash"></i></a>',
           'id_login');
          return $this->datatables->generate();
      }


     function get_data()
      {
        return $this->db->query("SELECT * FROM $this->table ORDER BY $this->id DESC");
      }


      function get_insert($data)
        {
          return $this->db->insert($this->table,$data);
        }


      function get_where($where)
        {
          return $this->db->where($this->id,$where)
                          ->get($this->table)
                          ->row();
        }


      function get_update($where,$data)
        {
          return $this->db
                ->where($this->id,$where)
                ->update($this->table,$data);
        }


      function get_delete($where)
        {
          return $this->db->where($this->id,$where)
                          ->delete($this->table);
        }

}
  /* End Model */
