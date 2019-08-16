<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->_security_public();
    $this->load->helper('frontend');
    $this->load->library(array("Temp_public"));
  }

  function index()
  {
    $this->temp_public->set_title('Main Menu');
    $this->temp_public->view('home/index');
  }

  function json_pemberitahuan($id_trans_kendaraan)
  {
    $query =  $this->db->query("SELECT * FROM tb_notifikasi_cs WHERE id_trans_kendaraan=$id_trans_kendaraan AND status='belum'");
    if ($query->num_rows()>0) {
        $data['success']=true;
        $data['jml'] = $query->num_rows();
    }else {
      $data['success']=false;
    }
    $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($data));
  }



  function json_jadwal($id_trans_kendaraan)
  {
    $query =  $this->db->query("SELECT * FROM tb_jadwal WHERE id_trans_kendaraan=$id_trans_kendaraan AND status='belum'");
    if ($query->num_rows()>0) {
        $data['success']=true;
        $data['jml'] = $query->num_rows();
    }else {
      $data['success']=false;
    }
    $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($data));
  }


  function cek_service()
  {
    $id_trans_kendaraan =  $this->session->userdata('id_trans_kendaraan');
    $cek =  $this->db->query("SELECT
                              trans_kendaraan.id_trans_kendaraan,
                              trans_kendaraan.no_registrasi,
                              trans_kendaraan.tgl_registrasi,
                              trans_kendaraan.id_pemilik,
                              trans_kendaraan.id_kendaraan,
                              trans_kendaraan.aktif,
                              tb_kendaraan.id_kendaraan,
                              tb_kendaraan.kilometer,
                              tb_kendaraan.kilometer_skrg
                              FROM
                              trans_kendaraan
                              INNER JOIN tb_kendaraan ON trans_kendaraan.id_kendaraan = tb_kendaraan.id_kendaraan
                              WHERE
                              trans_kendaraan.id_trans_kendaraan = $id_trans_kendaraan");
    if ($cek->num_rows()==1) {
      $row = $cek->row();

      $jarak = $row->kilometer_skrg - $row->kilometer;
      $waktu = selisih_bulan($row->tgl_registrasi);
      $query =  $this->db->query("SELECT
                                  tb_service.id_service,
                                  tb_service.nama_service,
                                  tb_service.jarak_tempuh,
                                  tb_service.s_jarak_tempuh,
                                  tb_service.waktu,
                                  tb_service.s_waktu
                                  FROM
                                  tb_service
                                  WHERE
                                  $jarak>= tb_service.jarak_tempuh AND
                                  $jarak < tb_service.s_jarak_tempuh OR
                                  $waktu >= tb_service.waktu AND
                                  $waktu < tb_service.s_waktu
                                  ORDER BY tb_service.id_service DESC
                                  LIMIT 1"
                              );


        if ($query->num_rows()>0) {
          $row2 = $query->row();
          $data['id_service'] = $row2->id_service;
          $data['nama_service'] = $row2->nama_service;
          $cek_servisan = $this->db->get_where("trans_cs_service",array("id_trans_kendaraan"=>$id_trans_kendaraan,"id_service"=>$row2->id_service));
          if ($cek_servisan->num_rows()>0) {
            $data['status'] = "telah melakukan perbaikan dan perawatan.";
          }else {
            $data['status'] = "belum melakukan perbaikan dan perawatan.";
          }
          $data['success']=true;
        }else {
          $data['success']=false;
        }
    }else {
      $data['success']=false;
    }
    $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($data));
  }

}
