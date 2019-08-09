<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{

  function get_login($no_registrasi)
  {
    return $this->db->query("SELECT
                              trans_kendaraan.id_trans_kendaraan,
                              trans_kendaraan.no_registrasi,
                              trans_kendaraan.tgl_registrasi,
                              trans_kendaraan.id_pemilik,
                              trans_kendaraan.id_kendaraan,
                              trans_kendaraan.aktif
                              FROM
                              trans_kendaraan
                              WHERE
                              trans_kendaraan.no_registrasi = $no_registrasi AND trans_kendaraan.aktif='y'
                              ");
  }

}
