<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_adm extends CI_Model
{

	private $insert_id;

	function __construct()
	{
		parent::__construct();
	}


	// GENERAL
	function record_count($tabel)
	{
		return $this->db->count_all($tabel);
	}

	function fetch_materi_pokok_by_mapel($id_mapel)
	{
		$this->db->select('*');
		$this->db->from('materi_pokok');
		$this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		$this->db->where('materi_pokok.mapel_id', $id_mapel);
		$this->db->order_by('materi_pokok.nama_materi_pokok', 'ASC');
		//tester
		// echo $this->db->_compile_select();

		$query = $this->db->get();
		
		return $query->result();
	}

	function fetch_submateri_by_materi_pokok($id_materi_pokok)
	{
		$this->db->select('*');
		$this->db->from('sub_materi');
		$this->db->join('materi_pokok', 'materi_pokok.id_materi_pokok = sub_materi.materi_pokok_id', 'left');
		$this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		$this->db->where('sub_materi.materi_pokok_id', $id_materi_pokok);
		$this->db->order_by('sub_materi.urutan_materi ASC', 'sub_materi.nama_sub_materi ASC');
		//tester
		// echo $this->db->_compile_select();

		$query = $this->db->get();
		
		return $query->result();
	}

	function select_max($table, $field)
	{
		$this->db->select_max($field);
		$query = $this->db->get($table);
		
		return $query->row();
	}


	// DASHBOARD
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

	function fetch_kategori_konten()
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

	function update_urutan_materi_pokok($id_mapel, $id_materi_pokok)
	{
		$urutan = 1;
		foreach ($id_materi_pokok as $id) {
			$this->db->set('urutan', $urutan);
			// $this->db->where('mapel_id', $id_mapel);
			$this->db->where('id_materi_pokok', $id);
			$this->db->update('materi_pokok');
			$urutan++;
		}

	}

	function update_urutan_sub_materi($id_materi_pokok, $id_sub_materi)
	{
		$urutan = 1;

		foreach ($id_sub_materi as $id) {
			$this->db->set('urutan_materi', $urutan);
			// $this->db->where('materi_pokok_id', $id_materi_pokok);
			$this->db->where('id_sub_materi', $id);
			$this->db->update('sub_materi');
			$urutan++;
		}

	}

	function update_urutan_konten($urutan_konten)
	{
		foreach ($urutan_konten as $key => $urutan) {
			$this->db->set('urutan_konten', $urutan);
			$this->db->where('id_sub_materi', $key);

			echo $this->db->update('sub_materi');
		}

	}

	function set_status_materi($id_sub, $state)
	{
		$this->db->set('status_materi', $state);
		$this->db->where('id_sub_materi', $id_sub);
		echo $this->db->update('sub_materi');

		// return $result;
	}

	function cek_demo($id)
	{
		$this->db->select('is_demo');
		$this->db->where('sub_materi_id', $id);
		$query = $this->db->get('konten_materi');
		return $query->row();
	}

	function set_demo($id, $is_demo)
	{
		$this->db->set('is_demo', $is_demo);
		$this->db->where('sub_materi_id', $id);
		$query = $this->db->update('konten_materi');

		return $query;
	}


	// KELAS
	function fetch_all_table_data($tabel)
	{
		$query = $this->db->get($tabel);
		
		return $query->result();
	}

	function get_table_fields()
	{
		$fields = [];

		foreach(func_get_args() as $table)
		{
			$fields = array_merge($fields, $this->db->list_fields($table));
		}

		return $fields;
	}

	function get_specific_kelas(){
		$result=$this->db->where("id_kelas !=", "0");
		$result=$this->db->get("kelas");
		
		return $result->result();
	}



	// MATERI
	function fetch_all_materi()
	{
		$this->db->select('kelas.alias_kelas, mata_pelajaran.nama_mapel, materi_pokok.nama_materi_pokok, sub_materi.id_sub_materi, sub_materi.nama_sub_materi, sub_materi.status_materi, konten_materi.kategori');
		$this->db->from('konten_materi');
		$this->db->join('sub_materi', 'sub_materi.id_sub_materi = konten_materi.sub_materi_id', 'left');
		$this->db->join('materi_pokok', 'materi_pokok.id_materi_pokok = sub_materi.materi_pokok_id', 'left');
		$this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		$this->db->order_by('kelas.tingkatan_kelas ASC');
		$this->db->order_by('mata_pelajaran.nama_mapel ASC');
		//tester
		// echo $this->db->_compile_select();

		$query = $this->db->get();
		
		return $query->result();
	}

	function fetch_ajax_materi($fields, $totalFiltered, $filterColumn, $request_data)
	{
		// $this->db->select('kelas.alias_kelas, mata_pelajaran.nama_mapel, materi_pokok.nama_materi_pokok, sub_materi.nama_sub_materi, konten_materi.kategori');
		// echo "<pre>";
		// echo print_r($request_data);
		// echo "</pre>";
		// die();
		$this->db->select($fields);
		$this->db->from('konten_materi');
		$this->db->join('sub_materi', 'sub_materi.id_sub_materi = konten_materi.sub_materi_id', 'left');
		$this->db->join('materi_pokok', 'materi_pokok.id_materi_pokok = sub_materi.materi_pokok_id', 'left');
		$this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		if($key = $request_data['search']['value'] !== "") {
			$this->db->or_like('konten_materi.isi_materi', $key);
			$this->db->or_like('sub_materi.nama_sub_materi', $key);
			$this->db->or_like('materi_pokok.nama_materi_pokok', $key);
			$this->db->or_like('mata_pelajaran.nama_mapel', $key);
			$this->db->or_like('kelas.alias_kelas', $key);
		}

		// $this->db->limit($request_data['start'], $request_data['length']);
		$this->db->limit($totalFiltered, $request_data['start']);
		if(!empty($request_data['order'][0]['column'])) {
			$this->db->order_by($filterColumn, $request_data['order'][0]['dir']);
		}
		else {
			$this->db->order_by('kelas.tingkatan_kelas ASC');
			$this->db->order_by('mata_pelajaran.nama_mapel ASC');
			$this->db->order_by('materi_pokok.nama_materi_pokok ASC');
			$this->db->order_by('sub_materi.nama_sub_materi ASC');
		}
		// echo $this->db->_compile_select();
		// die();
		$query = $this->db->get();
		
		return $query->result();
	}

	function fetch_materi_by_id($id_sub_materi)
	{
		$this->db->select('*');
		$this->db->from('konten_materi');
		$this->db->join('sub_materi', 'sub_materi.id_sub_materi = konten_materi.sub_materi_id', 'left');
		$this->db->join('materi_pokok', 'materi_pokok.id_materi_pokok = sub_materi.materi_pokok_id', 'left');
		$this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		$this->db->where('sub_materi.id_sub_materi', $id_sub_materi);
		//tester
		//echo $this->db->_compile_select();
		$query = $this->db->get();

		return $query->row();
	}

	function fetch_content_by_id($sub_materi_id)
	{
		$this->db->where('sub_materi_id', $sub_materi_id);
		$query = $this->db->get('konten_materi');

		return $query->row();
	}

	function fetch_options_materi()
	{
		$this->db->select('*');
		$this->db->from('materi_pokok');
		$this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		$this->db->order_by('materi_pokok.nama_materi_pokok', 'ASC');
		//tester
		// echo $this->db->_compile_select();

		$query = $this->db->get();
		
		return $query->result();
	}

	function fetch_jumlah_soal($id_sub_materi)
	{
		$this->db->select('id_soal');
		$this->db->from('soal');
		$this->db->where('soal.sub_materi_id', $id_sub_materi);
		$result = $this->db->count_all_results();
		//tester
		// echo $this->db->_compile_select();
		return $result;
	}

	function add_materi($kategori, $mapel_id, $materi_pokok_id, $nama_sub_materi, $deskripsi_sub_materi, $isi_materi, $video_materi, $gambar_materi, $tanggal, $waktu, $urutan_materi)
	{	
		//Insert data into table sub_materi 
		$data = array(
			// 'mapel_id' 			=> $mapel_id, 
			'materi_pokok_id' 		=> $materi_pokok_id,
			'nama_sub_materi' 		=> $nama_sub_materi,
			'deskripsi_sub_materi' 	=> $deskripsi_sub_materi,
			'urutan_materi' 		=> $urutan_materi,
			'status_materi'			=> 1
			);
		$result = $this->db->insert('sub_materi', $data);

		//Fetch the last insert ID after running insert query
		$this->insert_id = $this->db->insert_id();
		$insert_id = $this->insert_id;

		if ($this->insert_id != NULL)
		{
			//Insert data into table konten_materi 
			$data = array(
				'kategori' 		=> $kategori, 
				'sub_materi_id' => $this->insert_id,
				'isi_materi' 	=> $isi_materi,
				'video_materi' 	=> $video_materi,
				'gambar_materi' => $gambar_materi, 
				'tanggal'		=> $tanggal, 
				'waktu' 		=> $waktu 
				);
			$result = $this->db->insert('konten_materi', $data);
		}

		return $insert_id;
	}

	function update_materi($id, $kategori, $mapel_id, $materi_pokok_id, $nama_sub_materi, $deskripsi_sub_materi, $isi_materi, $video_materi, $gambar_materi, $tanggal, $waktu)
	{
		//Update row by id in table sub_materi 
		$data = array(
			'materi_pokok_id' 		=> $materi_pokok_id,
			'nama_sub_materi' 		=> $nama_sub_materi,
			'deskripsi_sub_materi' 	=> $deskripsi_sub_materi
			);
		$this->db->where('id_sub_materi', $id);
		$result = $this->db->update('sub_materi', $data);

		if ($result)
		{
			//Update row by id in table konten_materi 
			$data = array(
				'kategori' 		=> $kategori, 
				'isi_materi' 	=> $isi_materi,
				'video_materi' 	=> $video_materi,
				'gambar_materi' => $gambar_materi, 
				'tanggal'		=> $tanggal, 
				'waktu' 		=> $waktu 
				);
			$this->db->where('sub_materi_id', $id);
			$result = $this->db->update('konten_materi', $data);
		}

		return $result;
	}

	function delete_materi($id)
	{
		$this->db->where('id_sub_materi', $id);
		$result = $this->db->delete('sub_materi');

		if($result) {
			$this->db->where('sub_materi_id', $id);
			$result = $this->db->delete('konten_materi');
		}
		
		return $result;
	}


	// KELAS
	function fetch_all_kelas()
	{
		$this->db->order_by('tingkatan_kelas', 'ASC');
		$query = $this->db->get('kelas');
		
		return $query->result();
	}

	function fetch_kelas_by_id($id_kelas)
	{
		$this->db->where('id_kelas', $id_kelas);
		$query = $this->db->get('kelas');

		return $query->row();
	}

	function add_kelas($jenjang, $tingkatan_kelas, $alias_kelas)
	{	
		//Insert data into table kelas 
		$data = array(
			'jenjang' 			=> $jenjang,
			'tingkatan_kelas' 	=> $tingkatan_kelas,
			'alias_kelas' 		=> $alias_kelas
			);
		$result = $this->db->insert('kelas', $data);

		return $result;
	}

	function update_kelas($id, $jenjang, $tingkatan_kelas, $alias_kelas)
	{
		//Update row by id in table sub_materi 
		$data = array(
			'jenjang' 			=> $jenjang, 
			'tingkatan_kelas' 	=> $tingkatan_kelas,
			'alias_kelas' 		=> $alias_kelas 
			);
		$this->db->where('id_kelas', $id);
		$result = $this->db->update('kelas', $data);

		return $result;
	}

	function delete_kelas($id)
	{
		$this->db->where('id_kelas', $id);
		$result = $this->db->delete('kelas');
		
		return $result;
	}


	// MATA PELAJARAN
	function fetch_all_mapel()
	{
		$this->db->select('*');
		$this->db->from('mata_pelajaran');
		$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		$this->db->order_by( 'kelas.tingkatan_kelas ASC', 'mata_pelajaran.nama_mapel ASC');

		$query = $this->db->get();
		
		return $query->result();
	}

	function fetch_mapel_by_id($id_mapel)
	{
		$this->db->select('*');
		$this->db->from('mata_pelajaran');
		$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		$this->db->where('mata_pelajaran.id_mapel', $id_mapel);
		// echo $this->db->_compile_select();

		$query = $this->db->get();

		return $query->row();
	}

	function add_mapel($kelas_id, $nama_mapel, $deskripsi_mapel, $gambar_mapel)
	{	
		//Insert data into table mata_pelajaran
		$data = array(
			'kelas_id' 			=> $kelas_id,
			'nama_mapel' 		=> $nama_mapel,
			'deskripsi_mapel' 	=> $deskripsi_mapel,
			'gambar_mapel' 		=> $gambar_mapel
			);
		$result = $this->db->insert('mata_pelajaran', $data);

		return $result;
	}

	function update_mapel($id, $kelas_id, $nama_mapel, $deskripsi_mapel, $gambar_mapel)
	{
		//Update row by id in table mata_pelajaran 
		$data = array(
			'kelas_id' 			=> $kelas_id, 
			'nama_mapel' 		=> $nama_mapel,
			'deskripsi_mapel' 	=> $deskripsi_mapel,
			'gambar_mapel' 		=> $gambar_mapel
			);
		$this->db->where('id_mapel', $id);
		$result = $this->db->update('mata_pelajaran', $data);

		return $result;
	}

	function delete_mapel($id)
	{
		$this->db->where('id_mapel', $id);
		$result = $this->db->delete('mata_pelajaran');
		
		return $result;
	}


	// MATERI POKOK
	function fetch_all_materi_pokok()
	{
		$this->db->select('*');
		$this->db->from('materi_pokok');
		$this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		$this->db->order_by('kelas.tingkatan_kelas ASC', 'mata_pelajaran.nama_mapel ASC', 'materi_pokok.nama_materi_pokok ASC');
		//tester
		// echo $this->db->_compile_select();

		$query = $this->db->get();
		
		return $query->result();
	}

	function fetch_materi_pokok_by_id($id_materi_pokok)
	{
		$this->db->select('*');
		$this->db->from('materi_pokok');
		$this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		$this->db->where('materi_pokok.id_materi_pokok', $id_materi_pokok);
		//tester
		// echo $this->db->_compile_select();

		$query = $this->db->get();
		
		return $query->row();
	}

	function fetch_options_materi_pokok()
	{
		$this->db->select('*');
		$this->db->from('mata_pelajaran');
		$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		$this->db->order_by('mata_pelajaran.nama_mapel', 'ASC');
		//tester
		// echo $this->db->_compile_select();

		$query = $this->db->get();
		
		return $query->result();
	}

	function add_materi_pokok($mapel_id, $nama_materi_pokok, $deskripsi_materi_pokok, $urutan)
	{	
		//Insert data into table materi_pokok
		$data = array(
			'mapel_id' 				 => $mapel_id,
			'nama_materi_pokok' 	 => $nama_materi_pokok,
			'deskripsi_materi_pokok' => $deskripsi_materi_pokok,
			'urutan'				 => $urutan
			);
		$result = $this->db->insert('materi_pokok', $data);

		return $result;
	}

	function update_materi_pokok($id, $mapel_id, $nama_materi_pokok, $deskripsi_materi_pokok)
	{
		//Update row by id in table materi_pokok 
		$data = array(
			'mapel_id' 				 => $mapel_id, 
			'nama_materi_pokok' 	 => $nama_materi_pokok,
			'deskripsi_materi_pokok' => $deskripsi_materi_pokok
			);
		$this->db->where('id_materi_pokok', $id);
		$result = $this->db->update('materi_pokok', $data);

		return $result;
	}

	function delete_materi_pokok($id)
	{
		$this->db->where('id_materi_pokok', $id);
		$result = $this->db->delete('materi_pokok');
		
		return $result;
	}

	
	//SEKOLAH
	function fetch_all_sekolah()
	{
		if ($this->session->userdata('idcabang') > 0){
			$this->db->select('kabupaten_id');
			$this->db->from('cabang');
			$this->db->where('id_cabang', $this->session->userdata('idcabang'));
			$q = $this->db->get();
			$h = $q->row();
		}

		$this->db->select('*');
		$this->db->from('sekolah');
		if ($this->session->userdata('idcabang') > 0){
			$this->db->where('kota_id', $h->kabupaten_id);
		}
		$this->db->order_by('sekolah.jenjang', 'ASC');
		$this->db->order_by('sekolah.nama_sekolah', 'ASC');
		$query = $this->db->get();
		
		return $query->result();
	}

	function fetch_sekolah_by_id($id_sekolah)
	{
		$this->db->select('*');
		$this->db->from('sekolah');
		$this->db->join('kota_kabupaten', 'kota_kabupaten.id_kota = sekolah.kota_id', 'left');
		$this->db->where('sekolah.id_sekolah', $id_sekolah);
		$query = $this->db->get();

		return $query->row();
	}
	
	function fetch_sekolah_by_kota($idkota)
	{
		$this->db->select('*');
		$this->db->from('sekolah');
		$this->db->where('kota_id', $idkota);
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

	function fetch_options_provinsi()
	{
		$this->db->select('*');
		$this->db->from('provinsi');
		$this->db->order_by('provinsi.nama_provinsi', 'ASC');
		$query = $this->db->get();
		
		return $query->result();
	}

	function fetch_options_kota()
	{
		$this->db->select('*');
		$this->db->from('kota_kabupaten');
		$this->db->order_by('kota_kabupaten.nama_kota', 'ASC');
		$query = $this->db->get();
		
		return $query->result();
	}

	function fetch_kota_by_provinsi($id_provinsi)
	{
		$this->db->select('*');
		$this->db->from('kota_kabupaten');
		$this->db->where('kota_kabupaten.provinsi_id', $id_provinsi);
		$query = $this->db->get();

		return $query->result();
	}

	function import_sekolah($data_sekolah)
	{	
		//Insert data into table sekolah
		foreach ($data_sekolah as $data) {
			$result = $this->db->insert('sekolah', $data);
		}

		return $result;
	}

	function check_sekolah_by_nama($nama_sekolah)
	{
		$this->db->like('nama_sekolah', $nama_sekolah);
		$query = $this->db->get('sekolah');
		
		return $query->num_rows();
	}

	function add_sekolah($npsn, $nama_sekolah, $jenjang, $email, $telepon, $kota, $alamat_sekolah, $status)
	{	
		//Insert data into table mata_pelajaran
		$data = array(
			'npsn' 						=> $npsn,
			'nama_sekolah' 		=> $nama_sekolah,
			'jenjang' 				=> $jenjang,
			'email' 					=> $email,
			'telepon' 				=> $telepon,
			'kota_id' 				=> $kota,
			'alamat_sekolah' 	=> $alamat_sekolah,
			'status' 					=> $status
			);
		$result = $this->db->insert('sekolah', $data);
		$insert_id = $this->db->insert_id();

		return $insert_id;
	}

	function add_quick_sekolah($nama_sekolah, $jenjang)
	{	
		//Insert data into table mata_pelajaran
		$data = array(
			'nama_sekolah' 		=> $nama_sekolah,
			'jenjang' 				=> $jenjang,
			);
		$this->db->insert('sekolah', $data);
		$insert_id = $this->db->insert_id();

		return $insert_id;
	}

	function update_sekolah($id, $npsn, $nama_sekolah, $jenjang, $email, $telepon, $kota, $alamat_sekolah, $status)
	{
		//Update row by id in table mata_pelajaran 
		$data = array(
			'npsn' 						=> $npsn,
			'nama_sekolah' 		=> $nama_sekolah,
			'jenjang' 				=> $jenjang,
			'email' 					=> $email,
			'telepon' 				=> $telepon,
			'kota_id' 				=> $kota,
			'alamat_sekolah' 	=> $alamat_sekolah,
			'status' 					=> $status
			);
		$this->db->where('sekolah.id_sekolah', $id);
		$result = $this->db->update('sekolah', $data);

		return $result;
	}

	function delete_sekolah($id)
	{
		$this->db->where('id_sekolah', $id);
		$result = $this->db->delete('sekolah');
		
		return $result;
	}


	// SISWA (IFA)
	function fetch_all_siswa()
	{
		$this->db->select('*');
		$this->db->from('siswa');
		$this->db->join('kelas', 'kelas.id_kelas = siswa.kelas', 'left');
		$this->db->order_by('siswa.nama_siswa', 'ASC');

		$query = $this->db->get();
		
		return $query->result();
	}

	function fetch_siswa_by_id($id_siswa)
	{
		$this->db->select('*');
		$this->db->from('siswa');
		$this->db->join('kelas', 'kelas.id_kelas = siswa.kelas', 'left');
		$this->db->where('siswa.id_siswa', $id_siswa);
		// echo $this->db->_compile_select();

		$query = $this->db->get();

		return $query->row();
	}
	function fetch_siswa_pendaftar()
	{
		$this->db->select('siswa.*, kelas.*, sekolah.nama_sekolah, cabang.nama_cabang');
		$this->db->from('siswa');
		$this->db->join('kelas', 'kelas.id_kelas = siswa.kelas', 'left');
		$this->db->join('sekolah', 'sekolah.id_sekolah = siswa.sekolah_id', 'left');
		$this->db->join('cabang', 'cabang.id_cabang = siswa.cabang_id', 'left');
		$this->db->where(
			"siswa.id_siswa NOT IN (
				SELECT paket_aktif.id_siswa 
				FROM paket_aktif 
				WHERE paket_aktif.isaktif = '1'
				) "
		);
		if ($this->session->userdata('idcabang') > 0){
			$this->db->where('cabang_id', $this->session->userdata('idcabang'));
		}
		$this->db->order_by('siswa.timestamp', 'ASC');
		$this->db->order_by('siswa.nama_siswa', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	function fetch_siswa_aktif()
	{
		$this->db->select('siswa.*, kelas.*, sekolah.nama_sekolah, cabang.nama_cabang, login_siswa.username');
		$this->db->from('siswa');
		$this->db->join('kelas', 'kelas.id_kelas = siswa.kelas', 'left');
		$this->db->join('sekolah', 'sekolah.id_sekolah = siswa.sekolah_id', 'left');
		$this->db->join('cabang', 'cabang.id_cabang = siswa.cabang_id', 'left');
		$this->db->join('login_siswa', 'login_siswa.id_login = siswa.id_login', 'left');
		$this->db->where(
			"siswa.id_siswa IN (
				SELECT paket_aktif.id_siswa 
				FROM paket_aktif 
				WHERE paket_aktif.isaktif = '1'
				) "
		);
		if ($this->session->userdata('idcabang') > 0){
			$this->db->where('cabang_id', $this->session->userdata('idcabang'));
		}
		$this->db->order_by('siswa.timestamp', 'ASC');
		$this->db->order_by('siswa.nama_siswa', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}
	
	function add_siswa($nama, $email, $telepon, $telepon_ortu, $alamat, $sekolah_id, $kelas, $idlogin, $cabang, $konselor='')
	{	
		//Insert data into table mata_pelajaran
		$data = array(
			'nama_siswa' 		=> $nama,
			'kelas' 				=> $kelas,
			'sekolah_id' 		=> $sekolah_id,
			'alamat' 				=> $alamat,
			'email' 				=> $email,
			'telepon' 			=> $telepon,
			'telepon_ortu' 	=> $telepon_ortu,
			'id_login' 			=> $idlogin,
			'cabang_id' 		=> $cabang,
			'kode_konselor' => $konselor,
			);
		$result = $this->db->insert('siswa', $data);
		$lastid = $this->db->insert_id();
		return $lastid;
	}

	function update_siswa($id, $nama, $email, $telepon, $telepon_ortu, $alamat, $sekolah_id, $kelas, $cabang, $konselor='')
	{
		//Update row by id in table mata_pelajaran 
		$data = array(
			'nama_siswa' 		=> $nama,
			'kelas' 				=> $kelas,
			'sekolah_id' 		=> $sekolah_id,
			'alamat' 				=> $alamat,
			'email' 				=> $email,
			'telepon' 			=> $telepon,
			'telepon_ortu' 	=> $telepon_ortu,
			'cabang_id' 		=> $cabang,
			'kode_konselor' => $konselor,
			);
		$this->db->where('id_siswa', $id);
		$result = $this->db->update('siswa', $data);

		return $result;
	}

	function delete_siswa($id)
	{
		$this->db->select('id_login');
		$this->db->from('siswa');
		$this->db->where('id_siswa', $id);
		$query = $this->db->get();
		$profil = $query->row();
		
		$this->db->where('id_login', $profil->id_login);
		$result = $this->db->delete('login_siswa');
		
		$this->db->where('id_siswa', $id);
		$result = $this->db->delete('siswa');
		
		$this->db->where('id_siswa', $id);
		$result = $this->db->delete('paket_aktif');
		
		return $result;
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

	
	// LOG AKSES
	function fetch_log_siswa()
	{
		$this->db->select('usertracking.session_id, siswa.id_siswa, siswa.nama_siswa, siswa.asal_sekolah, siswa.email, siswa.telepon, kelas.alias_kelas');
		//Careful with this (Might led to Grouping pitfall)
		$this->db->select('COUNT(usertracking.session_id) AS total_akses');
		$this->db->select_max('usertracking.timestamp');
		$this->db->from('usertracking');
		$this->db->join('siswa', 'siswa.id_siswa = usertracking.session_id', 'left');
		$this->db->join('kelas', 'kelas.id_kelas = siswa.kelas', 'left');
		$this->db->where(
			"siswa.id_siswa IN (
				SELECT paket_aktif.id_siswa 
				FROM paket_aktif 
				WHERE paket_aktif.isaktif = '1'
				) "
		);
		$this->db->group_by('usertracking.session_id');
		$this->db->order_by('siswa.timestamp', 'ASC');
		$this->db->order_by('siswa.nama_siswa', 'ASC');
		// echo $this->db->_compile_select();
		$query = $this->db->get();
		return $query->result();
	}

	function last_akses_by_id($id_siswa)
	{
		$this->db->select_max('timestamp');
		if(strtoupper($id_siswa) != 'ALL') {
			$this->db->where('session_id', $id_siswa);
		}
		
		$query = $this->db->get('usertracking');
		return $query->row()->timestamp;
	}

	function track_akses_by_id($id_siswa, $kategori)
	{
		$month = date('m'); $year = date('Y');
		$this->db->select('usertracking.id, usertracking.session_id, usertracking.request_uri, usertracking.timestamp, konten_materi.kategori');
		$this->db->select('sub_materi.nama_sub_materi, materi_pokok.nama_materi_pokok, mata_pelajaran.nama_mapel, kelas.alias_kelas');
		$this->db->from('usertracking');
		$this->db->join('konten_materi', 'konten_materi.id_konten = usertracking.sub_materi_id', 'left');
		$this->db->join('sub_materi', 'sub_materi.id_sub_materi = konten_materi.sub_materi_id', 'left');
		$this->db->join('materi_pokok', 'materi_pokok.id_materi_pokok = sub_materi.materi_pokok_id', 'left');
		$this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		$this->db->where('konten_materi.kategori', $kategori);
		$this->db->where('usertracking.request_uri NOT LIKE', '%latihan%');		

		$this->db->where('session_id', $id_siswa);
		$this->db->where('MONTH(timestamp)', $month);
		$this->db->where('YEAR(timestamp)', $year);
		// echo $this->db->_compile_select(); //die();
		$query = $this->db->get();
		return $query->result_array();
	}

	function track_akses_soal_by_id($id_siswa)
	{
		$kategori = 3;
		$month = date('m'); $year = date('Y');
		$this->db->select('usertracking.id, usertracking.request_uri, usertracking.timestamp, konten_materi.kategori');
		$this->db->select('sub_materi.nama_sub_materi, materi_pokok.nama_materi_pokok, mata_pelajaran.nama_mapel, kelas.alias_kelas');
		$this->db->from('usertracking');
		$this->db->join('konten_materi', 'konten_materi.sub_materi_id = usertracking.sub_materi_id', 'left');
		$this->db->join('sub_materi', 'sub_materi.id_sub_materi = konten_materi.sub_materi_id', 'left');
		$this->db->join('materi_pokok', 'materi_pokok.id_materi_pokok = sub_materi.materi_pokok_id', 'left');
		$this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		$this->db->where('konten_materi.kategori', $kategori);
		$this->db->where('usertracking.request_uri LIKE', '%latihan%');

		$this->db->where('session_id', $id_siswa);
		$this->db->where('MONTH(timestamp)', $month);
		$this->db->where('YEAR(timestamp)', $year);
		// echo $this->db->_compile_select(); //die();
		$query = $this->db->get();
		return $query->result_array();
	}

	function group_akses_by_id($id_siswa, $kategori, $date_start=NULL, $date_end=NULL)
	{
		if(empty($date_start) && empty($date_end)) {
			$date_start = date('Ym'); $date_end = date('Ym');
		}

		$this->db->select('usertracking.session_id, usertracking.request_uri, usertracking.timestamp, konten_materi.kategori');
		$this->db->select('mata_pelajaran.nama_mapel, kelas.alias_kelas');
		//Careful with this (Might led to Grouping pitfall)
		$this->db->select('COUNT(mata_pelajaran.id_mapel) AS jumlah_akses');
		
		$this->db->from('usertracking');
		$this->db->join('konten_materi', 'konten_materi.id_konten = usertracking.sub_materi_id', 'left');
		$this->db->join('sub_materi', 'sub_materi.id_sub_materi = konten_materi.sub_materi_id', 'left');
		$this->db->join('materi_pokok', 'materi_pokok.id_materi_pokok = sub_materi.materi_pokok_id', 'left');
		$this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		$this->db->where('konten_materi.kategori', $kategori);
		$this->db->where('usertracking.request_uri NOT LIKE', '%latihan%');		

		if(strtoupper($id_siswa) != 'ALL') {
			$this->db->where('session_id', $id_siswa);
		}
		$this->db->where('EXTRACT( YEAR_MONTH FROM timestamp) >= ', $date_start);
		$this->db->where('EXTRACT( YEAR_MONTH FROM timestamp) <= ', $date_end);
		// $this->db->where('MONTH(timestamp)', $month);
		// $this->db->where('YEAR(timestamp)', $year);
		$this->db->group_by('mata_pelajaran.id_mapel');
		// echo $this->db->_compile_select(); die();
		$query = $this->db->get();
		return $query->result_array();
	}

	function group_akses_soal_by_id($id_siswa, $date_start=NULL, $date_end=NULL)
	{
		$kategori = 3; // 3 = soal
		if(empty($date_start) && empty($date_end)) {
			$date_start = date('Ym'); $date_end = date('Ym');
		}
		
		$this->db->select('usertracking.session_id, usertracking.request_uri, usertracking.timestamp, konten_materi.kategori');
		$this->db->select('mata_pelajaran.nama_mapel, kelas.alias_kelas');
		//Careful with this (Might led to Grouping pitfall)
		$this->db->select('COUNT(mata_pelajaran.id_mapel) AS jumlah_akses');
		
		$this->db->from('usertracking');
		$this->db->join('konten_materi', 'konten_materi.sub_materi_id = usertracking.sub_materi_id', 'left');
		$this->db->join('sub_materi', 'sub_materi.id_sub_materi = konten_materi.sub_materi_id', 'left');
		$this->db->join('materi_pokok', 'materi_pokok.id_materi_pokok = sub_materi.materi_pokok_id', 'left');
		$this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		$this->db->where('konten_materi.kategori', $kategori);
		$this->db->where('usertracking.request_uri LIKE', '%latihan%');		

		if(strtoupper($id_siswa) != 'ALL') {
			$this->db->where('session_id', $id_siswa);
		}
		$this->db->where('EXTRACT( YEAR_MONTH FROM timestamp) >= ', $date_start);
		$this->db->where('EXTRACT( YEAR_MONTH FROM timestamp) <= ', $date_end);
		$this->db->group_by('mata_pelajaran.id_mapel');
		// echo $this->db->_compile_select(); die();
		$query = $this->db->get();
		return $query->result_array();
	}

	function delete_log_siswa($id)
	{
		$this->db->where('session_id', $id);
		$result = $this->db->delete('usertracking');
		
		return $result;
	}

	//untuk halaman Laporan Grafik Log
	function track_akses_by_date($date_start, $date_end, $kategori)
	{
		if(empty($date_start) && empty($date_end)) {
			$date_start = date('Ym'); $date_end = date('Ym');
		}
		// $this->db->select('usertracking.id, usertracking.session_id, usertracking.request_uri, usertracking.timestamp, konten_materi.kategori');
		// $this->db->select('sub_materi.nama_sub_materi, materi_pokok.nama_materi_pokok, mata_pelajaran.nama_mapel, kelas.alias_kelas');
		$this->db->select("DATE_FORMAT(usertracking.timestamp,'%Y-%m') AS bulan");
		$this->db->select("COUNT(usertracking.session_id) AS jumlah_akses");

		$this->db->from('usertracking');
		$this->db->join('konten_materi', 'konten_materi.id_konten = usertracking.sub_materi_id', 'left');
		// $this->db->join('sub_materi', 'sub_materi.id_sub_materi = konten_materi.sub_materi_id', 'left');
		// $this->db->join('materi_pokok', 'materi_pokok.id_materi_pokok = sub_materi.materi_pokok_id', 'left');
		// $this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		// $this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		$this->db->where('konten_materi.kategori', $kategori);
		$this->db->where('usertracking.request_uri NOT LIKE', '%latihan%');		

		$this->db->where('EXTRACT( YEAR_MONTH FROM timestamp) >= ', $date_start);
		$this->db->where('EXTRACT( YEAR_MONTH FROM timestamp) <= ', $date_end);
		$this->db->group_by('MONTH(usertracking.timestamp)');
		// echo $this->db->_compile_select(); //die();
		$query = $this->db->get();
		return $query->result_array();
	}

	function track_akses_soal_by_date($date_start, $date_end)
	{
		$kategori = 3;
		if(empty($date_start) && empty($date_end)) {
			$date_start = date('Ym'); $date_end = date('Ym');
		}
		// $this->db->select('usertracking.id, usertracking.session_id, usertracking.request_uri, usertracking.timestamp, konten_materi.kategori');
		// $this->db->select('sub_materi.nama_sub_materi, materi_pokok.nama_materi_pokok, mata_pelajaran.nama_mapel, kelas.alias_kelas');
		$this->db->select("DATE_FORMAT(usertracking.timestamp,'%Y-%m') AS bulan");
		$this->db->select("COUNT(usertracking.session_id) AS jumlah_akses");

		$this->db->from('usertracking');
		$this->db->join('konten_materi', 'konten_materi.sub_materi_id = usertracking.sub_materi_id', 'left');
		// $this->db->join('sub_materi', 'sub_materi.id_sub_materi = konten_materi.sub_materi_id', 'left');
		// $this->db->join('materi_pokok', 'materi_pokok.id_materi_pokok = sub_materi.materi_pokok_id', 'left');
		// $this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		// $this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		$this->db->where('konten_materi.kategori', $kategori);
		$this->db->where('usertracking.request_uri LIKE', '%latihan%');		

		$this->db->where('EXTRACT( YEAR_MONTH FROM timestamp) >= ', $date_start);
		$this->db->where('EXTRACT( YEAR_MONTH FROM timestamp) <= ', $date_end);
		$this->db->group_by('MONTH(usertracking.timestamp)');
		// echo $this->db->_compile_select(); //die();
		$query = $this->db->get();
		return $query->result_array();
	}


	// LOGIN (IFA)
	function do_login($username, $password){
		
		$cred = array('username' => $username,
					   'password' => md5($password)
				);
		
		$this->db->select('*');
		$this->db->from('login_adm');
		
		$this->db->where($cred);
		
		$query = $this->db->get();
		$exist = $query->num_rows();
		
		if($exist > 0){
			return $query->result();
		}
		else{
			return false;
		}
	}

	function data_login($username, $password){
		$cred = array('username' => $username,
					   'password' => md5($password)
				);
		$this->db->select('*');
		$this->db->from('login_adm');
		
		$this->db->where($cred);
		
		$query = $this->db->get();
		return $query->row();
	}
	// LATIHAN SOAL	(IFA)
	function fetch_all_soal()
	{
		$this->db->select('*');
		$this->db->from('soal');
		$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
		$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
		$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
		$this->db->order_by('kelas.tingkatan_kelas', 'ASC');
		$this->db->group_by('soal.sub_materi_id');
		//tester
		//echo $this->db->_compile_select();exit;

		$query = $this->db->get();
		
		return $query->result();
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
	
	function fetch_soal_by_id($id_soal)
	{
		$this->db->select('*');
		$this->db->from('soal');
		$this->db->join('jawaban', 'soal.id_soal = jawaban.soal_id', 'left');
		$this->db->where('soal.id_soal', $id_soal);
		//tester
		//echo $this->db->_compile_select();exit;
		$query = $this->db->get();

		return $query->row();
	}

	function add_latihan_soal($submateri)
	{	
		$insert_id;
		//Insert data into table soal 
		$data = array(
			'sub_materi_id' 	=> $submateri,
			'isi_soal'			=> "Masukkan isi soal"
			);
		$result = $this->db->insert('soal', $data);
		
		// Revision
		$insert_id = $this->db->insert_id();

		if ($insert_id != NULL)
		{
			//Insert data into table jawaban 
			$data = array(
				'soal_id' 		=> $insert_id 
				);
			$result = $this->db->insert('jawaban', $data);
		}
		// /Revision

		return $result;
	}

	function add_item_soal($isi_soal, $jawab_1, $jawab_2, $jawab_3, $jawab_4, $jawab_5, $kunci_jawaban, $sub_materi_id, $pembahasan, $pembahasan_video)
	{	
		//Insert data into table soal 
		$data = array(
			'isi_soal' 				=> $isi_soal,
			'sub_materi_id' 	=> $sub_materi_id
			);
		$result = $this->db->insert('soal', $data);

		//Fetch the last insert ID after running insert query
		$this->insert_id = $this->db->insert_id();

		if ($this->insert_id != NULL)
		{
			//Insert data into table jawaban 
			$data = array(
				'soal_id' 					=> $this->insert_id,
				'pembahasan' 				=> $pembahasan,
				'pembahasan_video' 	=> $pembahasan_video,
				'jawab_1'						=> $jawab_1,
				'jawab_2'						=> $jawab_2,
				'jawab_3'						=> $jawab_3,
				'jawab_4'						=> $jawab_4,
				'jawab_5'						=> $jawab_5,
				'kunci_jawaban' 		=> $kunci_jawaban
				);
			$result = $this->db->insert('jawaban', $data);
		}

		return $result;
	}

	function update_item_soal($isi_soal,$jawab_1,$jawab_2,$jawab_3,$jawab_4,$jawab_5,$kunci_jawaban,$pembahasan,$pembahasan_video,$id_soal)
	{
		//Update row by id in table sub_materi 
		$data = array(
			'isi_soal' 			=> $isi_soal,
			);
		$this->db->where('id_soal', $id_soal);
		$result = $this->db->update('soal', $data);

		if ($result)
		{
			//Update row by id in table konten_materi 
			$data = array(
				'pembahasan' 				=> $pembahasan,
				'pembahasan_video'	=> $pembahasan_video,
				'jawab_1'						=> $jawab_1,
				'jawab_2'						=> $jawab_2,
				'jawab_3'						=> $jawab_3,
				'jawab_4'						=> $jawab_4,
				'jawab_5'						=> $jawab_5,
				'kunci_jawaban' 		=> $kunci_jawaban
				);
			$this->db->where('soal_id', $id_soal);
			$result = $this->db->update('jawaban', $data);
		}

		return $result;
	}

	function delete_item_soal($id)
	{
		$this->db->where('id_soal', $id);
		$result = $this->db->delete('soal');
		
		if($result) {
			$this->db->where('soal_id', $id);
			$result = $this->db->delete('jawaban');
		}
		
		return $result;
	}


	// PAKET
	function fetch_all_paket()
	{
		
		$this->db->order_by('tipe ASC');
		$this->db->order_by('durasi ASC');
		$query = $this->db->get('paket');
		
		return $query->result();
	}

	function add_paket($kode_paket, $durasi, $harga, $tipe)
	{
		$data = array(
						'kode_paket' 	=> $kode_paket,
						'durasi' 			=> $durasi,
						'harga'	 			=> $harga,
						'tipe'   			=> $tipe
					 );
		$result = $this->db->insert('paket', $data);

		return $result;
	}

	function update_paket($id, $kode_paket, $durasi, $harga, $tipe){
		$data = array(
			'kode_paket' 	=> $kode_paket, 
			'durasi' 			=> $durasi, 
			'harga' 			=> $harga,
			'tipe' 				=> $tipe 
			);
		$this->db->where('id_paket', $id);
		$result = $this->db->update('paket', $data);

		return $result;
	}

	function delete_paket($id)
	{
		$this->db->where('id_paket', $id);
		$result = $this->db->delete('paket');
		
		return $result;
	}

	function fetch_paket_by_id($id_paket)
	{
		$this->db->where('id_paket', $id_paket);
		$query = $this->db->get('paket');

		return $query->row();
	}

	// PEMBAYARAN
	function fetch_all_pembayaran(){
		$this->db->select("pembelian.no_tagihan, pembelian.siswa_id, pembelian.total_harga, pembelian.metode_pembayaran, pembelian.status, pembelian.status as angka_status, pembelian.expired_on, pembelian.id_pembelian, pembelian.file_bukti, pembelian.status, pembelian.email, siswa.nama_siswa");
		$this->db->from("pembelian");
		$this->db->join("siswa", "siswa.id_siswa = pembelian.siswa_id","left");
		$this->db->order_by("pembelian.expired_on", "DESC");
		$this->db->order_by("siswa.nama_siswa", "ASC");
		$result=$this->db->get();

		return $result->result();
	}

	

	function add_paket_aktif($data){
		$result = $this->db->insert('paket_aktif', $data);

		return $result;
	}

	//voucher
	function fetch_all_voucher(){
		$this->db->select("voucher.kode_voucher, voucher.ket, voucher.status, paket.durasi, paket.tipe, kelas.alias_kelas");
		$this->db->from("voucher");
		$this->db->join("paket", "paket.id_paket = voucher.paket_id");
		$this->db->join("kelas", "kelas.id_kelas = voucher.id_kelas");
		$this->db->order_by("paket.tipe", "ASC");
		$this->db->order_by("paket.durasi", "ASC");
		$result = $this->db->get();
		return $result->result();
	}
	
	function add_voucher($paket, $kelas, $keterangan){
		$a = mt_rand(10000000,99999999);
		$random = "PG".$a;
		
		$data = array(
						'paket_id' => $paket,
						'id_kelas'	 => $kelas,
						'kode_voucher' => $random,
						'ket' => $keterangan,
						'status' => '0'
					 );
		$result=$this->db->insert('voucher', $data);

		return $result;
	}
	
	//profil tryout FAJAR
	function fetch_all_profil(){

		$this->db->select("
		profil_tryout.id_tryout,
		profil_tryout.id_kelas,
		profil_tryout.nama_profil,
		profil_tryout.penyelenggara,
		profil_tryout.tgl_acara,
		profil_tryout.jam_acara,
		profil_tryout.biaya,
		profil_tryout.banner,
		profil_tryout.status,
		profil_tryout.tipe,
		kelas.alias_kelas
		");
		$this->db->from("profil_tryout");
		$this->db->join("kelas", "kelas.id_kelas=profil_tryout.id_kelas");
		
		$result=$this->db->get();

		return $result->result();

	}
	
	function add_profil(
	$kelas, $nama, $deskripsi_sub_materi, $urutan_materi,
	$penyelenggara, $tgl, $jam, $biaya, $banner, $tanggalpost, $waktupost, $tipe){
		$profil = array(
			'id_kelas' 		=> $kelas,
			'nama_profil' 	=> $nama,
			'penyelenggara'	=> $penyelenggara,
			'biaya'			=> $biaya,
			'tgl_acara'		=> $tgl,
			'jam_acara'		=> $jam,
			'biaya'			=> $biaya,
			'status'		=> '0',
			'tipe'			=> $tipe,
			'banner'		=> $banner,
			'keterangan'	=> $deskripsi_sub_materi
		);
		$result=$this->db->insert('profil_tryout', $profil);
		
		return $result;
	}
	
	function fetch_banksoal(){
		$this->db->select("bank_soal.id_banksoal, bank_soal.id_mapel, bank_soal.pertanyaan, bank_soal.pembahasan_teks, bank_soal.pembahasan_video, bank_soal.bobot_soal, bank_soal.kunci, bank_soal.topik, bank_soal.bobot_topik, mata_pelajaran.id_mapel, mata_pelajaran.kelas_id, mata_pelajaran.nama_mapel, kelas.alias_kelas");
		$this->db->from("bank_soal");
		$this->db->join("mata_pelajaran", "mata_pelajaran.id_mapel=bank_soal.id_mapel");
		$this->db->join("kelas", "kelas.id_kelas=mata_pelajaran.kelas_id");
		$result=$this->db->get();
		return $result->result();
	}
	
	function add_kategori($idprofil, $nama, $random, $tanggal, $jam, $waktu, $ketuntasan, $jumlah){
		$data = array(
			'id_profil'		=> $idprofil,
			'nama_kategori'	=> $nama,
			'random'		=> $random,
			'tanggal'		=> $tanggal,
			'jam'			=> $jam,
			'durasi'		=> $waktu,
			'ketuntasan'	=> $ketuntasan,
			'status'		=> '0',
			'jumlah_soal'	=> $jumlah
		);
		$result=$this->db->insert('kategori_tryout', $data);
		return $result;
	}
	
	function last_addedkategori(){
		$this->db->select("max(id_kategori) as id_terakhir");
		$this->db->from("kategori_tryout");
		$result=$this->db->get();
		return $result->result();
	}
	
	function add_soal($idkategori, $idbanksoal){
		$data = array(
		'id_kategori'	=> $idkategori,
		'id_banksoal'	=> $idbanksoal
		);
		$result=$this->db->insert('soal_tryout', $data);
		return $result;
	}
	
	function fetch_kategori(){
		$this->db->select("*");
		$this->db->from("kategori_tryout");
		$result=$this->db->get();
		return $result->result();
	}
	
	
	
	function fetch_soalkategori($idkategori){
		$this->db->select("
			bank_soal.id_banksoal,
			bank_soal.id_mapel,
			bank_soal.pertanyaan,
			bank_soal.topik,
			bank_soal.pembahasan_teks,
			bank_soal.pembahasan_video,
			bank_soal.bobot_soal,
			bank_soal.bobot_topik,
			bank_soal.kunci,
			soal_tryout.id_soal,
			soal_tryout.id_kategori,
		");
		$this->db->from("bank_soal");
		$this->db->join("soal_tryout", "bank_soal.id_banksoal=soal_tryout.id_banksoal");
		$this->db->where("soal_tryout.id_kategori", $idkategori);
		$result=$this->db->get();
		return $result->result();
	}
	
	function delete_soal($idkategori, $idbanksoal, $jumlahsoal){
		$this->db->delete('soal_tryout', array('id_kategori' => $idkategori, 'id_banksoal' => $idbanksoal));
	}
	
	function update_jumlahsoal($idkategori, $jumlahsoal){
		$this->db->query("UPDATE kategori_tryout SET jumlah_soal = jumlah_soal - $jumlahsoal WHERE id_kategori = $idkategori");
	}
	
	function aktivasi_kategori($idkategori){
		$this->db->query("UPDATE kategori_tryout SET status = '1' WHERE id_kategori = $idkategori");
	}
	
	function nonaktif($idkategori){
		$this->db->query("UPDATE kategori_tryout SET status = '0' WHERE id_kategori = $idkategori");
	}
	
	function fetch_kategoriedit($idkategori){
		$this->db->select("*");
		$this->db->from("kategori_tryout");
		$this->db->where("id_kategori", $idkategori);
		$result=$this->db->get();
		return $result->result();
	}
	
	function edit_kategori($idkategori, $nama, $random, $tanggal, $jam, $waktu, $ketuntasan){
		$data = array(
			'nama_kategori' 	=> $nama,
			'random'			=> $random,
			'tanggal'			=> $tanggal,
			'jam'				=> $jam,
			'durasi'			=> $waktu,
			'ketuntasan'		=> $ketuntasan
			);

		$this->db->where('id_kategori', $idkategori);
		$result = $this->db->update('kategori_tryout', $data);
		return $result;
	}
	
	function hapus_kategori($idkategori){
		$this->db->delete('kategori_tryout', array('id_kategori' => $idkategori));
	}
	
	function hapus_soal($idkategori){
		$this->db->delete('soal_tryout', array('id_kategori' => $idkategori));
	}
		// 15 OKTOBER 2016 poin quote bonus dari mas dimas-------------------
	//###################################################################
	//###################################################################
	//###################################################################
	// POIN 
	function fetch_all_poin()
	{
		$this->db->order_by('kategori', 'ASC');
		$query = $this->db->get('poin');
		
		return $query->result();
	}

	function fetch_poin_by_id($id_poin)
	{
		$this->db->where('id_poin', $id_poin);
		$query = $this->db->get('poin');

		return $query->row();
	}

	function update_poin($id_poin, $data)
	{
		//Update row by id in table sub_materi 
		$this->db->where('id_poin', $id_poin);
		$result = $this->db->update('poin', $data);

		return $result;
	}

	function delete_poin($id_poin)
	{
		$this->db->where('id_poin', $id_poin);
		$result = $this->db->delete('poin');
		
		return $result;
	}

	// QUOTE
	function fetch_all_quotes()
	{
		$this->db->order_by('tokoh', 'ASC');
		$query = $this->db->get('quotes');
		
		return $query->result();
	}

	function fetch_quote_by_id($id_quote)
	{
		$this->db->where('id_quote', $id_quote);
		$query = $this->db->get('quotes');

		return $query->row();
	}

	function add_quote($data)
	{
		$result = $this->db->insert('quotes', $data);
		return $result;
	}

	function update_quote($id_quote, $data)
	{
		//Update row by id in table sub_materi 
		$this->db->where('id_quote', $id_quote);
		$result = $this->db->update('quotes', $data);

		return $result;
	}

	function delete_quote($id_quote)
	{
		$this->db->where('id_quote', $id_quote);
		$result = $this->db->delete('quotes');
		
		return $result;
	}

	// BONUS
	function fetch_all_kategori_bonus()
	{
		$this->db->order_by('kategori_bonus', 'ASC');
		$query = $this->db->get('bonus_kategori');
		
		return $query->result();
	}

	function check_kategori_bonus($kategori)
	{
		$this->db->like('kategori_bonus', $kategori);
		$query = $this->db->get('bonus_kategori');
		
		return $query->num_rows();
	}
	
	function add_bonus_kategori($data)
	{
		$result = $this->db->insert('bonus_kategori', $data);
		return $result;
	}

	function fetch_all_bonus_konten()
	{
		$this->db->select('*');
		$this->db->from('bonus_konten');
		$this->db->join('bonus_kategori', 'bonus_kategori.id_kategori = bonus_konten.kategori_id');
		$this->db->order_by('bonus_kategori.kategori_bonus', 'ASC');
		$this->db->order_by('bonus_konten.judul_konten', 'ASC');
		$query = $this->db->get();
		
		return $query->result();
	}

	function fetch_bonus_konten_by_id($id_konten)
	{
		$this->db->where('id_konten', $id_konten);
		$query = $this->db->get('bonus_konten');

		return $query->row();
	}


	function add_bonus_konten($data)
	{
		$result = $this->db->insert('bonus_konten', $data);
		return $result;
	}

	function update_bonus_konten($id_konten, $data)
	{
		//Update row by id in table sub_materi 
		$this->db->where('id_konten', $id_konten);
		$result = $this->db->update('bonus_konten', $data);

		return $result;
	}

	function delete_bonus($id_konten)
	{
		$this->db->where('id_konten', $id_konten);
		$result = $this->db->delete('bonus_konten');
		
		return $result;
	}
	// END
	//###################################################################
	//###################################################################
	//###################################################################


	//MODEL UNTUK MANAJEMEN USER PM
	//########################################
	//########################################
	//########################################
	function fetch_all_user(){
		$this->db->select('login_adm.*, cabang.nama_cabang');
		$this->db->from('login_adm');
		$this->db->join('cabang', 'cabang.id_cabang = login_adm.cabang_id', 'left');

		$query = $this->db->get();
		return $query->result();
	}

	function fetch_all_konselor(){
		$this->db->select('login_adm.*, cabang.nama_cabang');
		$this->db->from('login_adm');
		$this->db->join('cabang', 'cabang.id_cabang = login_adm.cabang_id', 'left');
		$this->db->where('level', 'admin');
		$this->db->where('jabatan', 'konselor');
		if ($this->session->userdata('idcabang') > 0){
			$this->db->where('cabang_id', $this->session->userdata('idcabang'));
		}

		$query = $this->db->get();
		return $query->result();
	}

	function cari_user($username, $password){	
		$cred = array('username' => $username,
						 'password' => md5($password)
				);
		
		$this->db->select('*');
		$this->db->from('login_adm');
		
		$this->db->where($cred);
		
		$query = $this->db->get();
		$exist = $query->num_rows();
		
		if($exist > 0){
			return $query->result();
		}
		else{
			return false;
		}
	}

	function tambah_user($username, $password, $level, $jabatan, $cabang, $nama, $status, $kode='', $tptlhr='', $tgllhr=''){
		$data = array(
			'username'	=> $username,
			'password'	=> $password,
			'nama'			=> $nama,
			'level'			=> $level,
			'jabatan'		=> $jabatan,
			'cabang_id'	=> $cabang,
			'status'		=> $status,
			'kode'			=> $kode,
			'tpt_lahir'	=> $tptlhr,
			'tgl_lahir'	=> ($tgllhr ? date('Y-m-d', strtotime($tgllhr)) : ''),
		);
		
		$result = $this->db->insert('login_adm', $data);
		return $result;
	}

	function edit_user($iduser, $username, $level, $jabatan, $cabang, $nama, $status, $kode='', $tptlhr='', $tgllhr=''){
		$data = array(
			'username' 	=> $username,
			'nama'			=> $nama,
			'level'			=> $level,
			'jabatan'		=> $jabatan,
			'cabang_id'	=> $cabang,
			'status'		=> $status,
			'kode'			=> $kode,
			'tpt_lahir'	=> $tptlhr,
			'tgl_lahir'	=> ($tgllhr ? date('Y-m-d', strtotime($tgllhr)) : ''),
		);
		$this->db->where('id_adm', $iduser);
		$result = $this->db->update('login_adm', $data);

		return $result;
	}

	function get_user_by_id($iduser){
		$this->db->select('*');
		$this->db->from('login_adm');
		$this->db->where('id_adm', $iduser);
		
		$query = $this->db->get();
		return $query->row();
	}

	function edit_password_user($iduser, $password){
		$data = array(
			'password' 		=> md5($password)
		);
		$this->db->where('id_adm', $iduser);
		$result = $this->db->update('login_adm', $data);

		return $result;
	}

	function hapus_user($iduser){
		$this->db->where('id_adm', $iduser);
		$result = $this->db->delete('login_adm');
	}
	//#########################################
	//#########################################
	//#########################################

	//model untuk poin materi
	//#########################################
	//#########################################
	//#########################################

	function fetch_poin_materi(){
		$this->db->select("*");
		$this->db->from("poin_sub_materi");
		
		$query = $this->db->get();
		return $query->result();
	}


	//end model untuk poin materi
	//#########################################
	//#########################################
	//#########################################



	//CABANG
	function fetch_all_cabang()
	{
		$this->db->select('*');
		$this->db->from('cabang');
		$this->db->order_by('cabang.nama_cabang', 'ASC');
		$query = $this->db->get();
		
		return $query->result();
	}

	function fetch_cabang_by_id($id_cabang)
	{
		$this->db->select('*');
		$this->db->from('cabang');
		$this->db->join('kota_kabupaten', 'kota_kabupaten.id_kota = cabang.kabupaten_id', 'left');
		$this->db->where('cabang.id_cabang', $id_cabang);
		$query = $this->db->get();

		return $query->row();
	}
	
	function fetch_cabang_by_kota($idkota)
	{
		$this->db->select('*');
		$this->db->from('cabang');
		$this->db->where('kabupaten_id', $idkota);
		$query = $this->db->get();

		return $query->result();
	}

	function add_cabang($no_induk, $nama_cabang, $email, $telepon, $kota, $alamat_cabang)
	{	
		//Insert data into table mata_pelajaran
		$data = array(
			'no_induk' 				=> $no_induk,
			'nama_cabang' 		=> $nama_cabang,
			'email' 					=> $email,
			'telepon' 				=> $telepon,
			'kabupaten_id' 		=> $kota,
			'alamat_cabang' 	=> $alamat_cabang
			);
		$result = $this->db->insert('cabang', $data);
		$insert_id = $this->db->insert_id();

		return $insert_id;
	}

	function update_cabang($id, $no_induk, $nama_cabang, $email, $telepon, $kota, $alamat_cabang)
	{
		//Update row by id in table mata_pelajaran 
		$data = array(
			'no_induk' 				=> $no_induk,
			'nama_cabang' 		=> $nama_cabang,
			'email' 					=> $email,
			'telepon' 				=> $telepon,
			'kabupaten_id' 				=> $kota,
			'alamat_cabang' 	=> $alamat_cabang
			);
		$this->db->where('cabang.id_cabang', $id);
		$result = $this->db->update('cabang', $data);

		return $result;
	}

	function delete_cabang($id)
	{
		$this->db->where('id_cabang', $id);
		$result = $this->db->delete('cabang');
		
		return $result;
	}

	function add_user_siswa($nama)
	{	
		$pass = rand(100,999);
		$data = array(
			'username' 			=> strtolower(str_replace('.','',str_replace(' ','',$nama))).$pass,
			'password' 			=> md5($pass),
			);
		$result = $this->db->insert('login_siswa', $data);
		$lastid = $this->db->insert_id();
		return $lastid;
	}

	function add_aktivasi($idsiswa,$kode)
	{	
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('kode', $kode);
		$result = $this->db->delete('paket_aktif');

		$this->db->select('id_profil');
		$this->db->from('profil_agcu');
		$this->db->where('kode', $kode);
		$query = $this->db->get();
		$profil = $query->row();
		
		$data = array(
			'id_siswa' 	=> $idsiswa,
			'kode' 			=> $kode,
			'id_profil' => $profil->id_profil,
			'isaktif' 	=> 1,
			);
		$result = $this->db->insert('paket_aktif', $data);

		return $result;
	}

}
