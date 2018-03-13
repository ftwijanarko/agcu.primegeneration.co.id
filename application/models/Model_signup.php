<?php 
/**
* 
*/
class Model_signup extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function cek_exist_user($username) {
		$this->db->where('username', $username);
		$query = $this->db->get('login_siswa');

		return $query->num_rows();
	}

	function cek_exist_email($email) {
		$this->db->or_where('email', $email);
		$query = $this->db->get('siswa');
		
		return $query->num_rows();
	}
	
	function add_user($username, $password, $nama, $email, $telepon, $telepon_ortu, $sekolah, $kelas, $timestamp, $jeniskelamin, $kota, $jenjang, $sekolahbaru){
		$result 	= null;
		$data_user 	= array(
			"username" => $username,
			"password" => $password
			);
		$tambah_user = $this->db->insert("login_siswa", $data_user);
		$id_login 	 = $this->db->insert_id();
		
		//jika menambahkan sekolah baru, input data sekolah ke tabel sekolah dulu...
		if($sekolah == "sekolahbaru"){
			$datasekolah = array(
				'kota_id'	=> $kota,
				'nama_sekolah'	=> $sekolahbaru,
				'jenjang'		=> $jenjang
			);
			$tambahsekolah 	= $this->db->insert("sekolah", $datasekolah);
			$sekolah 	 	= $this->db->insert_id();
		}
		
		//end input sekolah baru...
		
		if ($id_login != NULL) 
		{
			$data_siswa = array(
					"nama_siswa"		=> $nama,
					"email"				=> $email,
					"telepon"			=> $telepon,
					"telepon_ortu"		=> $telepon_ortu,
					"sekolah_id"		=> $sekolah,
					"kelas"				=> $kelas,
					"id_login"			=> $id_login,
					'timestamp'			=> $timestamp,
					'jenis_kelamin'		=> $jeniskelamin
				);
			$this->db->insert("siswa", $data_siswa);
			$result = $this->db->insert_id();
		}
		return $result;
	}

	function cek_akun_fb($fb_id)
	{
		$this->db->select("siswa.id_siswa, siswa.nama_siswa, siswa.email, siswa.foto, login_siswa.username");
		$this->db->from("login_siswa");
		$this->db->join("siswa", "siswa.id_login = login_siswa.id_login");
		$this->db->where('login_siswa.fb_id', $fb_id);
		// echo $this->db->_compile_select();
		$query = $this->db->get();

		return $query->row_array();
	}

function get_provinsi(){
	$this->db->select('*');
	$this->db->from('provinsi');
	
	$query = $this->db->get();
	return $query->result();
}

function get_kota_by_provinsi($idprovinsi=0){
	$this->db->select('*');
	$this->db->from('kota_kabupaten');
	if($idprovinsi > 0){
		$this->db->where('provinsi_id', $idprovinsi);
	}
	$query = $this->db->get();
	return $query->result();
}

function get_sekolah_by_kota($idkota=0){
	$this->db->select('*');
	$this->db->from('sekolah');
	if($idkota > 0){
		$this->db->where('kota_id', $idkota);
	}
	$query = $this->db->get();
	return $query->result();
}
function get_sekolah_by_kota_row($idsekolah=0){
	$this->db->select('*');
	$this->db->from('sekolah');
	$this->db->join("kota_kabupaten", "kota_kabupaten.id_kota = sekolah.kota_id");
	$this->db->join("provinsi", "provinsi.id_provinsi = kota_kabupaten.provinsi_id");
	if($idsekolah > 0){
		$this->db->where('sekolah.id_sekolah', $idsekolah);
	}
	$query = $this->db->get();
	return $query->row();
}
function cari_jenjang($idsekolah=0){
	$this->db->select('*');
	$this->db->from('sekolah');
	$this->db->where('id_sekolah', $idsekolah);
	
	$query = $this->db->get();
	return $query->row();
}

function cari_kelas_by_jenjang($jenjang=0){
	$this->db->select('*');
	$this->db->from('kelas');
	if($jenjang > 0){
		$this->db->where('jenjang', $jenjang);
	}
	$query = $this->db->get();
	return $query->result();
}
	
}
?>
