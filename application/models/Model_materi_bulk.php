<?php  if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_materi_bulk extends CI_Model
{  

	function __construct()
	{
		parent::__construct();
	}
  
	function count_mapok($mapok,$mapel)
	{
		$this->db->select('*');
		$this->db->from('materi_pokok');
		$this->db->like('materi_pokok.nama_materi_pokok', $mapok);
		$this->db->where('materi_pokok.mapel_id', $mapel);
		$query = $this->db->get();
		
		return $query->num_rows();
	}

	function add_mapok_csv($mapel,$urutan,$nama){
		$data = array(
						'mapel_id' 									=> $mapel,
						'urutan' 										=> $urutan,
						'nama_materi_pokok' 				=> $nama,
						'deskripsi_materi_pokok' 		=> ''
					 );
		$result = $this->db->insert('materi_pokok', $data);

		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}	
	
	function cek_mapok_csv($mapel,$nama){
		$this->db->select('*');
		$this->db->from('materi_pokok');
		$this->db->where('materi_pokok.nama_materi_pokok', $nama);
		$this->db->where('materi_pokok.mapel_id', $mapel);
		$query = $this->db->get();
		
		return $query->row();
	}	
	
	function count_mapem($mapem,$mapok)
	{
		$this->db->select('*');
		$this->db->from('sub_materi');
		$this->db->like('sub_materi.nama_sub_materi', $mapem);
		$this->db->where('sub_materi.materi_pokok_id', $mapok);
		$query = $this->db->get();
		
		return $query->num_rows();
	}

	function add_mapem_csv($mapok,$urutan,$nama){
		$data = array(
						'materi_pokok_id' 				=> $mapok,
						'urutan_materi' 					=> $urutan,
						'nama_sub_materi' 				=> $nama,
						'deskripsi_sub_materi' 		=> ''
					 );
		$result = $this->db->insert('sub_materi', $data);

		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}	
	
	function cek_mapem_csv($mapok,$nama){
		$this->db->select('*');
		$this->db->from('sub_materi');
		$this->db->where('sub_materi.nama_sub_materi', $nama);
		$this->db->where('sub_materi.materi_pokok_id', $mapok);
		$query = $this->db->get();
		
		return $query->row();
	}	
	
	function cek_mapem_soal_csv($insertmapem,$kategori){
		$this->db->select('*');
		$this->db->from('konten_materi');
		$this->db->where('konten_materi.sub_materi_id', $insertmapem);
		$this->db->where('konten_materi.kategori', $kategori);
		$query = $this->db->get();
		
		return $query->row();
	}	
	
	function add_materi_csv($mapem,$isi,$video,$kategori){
		$data = array(
						'sub_materi_id' 				=> $mapem,
						'isi_materi' 						=> $isi,
						'video_materi' 					=> $video,
						'kategori' 							=> $kategori,
						'tanggal' 							=> date('Y-m-d'),
						'waktu' 								=> date('H:i:s')
					 );
		$result = $this->db->insert('konten_materi', $data);

		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}	
	
	function add_materi_soal_csv($mapem){
		$data = array(
						'sub_materi_id' 				=> $mapem,
						'kategori' 							=> '3',
						'tanggal' 							=> date('Y-m-d'),
						'waktu' 								=> date('H:i:s')
					 );
		$result = $this->db->insert('konten_materi', $data);

		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}	
	
	function add_pertanyaan_csv($idmapem,$soal){
		$data = array(
						'sub_materi_id' 				=> $idmapem,
						'isi_soal' 							=> $soal
					 );
		$result = $this->db->insert('soal', $data);

		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}	
	
	function add_jawaban_csv($idsoal,$a,$b,$c,$d,$e,$kunci,$teks,$video){
		$data = array(
						'soal_id' 					=> $idsoal,
						'jawab_1' 					=> $a,
						'jawab_2' 					=> $b,
						'jawab_3' 					=> $c,
						'jawab_4' 					=> $d,
						'jawab_5' 					=> $e,
						'kunci_jawaban' 		=> $kunci,
						'pembahasan' 				=> $teks,
						'pembahasan_video' 	=> $video
					 );
		$result = $this->db->insert('jawaban', $data);

		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}	
	
}