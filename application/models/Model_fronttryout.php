<?php 

class Model_fronttryout extends CI_Model{
	function __construct(){

		parent::__construct();
	}

//general
function get_navbar_links(){
	$this->db->select('*');
	$this->db->from('mata_pelajaran');
	$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
	$this->db->order_by('mata_pelajaran.nama_mapel', 'ASC');
	$query = $this->db->get();
	return $query->result();

}
function get_mapel_by_tryout($id){
	$this->db->select('*');
	$this->db->from('konten_materi');
	$this->db->join('sub_materi', 'konten_materi.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
	$this->db->where('konten_materi.sub_materi_id', $id);
	
	$query = $this->db->get();
	return $query->row();
}
function fetch_subtryout($id){
	$this->db->select('*');
	$this->db->from('sub_materi');
	$this->db->where('id_sub_materi', $id);
	$query = $this->db->get();
	return $query->row();
}

function fetch_kategori($idtryout){
	$this->db->select("
	sub_materi.id_sub_materi,
	sub_materi.materi_pokok_id,
	sub_materi.urutan_materi,
	sub_materi.urutan_konten,
	sub_materi.nama_sub_materi,
	sub_materi.deskripsi_sub_materi,
	sub_materi.status_materi,
	profil_tryout.id_tryout,
	profil_tryout.penyelenggara,
	profil_tryout.tgl_acara,
	profil_tryout.jam_acara,
	profil_tryout.jenjang,
	profil_tryout.biaya,
	profil_tryout.banner,
	profil_tryout.status,
	kategori_tryout.id_kategori,
	kategori_tryout.nama_kategori,
	kategori_tryout.random,
	kategori_tryout.tanggal,
	kategori_tryout.jam,
	kategori_tryout.durasi,
	kategori_tryout.ketuntasan,
	kategori_tryout.status,
	kategori_tryout.jumlah_soal
	");
	$this->db->from("sub_materi");
	$this->db->join("profil_tryout", "profil_tryout.id_submateri = sub_materi.id_sub_materi");
	$this->db->join("kategori_tryout", "kategori_tryout.id_profil = profil_tryout.id_tryout");
	$this->db->where("id_sub_materi", $idtryout);
	$query = $this->db->get();
	return $query->result();
}

function fetch_soal_by_kategori($idkategori){
	$this->db->select("
	soal_tryout.id_soal,
	soal_tryout.id_kategori,
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
	kategori_tryout.nama_kategori,
	kategori_tryout.durasi,
	kategori_tryout.ketuntasan,
	kategori_tryout.jumlah_soal
	");
	$this->db->from("soal_tryout");
	$this->db->join("bank_soal", "soal_tryout.id_banksoal=bank_soal.id_banksoal");
	$this->db->join("kategori_tryout", "soal_tryout.id_kategori=kategori_tryout.id_kategori");
	$this->db->where("soal_tryout.id_kategori", $idkategori);
	
	$query = $this->db->get();
	return $query->result();
}

function get_info_tryout($id_sub_materi){
	$this->db->select('*');
	$this->db->from('kategori_tryout');
	$this->db->where('kategori_tryout.id_kategori', $id_sub_materi);

	$query = $this->db->get();
	//return $query->result_array();
	return $query->row();
}

function fetch_array_id_soal($kategori){
	$this->db->select('soal_tryout.id_banksoal, bank_soal.kunci');
	$this->db->from('soal_tryout');
	$this->db->join('bank_soal', 'soal_tryout.id_banksoal=bank_soal.id_banksoal');
	$this->db->where('soal_tryout.id_kategori', $kategori);
	
	$query = $this->db->get();
	return $query->result_array();
}
function fetch_array_kunci(){
	$this->db->select('bank_soal.id_banksoal, bank_soal.kunci');
	$this->db->from('bank_soal');
	
	
	$query = $this->db->get();
	return $query->result_array();
}

function get_sub_materi_by_id($id_sub_materi){
	$this->db->select('*');
	$this->db->from('sub_materi');
	$this->db->join('profil_tryout', 'sub_materi.id_sub_materi=profil_tryout.id_submateri');
	$this->db->join('kategori_tryout', 'profil_tryout.id_tryout=kategori_tryout.id_profil');
	$this->db->where('kategori_tryout.id_kategori', $id_sub_materi);

	$query = $this->db->get();
	//return $query->result_array();
	return $query->row();
}

function jumlah_soal($idkategori){
		$this->db->where('soal_tryout.id_kategori', $idkategori);

		return $this->db->count_all_results('soal_tryout');

}

function get_timer($idkategori){
	$this->db->select('durasi');
	$this->db->from('kategori_tryout');
	$this->db->where('id_kategori', $idkategori);
	
	$query = $this->db->get();
	return $query->row();
}

function get_ketuntasan($idkategori){
	$this->db->select('*');
	$this->db->from('kategori_tryout');
	$this->db->where('id_kategori', $idkategori);
	
	$query = $this->db->get();
	return $query->row();
}

function carianalisispelajaran($idkategori, $idsiswa){
	$this->db->select('*');
	$this->db->from('analisis_pelajaran');
	$this->db->where('id_kategori', $idkategori);
	$this->db->where('id_siswa', $idsiswa);
	$result = $this->db->count_all_results();
	//tester
	// echo $this->db->_compile_select();
	return $result;
}

function carianalisiswaktu($idkategori, $idsiswa){
	$this->db->select('*');
	$this->db->from('analisis_waktu');
	$this->db->where('id_kategori', $idkategori);
	$this->db->where('id_siswa', $idsiswa);
	$result = $this->db->count_all_results();
	//tester
	// echo $this->db->_compile_select();
	return $result;
}

function inputanalisispelajaran($id_sub_materi, $idsiswa, $benar, $salah, $final_skor, $skorpersen, $tuntas){
	$data = array(
		'id_kategori'		=> $id_sub_materi,
		'id_siswa'			=> $idsiswa,
		'benar'				=> $benar,
		'salah'				=> $salah,
		'nilai'				=> $final_skor,
		'skor'				=> $skorpersen,
		'tuntas'			=> $tuntas
	);
	
	$result = $this->db->insert('analisis_pelajaran', $data);
}

function editanalisispelajaran($id_sub_materi, $idsiswa, $benar, $salah, $final_skor, $skorpersen, $tuntas){
	$this->db->set('benar', $benar);
	$this->db->set('salah', $salah);
	$this->db->set('nilai', $final_skor);
	$this->db->set('skor', $skorpersen);
	$this->db->set('tuntas', $tuntas);
	
	$this->db->where('id_kategori', $id_sub_materi);
	$this->db->where('id_siswa', $idsiswa);
	$query = $this->db->update('analisis_pelajaran');
	return $query;
}

function inputanalisiswaktu($id_sub_materi, $idsiswa, $durasiasli, $lama, $average){
	$data = array(
		'id_kategori'		=> $id_sub_materi,
		'id_siswa'			=> $idsiswa,
		'disediakan'		=> $durasiasli,
		'dikerjakan'		=> $lama,
		'rata_rata'			=> $average
		
	);
	
	$result = $this->db->insert('analisis_waktu', $data);
}


function editanalisiswaktu($id_sub_materi, $idsiswa, $durasiasli, $lama, $average){
	$this->db->set('disediakan', $durasiasli);
	$this->db->set('dikerjakan', $lama);
	$this->db->set('rata_rata', $average);
	
	$this->db->where('id_kategori', $id_sub_materi);
	$this->db->where('id_siswa', $idsiswa);
	$query = $this->db->update('analisis_waktu');
	return $query;
}

function carianalisistopik($idkategori, $idsiswa, $id_soal){
	$this->db->select('*');
	$this->db->from('analisis_topik');
	$this->db->where('id_kategori', $idkategori);
	$this->db->where('id_siswa', $idsiswa);
	$this->db->where('id_soal', $id_soal);
	$result = $this->db->count_all_results();
	//tester
	// echo $this->db->_compile_select();
	return $result;
}
function editanalisistopik($idkategori, $idsiswa, $id_soal, $status, $jawaban, $waktu){
	$this->db->set('status', $status);
	$this->db->set('terjawab', $jawaban);
	$this->db->set('jawab_waktu', $waktu);
	
	$this->db->where('id_kategori', $idkategori);
	$this->db->where('id_siswa', $idsiswa);
	$this->db->where('id_soal', $id_soal);
	$query = $this->db->update('analisis_topik');
	return $query;
}

function inputanalisistopik($idkategori, $idsiswa, $id_soal, $status, $jawaban, $waktu){
	$data = array(
		'id_kategori'		=> $idkategori,
		'id_siswa'			=> $idsiswa,
		'id_soal'			=> $id_soal,
		'status'			=> $status,
		'terjawab'			=> $jawaban,
		'jawab_waktu'		=> $waktu
	);
	
	$result = $this->db->insert('analisis_topik', $data);
}


function fetch_topik_soal_salah($idkategori, $idsiswa){
	$this->db->select('bank_soal.id_banksoal, bank_soal.topik as topik_salah');
	$this->db->from('analisis_topik');
	$this->db->join('bank_soal', 'analisis_topik.id_soal=bank_soal.id_banksoal');
	$this->db->where('analisis_topik.status', 0);
	$this->db->where('analisis_topik.id_kategori', $idkategori);
	$this->db->where('analisis_topik.id_siswa', $idsiswa);
	
	$query = $this->db->get();
	return $query->result();
}


function get_kelas_by_kategori_tryout($idkategori){
	$this->db->select("kategori_tryout.id_kategori, profil_tryout.id_kelas");
	$this->db->from('kategori_tryout');
	$this->db->join('profil_tryout', 'kategori_tryout.id_profil=profil_tryout.id_tryout');
	$this->db->where('kategori_tryout.id_kategori', $idkategori);
	
	$query = $this->db->get();
	return $query->row();
}
function fetch_open_class($idkelas){
	$this->db->select('*');
	$this->db->from('bank_soal');
	$this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel');
	$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas');
	$this->db->where('kelas.id_kelas', $idkelas);
	$this->db->where('bank_soal.status', 'open');
	
	$query = $this->db->get();
	return $query->result();
}

function jumlah_soal_topik_salah($idkategori, $idsiswa){
	$this->db->where('status', 0);
	$this->db->where('id_kategori', $idkategori);
	$this->db->where('id_siswa', $idsiswa);
	
	return $this->db->count_all_results('analisis_topik');
}
//DIMAS -----
function get_analisis_topik_ranking($id_kategori, $limit=3){
	$sql = "SELECT analisis_topik.id_kategori, analisis_topik.id_siswa, analisis_topik.status,
				(SUM(CASE(analisis_topik.status) WHEN 1 THEN analisis_topik.status ELSE 0 END)) AS 'jumlah_benar', 
				(SUM(CASE(analisis_topik.status) WHEN 0 THEN 1 ELSE 0 END)) AS 'jumlah_salah',
				(COUNT(analisis_topik.status)) AS 'jumlah_soal'
			FROM `analisis_topik`
			WHERE analisis_topik.id_kategori = $id_kategori
			GROUP BY analisis_topik.id_siswa
			ORDER BY jumlah_benar DESC
			LIMIT $limit";
	$query = $this->db->query($sql);
	
	return $query->result();
}

//21 oktober 2016
//################################
function get_benar_by_kategori($idkategori, $idsiswa){
	$this->db->select('*');
	$this->db->from('analisis_topik');
	$this->db->where('id_kategori', $idkategori);
	$this->db->where('id_siswa', $idsiswa);
	$this->db->where('status', 1);
	return $this->db->count_all_results();
}

function get_salah_by_kategori($idkategori, $idsiswa){
	$this->db->select('*');
	$this->db->from('analisis_topik');
	$this->db->where('id_kategori', $idkategori);
	$this->db->where('id_siswa', $idsiswa);
	$this->db->where('status', 0);
	return $this->db->count_all_results();
}
//end 21 oktober 2016
//################################
//update 12 november 2016
function cari_terjawab($id_sub_materi, $idsiswa){
	$this->db->select("*");
	$this->db->from("analisis_topik");
	$this->db->where('id_kategori', $id_sub_materi);
	$this->db->where('id_siswa', $idsiswa);
	
	$query = $this->db->get();
	return $query->result();
}

function jumlah_terjawab($id_sub_materi, $idsiswa){
	$this->db->select("*");
	$this->db->from("analisis_topik");
	$this->db->where('id_kategori', $id_sub_materi);
	$this->db->where('id_siswa', $idsiswa);
	
	return $this->db->count_all_results();
}

function elapsed_time($id_sub_materi, $idsiswa){
	$this->db->select("max(jawab_waktu) as elapsed_time");
	$this->db->from("analisis_topik");
	$this->db->where('id_kategori', $id_sub_materi);
	$this->db->where('id_siswa', $idsiswa);
	
	$query = $this->db->get();
	return $query->row();
}
//end
function hitung_skor_akhir($id_sub_materi, $idsiswa){
	$this->db->select("
	sum(bobot_soal) as jumlah_bobot_benar
	");
	$this->db->from("bank_soal");
	$this->db->join('analisis_topik', 'bank_soal.id_banksoal = analisis_topik.id_soal', 'left');
	$this->db->where("analisis_topik.status", 1);
	$this->db->where("analisis_topik.id_kategori", $id_sub_materi);
	$this->db->where("analisis_topik.id_siswa", $idsiswa);

	$query = $this->db->get();
	return $query->row();
}

function jumlah_bobot($id_sub_materi, $idsiswa){
	$this->db->select("
	sum(bobot_soal) as jumlah_bobot
	");
	$this->db->from("bank_soal");
	$this->db->join('analisis_topik', 'bank_soal.id_banksoal = analisis_topik.id_soal', 'left');
	$this->db->where("analisis_topik.id_kategori", $id_sub_materi);
	$this->db->where("analisis_topik.id_siswa", $idsiswa);

	$query = $this->db->get();
	return $query->row();
}
}


?>