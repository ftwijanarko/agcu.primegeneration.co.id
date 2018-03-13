<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_kontak extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get_pesan($id){
		$this->db->where('id', $id);
		$result = $this->db->get('kontak');

		return $result->row();
	}

	function add_pesan($nama, $email, $hp, $pesan)
	{
		$data = array(
						'nama' 				=> $nama,
						'email' 			=> $email,
						'hp'	 			=> $hp,
						'pesan'   			=> $pesan
					 );
		$query = $this->db->insert('kontak', $data);

		return $query;
	}
  
}
