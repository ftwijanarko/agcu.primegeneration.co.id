<?php 

/**
* 
*/
class Model_login extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function cek_login($username, $password)
	{
		$result = null;
		$this->db->select("siswa.id_siswa, siswa.nama_siswa, siswa.kelas, siswa.email, siswa.foto, siswa.last_login, login_siswa.username");
		$this->db->from("login_siswa");
		$this->db->join("siswa", "siswa.id_login = login_siswa.id_login");
		$this->db->where("(username = '$username' OR email = '$username')");
		$this->db->where('password', md5($password));
		$result = $this->db->get();
		return $result->row_array();
	}
	
	function cek_user_akses($id_siswa)
	{
		$this->db->select("paket_aktif.id_paket_aktif, paket_aktif.id_siswa, paket_aktif.isaktif");
		$this->db->from("paket_aktif");
		$this->db->where('paket_aktif.id_siswa', $id_siswa);
		$query = $this->db->get();

		return $query->result();
	}

}