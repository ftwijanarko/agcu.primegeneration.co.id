<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_poin extends CI_Model
{
	function __construct() {
		parent::__construct();
	}
	
//16 OKTOBER 2016 --------------
// DIMAS --
	function update_siswa($id_siswa, $data) {
		$result = NULL;
		if(!empty($id_siswa)) {
			$this->db->where('id_siswa', $id_siswa);
			$result = $this->db->update('siswa', $data);
		}
		return $result;
	}

	function fetch_poin_siswa($id_siswa) {
		$this->db->where('id_siswa', $id_siswa);
		$result = $this->db->get('siswa');
		$poin = $result->row();
		return !empty($poin->poin) ? $poin->poin : 0;
	}

	function fetch_poin_minus($id_konten) {
		$this->db->where('id_konten', $id_konten);
		$result = $this->db->get('bonus_konten');
		$poin = $result->row();
		return !empty($poin->poin) ? $poin->poin : 0;
	}

	function fetch_poin_bonus($alias_kategori="") {
		$this->db->where('alias_kategori', $alias_kategori);
		$result = $this->db->get('poin');
		$poin = $result->row();
		return !empty($poin->nilai) ? $poin->nilai : 0;
	}

	function add_poin_siswa($id_siswa, $alias_kategori) {
		$result = NULL;
		if(!empty($id_siswa) AND !empty($alias_kategori)) {
			$poin_siswa = $this->fetch_poin_siswa($id_siswa);
			$poin_bonus = $this->fetch_poin_bonus($alias_kategori);
			$data['poin'] = $poin_siswa + $poin_bonus;
			if($alias_kategori == 'login') {
				$data['last_login'] = date("Y-m-d");
			}
			
			$this->update_siswa($id_siswa, $data);		
			$result = $data['poin'];
		}
		return $result;
	}

	function cut_poin_siswa($id_siswa, $id_konten) {
		$result = NULL;
		if(!empty($id_siswa) AND !empty($id_konten)) {
			$poin_siswa = $this->fetch_poin_siswa($id_siswa);
			$poin_minus = $this->fetch_poin_minus($id_konten);
			
			if($poin_siswa >= $poin_minus) {
				$data['poin'] = $poin_siswa - $poin_minus;
				$result = $this->update_siswa($id_siswa, $data);
			}
		}
		return $result;
	}

}

