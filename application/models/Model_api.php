<?php 

class Model_api extends CI_Model{
	function __construct(){

		parent::__construct();
	}

function cari_indihome($idindihome){
	$this->db->select("*");
	$this->db->from("indihome_user");
	$this->db->where("no_indihome", $idindihome);
	
	return $this->db->count_all_results();
}
function register_indihome($idindihome, $addon, $nama, $alamat, $hp, $email){
	$data = array(
		'no_indihome'	=> $idindihome,
		'addon'			=> $addon,
		'nama'			=> $nama,
		'alamat'		=> $alamat,
		'hp'			=> $hp,
		'email'			=> $email,
		'status'		=> 1
	);
	
	$result = $this->db->insert('indihome_user', $data);
	
	$insert_id = $this->db->insert_id();
	return  $insert_id;
}
function register_login($username, $password){
	$data = array(
		'username'	=> $username,
		'password'	=> md5($password)
	);
	
	$result = $this->db->insert('login_siswa', $data);
	
	$insert_id = $this->db->insert_id();
	return  $insert_id;
}
function register_siswa($registerindihome, $registerlogin){
	$data = array(
		'id_login'		=> $registerlogin,
		'id_indihome'	=> $registerindihome
		
	);
	
	$result = $this->db->insert('siswa', $data);
	
	$insert_id = $this->db->insert_id();
	return  $insert_id;
}

function cari_user($idindihome){
	$this->db->select(
		"
		login_siswa.username as username,
		login_siswa.password as password,
		indihome_user.nama as nama,
		indihome_user.no_indihome,
		indihome_user.addon,
		indihome_user.nama,
		indihome_user.alamat,
		indihome_user.hp,
		indihome_user.email,
		indihome_user.status
		"
	);
	$this->db->from("login_siswa");
	$this->db->join("siswa", "login_siswa.id_login=siswa.id_login");
	$this->db->join("indihome_user", "siswa.id_indihome=indihome_user.id_indihome_user");
	$this->db->where("indihome_user.id_indihome_user", $idindihome);
	
	$query = $this->db->get();
	return $query->result();
}
function cari_user_indihome($idindihome){
	$this->db->select("*");
	$this->db->from("indihome_user");
	$this->db->where("id_indihome_user", $idindihome);
	
	$query = $this->db->get();
	return $query->row();
}

function cari_id_indihome($idindihome){
	$this->db->select("id_indihome_user");
	$this->db->from("indihome_user");
	$this->db->where("no_indihome", $idindihome);
	
	$query = $this->db->get();
	return $query->row();
}

function cari_login($idindihome){
	$this->db->select(
		"
		login_siswa.id_login
		"
	);
	$this->db->from("login_siswa");
	$this->db->join("siswa", "login_siswa.id_login=siswa.id_login");
	$this->db->join("indihome_user", "siswa.id_indihome=indihome_user.id_indihome_user");
	$this->db->where("indihome_user.id_indihome_user", $idindihome);
	
	$query = $this->db->get();
	return $query->result();
}

function hapus_login($idlogin){
	$this->db->where('id_login', $idlogin);
	$result = $this->db->delete('login_siswa');
	return $result;
}
function hapus_indihome($idindihome){
	$this->db->where('id_indihome_user', $idindihome);
	$result = $this->db->delete('indihome_user');
	return $result;
}

}

?>