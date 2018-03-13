<?php 

/**
* 
*/
class Model_voucher extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
  }
  
  function check_voucher_by_kode($kode_voucher)
  {
    $this->db->select("*");
    $this->db->from("voucher");
    $this->db->join("paket", "paket.id_paket = voucher.paket_id");
    $this->db->where("voucher.kode_voucher", $kode_voucher);
    $query = $this->db->get();

    return $query->row();
  }

  function get_kelas_by_id($id_kelas)
  {
    $this->db->select("*");
    $this->db->from("kelas");
    $this->db->where("kelas.id_kelas", $id_kelas);
    $query = $this->db->get();

    return $query->row() ? $query->row()->alias_kelas : null;
  }
  
  function add_paket_aktif($data_aktivasi)
  {
    //insert data into table paket_aktif
    $query = $this->db->insert('paket_aktif', $data_aktivasi);
    
    return $query;
  }
  
  function set_status_voucher($kode_voucher)
  {
    $this->db->set('status', 1); //set status to 'activated'
    $this->db->where('kode_voucher', $kode_voucher);
    $query = $this->db->update('voucher');

    return $query;
  }
  
  function get_kelas(){
	  $this->db->select("*");
	  $this->db->from("kelas");
	  
	  $query = $this->db->get();
	  return $query->result();
  }
  
  function fetch_durasi($kodepaket){
	  $this->db->select("*");
	  $this->db->from("paket");
	  $this->db->where("tipe", $kodepaket);
	  
	  $query = $this->db->get();
	  return $query->result();  
  }
  
  
  function fetch_voucher_by_durasi_kelas($paket, $kelas){
		$this->db->select("voucher.kode_voucher, voucher.ket, voucher.status, paket.durasi, paket.tipe, kelas.alias_kelas");
		$this->db->from("voucher");
		$this->db->join("paket", "paket.id_paket = voucher.paket_id");
		$this->db->join("kelas", "kelas.id_kelas = voucher.id_kelas");
		
		$this->db->where("voucher.paket_id", $paket);
		$this->db->where("voucher.id_kelas", $kelas);
		$this->db->where("voucher.status", 0);
		
		$this->db->order_by("paket.tipe", "ASC");
		$this->db->order_by("paket.durasi", "ASC");
		$result = $this->db->get();
		return $result->result();
  }
  
  function check_voucher_by_aktivasi($nmr_aktivasi)
  {
    $this->db->select("*");
    $this->db->from("voucher");
    $this->db->join("paket", "paket.id_paket = voucher.paket_id");
    $this->db->where("voucher.no_aktivasi", $nmr_aktivasi);
    $query = $this->db->get();

    return $query->row();
  }

  function set_status_aktivasi($nmr_aktivasi)
  {
    $this->db->set('status', 1); //set status to 'activated'
    $this->db->where('no_aktivasi', $nmr_aktivasi);
    $query = $this->db->update('voucher');

    return $query;
  }

function hapus_paket_aktif($idsiswa){
	$this->db->delete('paket_aktif', array('id_siswa' => $idsiswa));
}

function edit_kelas_siswa($idsiswa, $idkelas){
	$this->db->set('kelas', $idkelas); //set status to 'activated'
    $this->db->where('id_siswa', $idsiswa);
    $query = $this->db->update('siswa');

    return $query;
}
 
function fetch_voucher_by_aktivasi($nmr_aktivasi){
	$this->db->select("*");
	$this->db->from("voucher");
	$this->db->where("no_aktivasi", $nmr_aktivasi);
	
	$query = $this->db->get();
    return $query->row();
}
}