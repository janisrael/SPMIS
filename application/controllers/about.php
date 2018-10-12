<?php defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller{
    public function view($page='aboutView'){

  		$this->load->view('include/header');
  		$this->load->view($page);
  		$this->load->view('include/footer');
  	}

}
