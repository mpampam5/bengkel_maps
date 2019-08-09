<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_km extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->_security_public();
    $this->load->helper('frontend');
    $this->load->library(array("Temp_public"));
  }

  function _rules(){
 		$this->form_validation->set_rules('kilometer', 'Kilometer', 'trim|xss_clean|required|numeric|callback__cek_kilometer['.get_cek_kilometer_cs('kilometer').']');
 		$this->form_validation->set_error_delimiters('<span class="text-danger text-center"><i>', '</i></span>');
   }

  function index()
  {
    $this->temp_public->set_title('Update Kilometer');
    $this->temp_public->view('update_kilometer/index');
  }


  function action()
  {
    $json = array('success'=>false ,'alert'=>array());
    if ($this->input->is_ajax_request()) {
      $this->_rules();
      if ($this->form_validation->run()) {
          $update = array('kilometer_skrg' =>$this->input->post('kilometer'));
          $id_kendaraan = get_cek_kilometer_cs('id_kendaraan');
          $this->db->where("id_kendaraan",$id_kendaraan)
                    ->update("tb_kendaraan",$update);
          $json['success'] = true;
          $json['alert'] = "Berhasil Mengupdate Kilometer Kendaraan";
      }else {
        foreach ($_POST as $key => $value) {
          $json['alert'][$key] = form_error($key);
        }
      }
      echo json_encode($json);
    }
  }

  function _cek_kilometer($str, $kilometer)
  {
    if ($str < $kilometer) {
      $this->form_validation->set_message('_cek_kilometer', "Kilometer harus di atas $kilometer KM");
      return false;
    }else {
      return true;
    }
  }

}
