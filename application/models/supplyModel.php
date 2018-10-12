<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SupplyModel extends CI_Model{
  public function getSupply(){
    $this->db->select('b.personID, a.paricsID, a.parics, dateIssued, surName, firstName, office, officeAcronym, a.docType,isPosted,datePosted');
    $this->db->join('tblpersonnel b','a.personID=b.personID');
    $this->db->join('refoffice c','b.officeID=c.officeID');
    $this->db->order_by('surName','ASC');
    $qry=$this->db->get('tblparics a');

    return $qry->result_array();
  }

  public function newAcquisition($rawData){
    $data=array(
      'parics'=>$rawData["codeNew"],
      'docType'=>$rawData["par"],
      'dateIssued'=>$rawData["dateNew_submit"],
      'personID'=>$rawData["user"],
      'headProperty'=>$rawData["head"],
      'obligation'=>$rawData["obNew"],
      'poNumber'=>$rawData["poNew"],
      'prNumber'=>$rawData["prNew"],
      'orNumber'=>$rawData["orNew"],
      'supplierID'=>$rawData["supplierPAR"],
      'dateGiven'=>$rawData["dateGivenOR_submit"],
      'fundID'=>$rawData["fundCode"],
    );
    $this->db->insert('tblparics',$data);

    // for logs
    $data=array(
      'username'=>$this->session->userdata('sppmo')['username'],
      'timestamp'=>time(),
      'affectedTable'=>'tblparics',
      'affectedField'=>'all',
      'logType'=>1,
      'recordID'=>$this->db->insert_id(),
    );
    $this->db->insert('tbllogs',$data);

    // for logs
  }

  public function _newIAR($rawData){
    $data=array(
      'iarNo'=>$rawData["codeNew"],
      'iarDate'=>$rawData["dateNew_submit"],
      'orNo'=>$rawData["orNew"],
      'orDate'=>$rawData["dateGivenOR_submit"],
      'poID'=>$rawData["poNew"],
      'prID'=>$rawData["prNew"],
      'inspector'=>$rawData["inspectNew"],
      'supplierID'=>$rawData["supplierPAR"],
      'officeID'=>$rawData["officeID"],
      'headProp'=>$rawData["head"],
    );
    $this->db->insert('tbliar',$data);

    $data=array(
      'username'=>$this->session->userdata('sppmo')['username'],
      'timestamp'=>time(),
      'affectedTable'=>'tbliar',
      'affectedField'=>'all',
      'logType'=>1,
      'recordID'=>$this->db->insert_id(),
    );
    $this->db->insert('tbllogs',$data);
  }

  public function getUsers(){
    $this->db->select('personID, surName, firstName, middleName,suffixName');
    $this->db->order_by("surName","ASC");
    $this->db->order_by("firstName","ASC");
    $this->db->order_by("middleName","ASC");
    $this->db->order_by("suffixName","ASC");
    $qry=$this->db->get('tblpersonnel');

    return $qry->result_array();
  }


  var $table = "tblparics a";
  var $select_column = array("b.personID", "a.paricsID", "a.parics", "dateIssued", "cancelledDate","forwardDate", "surName", "firstName","middleName","suffixName", "poNumber", "officeAcronym", "a.docType","isPosted","datePosted","isForward","isCancelled");
  var $order_column = array( "docType", "a.parics", "dateIssued", "surName", "poNumber","forwardDate");
  
  function make_query(){
    //$this->output->enable_profiler(TRUE);
       $this->db->select($this->select_column);
       $this->db->join('tblpersonnel b','a.personID=b.personID','left');
       $this->db->join('refoffice c','b.officeID=c.officeID','left');
       // $this->db->limit(10);

       $this->db->from($this->table);
       if(isset($_POST["search"]["value"])){
            $this->db->like("firstName", $_POST["search"]["value"]);
            $this->db->or_like("surName", $_POST["search"]["value"]);
            $this->db->or_like("middleName", $_POST["search"]["value"]);
            $this->db->or_like("suffixName", $_POST["search"]["value"]);
            $this->db->or_like("poNumber", $_POST["search"]["value"]);
            $this->db->or_like("a.parics", $_POST["search"]["value"]);

            $parics="";
            if(strcmp($_POST["search"]["value"],"(PAR)")==0){
              $parics="2";
              $this->db->or_like("docType",$parics);
            }else if(strcmp($_POST["search"]["value"],"(ICS)")==0){
              $parics="1";
              $this->db->or_like("docType",$parics);
            }
            $status="";
            if(strcmp(strtoupper($_POST["search"]["value"]),"FORWARDED")==0){
              $status="1";
              $this->db->or_like("isForward",$status);
            }else if(strcmp(strtoupper($_POST["search"]["value"]),"CANCELLED")==0){
              $status="1";
              $this->db->or_like("isCancelled",$status);
            }else if(strcmp(strtoupper($_POST["search"]["value"]),"FOR SIGNATURE")==0){
              $this->db->or_like("(isCancelled='0' AND isForward='0')",NULL,FALSE);
            }
       }
       if(isset($_POST["order"])){
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
       }else{
         $this->db->order_by('parics', 'DESC');
         $this->db->order_by('surName', 'ASC');
         $this->db->order_by('firstName', 'ASC');
       }
     }

    function make_datatables(){
         $this->make_query();
         if($_POST["length"] != -1){
              $this->db->limit($_POST['length'], $_POST['start']);
         }
         $this->db->limit(10);
         $query = $this->db->get();
         return $query->result();
    }

    function get_filtered_data(){
         $this->make_query();
    
         $query = $this->db->get();
         return $query->num_rows();
    }

    function get_all_data(){

         $this->db->select("*");
         $this->db->join('tblpersonnel b','a.personID=b.personID','left');
         $this->db->join('refoffice c','b.officeID=c.officeID','left');

         $this->db->from($this->table);
         return $this->db->count_all_results();
    }

    var $tableIar = "tbliar i";
    var $select_columnIar = array("i.iarID","i.iarNo","i.iarDate","i.orNo","i.orDate","b.surName","b.firstName","b.middleName","b.suffixName","i.spNo","s.supplier");
    var $order_columnIar = array("iarID","iarNo","iarDate","orNo","orDate","surName","spNo");


    function make_queryIar(){
         //$this->output->enable_profiler(TRUE);
         $this->db->select($this->select_columnIar);
         $this->db->join('tblpersonnel b','i.inspector=b.personID','left');
         $this->db->join('tblsupplier s','s.supplierID=i.supplierID','left');
         $this->db->join('refoffice c','b.officeID=c.officeID','left');
         $this->db->from($this->tableIar);
         if(isset($_POST["search"]["value"])){
              $this->db->like("firstName", $_POST["search"]["value"]);
              $this->db->or_like("surName", $_POST["search"]["value"]);
              $this->db->or_like("middleName", $_POST["search"]["value"]);
              $this->db->or_like("suffixName", $_POST["search"]["value"]);
              $this->db->or_like("office", $_POST["search"]["value"]);
              $this->db->or_like("officeAcronym", $_POST["search"]["value"]);
              $this->db->or_like("iarNo", $_POST["search"]["value"]);
              $this->db->or_like("supplier", $_POST["search"]["value"]);
         }
         if(isset($_POST["order"])){
              $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
         }else{
           $this->db->order_by('iarNo', 'DESC');
           $this->db->order_by('surName', 'ASC');
           $this->db->order_by('firstName', 'ASC');
         }
       }


      function make_datatablesIar(){
           $this->make_queryIar();
           if($_POST["length"] != -1){
                $this->db->limit($_POST['length'], $_POST['start']);
           }
           $query = $this->db->get();
           return $query->result();
      }

      function get_filtered_dataIar(){
           $this->make_queryIar();
           $query = $this->db->get();
           return $query->num_rows();
      }

      function get_all_dataIar(){
           $this->db->select("*");
           $this->db->join('tblpersonnel b','i.inspector=b.personID','left');
           $this->db->join('tblsupplier s','s.supplierID=i.supplierID','left');
           $this->db->join('refoffice c','b.officeID=c.officeID','left');
           $this->db->from($this->tableIar);
           return $this->db->count_all_results();
      }

    public function getEquipments($areid){
      //$this->output->enable_profiler(TRUE);
      $this->db->select("EQ.equipmentID, EQ.p_Id ,EQ.equipmentDesc, EQ.qty, EQ.unit, EQ.unitPrice, EQ.wastedQty, PR.subCode, PC.code,isPosted,isWasted,isTransferred,wasteNumber, par.isPosted, par.isForward,pt.surName AS tsur,pt.firstName AS tfirst,pt.middleName AS tmiddle,pt.suffixName AS tsuffix");
      $this->db->where("DE.paricsID",$areid);
      $this->db->join("tbldocequipment DE","DE.equipmentID = EQ.equipmentID","left");
      $this->db->join("tblparics par","par.paricsID = DE.paricsID","left");
      $this->db->join("tblproperty PR","EQ.propertyID = PR.propertyID","left");
      $this->db->join("tblpropertycategory PC","PR.categoryID = PC.categoryID","left");
      $this->db->join("tbltransfer t","t.transferEquip = EQ.equipmentID","left");
      $this->db->join("tblpersonnel pt","t.transferTo = pt.personID","left");
      $query=$this->db->get("tblequipment EQ");

      return $query->result_array();
    }

    /*public function getDocuments($areid){
      $this->db->select("DocCode, Document");
      $this->db->where("AREID",$areid);
      $query=$this->db->get("tbldocuments");

      return $query->result_array();
    }*/

    public function getPersonDetails($areid){
      //$this->output->enable_profiler(TRUE);
      $this->db->select('personID');
      $this->db->where("paricsID",$areid);
      $qry=$this->db->get('tblparics');

      $PID=$qry->row()->personID;

      $this->db->select("PE.surName, PE.firstName, PE.middleName, PE.suffixName,PO.position,O.office, O.officeAcronym");
      $this->db->where("personID",$PID);
      $this->db->join("refposition PO","PE.positionID = PO.positionID","left");
      $this->db->join("refoffice O","PE.officeID = O.officeID","left");
      $query=$this->db->get("tblpersonnel PE");

      return $query->result_array();
    }

    public function getSupplyDetails($areid){
      //$this->output->enable_profiler(TRUE);
      $this->db->select("`p`.`paricsID`,`s.supplierID`,`paricsID`, `parics`, `docType`, `dateIssued`, `p`.`personID`,`surName`,`firstName`,`middleName`,`suffixName`,`poNumber`,`prNumber`,`obligation`,`orNumber`,`dateGiven`,`fundCode`,`supplier`,`f`.`fundID`,f.fundCode,f.fundDesc,isPosted,datePosted");
      $this->db->join('reffund f','f.fundID=p.fundID','left');
      $this->db->join('tblsupplier s','s.supplierID=p.supplierID','left');
      $this->db->join('tblpersonnel pe','pe.personID=p.headProperty','left');
      $this->db->where("paricsID",$areid);
      $query=$this->db->get("tblparics p");

      return $query->result_array();
    }

    public function getSpecificEquipment($eid){
      $this->db->select("dateIssued,fundCode,o.officeID, eq.equipmentID, eq.equipmentDesc, eq.qty, eq.unit, eq.unitPrice, eq.propertyID, eq.life, eq.seq, PR.propertyID, PR.subCode, PR.subDesc, PC.categoryID, PC.code, o.officeCode, o.officeAcronym, o.office,isWasted,isTransferred,wasteNumber,pt.surName AS tsur,pt.firstName AS tfirst,pt.middleName AS tmiddle,pt.suffixName AS tsuffix");
      $this->db->where("eq.equipmentID",$eid);
      $this->db->join("tblproperty PR","eq.propertyID = PR.propertyID","left");
      $this->db->join("tblpropertycategory PC","PR.categoryID = PC.categoryID","left");
      $this->db->join("refoffice o","o.officeID = eq.officeID","left");
      $this->db->join("tbldocequipment de","de.equipmentID = eq.equipmentID","left");
      $this->db->join("tblparics p","p.paricsID = de.paricsID","left");
      $this->db->join("reffund f","p.fundID = f.fundID","left");
      $this->db->join("tbltransfer t","t.transferEquip = eq.equipmentID","left");
      $this->db->join("tblpersonnel pt","t.transferTo = pt.personID","left");
      $query=$this->db->get("tblequipment eq");
      return $query->result_array();
    }



    public function getSpecificProperty($eid){

      $this->db->select("id, equipmentID, propertyNumber, isWasted, isTransferred, notes");
      $this->db->where("equipmentID",$eid);
      $query=$this->db->get("tblpropertynumber");
      return $query->result_array();

    }

    
    public function getCurSeq(){
      // $this->db->order_by("id","ASC");
      // $query=$this->db->get("tblwaste");
      // return $query->result_array();
      $curYear = date("Y"); 
      $this->db->order_by("id","desc");
      $this->db->select("wasteNumber");
      $this->db->like('wasteNumber', $curYear);  
      $query=$this->db->get("tblwaste");
      return $query->result_array();
    }


    public function _getSearchResult(){
      // $property_number = $to_search;
      $property_number=$this->input->post('to_search');
      $this->db->select('p.parics, p.docType, p.poNumber, p.prNumber, p.dateIssued, p.dateGiven, p.orNumber, p.forwardDate,p.datePosted, rf.fundCode, p.obligation, PN.equipmentID, PN.notes, PN.propertyNumber,PN.wasteNumber, w.wasteNumber, w.dateWasted, dE.paricsID, dE.equipmentID, p.fundID, p.supplierID,s.supplier, Pe.IDNum, Pe.EmpNo, Pe.surName, Pe.firstName, Pe.middleName, ro.office, rp.position,e.equipmentDesc,e.qty,e.unitPrice, prg.code, ro.office');
       $this->db->from('tblpropertynumber PN');

      $this->db->join('tblwaste w','PN.wasteNumber = w.wasteNumber','left');
      $this->db->join('tbldocequipment dE','PN.equipmentID=dE.equipmentID','left');
      $this->db->join('tblequipment e','dE.equipmentID=e.equipmentID');
      $this->db->join('tblproperty pr', 'e.propertyID=pr.propertyID');
      $this->db->join('tblpropertycategory prg', 'pr.categoryID=prg.categoryID');
      $this->db->join('tblparics p','dE.paricsID=p.paricsID');
      $this->db->join('tblsupplier s','p.supplierID=s.supplierID');
      $this->db->join('tblpersonnel Pe','p.personID=Pe.personID');
      $this->db->join('reffund rf','p.fundID=rf.fundID');
      $this->db->join('refoffice ro','Pe.officeID=ro.officeID');
      $this->db->join('refposition rp','Pe.positionID=rp.positionID');
      $this->db->where('PN.propertyNumber', $property_number);
      $query=$this->db->get();
      return $query->result_array();
    }


    public function getWastedCount(){
      $this->db->order_by("id","ASC");
      $query=$this->db->get("tblpropertynumber");
      return $query->result_array();
    }

    public function updateBulkWaste(){
      $equipmentID=$this->input->post('equipmentID');
      $wasteNumber=$this->input->post('wasteNumber');
      $this->db->set('isWasted', "1");
      $this->db->set('wasteNumber', $wasteNumber);
      $this->db->where('equipmentID', $equipmentID);
      $this->db->where('isWasted', 0);
      $result=$this->db->update('tblpropertynumber');
      return $result;
    }

    public function updateWaste(){
      // $id=$this->input->post('id_waste');
      $id=$this->input->post('waste_id');
      $equipmentID=$this->input->post('equipment_id');
      $propertyNumber=$this->input->post('property_number');
      $isWasted=$this->input->post('is_wasted');
      $wasteNumber=$this->input->post('waste_number');
      $isTransferred=$this->input->post('is_transferred');
      $notes=$this->input->post('notes');

      $this->db->where('id', $id);
      $this->db->set('equipmentID', $equipmentID);
      $this->db->set('propertyNumber', $propertyNumber);
      $this->db->set('isWasted', $isWasted);
      $this->db->set('wasteNumber', $wasteNumber);
      $this->db->set('isTransferred', $isTransferred);
      $this->db->set('notes',$notes);

      $result=$this->db->update('tblpropertynumber');
      return $result;
    }

// transfer

   public function addTransfer(){
    
   }

// end of transfer


// insert waste details everytime an item is wasted
    public function addWasteLog(){
      $wasteNumber=$this->input->post('waste_number');
      $propertyNumber=$this->input->post('property_number');
      $dateWasted=$this->input->post('date_wasted');

      $data=array(
        'wasteNumber'=>$wasteNumber,
        'user'=>$this->session->userdata('sppmo')['username'],
        // 'propertyNumber'=>$propertyNumber,
        'dateWasted'=>$dateWasted,
        'action'=>'wasted',
      );
      $this->db->insert('tblwaste',$data);

    }
//


// insert waste details everytime an item is wasted
    public function addWasteLog_B(){
      $wasteNumber=$this->input->post('wasteNumber');
      // $propertyNumber=$this->input->post('property_number');
      $dateWasted=$this->input->post('dateWasted');
      $data=array(
        'wasteNumber'=>$wasteNumber,
        // 'propertyNumber'=>$propertyNumber,
        'user'=>$this->session->userdata('sppmo')['username'],
        'dateWasted'=>$dateWasted,
        'action'=>'wasted',
      );
      $this->db->insert('tblwaste',$data);
    }
//




    public function delDocument($data){
      $this->db->delete('tblparics',$data);
      $data=array(
        'username'=>$this->session->userdata('sppmo')['username'],
        'timestamp'=>time(),
        'affectedTable'=>'tblparics',
        'affectedField'=>'all',
        'logType'=>6,
        'recordID'=>$data["paricsID"],
      );
      $this->db->insert('tbllogs',$data);
    }

    public function getAccCode(){
      $this->db->select("propertyID, code, subCode, p.subDesc");
      $this->db->join("tblpropertycategory c", "c.categoryID = p.categoryID","left");
      $where = "oldCode is NULL";
      $this->db->where($where);
      $this->db->order_by("code","ASC");
      //$this->db->limit("20");
      $query=$this->db->get("tblproperty p");

      return $query->result_array();
    }




    public function getOffices(){
      $this->db->order_by("office","ASC");
      $query=$this->db->get("refoffice");

      return $query->result_array();
    }

    public function getPositions(){
      $this->db->order_by("positionID","ASC");
      $query=$this->db->get("refposition");

      return $query->result_array();
    }

    public function getShifts(){
      $this->db->order_by("shiftID","ASC");
      $query=$this->db->get("refshift");

      return $query->result_array();
    }

    public function getAppointments(){
      $this->db->order_by("appointDesc","ASC");
      $query=$this->db->get("refappoint");

      return $query->result_array();
    }

    public function getSuppliers(){
      $this->db->order_by("supplier","ASC");
      $query=$this->db->get("tblsupplier");

      return $query->result_array();
    }


// reffund table
    public function getFund(){
      $this->db->order_by("fundCode","ASC");
      $query=$this->db->get("reffund");

      return $query->result_array();
    }
// reffund table



    public function _addSupplier($raw){
      $this->db->insert('tblsupplier',$raw["data"]);

      $data["id"]=$this->db->insert_id();
      $data["supp"]=$raw["data"]["supplier"];
      $data2=array(
        'username'=>$this->session->userdata('sppmo')['username'],
        'timestamp'=>time(),
        'affectedTable'=>'tblsupplier',
        'affectedField'=>'all',
        'logType'=>1,
        'recordID'=>$data["id"],
      );
      $this->db->insert('tbllogs',$data2);
      return $data;
    }

    public function _addPr($raw){
      $this->db->insert('tblPo',$raw["data"]);

      $data["id"]=$this->db->insert_id();
      $data["prNo"]=$raw["data"]["prNo"];
      $data2=array(
        'username'=>$this->session->userdata('sppmo')['username'],
        'timestamp'=>time(),
        'affectedTable'=>'tblpr',
        'affectedField'=>'all',
        'logType'=>1,
        'recordID'=>$data["id"],
      );
      $this->db->insert('tbllogs',$data2);
      return $data;
    }

    public function _addPo($raw){
      $this->db->insert('tblsupplier',$raw["data"]);

      $data["id"]=$this->db->insert_id();
      $data["poNo"]=$raw["data"]["poNo"];
      $data2=array(
        'username'=>$this->session->userdata('sppmo')['username'],
        'timestamp'=>time(),
        'affectedTable'=>'tblpo',
        'affectedField'=>'all',
        'logType'=>1,
        'recordID'=>$data["id"],
      );
      $this->db->insert('tbllogs',$data2);
      return $data;
    }

    public function addEquipment($raw){
      $data=array(
        "propertyID"=>$raw["data"]["PropNo"],
        "officeID"=>$raw["data"]["Office"],
        "seq"=>$raw["data"]["Seq"],
        "unit"=>$raw["data"]["Unit"],
        "qty"=>$raw["data"]["Qty"],
        "unitPrice"=>$raw["data"]["UnitPrice"],
        "life"=>$raw["data"]["Life"],
        "equipmentDesc"=>$raw["data"]["Specification"],
        "p_Id"=>$raw["data"]["PropertyNumberID"],
      );
      $this->db->insert('tblequipment',$data);
      
      $id=$this->db->insert_id();
      $data=array(
        'username'=>$this->session->userdata('sppmo')['username'],
        'timestamp'=>time(),
        'affectedTable'=>'tblequipment',
        'affectedField'=>'all',
        'logType'=>1,
        'recordID'=>$id,
      );
      $this->db->insert('tbllogs',$data);




// inserting property numbers inside a loop
      $count = $raw["data"]["Qty"];
      for ( $i=1; $i <= $count; $i++){

        $data=array(
            "equipmentID"=>$id,
            "propertyNumber"=>$raw["data"]["PropertyNumbers"] . $i,
        );
          $this->db->insert('tblpropertynumber',$data);
      }

      // $this->db->insert_batch('tblpropertynumber',$data);

//

      $data=array(
        "paricsID"=>$raw["data"]["AREID"],
        "equipmentID"=>$id,
      );
      $this->db->insert('tbldocequipment',$data);

      return $id;
    }

    public function delEqpt($raw){
      $this->db->where("equipmentID",$raw["ID"]);
      $this->db->delete('tblequipment');
      $data=array(
        'username'=>$this->session->userdata('sppmo')['username'],
        'timestamp'=>time(),
        'affectedTable'=>'tblequipment',
        'affectedField'=>'all',
        'logType'=>6,
        'recordID'=>$raw["ID"],
      );
      $this->db->insert('tbllogs',$data);
    }

    public function editData($raw){
      //$this->output->enable_profiler(TRUE);
      /*if($raw["table"]=="tbldocuments"){
        $this->db->where("DocCode",$raw["column"]);
        $data=array(
          "Document"=>$raw["value"]
        );
      }else{
        $data=array(
          $raw["column"]=>$raw["value"]
        );
      }*/
      $this->db->select($raw["column"]);
      $this->db->where($raw["idcolumn"],$raw["id"]);
      $query=$this->db->get($raw["table"]);

      $data=array(
        $raw["column"]=>$raw["value"]
      );
      $this->db->where($raw["idcolumn"],$raw["id"]);
      $this->db->update($raw["table"],$data);
      $data=array(
        'username'=>$this->session->userdata('sppmo')['username'],
        'timestamp'=>time(),
        'affectedTable'=>$raw["table"],
        'affectedField'=>$raw["column"],
        'lastValue'=>$query->row(0)->$raw["column"],
        'newValue'=>$raw["value"],
        'logType'=>2,
        'recordID'=>$raw["id"],
      );
      $this->db->insert('tbllogs',$data);

      if($raw["column"]=="personID"){
        $this->db->select("position,office");
        $this->db->where("personID",$raw["value"]);
        $this->db->join("refposition PO","PE.positionID = PO.positionID","left");
        $this->db->join("refoffice O","PE.officeID = O.officeID","left");
        $query=$this->db->get("tblpersonnel PE");
        return $query->result_array();
      }

    }

    public function postDoc($raw){
      $data=array(
        "datePosted"=>$raw["data"]["datePosted"],
        "isPosted"=>1,
      );
      $this->db->where("paricsID",$raw["data"]["paricsID"]);
      $this->db->update("tblparics",$data);
      return;
    }

    public function forwardDoc($raw){
      $data=array(
        "forwardDate"=>$raw["data"]["forwardDate"],
        "isForward"=>1,
      );
      $this->db->where("paricsID",$raw["data"]["paricsID"]);
      $this->db->update("tblparics",$data);
      return;
    }




    public function cancelDoc($raw){
      $data=array(
        "cancelledDate"=>$raw["data"]["cancelDate"],
        "isCancelled"=>1,
      );
      $this->db->where("paricsID",$raw["data"]["paricsID"]);
      $this->db->update("tblparics",$data);
      return;
    }

    public function getLastSequence($data){
      //$this->output->enable_profiler(true);
      $this->db->select("dateIssued");
      $this->db->where("paricsID",$data["data"]["paricsID"]);
      $query=$this->db->get("tblparics p");
      $date=explode("-",$query->row(0)->dateIssued);

      $this->db->select("seq");
      $this->db->join("tbldocequipment de","de.equipmentID=e.equipmentID","left");
      $this->db->join("tblparics p","p.paricsID=de.paricsID","left");
      $this->db->where("propertyID",$data["data"]["propertyID"]);
      $this->db->where("year(dateIssued)",$date[0]);
      $this->db->order_by("dateIssued","DESC");
      $this->db->order_by("e.equipmentID","DESC");
      $query=$this->db->get("tblequipment e");
      if($query->row(0))
        return $query->row(0)->seq;
      else
        return "0";
    }

    public function getAllPR(){
      $this->db->order_by("prNo","ASC");
      $query=$this->db->get("tblpr");

      return $query->result_array();
    }

    public function getAllPO(){
      $this->db->order_by("poNo","ASC");
      $query=$this->db->get("tblpo");

      return $query->result_array();
    }

    public function getDocs(){
      $this->db->order_by("parics","DESC");
      $this->db->like("parics",date('y')."-");
      //$this->db->limit('1000');
      $query=$this->db->get("tblparics a");

      return $query->result_array();
    }

    public function forTransmit($data){
      $this->db->select("parics,dateIssued,surName,firstName,middleName,suffixName,office,officeAcronym");
      $this->db->where_in("paricsID",$data["transmitID"]);
      $this->db->order_by("parics","DESC");
      $this->db->like("parics",date('y')."-");
      //$this->db->limit('1000');
      $this->db->join('tblpersonnel b','a.personID=b.personID','left');
      $this->db->join('refoffice c','b.officeID=c.officeID','left');
      $query=$this->db->get("tblparics a");

      return $query->result_array();
    }

    public function getYear(){
      $this->db->select("YEAR(dateIssued) AS year");
      $this->db->distinct();
      $this->db->where("dateIssued IS NOT NULL");
      $this->db->order_by("YEAR(dateIssued)","DESC");
      $query=$this->db->get("tblparics");

      return $query->result_array();
    }

    public function forProp($year){
      $this->db->select("a.parics,dateIssued,surName,firstName,middleName,suffixName,c.office,c.officeAcronym,Qty,equipmentDesc,qty,unit,unitPrice,seq,code,subCode,ce.officeCode,fundDesc,fundCode,subDesc");
      $this->db->where("YEAR(dateIssued)",$year["year"]);
      $this->db->where("docType",2);
      $this->db->where("isPosted","1");
      $this->db->order_by("dateIssued","DESC");
      $this->db->order_by("de.paricsID","DESC");
      $this->db->join('reffund f','f.fundID=a.fundID','left');
      $this->db->join('tblpersonnel b','a.personID=b.personID','left');
      $this->db->join('refoffice c','b.officeID=c.officeID','left');
      $this->db->join('tbldocequipment de','de.paricsID=a.paricsID','left');
      $this->db->join('tblequipment e','e.equipmentID=de.equipmentID','left');
      $this->db->join('tblproperty p','p.propertyID=e.propertyID','left');
      $this->db->join('tblpropertycategory pe','pe.categoryID=p.categoryID','left');
      $this->db->join('refoffice ce','ce.officeID=e.officeID','left');
      $query=$this->db->get("tblparics a");

      return $query->result_array();
    }



    // waste
    public function _wasteEqpt($raw){

    // condition if ondatabase.wastedQty != zero then tblequipment.wastedQty=tblequipment.wastedQty + $raw["data"]["unitWasted"]

      $data=array(
        "wasteNumber"=>$raw["data"]["wasteNum"],
        "isWasted"=>1,
        "dateWasted"=>$raw["data"]["dateWasted"],
        "wastedQty"=>$raw["data"]["unitWasted"],
      );
     $this->db->where("equipmentID",$raw["data"]["equipmentID"]);
     $this->db->update("tblequipment",$data);
     return 1;
    }

    //

    public function _transEqpt($data){
      //print_r($data);
      $data=array(
        "isTransferred"=>1,
      );
      $this->db->where("equipmentID",$data["equipmentID"]);
      $this->db->update("tblequipment",$data);

      $data=array(
        "transferNum"=>$data["transNum"],
        "transferDate"=>$data["transferDate"],
        "transferTo"=>$data["transferTo"],
        "transferEquip"=>$data["equipmentID"],
      );
      $this->db->insert('tbltransfer',$data);
      return 1;
    }

    public function _getUserYears($data){
      $this->db->select("YEAR(dateIssued) AS year");
      $this->db->distinct();
      $this->db->where("dateIssued IS NOT NULL");
      $this->db->where("personID",$data["data"]["personID"]);
      $this->db->order_by("YEAR(dateIssued)","DESC");
      $query=$this->db->get("tblparics");

      return $query->result_array();
    }

    public function _getUserDocs($data){
      $this->db->select("parics,paricsID");
      $this->db->where("personID",$data["data"]["personID"]);
      $this->db->where("YEAR(dateIssued)",$data["data"]["year"]);
      $this->db->order_by("parics","DESC");
      $query=$this->db->get("tblparics");

      return $query->result_array();
    }

    public function _getUserEquip($data){
      $this->db->select("e.equipmentID,equipmentDesc,qty,unit,unitPrice,seq,code,subCode,fundCode,officeCode,parics");
      $this->db->where("a.paricsID",$data["data"]["doc"]);
      $this->db->join('tbldocequipment de','a.paricsID=de.paricsID','left');
      $this->db->join('tblequipment e','e.equipmentID=de.equipmentID','left');
      $this->db->join('reffund f','f.fundID=a.fundID','left');
      $this->db->join('tblproperty p','p.propertyID=e.propertyID','left');
      $this->db->join('tblpropertycategory pe','pe.categoryID=p.categoryID','left');
      $this->db->join('refoffice ce','ce.officeID=e.officeID','left');
      $this->db->order_by("e.equipmentID","DESC");
      $query=$this->db->get("tblparics a");

      return $query->result_array();
    }

    public function getInspectors(){
      $this->db->select('personID, surName, firstName, middleName,suffixName');
      $this->db->order_by("FIELD(personID,602,591,552,525,499,215) DESC");
      $this->db->order_by("surName","ASC");
      $this->db->order_by("firstName","ASC");
      $this->db->order_by("middleName","ASC");
      $this->db->order_by("suffixName","ASC");
      $qry=$this->db->get('tblpersonnel');

      return $qry->result_array();
    }
    public function getMonitoring(){
      
    }
}
