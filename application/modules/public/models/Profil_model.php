<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_model extends CI_Model{
  public function get_data_profile()
  {
    $id =  $this->session->userdata('id_trans_kendaraan');
    return $this->db->query("SELECT
                              trans_kendaraan.id_trans_kendaraan,
                              trans_kendaraan.no_registrasi,
                              trans_kendaraan.tgl_registrasi,
                              trans_kendaraan.id_pemilik,
                              trans_kendaraan.id_kendaraan,
                              trans_kendaraan.aktif,
                              tb_pemilik.nama_pemilik,
                              tb_pemilik.telepon_pemilik,
                              tb_pemilik.email_pemilik,
                              tb_pemilik.alamat_pemilik,
                              tb_pemilik.jk_pemilik,
                              tb_pemilik.foto_pemilik,
                              tb_kendaraan.no_kendaraan,
                              tb_kendaraan.merek_kendaraan,
                              tb_kendaraan.transmisi_kendaraan,
                              tb_kendaraan.cc_kendaraan,
                              tb_kendaraan.warna_kendaraan,
                              tb_kendaraan.tahun_pembuatan,
                              tb_kendaraan.waktu_pembelian,
                              tb_kendaraan.kilometer,
                              tb_kendaraan.kilometer_skrg
                              FROM
                              trans_kendaraan
                              INNER JOIN tb_pemilik ON tb_pemilik.id_pemilik = trans_kendaraan.id_pemilik
                              INNER JOIN tb_kendaraan ON tb_kendaraan.id_kendaraan = trans_kendaraan.id_kendaraan
                              WHERE trans_kendaraan.id_trans_kendaraan = $id AND trans_kendaraan.aktif='y'"
                              )
                      ->row();
  }



}
