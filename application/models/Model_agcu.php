<?php
class Model_agcu extends CI_Model{
	function __construct(){

		parent::__construct();
	}

	function get_profil($kelas){
		$this->db->select('*');
		$this->db->from('profil_agcu');
		$this->db->where('id_kelas', $kelas);
		$this->db->where('status', 1);
		$this->db->order_by('tgl_acara', 'ASC');
		$query = $this->db->get();
		return $query->row();
	}

	function get_profil_kode($kode){
		$this->db->select('*');
		$this->db->from('profil_agcu');
		$this->db->where('kode', $kode);
		$this->db->where('tgl_acara <=', date('Y-m-d'));
		$this->db->where('tgl_acara_akhir >=', date('Y-m-d'));
		$this->db->where('status', 1);
		$this->db->order_by('tgl_acara', 'ASC');
		$query = $this->db->get();
		return $query->row();
	}

	function cek_eq($idsiswa,$idprofil){
		$this->db->select('*');
		$this->db->from('hasil_eq');
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('id_profil', $idprofil);
		$result = $this->db->count_all_results();
		return $result;
	}
	
	function get_eq($idsiswa,$idprofil=0){
		$this->db->select('*');
		$this->db->from('hasil_eq');
		$this->db->where("id_siswa", $idsiswa);
		if ($idprofil > 0){
			$this->db->where('hasil_eq.id_profil', $idprofil);
		}
		$query = $this->db->get();
		return $query->row();
	}
	function cek_ls($idsiswa,$idprofil){
		$this->db->select('*');
		$this->db->from('hasil_ls');
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('id_profil', $idprofil);
		$result = $this->db->count_all_results();
		return $result;
	}

	function get_jumlah_soal_diagnostic($idkelas,$idprofil=0){
		$this->db->select('
		soal_diagnostic.id_diagnostic,
		count( id_banksoal ) AS jumlah_soal');
		$this->db->from('soal_diagnostic');
		$this->db->join('kategori_diagnostic', 'soal_diagnostic.id_diagnostic = kategori_diagnostic.id_diagnostic');
		$this->db->join('mata_pelajaran', 'kategori_diagnostic.id_mapel = mata_pelajaran.id_mapel');
		$this->db->where('mata_pelajaran.kelas_id', $idkelas);
		$this->db->where('kategori_diagnostic.id_profil', $idprofil);
		$this->db->group_by('soal_diagnostic.id_diagnostic');
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_jumlah_soal_diagnostic_dikerjakan($idsiswa,$idprofil=0){
		$this->db->select('
		hasil_diagnostic.id_diagnostic, count( id_siswa ) AS jumlah');
		$this->db->from('hasil_diagnostic');
		$this->db->join('kategori_diagnostic', 'kategori_diagnostic.id_diagnostic = hasil_diagnostic.id_diagnostic','left');
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('kategori_diagnostic.id_profil', $idprofil);
		$this->db->group_by('id_diagnostic');
		$this->db->group_by('id_siswa');
		
		$query = $this->db->get();
		return $query->result();
	}

	function cek_kelas(){
		$this->db->select('*');
		$this->db->from('kategori_diagnostic');
		$this->db->join('mata_pelajaran', 'kategori_diagnostic.id_mapel=mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
		$this->db->group_by('alias_kelas'); 
		$query = $this->db->get();
		return $query->result();
	}



	function get_diagnostic(){
		$this->db->select('*');
		$this->db->from('kategori_diagnostic');
		$this->db->join('mata_pelajaran', 'kategori_diagnostic.id_mapel=mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
		$query = $this->db->get();
		return $query->result();
	}

	function get_jumlahsoal(){
		$this->db->select('id_diagnostic, COUNT(id_banksoal) as jumlah');
		$this->db->from('soal_diagnostic');
		$this->db->group_by('id_diagnostic'); 
		$query = $this->db->get();
		return $query->result();
	}

	function get_kelas(){
		$this->db->select('*');
		$this->db->from('kelas');
		$query = $this->db->get();
		return $query->result();
	}



	function get_mapel_by_kelas($idkelas){
		$this->db->select('*');
		$this->db->from('mata_pelajaran');
		$this->db->where('kelas_id', $idkelas);
		$query = $this->db->get();
		return $query->result();
	}

	function get_soal_by_mapel($idmapel){
		$this->db->select('*');
		$this->db->from('bank_soal');
		$this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
		$this->db->where('bank_soal.id_mapel', $idmapel);
		$query = $this->db->get();
		return $query->result();
	}

	function tambah_kategori($idprofil, $idmapel, $nama, $durasi, $ketuntasan, $jumlah, $random=0, $tanggal=NULL, $jam=NULL){
		$tanggal = ($tanggal == NULL ? date('Y-m-d') : $tanggal);
		$jam = ($jam == NULL ? date('H:i:s') : $jam);
		$data = array(
				'id_profil'		=> $idprofil,
				'id_mapel'		=> $idmapel,
				'nama_kategori'	=> $nama,
				'durasi'		=> $durasi,
				'ketuntasan'	=> $ketuntasan,
				'random'		=> $random,
				'tanggal'		=> $tanggal,
				'jam'			=> $jam,
				'jumlah_soal'			=> $jumlah,
			);
			$result=$this->db->insert('kategori_diagnostic', $data);
			return $result;
	}

	function last_addedkategori(){
		$this->db->select("max(id_diagnostic) as id_terakhir");
		$this->db->from("kategori_diagnostic");
		$query = $this->db->get();
		return $query->row();
	}

	function add_soal($iddiagnostic, $idbanksoal){
		$data = array(
				'id_diagnostic'		=> $iddiagnostic,
				'id_banksoal'		=> $idbanksoal
			);
			$result=$this->db->insert('soal_diagnostic', $data);
			return $result;
	}

	//TAMBAHAN UNTUK EDIT KATEGORI DIAGNOSTIC...
	function edit_kategori($iddiagnostic, $idmapel, $nama, $durasi, $ketuntasan, $jumlah, $random=0, $tanggal=NULL, $jam=NULL){
		$tanggal = ($tanggal == NULL ? date('Y-m-d') : $tanggal);
		$jam = ($jam == NULL ? date('H:i:s') : $jam);
		$data = array(
				'id_mapel'		=> $idmapel,
				'nama_kategori'	=> $nama,
				'durasi'		=> $durasi,
				'ketuntasan'	=> $ketuntasan,
				'random'		=> $random,
				'tanggal'		=> $tanggal,
				'jam'			=> $jam,
				'jumlah_soal'			=> $jumlah,
				);

		$this->db->where('id_diagnostic', $iddiagnostic);
		$result = $this->db->update('kategori_diagnostic', $data);
		return $result;
	}

	function aktivasi_kategori($idkategori){
		$this->db->query("UPDATE kategori_diagnostic SET status = '1' WHERE id_diagnostic = $idkategori");
	}

	function nonaktif_kategori($idkategori){
		$this->db->query("UPDATE kategori_diagnostic SET status = '0' WHERE id_diagnostic = $idkategori");
	}

	//END TAMBAHAN UNTUK EDIT KATEGORI DIAGNOSTIC...

	//fungsi hapus kategori diagnostic
	function hapuskategori($iddiagnostic){
		$this->db->delete('kategori_diagnostic', array('id_diagnostic' => $iddiagnostic));
	}
	function hapus_soal_kategori($iddiagnostic){
		$this->db->delete('soal_diagnostic', array('id_diagnostic' => $iddiagnostic));
	}

	//end hapus kategori diagnostic

	function get_diagnosticbyid($iddiagnostic){
		$this->db->select('*');
		$this->db->from('kategori_diagnostic');
		$this->db->join('mata_pelajaran', 'kategori_diagnostic.id_mapel=mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
		$this->db->where('kategori_diagnostic.id_diagnostic', $iddiagnostic);
		$query = $this->db->get();
		return $query->row();
	}

	function get_idsoal($iddiagnostic){
		$this->db->select('*');
		$this->db->from('soal_diagnostic');
		$this->db->where('id_diagnostic', $iddiagnostic);
		$query = $this->db->get();
		return $query->result();
	}

	function get_soal(){
		$this->db->select('*');
		$this->db->from('bank_soal');
		$this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
		$query = $this->db->get();
		return $query->result();
	}

	function get_diagnosticbykelas($kelas,$idprofil=0){
		$this->db->select('*');
		$this->db->from('kategori_diagnostic');
		$this->db->join('mata_pelajaran', 'kategori_diagnostic.id_mapel=mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
		$this->db->where('kelas.id_kelas', $kelas);
		if ($idprofil > 0){
			$this->db->where('kategori_diagnostic.id_profil', $idprofil);
		}
		$this->db->where('kategori_diagnostic.status', 1);
		$query = $this->db->get();
		return $query->result();
	}

	//function untuk diagnostic test
	//******************************

	function get_navbar_links(){
		$this->db->select('*');
		$this->db->from('mata_pelajaran');
		$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		$this->db->order_by('mata_pelajaran.nama_mapel', 'ASC');
		$query = $this->db->get();
		return $query->result();

	}

	function fetch_soal_by_diagnostic($iddiagnostic){
		$this->db->select("
		soal_diagnostic.id_soal,
		soal_diagnostic.id_diagnostic,
		bank_soal.id_banksoal,
		bank_soal.pertanyaan,
		bank_soal.topik,
		bank_soal.jawab_1,
		bank_soal.jawab_2,
		bank_soal.jawab_3,
		bank_soal.jawab_4,
		bank_soal.jawab_5,
		bank_soal.pembahasan_teks,
		bank_soal.pembahasan_video,
		bank_soal.bobot_soal,
		bank_soal.bobot_topik,
		bank_soal.kunci,
		kategori_diagnostic.nama_kategori,
		kategori_diagnostic.durasi,
		kategori_diagnostic.ketuntasan
		");
		$this->db->from("soal_diagnostic");
		$this->db->join("bank_soal", "soal_diagnostic.id_banksoal=bank_soal.id_banksoal");
		$this->db->join("kategori_diagnostic", "soal_diagnostic.id_diagnostic=kategori_diagnostic.id_diagnostic");
		$this->db->where("soal_diagnostic.id_diagnostic", $iddiagnostic);
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_timer($iddiagnostic){
		$this->db->select('durasi');
		$this->db->from('kategori_diagnostic');
		$this->db->where('id_diagnostic', $iddiagnostic);
		
		$query = $this->db->get();
		return $query->row();
	}

	function get_mapel_by_diagnostic($iddiagnostic){
		$this->db->select('*');
		$this->db->from('kategori_diagnostic');
		$this->db->join('mata_pelajaran', 'kategori_diagnostic.id_mapel = mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
		$this->db->where('kategori_diagnostic.id_diagnostic', $iddiagnostic);
		$query = $this->db->get();
		return $query->row();
	}

	function fetch_array_id_soal($iddiagnostic){
		$this->db->select('soal_diagnostic.id_banksoal, bank_soal.kunci');
		$this->db->from('soal_diagnostic');
		$this->db->join('bank_soal', 'soal_diagnostic.id_banksoal=bank_soal.id_banksoal');
		$this->db->where('soal_diagnostic.id_diagnostic', $iddiagnostic);
		
		$query = $this->db->get();
		return $query->result_array();
	}

	function carihasildiagnostic($idkategori, $idsiswa, $id_soal){
		$this->db->select('*');
		$this->db->from('hasil_diagnostic');
		$this->db->where('id_diagnostic', $idkategori);
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('id_soal', $id_soal);
		$result = $this->db->count_all_results();
		//tester
		// echo $this->db->_compile_select();
		return $result;
	}

	function edithasildiagnostic($idkategori, $idsiswa, $id_soal, $status, $jawaban){
		$this->db->set('jawaban', $jawaban);
		$this->db->set('status', $status);
		
		$this->db->where('id_diagnostic', $idkategori);
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('id_soal', $id_soal);
		$query = $this->db->update('hasil_diagnostic');
		return $query;
	}

	function inputhasildiagnostic($idkategori, $idsiswa, $id_soal, $status, $jawaban){
		$data = array(
			'id_diagnostic'		=> $idkategori,
			'id_siswa'			=> $idsiswa,
			'id_soal'			=> $id_soal,
			'status'			=> $status,
			'jawaban'			=> $jawaban
		);
		
		$result = $this->db->insert('hasil_diagnostic', $data);
	}

	function cari_jumlahsoal_by_diagnostic($iddiagnostic, $idsiswa){
		$this->db->select('*');
		$this->db->from('soal_diagnostic');
		$this->db->where('id_diagnostic', $iddiagnostic);
		$result = $this->db->count_all_results();
		return $result;
	}

	function cari_diagnostic_benar_by_diagnostic($iddiagnostic, $idsiswa){
		$this->db->select('*');
		$this->db->from('hasil_diagnostic');
		$this->db->where('id_diagnostic', $iddiagnostic);
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('status', 1);
		$result = $this->db->count_all_results();
		return $result;
	}

	function cari_diagnostic_salah_by_diagnostic($iddiagnostic, $idsiswa){
		$this->db->select('*');
		$this->db->from('hasil_diagnostic');
		$this->db->where('id_diagnostic', $iddiagnostic);
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('status', 0);
		$result = $this->db->count_all_results();
		return $result;
	}

	function get_jumlah_benar($idsiswa){
		$this->db->select('
		id_diagnostic,
		id_siswa,
		count(status) as "jumlah_benar"');
		$this->db->from('hasil_diagnostic');
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('status', 1);
		$this->db->group_by('id_diagnostic');
		$this->db->group_by('id_siswa');
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_jumlah_benar_by_kelas_sekolah($idkelas, $idsekolah){
		$this->db->select('
		hasil_diagnostic.id_diagnostic,
		hasil_diagnostic.id_siswa,
		hasil_diagnostic.id_soal
		');
		$this->db->from('hasil_diagnostic');
		$this->db->join("siswa", "hasil_diagnostic.id_siswa=siswa.id_siswa");
		$this->db->where('hasil_diagnostic.status', 1);
		$this->db->where('siswa.kelas', $idkelas);
		$this->db->where('siswa.sekolah_id', $idsekolah);
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_jumlah_hasil(){
		$this->db->select('
		id_diagnostic,
		count(status) as "jumlah_soal"
		');
		$this->db->from('hasil_diagnostic');
		$this->db->group_by('id_diagnostic');
		
		$query = $this->db->get();
		return $query->result();
	}
	function get_jumlah_benar_hasil(){
		$this->db->select('
		id_diagnostic,
		count(status) as "jumlah_benar"
		');
		$this->db->from('hasil_diagnostic');
		$this->db->where('status', 1);
		$this->db->group_by('id_diagnostic');
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_analisis_topik($id_siswa){
		$this->db->select("hasil_diagnostic.id_diagnostic, hasil_diagnostic.status, bank_soal.topik");
		$this->db->from('hasil_diagnostic');
		$this->db->join('bank_soal', 'hasil_diagnostic.id_soal=bank_soal.id_banksoal');
		$this->db->where('hasil_diagnostic.id_siswa', $id_siswa);
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_rank_by_kelas($idkelas){
		$this->db->select("siswa.kelas, hasil_diagnostic.id_siswa, count( hasil_diagnostic.status ) AS jumlah_benar");
		$this->db->from("hasil_diagnostic");
		$this->db->join("siswa","hasil_diagnostic.id_siswa = siswa.id_siswa");
		$this->db->where("hasil_diagnostic.status", 1);
		$this->db->where("siswa.kelas", $idkelas);
		$this->db->group_by("id_siswa");
		$this->db->order_by("jumlah_benar", "DESC");
		
		$query = $this->db->get();
		return $query->result();
	}

	//DIMAS 
	function get_ordered_hasildiagnostic(){
		$sql = "SELECT siswa.nama_siswa, hasil_diagnostic.id_siswa, hasil_diagnostic.id_diagnostic,
				(SUM(CASE(hasil_diagnostic.status) WHEN 1 THEN hasil_diagnostic.status ELSE 0 END)) AS 'jumlah_status' 
			FROM hasil_diagnostic 
			LEFT JOIN siswa 
				ON siswa.id_siswa = hasil_diagnostic.id_siswa
			GROUP BY hasil_diagnostic.id_diagnostic, hasil_diagnostic.id_siswa 
			ORDER BY hasil_diagnostic.id_diagnostic, jumlah_status DESC, siswa.nama_siswa";
		
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_peringkatsiswabykelas($id_kelas=0, $idprofil=0){
		$id_profil = ($idprofil > 0 ? 'AND kategori_diagnostic.id_profil = '.$idprofil : '');
		$sql = "SELECT siswa.kelas, siswa.nama_siswa, hasil_diagnostic.id_siswa, 
			(SUM(CASE(hasil_diagnostic.status) WHEN 1 THEN hasil_diagnostic.status ELSE 0 END)) AS 'jumlah_status' 
			FROM hasil_diagnostic 
			LEFT JOIN siswa ON siswa.id_siswa = hasil_diagnostic.id_siswa
			LEFT JOIN kategori_diagnostic ON kategori_diagnostic.id_diagnostic = hasil_diagnostic.id_diagnostic
			WHERE siswa.kelas = $id_kelas $id_profil
			GROUP BY hasil_diagnostic.id_siswa 
			ORDER BY jumlah_status DESC, siswa.nama_siswa";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	function fetch_soal(){
		$this->db->select("
		soal_diagnostic.id_soal,
		soal_diagnostic.id_diagnostic,
		bank_soal.id_banksoal,
		bank_soal.pertanyaan,
		bank_soal.topik,
		bank_soal.jawab_1,
		bank_soal.jawab_2,
		bank_soal.jawab_3,
		bank_soal.jawab_4,
		bank_soal.jawab_5,
		bank_soal.pembahasan_teks,
		bank_soal.pembahasan_video,
		bank_soal.bobot_soal,
		bank_soal.bobot_topik,
		bank_soal.kunci,
		kategori_diagnostic.nama_kategori,
		kategori_diagnostic.durasi,
		kategori_diagnostic.ketuntasan
		");
		$this->db->from("soal_diagnostic");
		$this->db->join("bank_soal", "soal_diagnostic.id_banksoal=bank_soal.id_banksoal");
		$this->db->join("kategori_diagnostic", "soal_diagnostic.id_diagnostic=kategori_diagnostic.id_diagnostic");
		
		$query = $this->db->get();
		return $query->result();
	}

	function cari_waktu($iddiagnostic, $idsiswa){
		$this->db->select("*");
		$this->db->from("elapsed_time_agcu");
		$this->db->where("id_diagnostic", $iddiagnostic);
		$this->db->where("id_siswa", $idsiswa);
		
		if($this->db->count_all_results() > 0){
			$this->db->select("*");
			$this->db->from("elapsed_time_agcu");
			$this->db->where("id_diagnostic", $iddiagnostic);
			$this->db->where("id_siswa", $idsiswa);
			
			$query = $this->db->get();
			return $query->row();
		}else{
			$this->db->select("*");
			$this->db->from("elapsed_time_agcu");
			$this->db->where("id_diagnostic", $iddiagnostic);
			$this->db->where("id_siswa", $idsiswa);
			return $this->db->count_all_results();
		}
	}
	function simpan_waktu($iddiagnostic, $idsiswa, $waktu){
		$this->db->select("*");
		$this->db->from("elapsed_time_agcu");
		$this->db->where("id_diagnostic", $iddiagnostic);
		$this->db->where("id_siswa", $idsiswa);
		
		if($this->db->count_all_results() > 0){
			$this->db->set('id_diagnostic', $iddiagnostic);
			$this->db->set('id_siswa', $idsiswa);
			$this->db->set('elapsed_time', $waktu);
			
			$this->db->where('id_diagnostic', $iddiagnostic);
			$this->db->where('id_siswa', $idsiswa);
			$query = $this->db->update('elapsed_time_agcu');
			return $query;
		}else{
			$data = array(
				'id_diagnostic'		=> $iddiagnostic,
				'id_siswa'			=> $idsiswa,
				'elapsed_time'		=> $waktu
				
			);
			$result = $this->db->insert('elapsed_time_agcu', $data);
		}
	}

	function cari_terjawab($idiagnostic, $idsiswa){
		$this->db->select("*");
		$this->db->from("hasil_diagnostic");
		$this->db->where('id_diagnostic', $idiagnostic);
		$this->db->where('id_siswa', $idsiswa);
		
		$query = $this->db->get();
		return $query->result();
	}
	
	//profil Diagnostic
	function fetch_all_profil($cari='0',$offset=0,$limit=0){
		$this->db->select("
		profil_agcu.id_profil,
		profil_agcu.id_profil_master,
		profil_agcu.id_kelas,
		profil_agcu.nama_profil,
		profil_agcu.penyelenggara,
		profil_agcu.tgl_acara,
		profil_agcu.jam_acara,
		profil_agcu.tgl_acara_akhir,
		profil_agcu.jam_acara_akhir,
		profil_agcu.biaya,
		profil_agcu.banner,
		profil_agcu.status,
		profil_agcu.tipe,
		profil_agcu.kode,
		profil_master.kode as kode_profil,
		profil_master.nama_profil as nama_kode_profil,
		cabang.nama_cabang,
		sekolah.nama_sekolah,
		kelas.tingkatan_kelas as kelas,
		kelas.alias_kelas
		");
		$this->db->from("profil_agcu");
		$this->db->join("profil_master", "profil_master.id_profil_master=profil_agcu.id_profil_master","left");
		$this->db->join("kelas", "kelas.id_kelas=profil_agcu.id_kelas","left");
		$this->db->join("cabang", "cabang.id_cabang=profil_agcu.penyelenggara","left");
		$this->db->join("sekolah", "sekolah.id_sekolah=profil_agcu.sekolah","left");
		$this->db->order_by("profil_agcu.tgl_acara", "DESC");
		$this->db->order_by("profil_agcu.jam_acara", "DESC");
		if ($cari != '0'){
			$cr = str_replace('-',' ',$cari);
			$this->db->or_like('cabang.nama_cabang', $cr);
			$this->db->or_like('sekolah.nama_sekolah', $cr);
			$this->db->or_like('kelas.alias_kelas', $cr);
			$this->db->or_like('profil_agcu.kode', $cr);
			$this->db->or_like('profil_agcu.nama_profil', $cr);
			$this->db->or_like('profil_master.kode', $cr);
			$this->db->or_like('profil_master.nama_profil', $cr);
		}
		if ($this->session->userdata('idcabang') > 0){
			$this->db->where('penyelenggara', $this->session->userdata('idcabang'));
		}
		$this->db->limit($limit, $offset);
		$result=$this->db->get();

		return $result;
	}
	
	//master Diagnostic
	function fetch_all_profil_master($cari='0',$offset=0,$limit=0){
		$this->db->select("
		profil_master.id_profil_master,
		profil_master.id_kelas,
		profil_master.nama_profil,
		profil_master.status,
		profil_master.kode,
		kelas.tingkatan_kelas as kelas,
		kelas.alias_kelas
		");
		$this->db->from("profil_master");
		$this->db->join("kelas", "kelas.id_kelas=profil_master.id_kelas");
		$this->db->order_by("profil_master.id_kelas", "ASC");
		$this->db->order_by("profil_master.nama_profil", "ASC");
		if ($cari != '0'){
			$cr = str_replace('-',' ',$cari);
			$this->db->or_like('kelas.alias_kelas', $cr);
			$this->db->or_like('profil_master.kode', $cr);
			$this->db->or_like('profil_master.nama_profil', $cr);
		}
		$this->db->limit($limit, $offset);
		$result=$this->db->get();

		return $result;
	}
	
	function fetch_profil_master($kelas=0){
		$this->db->select("*");
		$this->db->from("profil_master");
		if ($kelas > 0){
			$this->db->where('id_kelas', $kelas);
		}
		$this->db->where('status', 1);
		$result=$this->db->get();
		return $result->result();
	}
	
	function fetch_kategori($idprofil=0){
		$this->db->select("*");
		$this->db->from("kategori_diagnostic");
		$this->db->where('id_profil', $idprofil);
		$result=$this->db->get();
		return $result->result();
	}
	
	function add_profil($sekolah, $kelas, $nama, $keterangan, $penyelenggara, $tgl, $jam, $tgl1, $jam1, $biaya, $banner, $tipe, $kode, $profil){
		$profil = array(
			'id_profil_master'=> $profil,
			'sekolah' 				=> $sekolah,
			'id_kelas' 				=> $kelas,
			'nama_profil' 		=> $nama,
			'penyelenggara'		=> $penyelenggara,
			'biaya'						=> $biaya,
			'tgl_acara'				=> $tgl,
			'jam_acara'				=> $jam,
			'tgl_acara_akhir'	=> $tgl1,
			'jam_acara_akhir'	=> $jam1,
			'status'					=> '0',
			'tipe'						=> $tipe,
			'banner'					=> $banner,
			'kode'						=> $kode,
			'keterangan'			=> $keterangan
		);
		$result=$this->db->insert('profil_agcu', $profil);
		
		return $result;
	}
	
	function edit_profil($idprofil, $sekolah, $kelas, $nama, $keterangan, $penyelenggara, $tanggal, $jam, $tanggal1, $jam1, $biaya, $namafile, $type, $kode, $profil){
		$data = array(
			'id_profil_master'=> $profil,
			'sekolah' 				=> $sekolah,
			'id_kelas' 				=> $kelas,
			'nama_profil' 		=> $nama,
			'penyelenggara' 	=> $penyelenggara,
			'tgl_acara' 			=> $tanggal,
			'jam_acara' 			=> $jam,
			'tgl_acara_akhir'	=> $tanggal1,
			'jam_acara_akhir'	=> $jam1,
			'biaya' 					=> $biaya,
			'banner' 					=> $namafile,
			'keterangan'			=> $keterangan,
			'kode'						=> $kode,
			'tipe' 						=> $type
			);

		$this->db->where('id_profil', $idprofil);
		$result = $this->db->update('profil_agcu', $data);
		return $result;
	}

	function fetch_profil_by_id($idprofil){
		$this->db->select("*");
		$this->db->from("profil_agcu");
		$this->db->join("kelas", "kelas.id_kelas = profil_agcu.id_kelas", 'left');
		$this->db->join("cabang", "cabang.id_cabang=profil_agcu.penyelenggara","left");
		$this->db->join("sekolah", "sekolah.id_sekolah=profil_agcu.sekolah","left");
		$this->db->where("profil_agcu.id_profil", $idprofil);
		
		$query = $this->db->get();
		return $query->row();
	}

	function add_profil_master($kelas, $nama, $keterangan, $kode){
		$profil = array(
			'id_kelas' 				=> $kelas,
			'nama_profil' 		=> $nama,
			'kode'						=> $kode,
			'keterangan'			=> $keterangan
		);
		$result=$this->db->insert('profil_master', $profil);
		
		return $result;
	}
	
	function edit_profil_master($idprofil, $kelas, $nama, $keterangan, $kode){
		$data = array(
			'id_kelas' 				=> $kelas,
			'nama_profil' 		=> $nama,
			'kode'						=> $kode,
			'keterangan'			=> $keterangan
		);
		$this->db->where('id_profil_master', $idprofil);
		$result = $this->db->update('profil_master', $data);
		return $result;
	}
	
	function fetch_profil_master_by_id($idprofil){
		$this->db->select("*");
		$this->db->from("profil_master");
		$this->db->join("kelas", "kelas.id_kelas = profil_master.id_kelas", 'left');
		$this->db->where("profil_master.id_profil_master", $idprofil);
		
		$query = $this->db->get();
		return $query->row();
	}

	function get_kategori_by_profil($idprofil){
		$this->db->select("*");
		$this->db->from("kategori_diagnostic");
		$this->db->where("id_profil", $idprofil);
		
		$query = $this->db->get();
		return $query->result();
	}

	function hapus_agcu_test($idprofil){
		$this->db->where('id_profil', $idprofil);
		$this->db->delete('profil_agcu');
	}

	function hapus_profil($idprofil){
		$this->db->where('id_profil_master', $idprofil);
		$this->db->delete('profil_agcu');
	}

	function hapus_profil_master($idprofil){
		$this->db->where('id_profil_master', $idprofil);
		$this->db->delete('profil_master');
	}

	function hapus_soal_by_kategori($idkategori){
		$this->db->where('id_diagnostic', $idkategori);
		$this->db->delete('soal_diagnostic');
	}

	function hapus_kategori_by_profil($idprofil){
		$this->db->where('id_profil', $idprofil);
		$this->db->delete('kategori_diagnostic');
	}

	function hapus_hasil_by_diagnostic($iddiagnostic){
		$this->db->where('id_diagnostic', $iddiagnostic);
		$this->db->delete('hasil_diagnostic');
	}

	function hapus_hasil_eq_by_profil($idprofil){
		$this->db->where('id_profil', $idprofil);
		$this->db->delete('hasil_eq');
		
		$this->db->where('id_profil', $idprofil);
		$this->db->delete('hasil_eq_jawaban');
	}

	function hapus_hasil_ls_by_profil($idprofil){
		$this->db->where('id_profil', $idprofil);
		$this->db->delete('hasil_ls');
	}
	
	//TAMBAHAN UNTUK EDIT KATEGORI DIAGNOSTIC...
	function aktifkan_profil($id){
		$data = array(
				'status'		=> 1,
				);

		$this->db->where('id_profil', $id);
		$result = $this->db->update('profil_agcu', $data);
		
		//$this->db->query("UPDATE kategori_diagnostic SET status = '1' WHERE id_profil = $id");
		
		return $result;
	}

	function nonaktifkan_profil($id){
		$data = array(
				'status'		=> 0,
				);

		$this->db->where('id_profil', $id);
		$result = $this->db->update('profil_agcu', $data);

		//$this->db->query("UPDATE kategori_diagnostic SET status = '0' WHERE id_profil = $id");
		
		return $result;
	}

	function aktifkan_profil_master($id){
		$data = array(
				'status'		=> 1,
				);

		$this->db->where('id_profil_master', $id);
		$result = $this->db->update('profil_master', $data);
		
		$this->db->query("UPDATE kategori_diagnostic SET status = '1' WHERE id_profil = $id");
		
		return $result;
	}

	function nonaktifkan_profil_master($id){
		$data = array(
				'status'		=> 0,
				);

		$this->db->where('id_profil_master', $id);
		$result = $this->db->update('profil_master', $data);

		$this->db->query("UPDATE kategori_diagnostic SET status = '0' WHERE id_profil = $id");
		
		return $result;
	}

	//Peserta Diagnostic
	function fetch_all_peserta($idprofil=0,$cari='0',$offset=0,$limit=0){
		$this->db->select("siswa.id_siswa, siswa.nama_siswa, siswa.kelas, paket_aktif.id_profil, profil_agcu.id_profil_master");
		$this->db->from("siswa");
		$this->db->join("paket_aktif", "paket_aktif.id_siswa = siswa.id_siswa","left");
		$this->db->join("profil_agcu", "profil_agcu.id_profil = paket_aktif.id_profil","left");
		$this->db->join("profil_master", "profil_master.id_profil_master = profil_agcu.id_profil_master","left");
		$this->db->where("paket_aktif.id_profil", $idprofil);
		if ($cari != '0'){
			$cr = str_replace('-',' ',$cari);
			$this->db->or_like('siswa.nama_siswa', $cr);
		}
		$this->db->limit($limit, $offset);
		$result=$this->db->get();

		return $result;
	}
	
	function get_paket_aktif($idsiswa,$idprofil){
		$this->db->select("*");
		$this->db->from("paket_aktif");
		$this->db->where("id_siswa", $idsiswa);
		$this->db->where("id_profil", $idprofil);
		$result = $this->db->count_all_results();
		return $result;
	}

	function add_paket_aktif($idsiswa,$kode,$idprofil){
		$profil = array(
			'id_siswa' 			=> $idsiswa,
			'kode' 					=> $kode,
			'id_profil'			=> $idprofil,
		);
		$result=$this->db->insert('paket_aktif', $profil);
		
		return $result;
	}
	
	function cek_diagnostic($idsiswa,$idprofil){
		$this->db->select('hasil_diagnostic.*');
		$this->db->from('hasil_diagnostic');
		$this->db->join("kategori_diagnostic", "kategori_diagnostic.id_diagnostic = hasil_diagnostic.id_diagnostic");
		$this->db->join("profil_agcu", "profil_agcu.id_profil = kategori_diagnostic.id_profil");
		$this->db->where('hasil_diagnostic.id_siswa', $idsiswa);
		$this->db->where('profil_agcu.id_profil', $idprofil);
		$result = $this->db->count_all_results();
		return $result;
	}
	
	function cek_diagnostic_siswa($idsiswa,$iddiagnostic){
		$this->db->select('hasil_diagnostic.*');
		$this->db->from('hasil_diagnostic');
		$this->db->join("kategori_diagnostic", "kategori_diagnostic.id_diagnostic = hasil_diagnostic.id_diagnostic");
		$this->db->join("profil_master", "profil_master.id_profil_master = kategori_diagnostic.id_profil");
		$this->db->where('hasil_diagnostic.id_siswa', $idsiswa);
		$this->db->where('kategori_diagnostic.id_diagnostic', $iddiagnostic);
		$result = $this->db->count_all_results();
		return $result;
	}
	
	function count_eq(){
		$this->db->select('*');
		$this->db->from('eq_test');
		$result = $this->db->count_all_results();
		return $result;
	}
	
	function count_ls(){
		$this->db->select('*');
		$this->db->from('ls_test1');
		$result = $this->db->count_all_results();
		return $result;
	}
	
	function cek_jawaban_dg($idsiswa, $iddiagnostic=0){
		$this->db->select('hasil_diagnostic.*');
		$this->db->from('hasil_diagnostic');
		$this->db->join("kategori_diagnostic", "kategori_diagnostic.id_diagnostic = hasil_diagnostic.id_diagnostic");
		$this->db->join("profil_master", "profil_master.id_profil_master = kategori_diagnostic.id_profil");
		$this->db->where('hasil_diagnostic.id_siswa', $idsiswa);
		$this->db->where('kategori_diagnostic.id_diagnostic', $iddiagnostic);
		$query = $this->db->get();
		return $query->result();
	}

	function hapus_hasil_dg($idsiswa, $iddiagnostic=0){
		$this->db->where('hasil_diagnostic.id_siswa', $idsiswa);
		$this->db->where('hasil_diagnostic.id_diagnostic', $iddiagnostic);
		$this->db->delete('hasil_diagnostic');
	}

	function get_detail_kategori_diagnostic($id){
		$this->db->select("*");
		$this->db->from("kategori_diagnostic");
		$this->db->join("mata_pelajaran", "mata_pelajaran.id_mapel = kategori_diagnostic.id_mapel");
		$this->db->join("kelas", "kelas.id_kelas = mata_pelajaran.kelas_id");
		$this->db->where("id_diagnostic", $id);
		
		$query = $this->db->get();
		return $query->row();
	}

	function fetch_soal_eq(){
		$this->db->select("*");
		$this->db->from("eq_test");
		
		$query = $this->db->get();
		return $query->result();
	}

	function fetch_soal_ls(){
		$this->db->select("*");
		$this->db->from("ls_test1");
		
		$query = $this->db->get();
		return $query->result();
	}

}

?>