<?php 

class Model_tryout extends CI_Model{
	function __construct(){

		parent::__construct();
	}

function fetch_profil_by_id($idprofil){
	$this->db->select("*");
	$this->db->from("profil_tryout");
	$this->db->join("kelas", "kelas.id_kelas = profil_tryout.id_kelas", 'left');
	$this->db->where("profil_tryout.id_tryout", $idprofil);
	
	$query = $this->db->get();
	return $query->row();
}

function edit_profil($idprofil, $kelas, $nama, $keterangan, $urutan_materi,$penyelenggara, $tanggal, $jam, $biaya, $namafile, $tanggalpost, $waktupost, $type){
	$data = array(
		'id_kelas' 		=> $kelas,
		'nama_profil' 	=> $nama,
		'penyelenggara' => $penyelenggara,
		'tgl_acara' 	=> $tanggal,
		'jam_acara' 	=> $jam,
		'biaya' 		=> $biaya,
		'banner' 		=> $namafile,
		'status' 		=> 0,
		'tipe' 			=> $type
		);

	$this->db->where('id_tryout', $idprofil);
	$result = $this->db->update('profil_tryout', $data);
	return $result;
}
function get_kelas(){
	$this->db->select("*");
	$this->db->from("kelas");
	$query = $this->db->get();
	return $query->result();
}

function get_mapel($idkelas){
	$this->db->select("*");
	$this->db->from("mata_pelajaran");
	$this->db->where("kelas_id", $idkelas);
	$query = $this->db->get();
	return $query->result();
}

function get_topik($idmapel){
	$this->db->select("*");
	$this->db->from("bank_soal");
	$this->db->where("id_mapel", $idmapel);
	$this->db->group_by('topik');
	$query = $this->db->get();
	return $query->result();
}

function get_kategori($idmapel){
	$this->db->select("*");
	$this->db->from("kategori_bank_soal");
	$this->db->where("id_mapel", $idmapel);
	$query = $this->db->get();
	return $query->result();
}

function get_soal($idmapel, $topik){
	if($idmapel == "semua" and $topik == "semua"){
		$this->db->select("*");
		$this->db->from("bank_soal");
		$this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
		$this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
		
		$query = $this->db->get();
		return $query->result();
	}elseif($idmapel !== "semua" and $topik == "semua"){
		$this->db->select("*");
		$this->db->from("bank_soal");
		$this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
		$this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
		$this->db->where("bank_soal.id_mapel", $idmapel);

		$query = $this->db->get();
		return $query->result();
	}elseif($idmapel == "semua" and $topik !== "semua"){
		$this->db->select("*");
		$this->db->from("bank_soal");
		$this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
		$this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
		$this->db->where("bank_soal.topik", $topik);

		$query = $this->db->get();
		return $query->result();
	}else{
		$this->db->select("*");
		$this->db->from("bank_soal");
		$this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
		$this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
		
		$this->db->where("bank_soal.id_mapel", $idmapel);
		$this->db->where("bank_soal.topik", "'".$topik."'");

		$query = $this->db->get();
		return $query->result();
	}
}

function get_soal_by_mapel($idmapel){
	$this->db->select("*");
	$this->db->from("bank_soal");
	$this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
	$this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
	$this->db->where("bank_soal.id_mapel", $idmapel);
	$this->db->where("bank_soal.status", 'main');
	
	$query = $this->db->get();
	return $query->result();
}

function get_soal_by_topik($topik){
	$this->db->select("*");
	$this->db->from("bank_soal");
	$this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
	$this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
	$this->db->where("bank_soal.topik", $topik);
	
	$query = $this->db->get();
	return $query->result();
}

function get_soal_by_kategori($idkategori){
	if($idkategori == 'semua'){
		$this->db->select("*");
		$this->db->from("bank_soal");
		$this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
		$this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
		$this->db->where("bank_soal.status", 'main');
		
		$query = $this->db->get();
		return $query->result();
	}else{
		$this->db->select("*");
		$this->db->from("bank_soal");
		$this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
		$this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
		$this->db->where("bank_soal.id_kategori_bank_soal", $idkategori);
		$this->db->where("bank_soal.status", 'main');
		
		$query = $this->db->get();
		return $query->result();
	}
}

function aktifpendaftaran($idprofil){
	$data = array(
		'status' 	=> 1,
		);

	$this->db->where('id_tryout', $idprofil);
	$result = $this->db->update('profil_tryout', $data);
	return $result;
}
function nonaktifpendaftaran($idprofil){
	$data = array(
		'status' 	=> 0,
		);

	$this->db->where('id_tryout', $idprofil);
	$result = $this->db->update('profil_tryout', $data);
	return $result;
}

function get_pembayaran(){
	$this->db->select('
	pembayaran_cbt.id_profil,
	pembayaran_cbt.id_bayar_cbt,
	pembayaran_cbt.status as status_bayar,
	pembayaran_cbt.bukti,
	pembayaran_cbt.tgl_daftar,
	pembayaran_cbt.tgl_bayar,
	siswa.id_siswa,
	siswa.nama_siswa,
	profil_tryout.id_tryout,
	profil_tryout.nama_profil,
	profil_tryout.biaya,
	');
	$this->db->from('pembayaran_cbt');
	$this->db->join('profil_tryout', 'pembayaran_cbt.id_profil=profil_tryout.id_tryout', 'left');
	$this->db->join('siswa', 'pembayaran_cbt.id_siswa=siswa.id_siswa', 'left');
	
	$query = $this->db->get();
	return $query->result();
}

function konfirmasi_bayar($iddaftar, $idsiswa){
	$tglbayar = date('Y-m-d');
	$data = array(
		'status'	=> 2
		
	);
	$this->db->where('id_siswa', $idsiswa);
	$this->db->where('id_bayar_cbt', $iddaftar);
	$this->db->update('pembayaran_cbt', $data);
}
function tolak_bayar($iddaftar, $idsiswa){
	$tglbayar = date('Y-m-d');
	$data = array(
		'status'	=> 3
		
	);
	$this->db->where('id_siswa', $idsiswa);
	$this->db->where('id_bayar_cbt', $iddaftar);
	$this->db->update('pembayaran_cbt', $data);
}

function get_kategori_by_profil($idprofil){
	$this->db->select("*");
	$this->db->from("kategori_tryout");
	$this->db->where("id_profil", $idprofil);
	
	$query = $this->db->get();
	return $query->result();
}

function hapus_analisis_pelajaran_by_kategori($idkategori){
	$this->db->where('id_kategori', $idkategori);
	$this->db->delete('analisis_pelajaran');
}

function hapus_analisis_waktu_by_kategori($idkategori){
	$this->db->where('id_kategori', $idkategori);
	$this->db->delete('analisis_waktu');
}

function hapus_analisis_topik_by_kategori($idkategori){
	$this->db->where('id_kategori', $idkategori);
	$this->db->delete('analisis_topik');
}

function hapus_soal_by_kategori($idkategori){
	$this->db->where('id_kategori', $idkategori);
	$this->db->delete('soal_tryout');
}

function hapus_kategori_by_profil($idprofil){
	$this->db->where('id_profil', $idprofil);
	$this->db->delete('kategori_tryout');
}

function hapus_profil($idprofil){
	$this->db->where('id_tryout', $idprofil);
	$this->db->delete('profil_tryout');
}


function get_cbt_psep(){
	$this->db->select("*");
	$this->db->from("cbt_psep");
	$this->db->join("profil_tryout", "cbt_psep.id_profil=profil_tryout.id_tryout", "left");
	$this->db->join("sekolah", "cbt_psep.id_sekolah=sekolah.id_sekolah", "left");
	$this->db->join("tahun_ajaran", "cbt_psep.id_tahun_ajaran=tahun_ajaran.id_tahun_ajaran", "left");
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_all_profil_psep(){

		$this->db->select("
		profil_tryout.id_tryout,
		profil_tryout.id_kelas,
		profil_tryout.nama_profil,
		profil_tryout.penyelenggara,
		profil_tryout.tgl_acara,
		profil_tryout.jam_acara,
		profil_tryout.biaya,
		profil_tryout.banner,
		profil_tryout.status,
		profil_tryout.tipe,
		kelas.alias_kelas
		");
		$this->db->from("profil_tryout");
		$this->db->join("kelas", "kelas.id_kelas=profil_tryout.id_kelas");
		$this->db->where("profil_tryout.tipe", 2);
		
		$result=$this->db->get();
		return $result->result();
	}
function fetch_sekolah_by_kota($idkota){
	$this->db->select("*");
	$this->db->from("sekolah");
	$this->db->where("kota_id", $idkota);
	$result=$this->db->get();
	return $result->result();
}

function aktivasi_cbt_psep($idprofil, $idsekolah, $idtahunajaran){
	$data = array(
		'id_profil'			=> $idprofil,
		'id_sekolah'		=> $idsekolah,
		'id_tahun_ajaran'	=> $idtahunajaran
	);
	$this->db->insert('cbt_psep', $data);
}

function hapus_aktivasi_psep($idcbt){
	$this->db->where('id_cbt', $idcbt);
	$this->db->delete('cbt_psep');
}

function fetch_cbt_reguler(){

		$this->db->select("
		profil_tryout.id_tryout,
		profil_tryout.id_kelas,
		profil_tryout.nama_profil,
		profil_tryout.penyelenggara,
		profil_tryout.tgl_acara,
		profil_tryout.jam_acara,
		profil_tryout.biaya,
		profil_tryout.banner,
		profil_tryout.status,
		profil_tryout.tipe,
		kelas.alias_kelas
		");
		$this->db->from("profil_tryout");
		$this->db->join("kelas", "kelas.id_kelas=profil_tryout.id_kelas");
		$this->db->where("tipe", 0);
		
		$result=$this->db->get();

		return $result->result();

	}
	
function fetch_aktivasi_psep($idsekolah){
	$this->db->select("*");
	$this->db->from("cbt_psep");
	$this->db->where("id_sekolah", $idsekolah);
	
	$result=$this->db->get();
	return $result->result();
}

function fetch_cbt_psep(){

		$this->db->select("
		profil_tryout.id_tryout,
		profil_tryout.id_kelas,
		profil_tryout.nama_profil,
		profil_tryout.penyelenggara,
		profil_tryout.tgl_acara,
		profil_tryout.jam_acara,
		profil_tryout.biaya,
		profil_tryout.banner,
		profil_tryout.status,
		profil_tryout.tipe,
		kelas.alias_kelas
		");
		$this->db->from("profil_tryout");
		$this->db->join("kelas", "kelas.id_kelas=profil_tryout.id_kelas");
		$this->db->where("tipe", 2);
		
		$result=$this->db->get();

		return $result->result();

	}
}

