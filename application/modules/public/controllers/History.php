<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->_security_public();
    $this->load->helper('frontend');
    $this->load->library(array("Temp_public"));
    $this->load->model('History_model','model');
  }

  function index()
  {
    $this->temp_public->set_title('History Perjalanan');
    $this->temp_public->view('history/index');
  }

  function json()
  {
    header('Content-Type: application/json');
    echo $this->model->json();
  }

  function detail($token)
  {
    $row= $this->model->detail($token);
    $this->temp_public->set_title('Detail History Perjalanan');
    $where = array('id_history'=>$row->id);
    $querys = $this->db->get_where("waypoints_history",$where);
    $dataJson = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".$row->kordinat_start."&destinations=".$row->kordinat_end."&key=AIzaSyDMDVKjRep_9KhuXib8nA2iGgUONvsribE");
    $data = json_decode($dataJson,true);
    $nilaiJarak = $data['rows'][0]['elements'][0]['distance']['text'];
    $jarak = round($nilaiJarak);

    $data = [   "id_history" => $row->id,
                "token" => $token,
                "kordinat_start"=>$row->kordinat_start,
                "kordinat_end"=>$row->kordinat_end,
                "date_start"=>$row->date_start,
                "date_end"=>$row->date_end,
                "trs"=>$querys,
                "nilaiJarak"=>$jarak
            ];
    $this->temp_public->view('history/detail',array(),$data);
  }

}
