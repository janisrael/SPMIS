<?php defined('BASEPATH') OR exit('No direct script access allowed');

class personModel extends CI_Model{

  var $table = 'tblpersonnel';
  var $column_order = array('IDNum', 'EmpNo', 'surName', 'firstName');
  var $column_search = array('IDNum', 'EmpNo','surName', 'firstName');
  var $order = array('personID' => 'desc');

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

     private function _get_datatables_query()
    {

        //    $this->db->select('tblpersonnel.IDNum, tblpersonnel.EmpNo, tblpersonnel.surName, tblpersonnel.firstName, tblpersonnel.middleName, tblpersonnel.suffixName, refnametitle.nameTitle, tblpersonnel.bday, tblpersonnel.bplace, tblpersonnel.sex, refcivilstat.civilStatDesc, tblpersonnel.addHome, tblpersonnel.addEmail, refoffice.officeAcronym, refposition.position, refshift.shiftDesc, refappoint.appointDesc');
        // $this->db->from('tblpersonnel');
        // $this->db->join('refnametitle', 'tblpersonnel.nameTitleID=refnametitle.nameTitleID', 'inner');
        // $this->db->join('refcivilstat', 'tblpersonnel.civilStatID=refcivilstat.civilStatID', 'inner');
        // $this->db->join('refoffice', 'tblpersonnel.officeID=refoffice.officeID', 'inner');
        // $this->db->join('refposition', 'tblpersonnel.positionID=refposition.positionID', 'inner');
        // $this->db->join('refshift', 'tblpersonnel.shiftID=refshift.shiftID', 'inner');
        // $this->db->join('refappoint', 'tblpersonnel.appointID=refappoint.appointID', 'inner');
        // $query = $this->db->get();
        // return $query->result();
        
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }


    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($personID)
    {
        $this->db->from($this->table);
        $this->db->where('personID',$personID);
        $query = $this->db->get();

        return $query->row();
    }
      

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($personID)
    {
        $this->db->where('personID', $personID);
        $this->db->delete($this->table);
    }
}
