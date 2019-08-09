<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->_security_public();
    $this->load->helper('frontend');
    $this->load->library(array("Temp_public"));
    $this->load->model('Service_model','model');
  }

  function index()
  {
    $this->temp_public->set_title('Perbaikan & Perawatan');
    $data['query'] = $this->model->get_data();
    $this->temp_public->view('service/index',array(),$data);
  }

  function detail($id_service,$status){
     if ($status==1) {
       if($row=$this->model->get_where_join_detail_service($this->session->userdata('id_trans_kendaraan'),$id_service)){
         $this->temp_public->set_title("Detail Tahap $row->nama_service");
           $data=array('id_trans_cs_service' => $row->id_trans_cs_service,
   										'id_trans_kendaraan' => $row->id_trans_kendaraan,
   										'id_service' => $row->id_service,
   										'keterangan' => $row->keterangan,
   										'waktu_service' => $row->waktu_service,
                       'jarak_tempuh'=>$row->jarak_tempuh,
                       'waktu_tempuh'=>$row->waktu_tempuh,
                       'nama_service'=>$row->nama_service
   									);
   				 $this->temp_public->view('service/detail',array(),$data);
   //MODAL DETAIL
   //$this->layouts->view(config_item("cpanel").'content/cs_service/detail',array(),$data,false);
       }else {
           echo "404";
       }
     }elseif($status==0) {
       if($row=$this->db->query("SELECT * FROM tb_service where id_service=$id_service")->row()){
         $this->temp_public->set_title("Detail Tahap $row->nama_service");
           $data=array(
   										'id_service' => $row->id_service,
                       'nama_service'=>$row->nama_service
   									);
   				 $this->temp_public->view('service/details',array(),$data);
   //MODAL DETAIL
   //$this->layouts->view(config_item("cpanel").'content/cs_service/detail',array(),$data,false);
       }else {
           echo "404";
       }
     }else {
       echo "404";
     }
   }


}
