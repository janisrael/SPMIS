<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Error extends CI_Controller{
 public function showError404() {
    $this->output->set_status_header('404');
    $this->load->view('include/header');
    $this->load->view('errors/showError404');//loading in custom error view
    $this->load->view('include/footer');
 }

 public function showError403(){
   $this->output->set_status_header('403');
   $this->load->view('include/header');
   $this->load->view('errors/showError403');//loading in custom error view
   $this->load->view('include/footer');
 }
}
