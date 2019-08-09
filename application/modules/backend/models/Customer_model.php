<?php

if (!defined('BASEPATH'))exit('No direct script access allowed');



/* */
/* PENGEMBANG : MPAMPAM */
/* EMAIL : MPAMPAM5@GMAIL.COM */
/* FACEBOOK : https://www.facebook.com/mpampam */
/* http://mpampam.com */

 class Customer_model extends CI_Model{
  var $table = 'tb_pemilik';
  var $id    = 'id_pemilik';

    // datatables
      function json() {
          $this->datatables->select(' trans_kendaraan.id_trans_kendaraan,
                                      trans_kendaraan.no_registrasi,
                                      DATE_FORMAT(trans_kendaraan.tgl_registrasi,"%d/%m/%Y") as tgl_registrasi,
                                      trans_kendaraan.id_pemilik,
                                      trans_kendaraan.id_kendaraan,
                                      tb_pemilik.nama_pemilik,
                                      tb_pemilik.telepon_pemilik'
                                    );
          $this->datatables->from('trans_kendaraan');
          $this->datatables->where('trans_kendaraan.aktif','y');
          //add this line for join
          $this->datatables->join('tb_pemilik', 'trans_kendaraan.id_pemilik= tb_pemilik.id_pemilik');
          $this->datatables->add_column('action',
          '<a href="'.site_url(config_item("cpanel")."jadwal_service/tambah/$1").'" id="jadwal_service" data-toggle="tooltip" data-placement="top" title="Jadwal Service" class="text-success"><i class="fa fa-clock-o"></i> Set Jadwal Service</a>&nbsp;|&nbsp;
          <a href="'.site_url(config_item("cpanel")."notifikasi_cs/tambah/$1").'" id="notifikasi" data-toggle="tooltip" data-placement="top" title="Kirim Notifikasi" class="text-success"><i class="fa fa-bell"></i> Kirim Notifikasi</a>&nbsp;|&nbsp;
           <a href="'.site_url(config_item("cpanel")."customer/detail/$1").'" id="detail" data-toggle="tooltip" data-placement="top" title="Detail" class="text-primary"><i class="fa fa-file"></i></a>&nbsp;
           <a href="'.site_url(config_item("cpanel")."customer/edit/$1").'" id="edit" data-toggle="tooltip" data-placement="top" title="Edit" class="text-warning "><i class="fa fa-pencil"></i></a>&nbsp;
           <a href="'.site_url(config_item("cpanel")."customer/hapus/$1").'" id="hapus" data-toggle="tooltip" data-placement="top" title="Hapus" class="text-danger "><i class="fa fa-trash"></i></a>',
           'id_trans_kendaraan');
          return $this->datatables->generate();
      }


     function get_data()
      {
        return $this->db->query("SELECT * FROM $this->table ORDER BY $this->id DESC");
      }

      function get_data_join($where)
      {
        return $this->db->query(" SELECT
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
                                  tb_kendaraan.kilometer
                                  FROM
                                  trans_kendaraan
                                  INNER JOIN tb_pemilik ON tb_pemilik.id_pemilik = trans_kendaraan.id_pemilik
                                  INNER JOIN tb_kendaraan ON tb_kendaraan.id_kendaraan = trans_kendaraan.id_kendaraan
                                  WHERE trans_kendaraan.id_trans_kendaraan = $where AND trans_kendaraan.aktif='y'"
                                  )
                          ->row();
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


      function get_insert($table,$data)
        {
          return $this->db->insert($table,$data);
        }


      function get_where($where)
        {
          return $this->db->where($this->id,$where)
                          ->get($this->table)
                          ->row();
        }


      function get_update($table,$where,$data)
        {
          return $this->db
                ->where($where)
                ->update($table,$data);
        }


      function get_delete($where)
        {
          return $this->db->where($this->id,$where)
                          ->delete($this->table);
        }

}
  /* End Model */
