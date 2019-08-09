<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->_security_public();
    $this->load->helper('frontend');
    $this->load->library(array("Temp_public"));
    $this->load->model('Notifikasi_model','model');
  }

  function index()
  {
    $this->temp_public->set_title('Notifikasi');
    $this->temp_public->view('notifikasi/index');
  }

  function json()
  {
    header('Content-Type: application/json');
    echo $this->model->json();
  }

  function detail($id)
  {
    if ($row = $this->model->detail($id)) {
        $this->temp_public->set_title('Detail notifikasi');
        $this->db->where('id_notif',$id)
                  ->update('tb_notifikasi_cs',array('status'=>'sudah'));
        $data = array('id_notif' => $row->id_notif,
                      'waktu' =>$row->waktu,
                      'notifikasi'=>$row->notifikasi
                      );
        $this->temp_public->view('notifikasi/detail',array(),$data);
    }else {
      echo "error404";
    }

  }

}
