<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('frontend');
  }

  function _rules(){
 		$this->form_validation->set_rules('no_registrasi', 'No.Registrasi', 'trim|xss_clean|required|numeric');
 		$this->form_validation->set_error_delimiters('<span class="text-danger text-center"><i>', '</i></span>');
   }

  function index()
  {
    $this->load->view('login/index');
  }

  function action()
  {
    $json = array('success'=>false,'status'=>false ,'alert'=>array());
    if ($this->input->is_ajax_request()) {
        $this->_rules();
        if ($this->form_validation->run()) {
          $this->load->model('Login_model','model');
          $no_registrasi =  $this->input->post('no_registrasi',true);
          $j_login =  $this->input->post('j_login',true);

          $query = $this->model->get_login($no_registrasi);
          if ($query->num_rows()>0) {
            $data = $query->row();
              $session = array('id_trans_kendaraan' => $data->id_trans_kendaraan,
                                'no_registrasi'      => $data->no_registrasi,
                                'tgl_registrasi'      => $data->tgl_registrasi,
                                'id_pemilik'        =>$data->id_pemilik,
                                'id_kendaraan'      => $data->id_kendaraan,
                                'login'      => true,
                                'j_login'   => $j_login
                              );
              $this->session->set_userdata($session);
              if ($j_login == "akun") {
                $json['url'] =  site_url('home');
              }else {
                $json['url'] =  site_url('home_maps');
              }
              $json['status'] = true;

          }else {
            $json['alert'] = "No.Registrasi salah,Coba lagi!";
          }
          $json['success'] = true;
        }else {
          foreach ($_POST as $key => $value) {
            $json['alert'][$key] = form_error($key);
          }
        }
      echo json_encode($json);
    }else {
      echo "mau apa?";
    }
  }


  function lupa_no_registrasi(){
    $this->load->view('login/lupa_no_registrasi');
  }

  function logout()
  {
    $this->session->sess_destroy();
    redirect('login');
  }

}
