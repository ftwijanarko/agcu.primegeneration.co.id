<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_materi_urutan extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function cari_mapel_by_kelas($id)
	{
		$this->db->select('*');
		$this->db->from('mata_pelajaran');
		$this->db->where('kelas_id', $id);
		$this->db->order_by('nama_mapel', 'ASC');
		$query = $this->db->get();

		return $query->result();
	}

	function cari_mapok_by_mapel($id)
	{
		$this->db->select('*');
		$this->db->from('materi_pokok');
		$this->db->where('mapel_id', $id);
		$this->db->order_by('urutan', 'ASC');
		$query = $this->db->get();

		return $query->result();
	}

	function cari_mapem_by_mapok($id)
	{
		$this->db->select('*');
		$this->db->from('sub_materi');
		$this->db->join('konten_materi', 'konten_materi.sub_materi_id = sub_materi.id_sub_materi', 'left');
		$this->db->join('soal', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
		$this->db->where('sub_materi.materi_pokok_id', $id);
		$this->db->group_by('sub_materi.id_sub_materi');
		$this->db->order_by('sub_materi.urutan_materi', 'ASC');
		$query = $this->db->get();

		return $query->result();
	}
	
	function cari_latihan_soal_by_mapok($id)
	{
		$this->db->select('*');
		$this->db->from('sub_materi');
		$this->db->join('konten_materi', 'konten_materi.sub_materi_id = sub_materi.id_sub_materi', 'left');
		$this->db->join('soal', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
		$this->db->where('sub_materi.materi_pokok_id', $id);
		$this->db->where('konten_materi.kategori', 3);
		$this->db->group_by('sub_materi.id_sub_materi');
		$this->db->order_by('sub_materi.urutan_materi', 'ASC');
		$query = $this->db->get();

		return $query->result();
	}
}
