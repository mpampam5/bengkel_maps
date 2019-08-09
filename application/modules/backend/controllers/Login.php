<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->helper('backend');
  }

  function _rules(){
 		$this->form_validation->set_rules('username', 'username', 'trim|xss_clean|required');
 		$this->form_validation->set_rules('password', 'password', 'trim|xss_clean|required');
 		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
   }

  function index()
  {
    $this->load->view('login');
  }

  function action()
  {
    $json = array('success'=>false,'status'=>false ,'alert'=>array());
    if ($this->input->is_ajax_request()) {
        $this->_rules();
        if ($this->form_validation->run()) {
          $this->load->model('Login_model','model');
          $username =  $this->input->post('username',true);
          $password =  md5($this->input->post('password'));


          $query = $this->model->get_login($username,$password);
          if ($query->num_rows()>0) {
            $data = $query->row();
              $session = array('id_login' => $data->id_login,
                                'nama'      => $data->nama,
                                'username'=>$data->username,
                                'login'      => true,
                              );
              $this->session->set_userdata($session);
              $json['url'] =  site_url('backend/home');
              $json['status'] = true;

          }else {
            $json['alert'] = "Username atau password salah,Coba lagi!";
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

  function logout()
  {
    $this->session->sess_destroy();
    redirect('backend/login');
  }

}
