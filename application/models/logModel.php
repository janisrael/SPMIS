<?php defined('BASEPATH') OR exit('No direct script access allowed');

class LogModel extends CI_Model{
  public function getSessionLog(){
    $this->db->select();
    $this->db->where('logType',3);
    $this->db->or_where('logType',4);
    $this->db->or_where('logType',5);
    $this->db->order_by('timestamp','DESC');
    $query=$this->db->get('tbllogs');

    return $query->result_array();
  }
  public function getChangeLog(){
    $this->db->select();
    $this->db->where('logType',1);
    $this->db->or_where('logType',2);
    $this->db->or_where('logType',6);
    $this->db->order_by('timestamp','DESC');
    $query=$this->db->get('tbllogs');

    return $query->result_array();
  }
  public function getAllLog(){
    $this->db->select();
    $this->db->order_by('timestamp','DESC');
    $query=$this->db->get('tbllogs');

    return $query->result_array();
  }


}
