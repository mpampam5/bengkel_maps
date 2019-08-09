<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_maps extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->_security_public();
    $this->load->helper('frontend');
    $this->load->library(array("Temp_public"));
  }

  function index()
  {
    $this->temp_public->set_title('Main Menu');
    $this->temp_public->view('home/index_maps');
  }


}
