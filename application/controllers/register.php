<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
  public function view(){
    if($this->session->userdata('sppmo')){
      redirect('supply/view');
    }
    $this->load->view('include/header');
    $this->load->view("user/userView");
    $this->load->view('include/footer');
  }

 

  public function logout(){
    $this->userModel->logout();
    $this->session->unset_userdata('sppmo');
    $this->session->set_flashdata('logout','Logout Successfully!');
    redirect('user/view');

  }

  public function registerUser(){
    $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');
    $this->form_validation->set_message('is_unique', 'Email already exists.');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');

  }

  public function changePass(){
    $oldPass=$this->input->post('oldPass',TRUE);
    $newPass=$this->input->post('newPass',TRUE);
    $confirmPass=$this->input->post('confirmPass',TRUE);

    if($newPass!=$confirmPass){
      $this->session->set_flashdata('probDetails',"Password does not match!");
      redirect('settings/view');
    }

    if(!$this->userModel->checkPass($oldPass,$this->session->userdata('sppmo')['username'],$newPass)){
      $this->session->set_flashdata('probDetails',"Wrong Password!");
      redirect('settings/view');
    }
    $this->session->set_flashdata('doneChanged',"Password Changed!");
    redirect('settings/view');
  }
}
