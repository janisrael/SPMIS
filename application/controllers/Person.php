<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Person extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('personModel','person');
    }


    public function view($page="person_view"){
      $this->load->helper('url');
      $data['offices'] = $this->supplyModel->getOffices();
      $data['positions']=$this->supplyModel->getPositions();
      $data['shifts']=$this->supplyModel->getShifts();
      $data['appointments']=$this->supplyModel->getAppointments();
      $this->load->view("person/".$page, $data);
     
   }
 
    public function ajax_list()
    {
        $list = $this->person->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            $row = array();
            $row[] = $person->IDNum;
            $row[] = $person->EmpNo;
            $row[] = $person->surName;
            $row[] = $person->firstName;
            $row[] = $person->middleName;

 
            //add html for action
            $row[] = '<div class="actionWrapper"><a href="javascript:void(0)" class="actionEdit" title="Edit" onclick="edit_person('."'".$person->personID."'".')"><i class="glyphicon glyphicon-edit"></i></a>
                  <a href="javascript:void(0)" class="actionDelete" title="Delete" onclick="delete_person('."'".$person->personID."'".')"><i class="glyphicon glyphicon-trash"></i></a></div>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->person->count_all(),
                        "recordsFiltered" => $this->person->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($personID)
    {
        $data = $this->person->get_by_id($personID);
        $data->bday = ($data->bday == '0000-00-00') ? '' : $data->bday; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'IDNum' => $this->input->post('IDNum'),
                'EmpNo' => $this->input->post('EmpNo'),
                'surName' => $this->input->post('surName'),
                'firstName' => $this->input->post('firstName'),
                'middleName' => $this->input->post('middleName'),
                'suffixName' => $this->input->post('suffixName'),
                'nameTitleID' => $this->input->post('nameTitleID'),
                'bday' => $this->input->post('bday'),
                'bplace' => $this->input->post('bplace'),
                'sex' => $this->input->post('sex'),
                'civilStatID' => $this->input->post('civilStatID'),
                'addHome' => $this->input->post('addHome'),
                'addEmail' => $this->input->post('addEmail'),
                'officeID' => $this->input->post('officeID'),
                'positionID' => $this->input->post('positionID'),
                'shiftID' => $this->input->post('shiftID'),
                'appointID' => $this->input->post('appointID'),
            );
        $insert = $this->person->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'IDNum' => $this->input->post('IDNum'),
                'EmpNo' => $this->input->post('EmpNo'),
                'surName' => $this->input->post('surName'),
                'firstName' => $this->input->post('firstName'),
                'middleName' => $this->input->post('middleName'),
                'suffixName' => $this->input->post('suffixName'),
                'nameTitleID' => $this->input->post('nameTitleID'),
                'bday' => $this->input->post('bday'),
                'bplace' => $this->input->post('bplace'),
                'sex' => $this->input->post('sex'),
                'civilStatID' => $this->input->post('civilStatID'),
                'addHome' => $this->input->post('addHome'),
                'addEmail' => $this->input->post('addEmail'),
                'officeID' => $this->input->post('officeID'),
                'positionID' => $this->input->post('positionID'),
                'shiftID' => $this->input->post('shiftID'),
                'appointID' => $this->input->post('appointID'),
            );
        $this->person->update(array('personID' => $this->input->post('personID')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($personID)
    {
        $this->person->delete_by_id($personID);
        echo json_encode(array("status" => TRUE));
    }
 
 
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('surName') == '')
        {
            $data['inputerror'][] = 'surName';
            // $data['error_string'][] = 'last name is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('firstName') == '')
        {
            $data['inputerror'][] = 'firstName';
            // $data['error_string'][] = 'first name is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('positionID') == '')
        {
            $data['inputerror'][] = 'positionID';
            // $data['error_string'][] = 'positionID is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('officeID') == '')
        {
            $data['inputerror'][] = 'officeID';
            // $data['error_string'][] = 'positionID is required';
            $data['status'] = FALSE;
        }
 
        // if($this->input->post('gender') == '')
        // {
        //     $data['inputerror'][] = 'gender';
        //     $data['error_string'][] = 'Please select gender';
        //     $data['status'] = FALSE;
        // }
 
        // if($this->input->post('address') == '')
        // {
        //     $data['inputerror'][] = 'address';
        //     $data['error_string'][] = 'Addess is required';
        //     $data['status'] = FALSE;
        // }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 
}