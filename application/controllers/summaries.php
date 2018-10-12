<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Summaries extends CI_Controller{
  public function view($page){
    $data['users']=$this->summaryModel->getUsers();
    $data['offices']=$this->summaryModel->getOffices();
    $data['codes']=$this->summaryModel->getAccCode();

    $this->load->view('include/header');
    $this->load->view("summaries/".$page,$data);
    $this->load->view('include/footer');
  }

  public function filterPipz(){
    $data=$this->summaryModel->getEndUser($this->input->post(NULL,TRUE));
    echo json_encode($data);
  }

  public function equipOffice(){
    $data=$this->summaryModel->getEquipOffice($this->input->post(NULL,TRUE));

    echo json_encode($data);
  }

}
