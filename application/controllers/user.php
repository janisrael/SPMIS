<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

    public function __construct() {
    
    parent::__construct();
    // $this->load->library(array('session'));
    $this->load->helper(array('url'));
    $this->load->model('User_model');
    
  }


  public function view(){
    if($this->session->userdata('sppmo')){
      redirect('supply/view');
    }
    $this->load->view('include/header');
    $this->load->view("user/userView");
    $this->load->view('include/footer');
  }


  public function register() {
    
    // create the data object
    $data = new stdClass();
    
    // load form helper and validation library
    $this->load->helper('form');
    $this->load->library('form_validation');
    
    // set validation rules
    $this->form_validation->set_rules('Username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[user.Username]', array('is_unique' => 'This username already exists. Please choose another one.'));
    
    $this->form_validation->set_rules('Password', 'Password', 'trim|required|min_length[6]');
    $this->form_validation->set_rules('AccessLvl', 'Access level', 'trim|required');
    // $this->form_validation->set_rules('Password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
    
    if ($this->form_validation->run() === false) {
      
      // validation not ok, send validation errors to the view
      $this->load->view('include/header');
      $this->load->view('user/register/register', $data);
      $this->load->view('include/footer');
      
    } else {
      
      // set variables from the form
      $Username = $this->input->post('Username');
      $Password    = $this->input->post('Password');
      $AccessLvl = $this->input->post('AccessLvl');
      
      if ($this->User_model->create_user($Username, $Password, $AccessLvl)) {
        
        // user creation ok
        $data->error  = 'register success';
        // echo '<script>alert "register success!"; </script';
        // $this->load->view('include/header');
        // $this->load->view('user/register/register_success', $data);
        // $this->load->view('include/footer');
        $this->load->view('include/header');
        $this->load->view('user/register/register', $data);
        $this->load->view('include/footer');
        
      } else {
        
        // user creation failed, this should never happen
        $data->error = 'There was a problem creating your new account. Please try again.';
        
        // send error to the view
        $this->load->view('include/header');
        $this->load->view('user/register/register', $data);
        $this->load->view('include/footer');
       
      //       $this->load->view('include/header');
      // $this->load->view("supply/iarView",$data);
      // $this->load->view('include/footer');


      }
      
    }
    
  }


// public function login() {
    
//     // create the data object
//     $data = new stdClass();
    
//     // load form helper and validation library
//     $this->load->helper('form');
//     $this->load->library('form_validation');
    
//     // set validation rules
//     $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
//     $this->form_validation->set_rules('password', 'Password', 'required');
    
//     if ($this->form_validation->run() == false) {
      
//       // validation not ok, send validation errors to the view
//       $this->load->view('header');
//       $this->load->view('user/login/login');
//       $this->load->view('footer');
      
//     } else {
      
//       // set variables from the form
//       $username = $this->input->post('username');
//       $password = $this->input->post('password');
      
//       if ($this->user_model->resolve_user_login($username, $password)) {
        
//         $user_id = $this->user_model->get_user_id_from_username($username);
//         $user    = $this->user_model->get_user($user_id);
        
//         // set session user datas
//         $_SESSION['user_id']      = (int)$user->id;
//         $_SESSION['username']     = (string)$user->username;
//         $_SESSION['logged_in']    = (bool)true;
//         $_SESSION['is_confirmed'] = (bool)$user->is_confirmed;
//         $_SESSION['is_admin']     = (bool)$user->is_admin;
        
//         // user login ok
//         $this->load->view('header');
//         $this->load->view('user/login/login_success', $data);
//         $this->load->view('footer');
        
//       } else {
        
//         // login failed
//         $data->error = 'Wrong username or password.';
        
//         // send error to the view
//         $this->load->view('header');
//         $this->load->view('user/login/login', $data);
//         $this->load->view('footer');
        
//       }
      
//     }
    
//   }

  public function login(){
    $this->form_validation->set_rules('username','Username','required');
    $this->form_validation->set_rules('password','Password','required');

    if($this->form_validation->run()===FALSE){
      redirect('user/view');
    }else{
      $password=$this->input->post('password');
      $username=$this->input->post('username');
      $accessLvl=$this->userModel->login($username,$password);

      if($accessLvl){
        $userdata=array(
          'username'=>$username,
          'accessLvl'=>$accessLvl,
          'loggedIN'=>True
        );

        $this->session->set_userdata('sppmo',$userdata);
        redirect('supply/view');
      }else{
        $this->session->set_flashdata('loginFailed','Check username or password!');
        redirect('user/view');
      }
    }
  }

  public function logout(){
    $this->userModel->logout();
    $this->session->unset_userdata('sppmo');
    $this->session->set_flashdata('logout','Logout Successfully!');
    redirect('user/view');

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
