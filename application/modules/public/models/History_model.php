<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_model extends CI_Model{

  function json()
  {
    $this->datatables->select(" history_location.id,
                                history_location.id_trans_kendaraan,
                                history_location.token,
                                history_location.success,
                                DATE_FORMAT(history_location.date_start,'%d/%m/%Y %h:%i') AS date_start");
    $this->datatables->from('history_location');
    $this->datatables->where('id_trans_kendaraan',$this->session->userdata('id_trans_kendaraan'));
    $this->datatables->where('success','y');
    //add this line for join
    //$this->datatables->join('table2', 'tb_login.field = table2.field');
    return $this->datatables->generate();
  }

  function detail($token)
  {
    $query =  $this->db->where(array('token'=>$token,'success'=>'y','id_trans_kendaraan'=>$this->session->userdata('id_trans_kendaraan')))
                       ->get('history_location');
    if ($query->num_rows()>0) {
      return $query->row();
    }else {
      show_404();
    }
  }

}
