<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_service_model extends CI_Model{

  function json()
  {
    $this->datatables->select("tb_jadwal.id_jadwal,
                                tb_jadwal.id_trans_kendaraan,
                                DATE_FORMAT(tb_jadwal.waktu,'%d/%m/%Y %h:%i') AS waktu,
                                tb_jadwal.keterangan");
    $this->datatables->from('tb_jadwal');
    $this->datatables->where('tb_jadwal.id_trans_kendaraan',$this->session->userdata('id_trans_kendaraan'));
    //add this line for join
    //$this->datatables->join('table2', 'tb_login.field = table2.field');
    return $this->datatables->generate();
  }

  function detail($id)
  {
    return $this->db->select('*')
                    ->where('id_jadwal',$id)
                    ->get('tb_jadwal')
                    ->row();
  }

}
