<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Supply extends CI_Controller{
    function __construct(){
        parent::__construct();
        if(!$this->session->userdata('sppmo')){
            redirect('error/showError403','refresh');
        }
    }/**/
    public function view($page="supplyView"){
      $data['supplies']=$this->supplyModel->getSupply();
      $data['users']=$this->supplyModel->getUsers();
      $data['codes']=$this->supplyModel->getAccCode();
      // fetch data from offices table to dropdown option
      $data['offices']=$this->supplyModel->getOffices();
      // fetch data from supplier table to dropdown option
      $data['suppliers']=$this->supplyModel->getSuppliers();
      // fetch data from reffund table to dropdown option
      $data['funds']=$this->supplyModel->getFund();
      $data['docs']=$this->supplyModel->getDocs();
      $data['years']=$this->supplyModel->getYear();




  		$this->load->view('include/header');
  		$this->load->view("supply/".$page,$data);
  		$this->load->view('include/footer');
  	}



    public function track(){
      $data['supplies']=$this->supplyModel->getSupply();
      $data['inspectors']=$this->supplyModel->getInspectors();
      $data['users']=$this->supplyModel->getUsers();
      $data['codes']=$this->supplyModel->getAccCode();
      $data['offices']=$this->supplyModel->getOffices();
      $data['suppliers']=$this->supplyModel->getSuppliers();
      $data['funds']=$this->supplyModel->getFund();
      $data['prs']=$this->supplyModel->getAllPR();
      $data['pos']=$this->supplyModel->getAllPO();

      $this->load->view('include/header');
      $this->load->view("supply/trackView",$data);
      $this->load->view('include/footer');
    }

    public function iar(){
      $data['supplies']=$this->supplyModel->getSupply();
      $data['inspectors']=$this->supplyModel->getInspectors();
      $data['users']=$this->supplyModel->getUsers();
      $data['codes']=$this->supplyModel->getAccCode();
      $data['offices']=$this->supplyModel->getOffices();
      $data['suppliers']=$this->supplyModel->getSuppliers();
      $data['funds']=$this->supplyModel->getFund();
      $data['prs']=$this->supplyModel->getAllPR();
      $data['pos']=$this->supplyModel->getAllPO();

  		$this->load->view('include/header');
  		$this->load->view("supply/iarView",$data);
  		$this->load->view('include/footer');
  	}

    public function pmo(){
      $data['supplies']=$this->supplyModel->getSupply();
      $data['users']=$this->supplyModel->getUsers();
      $data['codes']=$this->supplyModel->getAccCode();
      $data['offices']=$this->supplyModel->getOffices();
      $data['suppliers']=$this->supplyModel->getSuppliers();
      $data['funds']=$this->supplyModel->getFund();

  		$this->load->view('include/header');
  		$this->load->view("supply/pmoView",$data);
  		$this->load->view('include/footer');
  	}




    public function transfer(){
      $data['supplies']=$this->supplyModel->getSupply();
      $data['users']=$this->summaryModel->getUsers();
      $data['codes']=$this->supplyModel->getAccCode();
      $data['offices']=$this->supplyModel->getOffices();
      $data['suppliers']=$this->supplyModel->getSuppliers();
      $data['funds']=$this->supplyModel->getFund();

  		$this->load->view('include/header');
  		$this->load->view("supply/transferView",$data);
  		$this->load->view('include/footer');
  	}



    function fetchData(){
      $fetch_data = $this->supplyModel->make_datatables();
      $data = array();
      $row;

   
      foreach($fetch_data as $row){

     
        $sub_array = array();
        if($row->docType==2){
          $doc="(PAR)";
        }else{
          $doc="(ICS)";
        }
 
        $post="For Signature";
        if($row->isForward!=0){
          $post="<div class='fwrapper'>FORWARDED • $row->forwardDate </div>";
          // $post="<div class='fwrapper'>FORWARDED • $row->forwardDate </div>";
          if($row->isPosted==1)
            $post.="&nbsp<div class='pwrapper'><div class='fa fa-arrow-up'></div></div>";
        }else if($row->isCancelled!=0){
          $post="<div class='cwrapper'>CANCELLED • $row->cancelledDate";
        }
        $appearForward="";
        $appearCancel="";
        $appearDelete="";

        if($row->isForward==0 && $row->isCancelled==0){
          $appearForward='
          <a class="tooltipped forwardDoc controlIcon" data-position="top" data-delay="1" data-tooltip="Forward" href="#forward">
            <div class="fa fa-forward effectIcon"></div>
          </a>&nbsp;&nbsp;';
          $appearCancel='
          <a class="tooltipped cancelDoc controlIcon" data-position="top" data-delay="1" data-tooltip="Cancel" href="#cancel">
            <div class="fa fa-minus-circle effectIcon"></div>
          </a>&nbsp;&nbsp;';
          $appearDelete='
          <a class="tooltipped controlIcon delete1" data-position="top" data-delay="1" data-tooltip="Delete" href="#delDoc">
            <div class="fa fa-times effectIcon"></div>
          </a>';
        }
        
        $sub_array[] = $doc;
        $sub_array[] = $row->parics;
        $sub_array[] = $row->dateIssued;
        $sub_array[] = ucwords(strtoupper($row->surName)).", ".ucwords(strtolower($row->firstName))." ".ucwords(strtolower($row->middleName))." ".ucwords(strtolower($row->suffixName));
        $sub_array[] = $row->poNumber;
        $sub_array[] = $post;
        $sub_array[] = '<div class="center">
        <p hidden class="AREID">'.$row->paricsID.'</p>
        <a class="tooltipped viewData controlIcon" data-position="top" data-delay="1" data-tooltip="View" href="#modal1">
          <div class="fa fa-eye effectIcon"></div>
        </a>&nbsp;&nbsp;'.$appearForward.$appearCancel.$appearDelete.'
        </div>
        <script>
          $(".tooltipped").tooltip();
        </script>
        ';
        $data[] = $sub_array;
      }
  
      $output = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal"  => $this->supplyModel->get_all_data(),
        "recordsFiltered" => $this->supplyModel->get_filtered_data(),
        "data" => $data,
      );
      echo json_encode($output);

    }

    function fetchIar(){
      $fetch_data = $this->supplyModel->make_datatablesIar();
      $data = array();
      $row;
      foreach($fetch_data as $row){
        $sub_array = array();
        $sub_array[] = $row->iarNo;
        $sub_array[] = $row->iarDate;
        $sub_array[] = ucwords(strtolower($row->surName)).", ".ucwords(strtolower($row->firstName))." ".ucwords(strtolower($row->middleName))." ".ucwords(strtolower($row->suffixName));
        $sub_array[] = $row->inspector;
        $sub_array[] = $row->officeAcronym." ".$row->office;
        $sub_array[] = '<p hidden class="iarID">'.$row->iarID.'
        </p><a class="tooltipped viewData controlIcon" data-position="top" data-delay="1" data-tooltip="View" href="#modal1"><div class="fa fa-eye effectIcon"></div></a>&nbsp;&nbsp;
        <a class="tooltipped controlIcon delete1" data-position="top" data-delay="1" data-tooltip="Delete" href="#delDoc"><div class="fa fa-times effectIcon"></div></a>
        <script>
          $(".tooltipped").tooltip();
        </script>
        ';
        $data[] = $sub_array;
      }
      $output = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal"  => $this->supplyModel->get_all_dataIar(),
        "recordsFiltered" => $this->supplyModel->get_filtered_dataIar(),
        "data" => $data
      );
      echo json_encode($output);
    }

    public function viewSupply(){
      	$AREID=$this->input->post('areID', TRUE);
        $data['equipments']=$this->supplyModel->getEquipments($AREID);
        $data['personDetails']=$this->supplyModel->getPersonDetails($AREID);
        $data['supplyDetails']=$this->supplyModel->getSupplyDetails($AREID);
        $data['curSeqs']=$this->supplyModel->getCurSeq();
        $data['wastedCount']=$this->supplyModel->getWastedCount();
  	    echo json_encode($data);
    }


    public function viewLastSeq(){
      $data['curSeqs']=$this->supplyModel->getCurSeq();
      echo json_encode($data);
    }


    public function viewEqpt(){

      	$eid=$this->input->post('EID', TRUE);
        $data['specificEqpt']=$this->supplyModel->getSpecificEquipment($eid);

        $data['specificProp']=$this->supplyModel->getSpecificProperty($eid);

        $data['curSeq']=$this->supplyModel->getCurSeq();

        $yrs=substr(mb_substr($data['specificEqpt'][0]["dateIssued"],0,4),-2);
        $toBC=$data['specificEqpt'][0]["code"].$data['specificEqpt'][0]["subCode"]."-".$data['specificEqpt'][0]["fundCode"]."-".$yrs."-".$data['specificEqpt'][0]["officeCode"]."-".$data['specificEqpt'][0]["seq"];
    		$this->load->library('zend');
    		$this->zend->load('Zend/Barcode');
        $file=Zend_Barcode::draw('code128', 'image', array('text'=>$toBC), array());
        $store_image = imagepng($file,"assets/images/barcode/bc.png");        
        // echo $data["barcode"]->render();
  	    echo json_encode($data);
    }

    public function get_searchResult(){
        $data['searchresults']=$this->supplyModel->_getSearchResult();
        echo json_encode($data);
    }

    public function updateWaste(){
        $data=$this->supplyModel->updateWaste();
        $data=$this->supplyModel->addWasteLog();
        echo json_encode($data);
    }

    public function waste_bulk(){
        $data=$this->supplyModel->updateBulkWaste();
        $data=$this->supplyModel->addWasteLog_B();
        echo json_encode($data);
    }



    public function setAcquisition(){
      $this->supplyModel->newAcquisition($this->input->post(NULL, TRUE));
      redirect('supply/view');
    }

    public function newIAR(){
      $this->supplyModel->_newIAR($this->input->post(NULL, TRUE));
      redirect('supply/iar');
    }

    public function deleteDoc(){
      $this->supplyModel->delDocument($this->input->post(NULL,TRUE));
      redirect('supply/view');
    }

    public function addSupp(){
      $data=$this->supplyModel->_addSupplier($this->input->post(NULL,TRUE));
      echo json_encode($data);
    }

    public function addPr(){
      $data=$this->supplyModel->_addPr($this->input->post(NULL,TRUE));
      echo json_encode($data);
    }

    public function addPo(){
      $data=$this->supplyModel->_addPo($this->input->post(NULL,TRUE));
      echo json_encode($data);
    }

    public function addEqpt(){
      $data=$this->supplyModel->addEquipment($this->input->post(NULL,TRUE));
      echo json_encode($data);
    }

    public function deleteEqpt(){
      $this->supplyModel->delEqpt($this->input->post(NULL,TRUE));
      echo json_encode("");
    }

    public function setData(){
      $data=$this->supplyModel->editData($this->input->post("data",TRUE));
      echo json_encode($data[0]);
    }

    public function postDoc(){
      $data=$this->supplyModel->postDoc($this->input->post(NULL,TRUE));
      echo json_encode($data);
    }

    public function forwardDoc(){
      $data=$this->supplyModel->forwardDoc($this->input->post(NULL,TRUE));
      echo json_encode($data);
    }

    public function cancelDoc(){
      $data=$this->supplyModel->cancelDoc($this->input->post(NULL,TRUE));
      echo json_encode($data);
    }

    public function sequence(){
      $data=$this->supplyModel->getLastSequence($this->input->post(NULL,TRUE));
      echo json_encode($data);
    }

    public function wasteEqpt(){
      $this->supplyModel->_wasteEqpt($this->input->post(NULL,TRUE));
      echo json_encode(1);
    }

  

    public function transEqpt(){
      $this->supplyModel->_transEqpt($this->input->post(NULL,TRUE));
      echo json_encode(1);
    }

    public function getUserYears(){
      $data=$this->supplyModel->_getUserYears($this->input->post(NULL,TRUE));
      echo json_encode($data);
    }

    public function getUserDocs(){
      $data=$this->supplyModel->_getUserDocs($this->input->post(NULL,TRUE));
      echo json_encode($data);
    }

    public function getUserEquip(){
      $data=$this->supplyModel->_getUserEquip($this->input->post(NULL,TRUE));
      echo json_encode($data);
    }

    public function barcodeInventory(){
      $bc=explode(PHP_EOL,$this->input->post("bar",TRUE));
      print_r($bc);
    }
}
