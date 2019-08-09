<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->_security_admin("backend");
    $this->load->library(array("Layouts"));
    $this->load->helper('backend');
  }

  function index()
  {
    $this->load->model('Home_model','model');
    $this->layouts->set_title('Home');

    $this->layouts->view('content/home/index');
  }

}
