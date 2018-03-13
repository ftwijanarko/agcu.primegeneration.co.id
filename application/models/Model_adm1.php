<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_adm1 extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	// MATERI
	function get_all_materi($kelas,$mapel,$mapok,$offset, $limit)
	{
		$this->db->select('kelas.alias_kelas, mata_pelajaran.nama_mapel, materi_pokok.nama_materi_pokok, sub_materi.id_sub_materi, sub_materi.nama_sub_materi, sub_materi.status_materi, konten_materi.kategori');
		$this->db->from('konten_materi');
		$this->db->join('sub_materi', 'sub_materi.id_sub_materi = konten_materi.sub_materi_id', 'left');
		$this->db->join('materi_pokok', 'materi_pokok.id_materi_pokok = sub_materi.materi_pokok_id', 'left');
		$this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		$this->db->where('sub_materi.id_sub_materi !=', '');
		$this->db->where('mata_pelajaran.nama_mapel !=', '');
		$this->db->where('materi_pokok.nama_materi_pokok !=', '');
		if ($kelas > 0){
			$this->db->where('kelas.id_kelas', $kelas);
		}
		if ($mapel > 0){
			$this->db->where('mata_pelajaran.id_mapel', $mapel);
		}
		if ($mapok > 0){
			$this->db->where('materi_pokok.id_materi_pokok', $mapok);
		}
		$this->db->order_by('sub_materi.urutan_materi ASC');
		$this->db->order_by('kelas.tingkatan_kelas ASC');
		$this->db->order_by('mata_pelajaran.nama_mapel ASC');
		$this->db->limit($limit, $offset);

		$query = $this->db->get();
		
		return $query->result();
	}

	function get_all_materi_query($kelas,$mapel,$mapok)
	{
		$this->db->select('kelas.alias_kelas, mata_pelajaran.nama_mapel, materi_pokok.nama_materi_pokok, sub_materi.id_sub_materi, sub_materi.nama_sub_materi, sub_materi.status_materi, konten_materi.kategori');
		$this->db->from('konten_materi');
		$this->db->join('sub_materi', 'sub_materi.id_sub_materi = konten_materi.sub_materi_id', 'left');
		$this->db->join('materi_pokok', 'materi_pokok.id_materi_pokok = sub_materi.materi_pokok_id', 'left');
		$this->db->join('mata_pelajaran', 'mata_pelajaran.id_mapel = materi_pokok.mapel_id', 'left');
		$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		$this->db->where('sub_materi.id_sub_materi !=', '');
		$this->db->where('mata_pelajaran.nama_mapel !=', '');
		$this->db->where('materi_pokok.nama_materi_pokok !=', '');
		if ($kelas > 0){
			$this->db->where('kelas.id_kelas', $kelas);
		}
		if ($mapel > 0){
			$this->db->where('mata_pelajaran.id_mapel', $mapel);
		}
		if ($mapok > 0){
			$this->db->where('materi_pokok.id_materi_pokok', $mapok);
		}
		$this->db->order_by('kelas.tingkatan_kelas ASC');
		$this->db->order_by('mata_pelajaran.nama_mapel ASC');

		$query = $this->db->get();
		
		return $query;
	}

	function get_mapok_by_mapel($idmapel){
		$this->db->select('*');
		$this->db->from('materi_pokok');
		$this->db->where('mapel_id', $idmapel);
		$this->db->order_by('materi_pokok.nama_materi_pokok ASC');
		$query = $this->db->get();
		return $query->result();
	}

}
