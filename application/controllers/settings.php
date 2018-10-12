<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller{
    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('sppmo')){
            redirect('error/showError403','refresh');
        }
    }/**/
    public function view($page="settingsView"){
      $data["sessionlogs"]=$this->logModel->getSessionLog();
      $data["alllogs"]=$this->logModel->getAllLog();
      $data["updatelogs"]=$this->logModel->getChangeLog();
  		$this->load->view('include/header');
  		$this->load->view("settings/".$page,$data);
  		$this->load->view('include/footer');
  	}
  }
