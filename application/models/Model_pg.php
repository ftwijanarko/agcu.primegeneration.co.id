<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_pg extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}


	// GENERAL
	function get_navbar_links()
	{
		$this->db->select('*');
		$this->db->from('mata_pelajaran');
		$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		$this->db->order_by('mata_pelajaran.nama_mapel', 'ASC');

		$query = $this->db->get();
		return $query->result();
	}

	function get_konten_materi_by_id($id_sub_materi, $id_kategori)
	{
		$this->db->select('*');
		$this->db->from('konten_materi');
		$this->db->join('sub_materi', 'sub_materi.id_sub_materi = konten_materi.sub_materi_id', 'left');
		$this->db->join('materi_pokok', 'materi_pokok.id_materi_pokok = sub_materi.materi_pokok_id', 'left');
		$this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		$conditions = array(
			'sub_materi.id_sub_materi' => $id_sub_materi,
			'konten_materi.kategori' => $kategori_id
			 );
		$this->db->where($conditions);
		//tester
		//echo $this->db->_compile_select();
		$query = $this->db->get();

		return $query->row();
	}

	function get_materi_by_mapel($id_mapel)
	{
		$this->db->select('*');
		$this->db->from('materi_pokok');
		$this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
		$this->db->where('materi_pokok.mapel_id', $id_mapel);
		$this->db->order_by('materi_pokok.urutan', 'ASC');
		//tester
		//echo $this->db->_compile_select();
		$query = $this->db->get();

		return $query->result();
	}
	
	
	function get_sub_materi_by_materi($id_materi)
	{
		$this->db->select('*');
		$this->db->from('sub_materi');
		$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
		$this->db->where('sub_materi.materi_pokok_id', $id_materi);
		//tester
		//echo $this->db->_compile_select(); exit;
		$query = $this->db->get();
		
		return $query->row();
	}
	
	function get_konten_by_sub_materi($id_materi)
	{
		$this->db->select('*');
		$this->db->from('konten_materi');
		$this->db->join('sub_materi', 'sub_materi.id_sub_materi = konten_materi.sub_materi_id', 'left');
		$this->db->join('materi_pokok', 'materi_pokok.id_materi_pokok = sub_materi.materi_pokok_id', 'left');
		$this->db->where('sub_materi.materi_pokok_id', $id_materi);
		$this->db->order_by('sub_materi.urutan_materi', 'ASC');
		//tester
		//echo $this->db->_compile_select();
		$query = $this->db->get();

		return $query->result();
	}
	
	function get_konten_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('konten_materi');
		$this->db->join('sub_materi', 'sub_materi.id_sub_materi = konten_materi.sub_materi_id', 'left');
		$this->db->join('materi_pokok', 'materi_pokok.id_materi_pokok = sub_materi.materi_pokok_id', 'left');
		$this->db->where('id_konten', $id);
		//tester
		//echo $this->db->_compile_select();
		$query = $this->db->get();

		return $query->row();
	}
	
	function get_mapel_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('mata_pelajaran');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
		$this->db->where('id_mapel', $id);
		//tester
		//echo $this->db->_compile_select();
		$query = $this->db->get();

		return $query->row();
	}
	
	function get_mapel_by_materi($id)
	{
		$this->db->select('*');
		$this->db->from('materi_pokok');
		$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
		$this->db->where('id_materi_pokok', $id);
		//tester
		//echo $this->db->_compile_select();
		$query = $this->db->get();

		return $query->row();
	}
	
	function get_mapel_by_konten($id)
	{
		$this->db->select('*');
		$this->db->from('konten_materi');
		$this->db->join('sub_materi', 'konten_materi.sub_materi_id = sub_materi.id_sub_materi', 'left');
		$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
		$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
		$this->db->where('id_konten', $id);
		//tester
		//echo $this->db->_compile_select();
		$query = $this->db->get();

		return $query->row();
	}
	
	function get_sub_materi_by_konten($id)
	{
		$this->db->select('*');
		$this->db->from('konten_materi');
		$this->db->join('sub_materi', 'konten_materi.sub_materi_id = sub_materi.id_sub_materi', 'left');
		$this->db->where('id_konten', $id);
		$query  = $this->db->get();
		$result = $query->row();
		
		$id_materi = $result->materi_pokok_id;
		
		return $this->get_konten_by_sub_materi($id_materi);
	}
	
	function get_next_sub_materi($id){
		$mapel = $this->get_mapel_by_konten($id);
		$id_mata_pelajaran = $mapel->id_mapel;
		$id_materi = $mapel->id_materi_pokok;
		$urutan = $mapel->urutan;
		
		
		// $condition = array('mapel_id' => $id_mata_pelajaran, 'id_materi_pokok > ' => $id_materi);
		$condition = array('materi_pokok.mapel_id' => $id_mata_pelajaran, 'materi_pokok.urutan > ' => $urutan);
		
		$this->db->select('*');
		$this->db->from('materi_pokok');
		$this->db->join('sub_materi', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok');
		$this->db->join('konten_materi', 'konten_materi.sub_materi_id = sub_materi.id_sub_materi');
		$this->db->where($condition);
		$this->db->order_by('sub_materi.urutan_materi');
		//tester
		//echo $this->db->_compile_select();
		$query = $this->db->get();

		return $query->row();
	}


	function get_video_demo($id_mapel)
	{
		$this->db->select('kelas.alias_kelas, mata_pelajaran.nama_mapel, sub_materi.id_sub_materi, sub_materi.nama_sub_materi, konten_materi.is_demo, konten_materi.video_materi');
		$this->db->from('sub_materi');
		$this->db->join('konten_materi', 'konten_materi.sub_materi_id = sub_materi.id_sub_materi', 'left');
		$this->db->join('materi_pokok', 'materi_pokok.id_materi_pokok = sub_materi.materi_pokok_id', 'left');
		$this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		$this->db->where('konten_materi.is_demo', 1);
		if(!empty($id_mapel)){
			$this->db->where('materi_pokok.mapel_id', $id_mapel);
		} else {
			$this->db->order_by('sub_materi.id_sub_materi', 'RANDOM');
		}
		$this->db->limit(4);
		// tester
		// echo $this->db->_compile_select();
		// die();
		$query  = $this->db->get();

		return $query->result();
	}



	//TAMBAHAN (DIMAS)
	function fetch_all_kelas()
	{
		$this->db->order_by('tingkatan_kelas', 'ASC');
		$query = $this->db->get('kelas');
		
		return $query->result();
	}

	function fetch_kelas_by_jenjang($jenjang)
	{
		$this->db->select('*');
		$this->db->from('kelas');
		$this->db->where('kelas.jenjang', $jenjang);
		// echo $jenjang."\n";
		// echo $this->db->_compile_select();
		// die();
		$query = $this->db->get();
		
		return $query->result();
	}
	function fetch_options_jenjang()

	{

		$this->db->select('kelas.id_kelas, kelas.jenjang');

		$this->db->from('kelas');

		$this->db->group_by('kelas.jenjang');

		$this->db->order_by('kelas.id_kelas', 'ASC');

		$query = $this->db->get();

		

		return $query->result();

	}
	function fetch_all_sekolah()
	{
		$this->db->select('*');
		$this->db->from('sekolah');
		$this->db->order_by('sekolah.jenjang', 'ASC');
		$this->db->order_by('sekolah.nama_sekolah', 'ASC');
		$query = $this->db->get();
		
		return $query->result();
	}
	function fetch_sekolah_by_kota($id_kota)

	{

		$this->db->select('*');

		$this->db->from('sekolah');

		$this->db->where('sekolah.kota_id', $id_kota);

		$query = $this->db->get();

		

		return $query->result();

	}



	function fetch_all_provinsi()

	{

		$this->db->select('*');

		$this->db->from('provinsi');

		$this->db->order_by('provinsi.nama_provinsi', 'ASC');

		$query = $this->db->get();

		

		return $query->result();

	}



	function fetch_all_kota()

	{

		$this->db->select('*');

		$this->db->from('kota_kabupaten');

		$this->db->order_by('kota_kabupaten.nama_kota', 'ASC');

		$query = $this->db->get();

		

		return $query->result();

	}
	function fetch_sekolah_by_id($id_sekolah)
	{
		$this->db->select('*');
		$this->db->from('sekolah');
		$this->db->where('sekolah.id_sekolah', $id_sekolah);
		$query = $this->db->get();

		return $query->row();
	}

	function fetch_kota_by_provinsi($id_provinsi)
	{
		$this->db->select('*');
		$this->db->from('kota_kabupaten');
		$this->db->where('kota_kabupaten.provinsi_id', $id_provinsi);
		$query = $this->db->get();

		return $query->result();
	}
	
	function get_all_konten_materi()
	{
		$this->db->select('*');
		$this->db->from('konten_materi');
		$this->db->join('sub_materi', 'sub_materi.id_sub_materi = konten_materi.sub_materi_id', 'left');
		$this->db->join('soal', 'sub_materi.id_sub_materi = soal.sub_materi_id', 'left');
		$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
		$this->db->order_by('sub_materi.urutan_materi ASC');
		//tester
		// echo $this->db->_compile_select();

		$query = $this->db->get();
		
		return $query->result();
	}

	function get_all_sub_materi()
	{
		$this->db->select('*');
		$this->db->from('sub_materi');
		$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
		$this->db->join('konten_materi', 'sub_materi.id_sub_materi = konten_materi.sub_materi_id', 'left');
		$this->db->order_by('sub_materi.urutan_materi', 'ASC');
		//tester
		//echo $this->db->_compile_select(); exit;
		$query = $this->db->get();
		
		return $query->result();
	} 

	function get_all_sub_materi_by_mapel($mapel)
	{
		$this->db->select('*');
		$this->db->from('sub_materi');
		$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
		$this->db->join('konten_materi', 'sub_materi.id_sub_materi = konten_materi.sub_materi_id', 'left');
		$this->db->where('materi_pokok.mapel_id',$mapel);
		$this->db->order_by('sub_materi.urutan_materi', 'ASC');
		$query = $this->db->get();
		
		return $query->result();
	} 

	function get_all_materi()
	{
		$this->db->select('*');
		$this->db->from('materi_pokok');
		$this->db->order_by('materi_pokok.urutan', 'ASC');
		//tester
		//echo $this->db->_compile_select(); exit;
		$query = $this->db->get();
		
		return $query->result();
	} 

	function fetch_kategori_konten($materi_id)
	{
		$this->db->select('*');
		$this->db->from('sub_materi');
		$this->db->join('konten_materi', 'konten_materi.sub_materi_id = sub_materi.id_sub_materi', 'left');
		$this->db->join('soal', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
		$this->db->join('materi_pokok', 'materi_pokok.id_materi_pokok = sub_materi.materi_pokok_id', 'left');
		$this->db->where('materi_pokok.id_materi_pokok', $materi_id);
		$this->db->group_by('sub_materi.id_sub_materi');
		$this->db->order_by('sub_materi.urutan_materi', 'ASC');
		// $this->db->order_by('sub_materi.urutan_konten', 'ASC');
		//tester
		// echo $this->db->_compile_select();
		$query = $this->db->get();

		return $query->result();
	}

	//Latihan Soal
	function get_sub_materi_by_id($id_sub_materi)
	{
		$this->db->where('sub_materi.id_sub_materi', $id_sub_materi);
		$result = $this->db->get('sub_materi');

		return $result->row();
	}

	function jumlah_soal($id_sub_materi)
	{
		$this->db->where('soal.sub_materi_id', $id_sub_materi);
		return $this->db->count_all_results('soal');
	}

	function fetch_soal_by_submateri($id_sub_materi)
	{
		$this->db->select('*');
		$this->db->from('jawaban');
		$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
		$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
		$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
		$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
		$this->db->where('sub_materi.id_sub_materi', $id_sub_materi);
		//tester
		//echo $this->db->_compile_select();exit;
		$query = $this->db->get();

		return $query->result();
	}

	function fetch_jawaban_by_soal($soal_id)
	{
		$this->db->where('jawaban.soal_id', $soal_id);
		$query = $this->db->get('jawaban');

		return $query->row();
	}

	function fetch_array_id_soal($id_sub_materi)
	{	
		$this->db->select('soal.id_soal, jawaban.kunci_jawaban');
		$this->db->join('jawaban', 'jawaban.soal_id = soal.id_soal', 'left');
		$this->db->where('soal.sub_materi_id', $id_sub_materi);
		$query = $this->db->get('soal');

		return $query->result_array();
	}

	//TABEL KONTEN DETAIL
	function fetch_list_group_by($tabel, $group_by="", $order_by="")
	{
		$this->db->select('*');
		$this->db->from($tabel);
		$this->db->group_by($group_by);
		$this->db->order_by($order_by);
		//tester
		// echo $this->db->_compile_select();
		$query = $this->db->get();

		return $query->result();
	}

	function fetch_list_konten()
	{
		$this->db->select('*');
		$this->db->from('sub_materi');
		$this->db->join('konten_materi', 'konten_materi.sub_materi_id = sub_materi.id_sub_materi', 'left');
		$this->db->join('soal', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
		$this->db->group_by('sub_materi.id_sub_materi');
		$this->db->order_by('sub_materi.urutan_materi', 'ASC');
		// $this->db->order_by('sub_materi.urutan_konten', 'ASC');
		//tester
		// echo $this->db->_compile_select();
		$query = $this->db->get();

		return $query->result();
	}

	function fetch_list_konten_by_materi($materi) //ADDED BY RUSMANTO
	{
		$this->db->select('*');
		$this->db->from('materi_pokok');
		$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
		$this->db->where('id_materi_pokok', $materi);
		$idmapel = $this->db->get()->row()->id_mapel;
		
		$this->db->select('*');
		$this->db->from('sub_materi');
		$this->db->join('konten_materi', 'konten_materi.sub_materi_id = sub_materi.id_sub_materi', 'left');
		$this->db->join('materi_pokok', 'materi_pokok.id_materi_pokok = sub_materi.materi_pokok_id', 'left');
		$this->db->join('soal', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
		$this->db->group_by('sub_materi.id_sub_materi');
		$this->db->order_by('sub_materi.urutan_materi', 'ASC');
		$this->db->where('materi_pokok.mapel_id', $idmapel);
		$query = $this->db->get();

		return $query->result();
	}


	//USER
	function get_data_user($id_siswa)
	{
		$this->db->select('login_siswa.*, siswa.*, sekolah.nama_sekolah, kelas.*');
		$this->db->from('siswa');
		$this->db->join('login_siswa', 'login_siswa.id_login = siswa.id_login', 'left');
		$this->db->join('sekolah', 'sekolah.id_sekolah = siswa.sekolah_id', 'left');
		$this->db->join('kelas', 'kelas.id_kelas = siswa.kelas', 'left');
		$this->db->where('siswa.id_siswa', $id_siswa);
		//tester
		// echo $this->db->_compile_select();
		$query = $this->db->get();
		return $query->row();
	}

	function update_data_user($id_siswa, $data_siswa, $data_login_siswa)
	{
		//update tabel siswa
		$this->db->where('id_siswa', $id_siswa);
		$result = $this->db->update("siswa", array_filter($data_siswa));

		//fetch id_login from tabel siswa by id_siswa
		$this->db->select('id_login');
		$this->db->where('id_siswa', $id_siswa);
		$query 		= $this->db->get('siswa');
		$id_login = $query->row()->id_login;

		if($id_login)
		{
			//update tabel login_siswa
			$this->db->where('id_login', $id_login);
			$result = $this->db->update("login_siswa", array_filter($data_login_siswa));
		}

		return $result;
	}

	function link_akun_fb($id_siswa, $fb_id) 
	{
		$result = FALSE;
		//fetch id_login from tabel siswa by id_siswa
		$this->db->select('id_login');
		$this->db->where('id_siswa', $id_siswa);
		$id_login = $this->db->get('siswa')->row()->id_login;
		// $id_login = $query->row()->id_login;

		if($id_login) {
			$this->db->set('fb_id', $fb_id);
			$this->db->where('id_login', $id_login);
			$result = $this->db->update('login_siswa');
		}

		return $result;
	}

	function unlink_akun_fb($fb_id) 
	{
		$this->db->set('fb_id', " ");
		$this->db->where('fb_id', $fb_id);
		return $this->db->update('login_siswa');
	}
	

	//PENCARIAN
	function count_records($tabel)
	{
		return $this->db->count_all($tabel);
	}

	function search_materi($limit, $start, $kata_kunci=NULL, $tipe=NULL, $kelas=NULL)
	{
		$this->db->select('*');
		$this->db->from('sub_materi');
		$this->db->join('konten_materi', 'konten_materi.sub_materi_id = sub_materi.id_sub_materi', 'left');
		$this->db->join('materi_pokok', 'materi_pokok.id_materi_pokok = sub_materi.materi_pokok_id', 'left');
		$this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		if(!empty($tipe)) {
			$this->db->where('konten_materi.kategori', $tipe);
		} else {
			$this->db->where('konten_materi.kategori <', 3);
		}
		if(!empty($kelas)) {
			$this->db->where('mata_pelajaran.kelas_id', $kelas);
		}
		$this->db->group_start();
		$this->db->where('konten_materi.isi_materi LIKE', '%'.$kata_kunci.'%');
		$this->db->or_where('sub_materi.nama_sub_materi LIKE', '%'.$kata_kunci.'%');
		$this->db->or_where('materi_pokok.nama_materi_pokok LIKE', '%'.$kata_kunci.'%');
		$this->db->or_where('mata_pelajaran.nama_mapel LIKE', '%'.$kata_kunci.'%');
		$this->db->or_where('kelas.alias_kelas LIKE', '%'.$kata_kunci.'%');
		$this->db->group_end();
		$this->db->limit($limit, $start);
		$this->db->order_by('sub_materi.urutan_materi', 'ASC');
		// tester
		// echo $this->db->_compile_select(); //die();
		$query = $this->db->get();

		return $query->result_array();
	}	function get_info_latihan($id_sub_materi){	$this->db->select("	sub_materi.nama_sub_materi,	kelas.alias_kelas,	mata_pelajaran.nama_mapel,	materi_pokok.nama_materi_pokok, kelas.id_kelas");	$this->db->from("sub_materi");	$this->db->join("materi_pokok","sub_materi.materi_pokok_id=materi_pokok.id_materi_pokok");	$this->db->join("mata_pelajaran","materi_pokok.mapel_id=mata_pelajaran.id_mapel");	$this->db->join("kelas","mata_pelajaran.kelas_id=kelas.id_kelas");	$this->db->where("sub_materi.id_sub_materi", $id_sub_materi);		$query = $this->db->get();	return $query->row();}function get_jumlah_soal_latihan($id_sub_materi){	$this->db->where("sub_materi_id", $id_sub_materi);	return $this->db->count_all_results('soal');}

function check_sekolah_by_nama($sekolah, $idkota){
	$this->db->where("nama_sekolah", $sekolah);
	$this->db->where("kota_id", $idkota);
	return $this->db->count_all_results('sekolah');
}
function add_sekolah($id_kota, $jenjang, $sekolah, $email, $telepon, $alamat){
	$data = array(
		// 'mapel_id' 			=> $mapel_id, 
		'kota_id' 				=> $id_kota,
		'nama_sekolah' 			=> $sekolah,
		'jenjang' 				=> $jenjang,
		'alamat_sekolah' 		=> $alamat,
		'email' 				=> $email,
		'telepon' 				=> $telepon
		);
	$result = $this->db->insert('sekolah', $data);
	
	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;
	return $insert_id;
}

function cari_password_lama($idsiswa, $oldpassword){
	$this->db->select('login_siswa.*, siswa.*');
		$this->db->from('siswa');
		$this->db->join('login_siswa', 'login_siswa.id_login = siswa.id_login', 'left');
		$this->db->where('siswa.id_siswa', $idsiswa);
		$this->db->where('login_siswa.password', md5($oldpassword));
		//tester
		// echo $this->db->_compile_select();
		$query = $this->db->get();
		return $query->row();
}

function ganti_password($idlogin, $newpassword){
	$data = array(
		'password' 			=> md5($newpassword)
		);
	$this->db->where('id_login', $idlogin);
	$result = $this->db->update('login_siswa', $data);

	return $result;
}

}
