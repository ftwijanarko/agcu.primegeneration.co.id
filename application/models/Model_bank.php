<?php 

/**
* 
*/
class Model_bank extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get_bank(){
		$result=$this->db->get("bank");

		return $result->result();
	}
}