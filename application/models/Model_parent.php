<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_parent extends CI_Model{
function __construct(){
	parent::__construct();
}

function daftar($idsiswa, $nama, $email, $telepon, $username, $password){
	$data = array(
	'id_siswa'	=> $idsiswa,
	'nama_ortu'	=> $nama,
	'telepon'	=> $telepon,
	'email'		=> $email,
	'username'	=> $username,
	'password'	=> md5($password)
	);
	
	$result = $this->db->insert('parents', $data);
}

function cari_ortu_by_idsiswa($idsiswa){
	$this->db->select('*');
	$this->db->from('parents');
	$this->db->where('id_siswa', $idsiswa);
	
	$result = $this->db->count_all_results();
	return $result;
}

function get_ortu($idsiswa){
	$this->db->select('*');
	$this->db->from('parents');
	$this->db->where('id_siswa', $idsiswa);
	
	$query = $this->db->get();
	return $query->row();
}


function get_parent($idparent){
	$this->db->select('parents.*, siswa.*, parents.email as email_ortu, parents.telepon as telepon_ortu');
	$this->db->from('parents');
	$this->db->join("siswa", "siswa.id_siswa = parents.id_siswa");
	$this->db->where('parents.id_ortu', $idparent);
	
	$query = $this->db->get();
	return $query->row();
}

function edit($idortu, $nama, $email, $telepon, $username, $password){
	$data = array(
	'nama_ortu'	=> $nama,
	'telepon'	=> $telepon,
	'email'		=> $email,
	'username'	=> $username,
	'password'	=> md5($password)
	);
	
	$this->db->where('id_ortu', $idortu);
	$result = $this->db->update('parents', $data);

	return $result;
}

}
