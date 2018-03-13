<?php 

/**
* 
*/
class Model_lupa_password extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function cek_email($email){
		$this->db->select('siswa.nama_siswa, siswa.email, siswa.foto, login_siswa.username');
		$this->db->from('siswa');
		$this->db->join('login_siswa', 'login_siswa.id_login = siswa.id_login', 'left');
		$this->db->where('siswa.email', $email);
		// echo $this->db->_compile_select();
		$result = $this->db->get();

		return $result->row();
	}

	function fetch_siswa_by_id($id_siswa)
	{
		$this->db->select('siswa.nama_siswa, siswa.email, siswa.foto, login_siswa.username');
		$this->db->from('siswa');
		$this->db->join('login_siswa', 'login_siswa.id_login = siswa.id_login', 'left');
		$this->db->where('siswa.id_siswa', $id_siswa);
		// echo $this->db->_compile_select();
		$result = $this->db->get();

		return $result->row();
	}

	function cek_key($key)
	{
		$this->db->select('login_siswa.id_login, login_siswa.recover_key');
		$this->db->from('login_siswa');
		$this->db->where('login_siswa.recover_key', $key);
		$result = $this->db->get();

		return $result->row();
	}

	function simpan_key($key, $email)
	{
		$this->db->select('siswa.id_login');
		$this->db->from('siswa');
		$this->db->where('siswa.email', $email);
		$result = $this->db->get();
		$id_login = $result->row()->id_login;

		$result = FALSE;
		if(!empty($id_login)) {
			$this->db->set('login_siswa.recover_key', $key);
			$this->db->where('login_siswa.id_login', $id_login);
			$result = $this->db->update('login_siswa');
		}
		return $result;
	}

	function remove_key($key)
	{
		$this->db->set('login_siswa.recover_key', '');
		$this->db->where('login_siswa.recover_key', $key);
		$result = $this->db->update('login_siswa');

		return $result;
	}

	function update_password($id_login, $password)
	{
		$password = md5($password);
		$this->db->set('login_siswa.password', $password);
		$this->db->where('login_siswa.id_login', $id_login);
		$result = $this->db->update('login_siswa');
		return $result;
	}

}