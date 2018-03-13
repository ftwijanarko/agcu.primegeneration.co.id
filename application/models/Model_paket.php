<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_paket extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get_all_paket(){
		$query = $this->db->get("paket");
		
		return $query->result_array(); 
		//result_array is needed to search index by key
	}

	function get_paket_reguler(){
		$result=$this->db->where("tipe", 0);
		$result=$this->db->order_by('durasi', 'ASC');
		$result=$this->db->get("paket");

		return $result->result();
	}

	function get_paket_premium(){
		$result=$this->db->where("tipe", 1);
		$result=$this->db->order_by('durasi', 'ASC');
		$result=$this->db->get("paket");

		return $result->result();	
	}

	function get_detail_paket($id_paket){
		$result= $this->db->where("id_paket", $id_paket);
		$result=$this->db->get("paket");

		return $result->result();
	}

	function get_durasi($id_paket){
		$this->db->select("durasi");
		$this->db->from("paket");
		$this->db->where("id_paket", $id_paket);

		$result=$this->db->get();

		return $result->result();
	}
}