<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_duplikat extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

function fetch_soal_awal($idawal){
	$this->db->select("*");
	$this->db->from("soal");
	$this->db->where("sub_materi_id", $idawal);
	
	$result=$this->db->get();
	return $result->result();
}

function insert_soal($idsubbab, $isisoal){
	$data = array(
		'sub_materi_id'		=> $idsubbab,
		'isi_soal'			=> $isisoal
	);
	$result = $this->db->insert('soal', $data);
	$this->insert_id = $this->db->insert_id();
	return $this->insert_id;
}

function fetch_jawaban_by_id_soal($idsoal){
	$this->db->select("*");
	$this->db->from("jawaban");
	$this->db->where("soal_id", $idsoal);
	
	$result=$this->db->get();
	return $result->row();
}

function insert_jawaban($idsoal, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $kunci, $pembahasan, $pembahasanvideo){
	$data = array(
		'soal_id'			=> $idsoal,
		'jawab_1'			=> $jawab2,
		'jawab_2'			=> $jawab1,
		'jawab_3'			=> $jawab3,
		'jawab_4'			=> $jawab4,
		'jawab_5'			=> $jawab5,
		'kunci_jawaban'				=> $kunci,
		'pembahasan'		=> $pembahasan,
		'pembahasan_video'	=> $pembahasanvideo
	);
	$result = $this->db->insert('jawaban', $data);
}

function insert_submateri($materipokok, $namasoal){
	$data = array(
		'materi_pokok_id'		=> $materipokok,
		'nama_sub_materi'		=> $namasoal,
		'status_materi'			=> 1
	);
	$result = $this->db->insert('sub_materi', $data);
	
	$this->insert_id = $this->db->insert_id();
	return $this->insert_id;
}

function insert_konten_materi($idsubmateri, $tanggal, $waktu){
	$data = array(
		'sub_materi_id'		=> $idsubmateri,
		'kategori'			=> 3,
		'is_demo'			=> 0,
		'tanggal'			=> $tanggal,
		'waktu'				=> $waktu	
	);
	$result = $this->db->insert('konten_materi', $data);
	
	$this->insert_id = $this->db->insert_id();
	return $this->insert_id;
}


}
?>