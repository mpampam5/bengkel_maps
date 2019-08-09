<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model{


  function get_data()
  {
    return $this->db->query("SELECT * FROM tb_service ORDER BY id_service ASC");
  }

  function get_where_join_detail_service($id_trans_kendaraan,$id_service)
  {
  $query = $this->db->select("trans_cs_service.id_trans_cs_service,
                                trans_cs_service.id_trans_kendaraan,
                                trans_cs_service.id_service,
                                trans_cs_service.keterangan,
                                trans_cs_service.waktu_service,
                                trans_cs_service.waktu_tempuh,
                                trans_cs_service.jarak_tempuh,
                                trans_kendaraan.no_registrasi,
                                trans_kendaraan.aktif,
                                trans_kendaraan.id_pemilik,
                                tb_pemilik.nama_pemilik,
                                tb_service.nama_service")
             ->join('trans_kendaraan', 'trans_cs_service.id_trans_kendaraan = trans_kendaraan.id_trans_kendaraan')
             ->join('tb_pemilik', 'trans_kendaraan.id_pemilik = tb_pemilik.id_pemilik')
             ->join('tb_service', 'trans_cs_service.id_service = tb_service.id_service')
             ->where(array('trans_cs_service.id_trans_kendaraan'=>$id_trans_kendaraan,'trans_cs_service.id_service'=>$id_service,'trans_kendaraan.aktif'=>'y'))
             ->get('trans_cs_service');
             return $query->row();
  }

  function join_trans_service($where)
  {
    return $this->db->query("SELECT
                              trans_service.id_trans_service,
                              trans_service.id_service,
                              trans_service.id_perbaikan,
                              tb_jenis_perbaikan.jenis_perbaikan
                              FROM
                              trans_service
                              INNER JOIN tb_jenis_perbaikan ON tb_jenis_perbaikan.id_jenis_perbaikan = trans_service.id_perbaikan
                              WHERE
                              trans_service.id_service = $where"
                            )
                      ->result();
  }

}
