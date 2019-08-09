<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_service extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->_security_public();
    $this->load->helper('frontend');
    $this->load->library(array("Temp_public"));
    $this->load->model('Jadwal_service_model','model');
  }

  function index()
  {
    $this->temp_public->set_title('Notifikasi');
    $this->temp_public->view('jadwal_service/index');
  }

  function json()
  {
    header('Content-Type: application/json');
    echo $this->model->json();
  }

  function detail($id)
  {
    if ($row = $this->model->detail($id)) {
        $this->temp_public->set_title('Detail Jadwal');
        $data = array('id_jadwal' => $row->id_jadwal,
                      'waktu' =>$row->waktu,
                      'keterangan'=>$row->keterangan
                      );
        $this->temp_public->view('jadwal_service/detail',array(),$data);
    }else {
      echo "error404";
    }

  }

}
