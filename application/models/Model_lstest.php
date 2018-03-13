<?php
class Model_lstest extends CI_Model{
	function __construct(){

		parent::__construct();
	}

	function hapus_ls($idsiswa){
		$this->db->delete('hasil_ls', array('id_siswa' => $idsiswa));
	}

	function get_lstest(){
		$this->db->select('*');
		$this->db->from('ls_test1');
		
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_lstest2(){
		$this->db->select('*');
		$this->db->from('ls_test2');
		
		$query = $this->db->get();
		return $query->result();
	}

	function hapus_hasil_ls($idsiswa, $idprofil=0){
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('id_profil', $idprofil);
		$this->db->delete('hasil_ls');
	}
	
	function cek_jawaban_ls($idsiswa, $idprofil=0){
		$this->db->select('no, skor');
		$this->db->from('hasil_ls');
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('id_profil', $idprofil);
		$query = $this->db->get();
		return $query->result();
	}

	function insert_skor($idsiswa, $no, $skor, $idprofil=0){
		$data = array(
			'id_profil'	=> $idprofil,
			'id_siswa' 	=> $idsiswa,
			'no' 	=> $no,
			'skor' 	=> $skor
			);
		$result = $this->db->insert('hasil_ls', $data);
		return $result;
	}

	function skor($idsiswa, $idprofil=0){
		$this->db->select('*');
		$this->db->from('hasil_ls');
		$this->db->where('id_siswa', $idsiswa);
		if ($idprofil > 0){
			$this->db->where('hasil_ls.id_profil', $idprofil);
		}
		
		$query = $this->db->get();
		return $query->result();
	}

}

?>