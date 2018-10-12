<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SummaryModel extends CI_Model{


  public function getEndUser($data){
    //$this->output->enable_profiler(TRUE);
    $this->db->select("p.firstName,p.surName,p.middleName,p.suffixName,p.personID");
    $this->db->distinct();
    $this->db->join("tblpersonnel p","a.personID=p.personID");
    $this->db->join("refoffice o","o.officeID=p.officeID");
    if($data["data"]["User"]!="0"){
      $this->db->where("a.personID",$data["data"]["User"]);
      
    }else if($data["data"]["Date"]!="0"){
      $this->db->like("a.dateGiven",$data["data"]["Date"]);

    }else{
      $this->db->where("o.officeID",$data["data"]["Office"]);
    }
    $this->db->where("isPosted",1);
      if($data["data"]["DocType"]!=3)
    $this->db->where("docType",$data["data"]["DocType"]);
    $this->db->order_by("p.firstName","ASC");
    $query=$this->db->get("tblparics a");

    return $query->result_array();
  }

  public function getSummary($eid){
    /*
      SELECT e.qty,e.equipmentDesc,e.unit,e.unitPrice,f.fundID,e.Office,e.Seq,g.Code ecode,t.SubCode,a.DateIssued,a.paricsID acode,o.DateGiven FROM tblparics A LEFT JOIN tblpersonnel P ON P.personID = A.personID LEFT JOIN tblequipment e ON a.ARpersonID=e.ID LEFT JOIN tblproperty t ON t.personID=e.PropNo LEFT JOIN tblpropertycategory g ON g.GID=t.GID LEFT JOIN reffunds f ON f.ID=e.Fund LEFT JOIN tblor o ON o.ORID=e.ORID WHERE p.personID=77
    */

      // SELECT * FROM `tblparics` WHERE `docType` = 2 AND `dateGiven` LIKE '%2017%'

    $this->db->select("e.qty,e.equipmentDesc,e.unit,e.unitPrice,f.fundID,fundCode,officeCode,o.officeID,e.seq,g.code,t.subCode,a.dateIssued,a.parics,dateGiven");
    $this->db->join("tblpersonnel p","p.personID=a.personID","left");
    $this->db->join("tbldocequipment de","de.paricsID=a.paricsID","left");
    $this->db->join("tblequipment e","de.equipmentID=e.equipmentID","left");
    $this->db->join("tblproperty t","t.propertyID=e.propertyID","left");
    $this->db->join("tblpropertycategory g","g.categoryID=t.categoryID","left");
    $this->db->join("refoffice o","o.officeID=p.officeID","left");
    $this->db->join("reffund f","f.fundID=a.fundID","left");
    $this->db->where("p.personID",$eid);
    $this->db->where("docType",2);
    $this->db->where("isPosted",1);
   
    $this->db->order_by("a.parics","DESC");
    $query=$this->db->get("tblparics a");

    return $query->result_array();
  }

  public function getSummary2($eid){
    /*
      SELECT e.qty,e.equipmentDesc,e.unit,e.unitPrice,f.fundID,e.Office,e.Seq,g.Code ecode,t.SubCode,a.DateIssued,a.paricsID acode,o.DateGiven FROM tblparics A LEFT JOIN tblpersonnel P ON P.personID = A.personID LEFT JOIN tblequipment e ON a.ARpersonID=e.ID LEFT JOIN tblproperty t ON t.personID=e.PropNo LEFT JOIN tblpropertycategory g ON g.categoryID=t.categoryID LEFT JOIN reffunds f ON f.ID=e.Fund LEFT JOIN tblor o ON o.ORID=e.ORID WHERE p.personID=77
    */
    $this->db->select("e.qty,e.equipmentDesc,e.unit,e.unitPrice,f.fundID,fundCode,officeCode,o.officeID,e.seq,g.code,t.subCode,a.dateIssued,a.parics,dateGiven");
    $this->db->join("tblpersonnel p","p.personID=a.personID","left");
    $this->db->join("tbldocequipment de","de.paricsID=a.paricsID","left");
    $this->db->join("tblequipment e","de.equipmentID=e.equipmentID","left");
    $this->db->join("tblproperty t","t.propertyID=e.propertyID","left");
    $this->db->join("tblpropertycategory g","g.categoryID=t.categoryID","left");
    $this->db->join("refoffice o","o.officeID=p.officeID","left");
    $this->db->join("reffund f","f.fundID=a.fundID","left");
    $this->db->where("p.personID",$eid);
    $this->db->where("docType",1);
    $this->db->where("isPosted",1);
    $this->db->order_by("a.parics","DESC");
    $query=$this->db->get("tblparics a");

    return $query->result_array();
  }

  public function getSummary3($eid){
    /*
      SELECT e.qty,e.equipmentDesc,e.unit,e.unitPrice,f.fundID,e.Office,e.Seq,g.Code ecode,t.SubCode,a.DateIssued,a.paricsID acode,o.DateGiven FROM tblparics A LEFT JOIN tblpersonnel P ON P.personID = A.personID LEFT JOIN tblequipment e ON a.ARpersonID=e.ID LEFT JOIN tblproperty t ON t.personID=e.PropNo LEFT JOIN tblpropertycategory g ON g.categoryID=t.categoryID LEFT JOIN reffunds f ON f.ID=e.Fund LEFT JOIN tblor o ON o.ORID=e.ORID WHERE p.personID=77
    */
    $this->db->select("e.qty,e.equipmentDesc,e.unit,e.unitPrice,f.fundID,fundCode,officeCode,o.officeID,e.seq,g.code,t.subCode,a.dateIssued,a.parics,dateGiven");
    $this->db->join("tblpersonnel p","p.personID=a.personID","left");
    $this->db->join("tbldocequipment de","de.paricsID=a.paricsID","left");
    $this->db->join("tblequipment e","de.equipmentID=e.equipmentID","left");
    $this->db->join("tblproperty t","t.propertyID=e.propertyID","left");
    $this->db->join("tblpropertycategory g","g.categoryID=t.categoryID","left");
    $this->db->join("refoffice o","o.officeID=p.officeID","left");
    $this->db->join("reffund f","f.fundID=a.fundID","left");
    $this->db->where("p.personID",$eid);
    $this->db->where("isPosted",1);
    $this->db->order_by("a.parics","DESC");
    $query=$this->db->get("tblparics a");

    return $query->result_array();
  }

  public function getByYear($data){
    $this->db->select("equipmentDesc,fundCode,office,parics,dateIssued,dateGiven,surName,firstName,middleName,suffixName,qty,unit,unitPrice,officeCode,seq,subCode,officeAcronym,code");

    $this->db->join("tblpersonnel p","p.personID=a.personID","left");
    $this->db->join("tbldocequipment de","de.paricsID=a.paricsID","left");
    $this->db->join("tblequipment e","de.equipmentID=e.equipmentID","left");
    $this->db->join("tblproperty t","t.propertyID=e.propertyID","left");
    $this->db->join("tblpropertycategory g","t.categoryID=g.categoryID","left");
    $this->db->join("refoffice o","o.officeID=e.officeID","left");
    $this->db->join("reffund f","f.fundID=a.fundID","left");
    if($data["Code"]!="0"){
      $this->db->where("e.propertyID",$data["Code"]);
      //$this->db->where("dateIssued",$data["Code"]);
      //$this->db->where("docType",$data["opt"]);
    }else{
      // $this->db->where("o.dateGiven",$data["offCode4"]);
      $this->db->like("a.dateGiven",$data["filter_year"]);

      if($data["opt"]!=3)
        $this->db->where("docType",$data["opt"]);
    }
    $this->db->where("isPosted",1);
    $this->db->order_by("parics","DESC");
    $query=$this->db->get("tblparics a");

    return $query->result_array();
  }

  public function export_csv(){

    $filter_year_csv = $this->input->post('filter_year_csv');
    $doc_type = $this->input->post('opt_csv');



    $this->db->select("surName,firstName,qty,unit,unitPrice,qty * unitPrice AS 'amount',equipmentDesc,dateGiven,obligation,poNumber,prNumber,orNumber,supplier,parics,code,subCode,fundCode,officeCode,seq,dateIssued");

    $this->db->join("tblpersonnel p","p.personID=a.personID","left");
    $this->db->join("tbldocequipment de","de.paricsID=a.paricsID","left");
    $this->db->join("tblequipment e","de.equipmentID=e.equipmentID","left");
    $this->db->join("tblproperty t","t.propertyID=e.propertyID","left");
    $this->db->join("tblpropertycategory g","t.categoryID=g.categoryID","left");
    $this->db->join("refoffice o","o.officeID=e.officeID","left");
    $this->db->join("reffund f","f.fundID=a.fundID","left");
    $this->db->join("tblsupplier su","a.supplierID=su.supplierID");

    $this->db->like("a.dateGiven",$filter_year_csv);
    

    if($doc_type==1){
      $this->db->where("a.docType",1);
  
    }elseif($doc_type==2){
      $this->db->where("a.docType",2);
 
    }

    $this->db->where("isPosted",1);
    $this->db->order_by("parics","DESC");
    $query=$this->db->get("tblparics a");

    return $query->result_array();
    // $this->db->where('isPosted',1);
    // $this->db->order_by('parics', 'DESC');
    // $query=$this->db->get('tblparics a');

    // return $query->result_array();
    // $date_issued_data = $this->db->select('');
    // $this->db->select('docType,dateIssued,dateGiven,personID,poNumber,prNumber,obligation,orNumber,fundID,supplierID');
    // $this->db->like("dateGiven",$filter_year_csv);
    // $query=$this->db->get("tblparics");

    // return $query->result_array();
  }




  public function getEquipOffice($data){
    //$this->output->enable_profiler(TRUE);
    //print_r($data);
    $this->db->select("equipmentDesc,fundCode,office,parics,dateIssued,dateGiven,surName,firstName,middleName,suffixName,qty,unit,unitPrice,officeCode,seq,subCode,officeAcronym,code");
    $this->db->join("tblpersonnel p","p.personID=a.personID","left");
    $this->db->join("tbldocequipment de","de.paricsID=a.paricsID","left");
    $this->db->join("tblequipment e","de.equipmentID=e.equipmentID","left");
    $this->db->join("tblproperty t","t.propertyID=e.propertyID","left");
    $this->db->join("tblpropertycategory g","t.categoryID=g.categoryID","left");
    $this->db->join("refoffice o","o.officeID=e.officeID","left");
    $this->db->join("reffund f","f.fundID=a.fundID","left");
    if($data["Code"]!="0"){
      $this->db->where("e.propertyID",$data["Code"]);
      //$this->db->where("dateIssued",$data["Code"]);
      //$this->db->where("docType",$data["opt"]);
    }else{
      $this->db->where("o.officeID",$data["offCode4"]);
      if($data["opt"]!=3)
        $this->db->where("docType",$data["opt"]);
    }
    $this->db->where("isPosted",1);
    $this->db->order_by("parics","DESC");
    $query=$this->db->get("tblparics a");

    return $query->result_array();
  }


  public function getPerson($eid){
    //$this->output->enable_profiler(TRUE);

    $this->db->select("PE.surName,PE.middleName,PE.suffixName, PE.firstName,PO.position,O.office, O.officeAcronym");
    $this->db->where("personID",$eid);
    $this->db->join("refposition PO","PE.positionID = PO.positionID","left");
    $this->db->join("refoffice O","PE.officeID = O.officeID","left");
    $query=$this->db->get("tblpersonnel PE");

    return $query->result_array();
  }

  public function getHead(){
    $this->db->select("a.headProperty");
    $this->db->distinct();
    $this->db->order_by("a.dateIssued","DESC");
    $this->db->limit(1);
    $query=$this->db->get("tblparics a");
    $eid=$query->row()->headProperty;

    $this->db->select("firstName,surName,middleName,suffixName,position,office");
    $this->db->where("personID",$eid);
    $this->db->join("refposition PO","PE.positionID = PO.positionID","left");
    $this->db->join("refoffice O","PE.officeID = O.officeID","left");
    $query=$this->db->get("tblpersonnel PE");

    return $query->result_array();
  }

  public function getAccCode(){
    $this->db->select("p.propertyID, code, subCode, p.subDesc");
    $this->db->distinct();
    $this->db->where("docType",2);
    $this->db->join("tblproperty p", "p.propertyID = e.propertyID","inner");
    $this->db->join("tblpropertycategory c", "c.categoryID = p.categoryID","left");
    $this->db->join("tbldocequipment de","de.equipmentID=e.equipmentID","left");
    $this->db->join("tblparics a","a.paricsID= de.paricsID","left");
    $query=$this->db->get("tblequipment e");

    return $query->result_array();
  }

  public function getOffices(){
    $this->db->select("o.officeID, office, officeAcronym, officeCode");
    $this->db->distinct();
    $this->db->join("refoffice o", "o.officeID = e.officeID","inner");
    $this->db->order_by("office","ASC");
    $query=$this->db->get("tblequipment e");

    return $query->result_array();
  }

  public function getUsers(){
    $this->db->select('p.personID, surName, firstName, middleName,suffixName');
    $this->db->distinct();
    $this->db->where("isPosted",1);
    $this->db->join("tblpersonnel p", "p.personID = a.personID","inner");
    $this->db->order_by("surName","ASC");
    $this->db->order_by("firstName","ASC");
    $this->db->order_by("middleName","ASC");
    $this->db->order_by("suffixName","ASC");
    $qry=$this->db->get('tblparics a');

    return $qry->result_array();
  }
}
