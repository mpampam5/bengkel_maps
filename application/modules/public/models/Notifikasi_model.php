<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi_model extends CI_Model{

  function json()
  {
    $this->datatables->select("tb_notifikasi_cs.id_notif,
                                tb_notifikasi_cs.id_trans_kendaraan,
                                tb_notifikasi_cs.notifikasi,
                                DATE_FORMAT(tb_notifikasi_cs.waktu,'%d/%m/%Y') AS waktu,
                                tb_notifikasi_cs.status");
    $this->datatables->from('tb_notifikasi_cs');
    $this->datatables->where('id_trans_kendaraan',$this->session->userdata('id_trans_kendaraan'));
    //add this line for join
    //$this->datatables->join('table2', 'tb_login.field = table2.field');
    return $this->datatables->generate();
  }

  function detail($id)
  {
    return $this->db->select('*')
                    ->where('id_notif',$id)
                    ->get('tb_notifikasi_cs')
                    ->row();
  }

}
