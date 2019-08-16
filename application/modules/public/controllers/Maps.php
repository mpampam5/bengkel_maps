<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->_security_public();
    $this->load->helper('frontend');
    $this->load->library(array("Temp_public"));
    $this->load->model('Maps_model','model');
  }

  function index()
  {
    $this->temp_public->set_title('Set lokasi saat ini');
    $this->temp_public->view('maps/index');
  }

  function lokasi_tujuan($token,$lat,$long)
  {
    $this->temp_public->set_title('Memulai Perjalanan');
    $insert = array('id_trans_kendaraan'=> $this->session->userdata('id_trans_kendaraan'),
                    'kordinat_start' =>$lat.",".$long ,
                    'token' => $token,
                    'date_start'=> date('Y-m-d h:i:s')
                    );
    $this->model->get_insert('history_location',$insert);
    $id_last_insert = $this->db->insert_id();
    $data = array('lat1' => $lat,
                  'long1' =>$long,
                  'token'=>$token,
                  'id_histry_location' => $id_last_insert
  );
    $this->temp_public->view('maps/jalan',array(),$data);
  }

  function save_waypoints()
  {
    if ($this->input->is_ajax_request()) {
      $id_history = $this->input->post('id_history');
      $kordinat = $this->input->post('kordinat');
      $insert = array('id_history' =>$id_history ,
                      'kordinat' => $kordinat
                      );
      if ($kordinat!="" OR $kordinat!=null) {
        if ($this->db->get_where('history_location',['kordinat_start'=>$kordinat])->num_rows()==0 AND $this->db->get_where('waypoints_history',['id_history'=>$id_history,'kordinat'=>$kordinat])->num_rows()==0) {
          if ($this->model->get_insert('waypoints_history',$insert)) {
            $data['success'] = true;
          }else {
            $data['success'] = false;
          }
        }else {
          $data['success'] = false;
        }
      }


    json_encode($data);
    }
  }

  function save_kordinat_end()
  {

        $token = $this->input->post('token');
        $kordinat = $this->input->post('kordinat');
        if ($kordinat==null) {
          $data['successs'] = false;
        }else {
          $update = array(
                            'kordinat_end' => $kordinat,
                            'success' =>'y',
                            'date_end'=> date('Y-m-d h:i:s')
                          );
            $this->model->get_update('history_location',['token'=>$token],$update);
            $data['successs'] = true;
        }
    echo json_encode($data);

  }


  function batal($token)
  {
    $delete = $this->model->get_delete('history_location',['token'=>$token]);
    if ($delete) {
      redirect('home_maps');
    }else {
      echo "error";
    }
  }


  function detail($token)
  {
    $query = $this->model->get_where('history_location',['token'=>$token]);
    if ($query->num_rows()>0) {
      $row = $query->row();
      $where = array('id_history'=>$row->id);
      $querys = $this->db->get_where("waypoints_history",$where);
        $dataJson = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".$row->kordinat_start."&destinations=".$row->kordinat_end."&key=AIzaSyDMDVKjRep_9KhuXib8nA2iGgUONvsribE");
        $data = json_decode($dataJson,true);
        $nilaiJarak = $data['rows'][0]['elements'][0]['distance']['text'];
        $jarak = round($nilaiJarak);

        $id_trans_kendaraan = $this->session->userdata('id_trans_kendaraan');
        $cek_kendaraan = $this->db->query("SELECT
                                    trans_kendaraan.id_trans_kendaraan,
                                    trans_kendaraan.id_kendaraan,
                                    trans_kendaraan.aktif
                                    FROM
                                    trans_kendaraan
                                    WHERE
                                    trans_kendaraan.id_trans_kendaraan=$id_trans_kendaraan");
      if ($query->num_rows()>0) {

          $id_kendaraan = $cek_kendaraan->row()->id_kendaraan;
          $this->db->query("UPDATE tb_kendaraan SET kilometer_skrg=kilometer_skrg+$jarak WHERE id_kendaraan=$id_kendaraan");
        }
      $data = [   "id_history" => $row->id,
                  "token" => $token,
                  "kordinat_start"=>$row->kordinat_start,
                  "kordinat_end"=>$row->kordinat_end,
                  "date_start"=>$row->date_start,
                  "date_end"=>$row->date_end,
                  "trs"=>$querys,
                  "nilaiJarak"=>$jarak
              ];
      $this->temp_public->set_title('Detail Perjalanan');
      $this->temp_public->view('maps/detail',array(),$data);
    }else {
      show_404();
    }
  }

  function get_json_location($id)
  {
    $where = array('id_history'=>$id);
    $query = $this->db->get_where("waypoints_history",$where);
    foreach ($query->result() as $row) {
      $data[]= $row->kordinat;
    }


    echo json_encode($data);
    // echo "var locationss = $json";
  }


  function jarak_tempuh($lat1,$long1,$lat2,$long2)
  {
    $this->temp_public->set_title('Detail perjalanan');

    $dataJson = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&key=AIzaSyDMDVKjRep_9KhuXib8nA2iGgUONvsribE");
    $data = json_decode($dataJson,true);
    $nilaiJarak = $data['rows'][0]['elements'][0]['distance']['text'];
    $waktu = $data['rows'][0]['elements'][0]['duration']['text'];
    $jarak = round($nilaiJarak);
    $row = array('jarak' => $nilaiJarak,
                'waktu' =>$waktu
                );

    $id = $this->session->userdata('id_trans_kendaraan');
    $query = $this->db->query("SELECT
                                trans_kendaraan.id_trans_kendaraan,
                                trans_kendaraan.id_kendaraan,
                                trans_kendaraan.aktif
                                FROM
                                trans_kendaraan
                                WHERE
                                trans_kendaraan.id_trans_kendaraan=$id");
    if ($query->num_rows()>0) {
        // $update = $this->db->where('id_kendaraan',$query->row()->id_kendaraan)
        //           ->update("tb_kendaraan",array("kilometer_skrg"=>$nilaiJarak));
        $id_kendaraan = $query->row()->id_kendaraan;
        $update = $this->db->query("UPDATE tb_kendaraan SET kilometer_skrg=kilometer_skrg+$jarak WHERE id_kendaraan=$id_kendaraan");
        if ($update) {
          $this->temp_public->view('maps/detail',array(),$row);
        }else {
          echo "error update";
        }
    }else {
      echo "error";
    }


  }

  function google_maps()
  {
    $this->temp_public->set_title('Google Maps');
    $this->temp_public->view('maps/google_maps');
  }




}
