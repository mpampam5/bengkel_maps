<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->_security_public();
    $this->load->helper('frontend');
    $this->load->library(array("Temp_public"));
    $this->load->model('Profil_model','model');
  }

  function index()
  {
    if ($row = $this->model->get_data_profile()) {
      $this->temp_public->set_title('Profile');
      $data['row'] = $row;
      $this->temp_public->view('profile/index',array(),$data);
    }else {
      echo "string";
    }

  }

}
