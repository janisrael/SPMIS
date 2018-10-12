<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model{

	function checkDuplicate($username)
	{
		$this->db->select('Username');
		$this->db->from('user');
		$this->db->like('Username', $username);
		return $this->db->count_all_results();
	}
	
	function insertUser($data)
	{
		if($this->db->insert('user', $data))
		{
			return  $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}
 

	public function login($username,$password){
		$hashPass=password_hash($password, PASSWORD_DEFAULT);
		$this->db->where('Username',$username);
		$result=$this->db->get('user');


		if(password_verify($password, $result->row(0)->Password)) {
			if(password_needs_rehash($hashPass, PASSWORD_DEFAULT)) {
			    $hashPass = password_hash($password, PASSWORD_DEFAULT);
					$passwordHashed=$hashPass;
					$this->db->set('Password',$passwordHashed);
			    $this->db->where('Username',$username);
			    $this->db->update('user',$data);
			}
			if($result->num_rows()==1){
				$accessLvl=$result->row(0)->accessLvl;

				$data=array(
					'username'=>$username,
					'logType'=>3,
					'timestamp'=>time(),
				);
				$this->db->insert('tbllogs',$data);

				return $accessLvl;
			}
		}
		return false;
	}

	public function checkPass($oldPass,$username,$newPass){
		$hashPass=password_hash($oldPass, PASSWORD_DEFAULT);
		$this->db->where('Username',$username);
		$result=$this->db->get('user');


		if(password_verify($oldPass, $result->row(0)->Password)) {
			if(password_needs_rehash($hashPass, PASSWORD_DEFAULT)) {
			    $hashPass = password_hash($oldPass, PASSWORD_DEFAULT);
			    $passwordHashed=$hashPass;
				$this->db->set('Password',$passwordHashed);
			    $this->db->where('Username',$username);
			    $this->db->update('user',$data);
			}
			if($result->num_rows()==1){
				//$this->output->enable_profiler(TRUE);
				$passwordHashed=password_hash($newPass, PASSWORD_DEFAULT);
				$this->db->set('Password',$passwordHashed);
				$this->db->where('Username',$username);
				$this->db->update('user');

				$data=array(
					'username'=>$username,
					'lastValue'=>$hashPass,
					'newValue'=>$passwordHashed,
					'affectedField'=>"Password",
					'affectedTable'=>"user",
					'logType'=>5,
					'timestamp'=>time(),
				);
				$this->db->insert('tbllogs',$data);
				return true;
			}
		}
		return false;
	}

	public function logout(){
		$data=array(
			'username'=>$this->session->userdata('sppmo')['username'],
			'timestamp'=>time(),
			'logType'=>4,
		);
		$this->db->insert('tbllogs',$data);
	}
}
