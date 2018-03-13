<?php
class Model_eqtest extends CI_Model{
	function __construct(){

		parent::__construct();
	}

	function get_eqtest(){
		$this->db->select('*');
		$this->db->from('eq_test');
		
		$query = $this->db->get();
		return $query->result();
	}

	function hapus_hasil($idsiswa, $idprofil=0){
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('id_profil', $idprofil);
		$this->db->delete('hasil_eq_jawaban');

		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('id_profil', $idprofil);
		$this->db->delete('hasil_eq');
	}
	
	function cek_jawaban_eq($idsiswa, $idprofil=0){
		$this->db->select('no, jawaban');
		$this->db->from('hasil_eq_jawaban');
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('id_profil', $idprofil);
		$query = $this->db->get();
		return $query->result();
	}

	function insert_jawaban($idsiswa, $no, $jawaban, $idprofil=0){
		$data = array(
			'id_profil'	=> $idprofil,
			'id_siswa' 	=> $idsiswa,
			'no' 	=> $no,
			'jawaban' 	=> $jawaban
			);
		$result = $this->db->insert('hasil_eq_jawaban', $data);
		return $result;
	}

	function insert_skor($idsiswa, $aq, $eq, $am, $idprofil=0){
		$data = array(
			'id_profil'	=> $idprofil,
			'id_siswa' 	=> $idsiswa,
			'skor_aq' 	=> $aq,
			'skor_eq' 	=> $eq,
			'skor_am' 	=> $am
			);
		$result = $this->db->insert('hasil_eq', $data);
		return $result;
	}

}

?>