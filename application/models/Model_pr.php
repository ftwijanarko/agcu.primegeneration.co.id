<?php 

class Model_pr extends CI_Model{
	function __construct(){

		parent::__construct();
	}

function cari_terjawab($idpr, $idsiswa){
	$this->db->select("*");
	$this->db->from("analisis_pr");
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_siswa", $idsiswa);
	
	$jumlahterjawab = $this->db->count_all_results();
	if($jumlahterjawab > 0){
		$this->db->select("*");
		$this->db->from("analisis_pr");
		$this->db->where("id_pr", $idpr);
		$this->db->where("id_siswa", $idsiswa);
		
		$query = $this->db->get();
		return $query->result();	
	}else{
		return null;
	}
}

function jumlah_terjawab($idpr, $idsiswa){
	$this->db->select("*");
	$this->db->from("analisis_pr");
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_siswa", $idsiswa);
	
	$jumlahterjawab = $this->db->count_all_results();
	return $jumlahterjawab;
}

function fetch_soal_by_pr($idpr){
	$this->db->select("*");
	$this->db->from("soal_pr");
	$this->db->where("id_pr", $idpr);
	
	$query = $this->db->get();
	return $query->result();
}

function jumlah_soal($idpr){
	$this->db->select("*");
	$this->db->from("soal_pr");
	$this->db->where("id_pr", $idpr);
	
	return $this->db->count_all_results();
}

function get_info_pr($idpr){
	$this->db->select("*");
	$this->db->from("pekerjaan_rumah");
	$this->db->join("tahun_ajaran", "pekerjaan_rumah.id_tahun_ajaran=tahun_ajaran.id_tahun_ajaran", "left");
	$this->db->join("kelas_paralel", "pekerjaan_rumah.id_kelas_paralel=kelas_paralel.id_kelas_paralel", "left");
	$this->db->where("id_pr", $idpr);
	
	$query = $this->db->get();
	return $query->row();
}

function fetch_array_id_soal($idpr){
	$this->db->select('id_soal_pr, kunci');
	$this->db->from('soal_pr');
	$this->db->where('id_pr', $idpr);
	
	$query = $this->db->get();
	return $query->result_array();
}

function cari_analisis_pr($idpr, $idsiswa, $id_soal){
	$this->db->select('*');
	$this->db->from('analisis_pr');
	$this->db->where('id_pr', $idpr);
	$this->db->where('id_siswa', $idsiswa);
	$this->db->where('id_soal_pr', $id_soal);
	$result = $this->db->count_all_results();
	//tester
	// echo $this->db->_compile_select();
	return $result;
}

function edit_analisis_pr($idpr, $idsiswa, $id_soal, $status, $jawaban){
	$this->db->set('status', $status);
	$this->db->set('terjawab', $jawaban);
	
	$this->db->where('id_pr', $idkategori);
	$this->db->where('id_siswa', $idsiswa);
	$this->db->where('id_soal_pr', $id_soal);
	$query = $this->db->update('analisis_pr');
	return $query;
}

function input_analisis_pr($idpr, $idsiswa, $id_soal, $status, $jawaban){
	$data = array(
		'id_pr'			=> $idpr,
		'id_siswa'		=> $idsiswa,
		'id_soal_pr'	=> $id_soal,
		'status'		=> $status,
		'terjawab'		=> $jawaban
	);
	
	$result = $this->db->insert('analisis_pr', $data);
}

function jumlah_benar_by_siswa_and_pr($idpr, $idsiswa){
	$this->db->select("*");
	$this->db->from("analisis_pr");
	$this->db->where("status", 1);
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_siswa", $idsiswa);
	
	return $this->db->count_all_results();
}

function insert_status_belum($idpr, $idsiswa){
	$data = array(
		'id_pr' 	=> $idpr,
		'id_siswa'	=> $idsiswa,
		'status'	=> 0
	);
	$result = $this->db->insert('status_pr', $data);
}

function insert_status_selesai($idpr, $idsiswa){
	$this->db->set('status', 1);
	
	$this->db->where('id_pr', $idpr);
	$this->db->where('id_siswa', $idsiswa);
	
	$query = $this->db->update('status_pr');
	return $query;
}

function fetch_status_pr($idpr, $idsiswa){
	$this->db->select("*");
	$this->db->from("status_pr");
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_siswa", $idsiswa);
	
	if($this->db->count_all_results() > 0){
		$this->db->select("*");
		$this->db->from("status_pr");
		$this->db->where("id_pr", $idpr);
		$this->db->where("id_siswa", $idsiswa);
		
		$query = $this->db->get();
		return $query->row();
	}else{
		return null;
	}
}

function fetch_jawaban_per_soal($idsiswa, $idsoal, $idpr){
	$this->db->select("*");
	$this->db->from("analisis_pr");
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("id_soal_pr", $idsoal);
	$this->db->where("id_pr", $idpr);
	
	$query = $this->db->get();
	return $query->row();
}
}