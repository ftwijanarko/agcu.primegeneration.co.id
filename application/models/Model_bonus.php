<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_bonus extends CI_Model
{
	function __construct() {
		parent::__construct();
	}
	
//16 OKTOBER 2016 --------------
// DIMAS --
	function fetch_random_quote() {
		$this->db->limit(1);
		$this->db->order_by('id_quote', 'RANDOM');
		$query = $this->db->get('quotes');
		return $query->row();
	}

	function fetch_bonus_unlocked($id_siswa) {
		$this->db->where('siswa_id', $id_siswa);
		$query = $this->db->get('bonus_unlock');
		return $query->row();
	}

	function update_bonus_unlock($id_siswa, $data) {
		$result = 0;
		$this->db->where('siswa_id', $id_siswa);
		$check = $this->db->get('bonus_unlock');
		if(empty($check->num_rows())) {
			$data['siswa_id'] = $id_siswa;
			$result = $this->db->insert('bonus_unlock', $data);
		} 
		else {
			$this->db->where('siswa_id', $id_siswa);
			$result = $this->db->update('bonus_unlock', $data);
		}
		return $result;
	}

	function fetch_limit_bonus_video($limit) {
		$this->db->select('*');
		$this->db->from('bonus_konten');
		$this->db->join('bonus_kategori', 'bonus_kategori.id_kategori = bonus_konten.kategori_id');
		$this->db->where('bonus_konten.kategori_id', 1);
		if(!empty($limit)) {
			$this->db->limit($limit);
		}
		$this->db->order_by('id_konten', 'RANDOM');
		$query = $this->db->get();
		return $query->result();
	}

	function fetch_limit_bonus_konten($limit) {
		$this->db->select('*');
		$this->db->from('bonus_konten');
		$this->db->join('bonus_kategori', 'bonus_kategori.id_kategori = bonus_konten.kategori_id');
		$this->db->where('bonus_konten.kategori_id !=', 1);
		if(!empty($limit)) {
			$this->db->limit($limit);
		}
		$this->db->order_by('id_konten', 'RANDOM');
		$query = $this->db->get();
		return $query->result();
	}


}

