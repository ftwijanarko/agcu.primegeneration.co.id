<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_dashboard extends CI_Model{
function __construct(){
	parent::__construct();
}

function get_analisis_mapel($idsiswa){
	$this->db->select('*');
	$this->db->from('analisis_pelajaran');
	$this->db->join('kategori_tryout', 'analisis_pelajaran.id_kategori=kategori_tryout.id_kategori', 'left');
	$this->db->join('profil_tryout', 'kategori_tryout.id_profil=profil_tryout.id_tryout', 'left');
	$this->db->join('sub_materi', 'profil_tryout.id_submateri=sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id=materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id=mata_pelajaran.id_mapel', 'left');
	$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
	$this->db->where('analisis_pelajaran.id_siswa', $idsiswa);
	
	$query = $this->db->get();
	return $query->result();
}

function get_analisis_mapel_bykelas($idsiswa, $idkelas){
	$this->db->select('*');
	$this->db->from('analisis_pelajaran');
	$this->db->join('kategori_tryout', 'analisis_pelajaran.id_kategori=kategori_tryout.id_kategori', 'left');
	$this->db->join('profil_tryout', 'kategori_tryout.id_profil=profil_tryout.id_tryout', 'left');
	$this->db->join('sub_materi', 'profil_tryout.id_submateri=sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id=materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id=mata_pelajaran.id_mapel', 'left');
	$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
	$this->db->where('analisis_pelajaran.id_siswa', $idsiswa);
	$this->db->where('kelas.id_kelas', $idkelas);
	
	$query = $this->db->get();
	return $query->result();
}

function get_analisis_mapel_byprofil($idsiswa, $idprofil){
	$this->db->select('*');
	$this->db->from('analisis_pelajaran');
	$this->db->join('kategori_tryout', 'analisis_pelajaran.id_kategori=kategori_tryout.id_kategori', 'left');
	$this->db->join('profil_tryout', 'kategori_tryout.id_profil=profil_tryout.id_tryout', 'left');
	$this->db->join('kelas', 'profil_tryout.id_kelas=kelas.id_kelas', 'left');
	$this->db->where('analisis_pelajaran.id_siswa', $idsiswa);
	$this->db->where('profil_tryout.id_tryout', $idprofil);
	
	$query = $this->db->get();
	return $query->result();
}

function get_analisis_waktu($idsiswa){
	$this->db->select('*');
	$this->db->from('analisis_waktu');
	$this->db->join('kategori_tryout', 'analisis_waktu.id_kategori=kategori_tryout.id_kategori', 'left');
	$this->db->join('profil_tryout', 'kategori_tryout.id_profil=profil_tryout.id_tryout', 'left');
	$this->db->join('sub_materi', 'profil_tryout.id_submateri=sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id=materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id=mata_pelajaran.id_mapel', 'left');
	$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
	$this->db->where('analisis_waktu.id_siswa', $idsiswa);
	
	$query = $this->db->get();
	return $query->result();
}
function get_analisis_waktu_bykelas($idsiswa, $idkelas){
	$this->db->select('*');
	$this->db->from('analisis_waktu');
	$this->db->join('kategori_tryout', 'analisis_waktu.id_kategori=kategori_tryout.id_kategori', 'left');
	$this->db->join('profil_tryout', 'kategori_tryout.id_profil=profil_tryout.id_tryout', 'left');
	$this->db->join('sub_materi', 'profil_tryout.id_submateri=sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id=materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id=mata_pelajaran.id_mapel', 'left');
	$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
	$this->db->where('analisis_waktu.id_siswa', $idsiswa);
	$this->db->where('kelas.id_kelas', $idkelas);
	
	$query = $this->db->get();
	return $query->result();
}
function get_analisis_waktu_byprofil($idsiswa, $idprofil){
	$this->db->select('*');
	$this->db->from('analisis_waktu');
	$this->db->join('kategori_tryout', 'analisis_waktu.id_kategori=kategori_tryout.id_kategori', 'left');
	$this->db->join('profil_tryout', 'kategori_tryout.id_profil=profil_tryout.id_tryout', 'left');
	$this->db->join('kelas', 'profil_tryout.id_kelas=kelas.id_kelas', 'left');
	$this->db->where('analisis_waktu.id_siswa', $idsiswa);
	$this->db->where('profil_tryout.id_tryout', $idprofil);
	
	$query = $this->db->get();
	return $query->result();
}

function get_kategori_tryout($kelas){
	$this->db->select('*');
	$this->db->from('kategori_tryout');
	$this->db->join('profil_tryout', 'kategori_tryout.id_profil=profil_tryout.id_tryout', 'left');
	$this->db->join('sub_materi', 'profil_tryout.id_submateri=sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id=materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id=mata_pelajaran.id_mapel', 'left');
	$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
	$this->db->where('kelas.id_kelas', $kelas);
	
	$query = $this->db->get();
	return $query->result();
}

function get_kategori_tryout_byprofil($idprofil){
	$this->db->select('*');
	$this->db->from('kategori_tryout');
	$this->db->join('profil_tryout', 'kategori_tryout.id_profil=profil_tryout.id_tryout', 'left');
	$this->db->join('kelas', 'profil_tryout.id_kelas=kelas.id_kelas', 'left');
	$this->db->where('profil_tryout.id_tryout', $idprofil);
	
	$query = $this->db->get();
	return $query->result();
}

function get_kelas($idsiswa){
	$this->db->select('*');
	$this->db->from('siswa');
	
	$this->db->where('id_siswa', $idsiswa);
	
	$query = $this->db->get();
	return $query->row();
}

function get_idkelas_byprofil($idprofil){
	$this->db->select('*');
	$this->db->from('profil_tryout');
	
	$this->db->where('id_tryout', $idprofil);
	
	$query = $this->db->get();
	return $query->row();
}

// ORI
function get_analisis_topik($idsiswa){
	$this->db->select('*');
	$this->db->from('analisis_topik');
	$this->db->join('bank_soal', 'analisis_topik.id_soal=bank_soal.id_banksoal', 'left');
	
	$this->db->where('analisis_topik.id_siswa', $idsiswa);
	$query = $this->db->get();
	return $query->result();
}

//DIMAS --
function get_analisis_topik_2($idsiswa){
	$sql = "SELECT bank_soal.id_mapel, bank_soal.topik, analisis_topik.id_kategori, analisis_topik.id_siswa, analisis_topik.status,
				(SUM(CASE(analisis_topik.status) WHEN 1 THEN analisis_topik.status ELSE 0 END)) AS 'jumlah_benar', 
				(SUM(CASE(analisis_topik.status) WHEN 0 THEN 1 ELSE 0 END)) AS 'jumlah_salah',
				(COUNT(analisis_topik.status)) AS 'jumlah_soal'
			FROM `analisis_topik`
			LEFT JOIN `bank_soal` ON `analisis_topik`.`id_soal`=`bank_soal`.`id_banksoal` 
			WHERE `analisis_topik`.`id_siswa` = $idsiswa
			GROUP BY bank_soal.topik
			ORDER BY bank_soal.id_mapel";
	$query = $this->db->query($sql);
	
	return $query->result();
}
// --

function get_kelas_aktif($idsiswa, $tanggalsekarang){
	$this->db->select("*");
	$this->db->from('paket_aktif');
	$this->db->where('id_siswa', $idsiswa);
	
	$query = $this->db->get();
	return $query->result();
}



function get_info_siswa($idsiswa){
	$this->db->select("siswa.*, sekolah.*, kelas.*, siswa.telepon as telepon_siswa, siswa.email as email_siswa");
	$this->db->from("siswa");
	$this->db->join("kelas", "siswa.kelas=kelas.id_kelas", "left");
	$this->db->join("sekolah", "siswa.sekolah_id=sekolah.id_sekolah", "left");
	$this->db->where("siswa.id_siswa", $idsiswa);

	$query = $this->db->get();
	return $query->row();
}

function get_mapel_by_kelas($idkelas){
	$this->db->select("*");
	$this->db->from("mata_pelajaran");
	$this->db->where("kelas_id", $idkelas);
	
	$query = $this->db->get();
	return $query->result();
}

function get_profil_by_kelas($idkelas){
	$this->db->select("profil_tryout.*, kategori_tryout.id_kategori");
	$this->db->from("profil_tryout");
	$this->db->join("kategori_tryout", "kategori_tryout.id_profil = profil_tryout.id_tryout");
	$this->db->where("id_kelas", $idkelas);
	$this->db->group_by("profil_tryout.id_tryout");
	$this->db->where("tipe", 0);
	
	$query = $this->db->get();
	return $query->result();
}
function get_tryout_by_profil($idprofil){
	$this->db->select("*");
	$this->db->from("kategori_tryout");
	$this->db->join("profil_tryout", "kategori_tryout.id_profil=profil_tryout.id_tryout", "left");
	$this->db->join("kelas", "profil_tryout.id_kelas=kelas.id_kelas", "left");
	$this->db->where("profil_tryout.id_tryout", $idprofil);
	$this->db->where("kategori_tryout.status", 1);
	
	$query = $this->db->get();
	return $query->result();
	
}

function cari_skor($idkategori, $idsiswa){
	$this->db->select("*");
	$this->db->from("analisis_topik");
	$this->db->where("id_kategori", $idkategori);
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("status", 1);
	$result = $this->db->count_all_results();
	return $result;
}
function cari_skor_salah($idkategori, $idsiswa){
	$this->db->select("*");
	$this->db->from("analisis_topik");
	$this->db->where("id_kategori", $idkategori);
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("status", 0);
	$result = $this->db->count_all_results();
	return $result;
}

function kelas_by_id($idkelas){
	$this->db->select("*");
	$this->db->from("kelas");
	$this->db->where("id_kelas", $idkelas);
	$query = $this->db->get();
	return $query->row();
}

function kelas_by_profil($idprofil){
	$this->db->select("*");
	$this->db->from("profil_tryout");
	$this->db->join("kelas", "profil_tryout.id_kelas=kelas.id_kelas", "left");
	$this->db->where("profil_tryout.id_tryout", $idprofil);
	$query = $this->db->get();
	return $query->row();
}

function peserta_tryout($idkelas){
	$this->db->select("*");
	$this->db->from("paket_aktif");
	$this->db->where("id_kelas", $idkelas);
	$result = $this->db->count_all_results();
	return $result;
}

function total_soal_bykelas($idkelas){
	$this->db->select("sum(jumlah_soal) as jumlah_soal");
	$this->db->from("kategori_tryout");
	$this->db->join("profil_tryout", "kategori_tryout.id_profil=profil_tryout.id_tryout", "left");
	$this->db->join("sub_materi", "profil_tryout.id_submateri=sub_materi.id_sub_materi", "left");
	$this->db->join("materi_pokok", "sub_materi.materi_pokok_id=materi_pokok.id_materi_pokok", "left");
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id=mata_pelajaran.id_mapel", "left");
	$this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
	$this->db->where("kelas.id_kelas", $idkelas);
	$query = $this->db->get();
	return $query->row();
}

function total_soal_byprofil($idprofil){
	$this->db->select("sum(jumlah_soal) as jumlah_soal");
	$this->db->from("kategori_tryout");
	$this->db->join("profil_tryout", "kategori_tryout.id_profil=profil_tryout.id_tryout", "left");
	$this->db->join("kelas", "profil_tryout.id_kelas=kelas.id_kelas", "left");
	$this->db->where("profil_tryout.id_tryout", $idprofil);
	$query = $this->db->get();
	return $query->row();
}

function jumlah_benar($idsiswa, $idprofil){
	$this->db->select("sum(analisis_topik.status) as jumlah_benar");
	$this->db->from("analisis_topik");
	$this->db->join('kategori_tryout', 'analisis_topik.id_kategori=kategori_tryout.id_kategori', 'left');
	$this->db->join('profil_tryout', 'kategori_tryout.id_profil=profil_tryout.id_tryout', 'left');
	$this->db->where("analisis_topik.id_siswa", $idsiswa);
	$this->db->where("profil_tryout.id_tryout", $idprofil);
	$this->db->where("analisis_topik.status", 1);
	$query = $this->db->get();
	return $query->row();
}

function peringkat($idprofil){
	$this->db->select("
	analisis_topik.id_kategori,
	analisis_topik.id_kategori as idkategori,
	analisis_topik.id_siswa,
	analisis_topik.id_siswa as idsiswa,
	sum(analisis_topik.status) AS jumlah_benar,
		(
		select count(analisis_topik.status)
		from analisis_topik
		inner join kategori_tryout on analisis_topik.id_kategori = kategori_tryout.id_kategori
		inner join profil_tryout on kategori_tryout.id_profil = profil_tryout.id_tryout
		where analisis_topik.id_siswa = idsiswa and analisis_topik.status = 0 and profil_tryout.id_tryout = $idprofil
		)as jumlah_salah,
		(
		select count(id_banksoal)
		from soal_tryout
		inner join kategori_tryout on soal_tryout.id_kategori = kategori_tryout.id_kategori
		inner join profil_tryout on kategori_tryout.id_profil = profil_tryout.id_tryout
		where profil_tryout.id_tryout = $idprofil
		) as jumlah_soal,
		(
		select sum(time_to_sec(analisis_waktu.dikerjakan)) 
		from analisis_waktu 
		inner join kategori_tryout on analisis_waktu.id_kategori = kategori_tryout.id_kategori
		inner join profil_tryout on kategori_tryout.id_profil = profil_tryout.id_tryout
		where id_siswa = analisis_topik.id_siswa and profil_tryout.id_tryout = $idprofil
		) as waktu_kerja,
		(
		select sum(bobot_soal)
		from bank_soal
		inner join analisis_topik on bank_soal.id_banksoal = analisis_topik.id_soal
		inner join kategori_tryout on analisis_topik.id_kategori = kategori_tryout.id_kategori
		inner join profil_tryout on kategori_tryout.id_profil = profil_tryout.id_tryout
		where id_siswa = idsiswa and profil_tryout.id_tryout = $idprofil and analisis_topik.status = 1
		) as jumlah_bobot_benar,
		(
		select sum(bobot_soal)
		from bank_soal
		inner join soal_tryout on bank_soal.id_banksoal = soal_tryout.id_banksoal
		inner join kategori_tryout on soal_tryout.id_kategori = kategori_tryout.id_kategori
		inner join profil_tryout on kategori_tryout.id_profil = profil_tryout.id_tryout
		where profil_tryout.id_tryout = $idprofil
		) as jumlah_bobot
	");
	$this->db->from("analisis_topik");
	$this->db->join('kategori_tryout', 'analisis_topik.id_kategori=kategori_tryout.id_kategori', 'left');
	$this->db->join('profil_tryout', 'kategori_tryout.id_profil=profil_tryout.id_tryout', 'left');
	$this->db->where("analisis_topik.status", 1);
	$this->db->where("profil_tryout.id_tryout", $idprofil);
	$this->db->group_by("analisis_topik.id_siswa");
	$this->db->order_by("jumlah_bobot_benar", "desc");
	$this->db->order_by("waktu_kerja", "asc");
	
	$query = $this->db->get();
	return $query->result();
}

function analisis_mapel_by_profil_siswa($idsiswa, $idprofil){
	$this->db->select("
	analisis_topik.id_kategori,
	analisis_topik.id_kategori as idkategori,
	analisis_topik.id_siswa,
	analisis_topik.id_siswa as idsiswa,
	kategori_tryout.nama_kategori,
	kategori_tryout.ketuntasan,
		(
		select sum(bobot_soal)
		from bank_soal
		inner join analisis_topik on bank_soal.id_banksoal = analisis_topik.id_soal
		inner join kategori_tryout on analisis_topik.id_kategori = kategori_tryout.id_kategori
		
		where analisis_topik.id_siswa = idsiswa and analisis_topik.id_kategori= idkategori and analisis_topik.status = 1 
		
		) as jumlah_bobot_benar,
		
		(
		select sum(bobot_soal)
		from bank_soal
		inner join soal_tryout on bank_soal.id_banksoal = soal_tryout.id_banksoal
		inner join kategori_tryout on soal_tryout.id_kategori = kategori_tryout.id_kategori
		
		where kategori_tryout.id_kategori = idkategori
		
		) as jumlah_bobot,
		
		(
		select count(analisis_topik.status) 
		from analisis_topik 
		inner join kategori_tryout on analisis_topik.id_kategori = kategori_tryout.id_kategori
		inner join profil_tryout on kategori_tryout.id_profil = profil_tryout.id_tryout
		
		where id_siswa = idsiswa and analisis_topik.id_kategori= idkategori and analisis_topik.status = 1
		) as count_benar,
		
		(select count(analisis_topik.status) 
		from analisis_topik 
		inner join kategori_tryout on analisis_topik.id_kategori = kategori_tryout.id_kategori
		inner join profil_tryout on kategori_tryout.id_profil = profil_tryout.id_tryout
		
		where id_siswa = idsiswa and analisis_topik.id_kategori= idkategori and analisis_topik.status = 0
		
		) as count_salah
	");
	$this->db->from("analisis_topik");
	$this->db->join('kategori_tryout', 'analisis_topik.id_kategori=kategori_tryout.id_kategori', 'left');
	$this->db->join('profil_tryout', 'kategori_tryout.id_profil=profil_tryout.id_tryout', 'left');
	$this->db->where("profil_tryout.id_tryout", $idprofil);
	$this->db->where("analisis_topik.id_siswa", $idsiswa);
	$this->db->group_by("analisis_topik.id_kategori");
	$this->db->order_by("jumlah_bobot_benar", "desc");
	
	$query = $this->db->get();
	return $query->result();
}


function data_peringkat($idsiswa, $idprofil){
	$this->db->select("
		analisis_waktu.dikerjakan,
		siswa.foto,
		siswa.nama_siswa,
		sekolah.nama_sekolah,
		kota_kabupaten.nama_kota,
		provinsi.nama_provinsi,
	");
	$this->db->from("analisis_waktu");
	$this->db->join('kategori_tryout', 'analisis_waktu.id_kategori=kategori_tryout.id_kategori', 'left');
	$this->db->join('profil_tryout', 'kategori_tryout.id_profil=profil_tryout.id_tryout', 'left');
	$this->db->join('siswa', 'analisis_waktu.id_siswa=siswa.id_siswa', 'left');
	$this->db->join('kelas', 'siswa.kelas=kelas.id_kelas', 'left');
	$this->db->join('sekolah', 'siswa.sekolah_id=sekolah.id_sekolah', 'left');
	$this->db->join('kota_kabupaten', 'sekolah.kota_id=kota_kabupaten.id_kota', 'left');
	$this->db->join('provinsi', 'kota_kabupaten.provinsi_id=provinsi.id_provinsi', 'left');
	$this->db->where("analisis_waktu.id_siswa", $idsiswa);
	$this->db->where("profil_tryout.id_tryout", $idprofil);
	
	$query = $this->db->get();
	return $query->row();
}
function data_peringkat_psep($idsiswa, $idprofil){
	$this->db->select("
		analisis_waktu.dikerjakan,
		siswa.foto,
		siswa.nama_siswa,
		sekolah.nama_sekolah,
		kota_kabupaten.nama_kota,
		provinsi.nama_provinsi,
		kelas.alias_kelas,
		kelas_paralel.kelas_paralel
	");
	$this->db->from("analisis_waktu");
	$this->db->join('kategori_tryout', 'analisis_waktu.id_kategori=kategori_tryout.id_kategori', 'left');
	$this->db->join('profil_tryout', 'kategori_tryout.id_profil=profil_tryout.id_tryout', 'left');
	$this->db->join('siswa', 'analisis_waktu.id_siswa=siswa.id_siswa', 'left');
	$this->db->join('kelas', 'siswa.kelas=kelas.id_kelas', 'left');
	$this->db->join('kelas_paralel', 'siswa.kelas=kelas_paralel.id_kelas', 'left');
	$this->db->join('sekolah', 'siswa.sekolah_id=sekolah.id_sekolah', 'left');
	$this->db->join('kota_kabupaten', 'sekolah.kota_id=kota_kabupaten.id_kota', 'left');
	$this->db->join('provinsi', 'kota_kabupaten.provinsi_id=provinsi.id_provinsi', 'left');
	$this->db->where("analisis_waktu.id_siswa", $idsiswa);
	$this->db->where("profil_tryout.id_tryout", $idprofil);
	
	$query = $this->db->get();
	return $query->row();
}
//update 12 november 2016 part 2
function cari_profil_tryout(){
	$this->db->select("*");
	$this->db->from("profil_tryout");
	
	$query = $this->db->get();
	return $query->result();
}

function get_topik_by_mapel($idmapel){
	$this->db->select("*");
	$this->db->from("materi_pokok");
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id=mata_pelajaran.id_mapel', 'left');
	$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
	$this->db->where("materi_pokok.mapel_id", $idmapel);
	
	$query = $this->db->get();
	return $query->result();
}

function get_info_mapel($idmapel){
	$this->db->select("*");
	$this->db->from("mata_pelajaran");
	$this->db->where("id_mapel", $idmapel);
	
	$query = $this->db->get();
	return $query->row();
}

function get_jumlah_soaltryout_bykelas($idkelas){
	$this->db->select("
	profil_tryout.id_kelas,
	count( id_banksoal ) AS jumlah_soal
	");
	$this->db->from("soal_tryout");
	$this->db->join('kategori_tryout', 'soal_tryout.id_kategori = kategori_tryout.id_kategori');
	$this->db->join('profil_tryout', 'kategori_tryout.id_profil = profil_tryout.id_tryout');
	$this->db->group_by("profil_tryout.id_kelas");
	
	$query = $this->db->get();
	return $query->result();
}
function get_materi_by_keyword($keyword){
	$this->db->select("*");
	$this->db->from("materi_pokok");
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id=mata_pelajaran.id_mapel', 'left');
	$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
	$this->db->where("(materi_pokok.nama_materi_pokok like '%$keyword%')");
	
	$query = $this->db->get();
	return $query->result();
}
//UPDATE 20 OKTOBER 2016
function cari_aktivasi($idsiswa){
	$this->db->select('*');
	$this->db->from('paket_aktif');
	$this->db->where('id_siswa', $idsiswa);
	
	$result = $this->db->count_all_results();
	return $result;
}

//UPDATE 25 OKTOBER 2016
//######################
function edit_profil($idsiswa, $nama, $phone, $email, $jeniskelamin, $alamat, $namafile){
	if($namafile !== ""){
		$data = array(
			'nama_siswa' 		=> $nama,
			'alamat' 			=> $alamat,
			'jenis_kelamin' 	=> $jeniskelamin,
			'email' 			=> $email,
			'telepon' 			=> $phone,
			'foto' 				=> $namafile
		);
		$this->db->where('id_siswa', $idsiswa);
		$this->db->update('siswa', $data);
	}else{
		$data = array(
			'nama_siswa' 		=> $nama,
			'alamat' 			=> $alamat,
			'jenis_kelamin' 	=> $jeniskelamin,
			'email' 			=> $email,
			'telepon' 			=> $phone
		);
		$this->db->where('id_siswa', $idsiswa);
		$this->db->update('siswa', $data);
		
	}
}
//UPDATE 12 NOVEMBER 2016
function cari_kelas_by_jenjang($jenjang){
	$this->db->select("*");
	$this->db->from("kelas");
	$this->db->where("jenjang", $jenjang);
	
	$query = $this->db->get();
	return $query->result();
}
function cari_sekolah($sekolah){
	$this->db->select("*");
	$this->db->from("sekolah");
	$this->db->where("id_sekolah", $sekolah);
	
	$query = $this->db->get();
	return $query->row();
}

function edit_sekolah_siswa($sekolah, $kelas, $idsiswa){
	$data = array(
		'sekolah_id' 		=> $sekolah,
		'kelas' 			=> $kelas
	);
	$this->db->where('id_siswa', $idsiswa);
	$this->db->update('siswa', $data);
}

function edit_sekolah_siswa_baru($kota, $jenjang, $sekolah, $kelas, $idsiswa){
	$datasekolah = array(
		'kota_id'		=> $kota,
		'nama_sekolah'	=> $sekolah,
		'jenjang'		=> $jenjang
	);
	$tambahsekolah 	= $this->db->insert("sekolah", $datasekolah);
	
	$idsekolah 	 	= $this->db->insert_id();
	
	$data = array(
		'sekolah_id' 		=> $idsekolah,
		'kelas' 			=> $kelas
	);
	$this->db->where('id_siswa', $idsiswa);
	$this->db->update('siswa', $data);
}
//update 12 november 2016 part II
function cari_waktu($idkategori, $idsiswa){
	$this->db->select("*");
	$this->db->from("analisis_waktu");
	$this->db->where("id_kategori", $idkategori);
	$this->db->where("id_siswa", $idsiswa);
	
	$result = $this->db->count_all_results();
	return $result;
}

function rekap_nilai($idprofil, $idsiswa){
	$this->db->select(
	"
	kategori_tryout.id_kategori,
	kategori_tryout.id_kategori as idkategori,
	kategori_tryout.nama_kategori,
	profil_tryout.nama_profil,
	(
	select sum(bobot_soal)
	from bank_soal
	inner join analisis_topik on bank_soal.id_banksoal = analisis_topik.id_soal
	inner join kategori_tryout on analisis_topik.id_kategori = kategori_tryout.id_kategori
	
	where analisis_topik.id_siswa = $idsiswa and analisis_topik.id_kategori= idkategori and analisis_topik.status = 1 
	
	group by analisis_topik.id_kategori
	)as jumlah_bobot_benar,
	(
	select count(id_banksoal)
	from soal_tryout
	inner join kategori_tryout on soal_tryout.id_kategori = kategori_tryout.id_kategori
	inner join profil_tryout on kategori_tryout.id_profil = profil_tryout.id_tryout
	where soal_tryout.id_kategori = idkategori
	) as jumlah_soal,
	(
	select count(analisis_topik.status)
	from analisis_topik
	inner join kategori_tryout on analisis_topik.id_kategori = kategori_tryout.id_kategori
	inner join profil_tryout on kategori_tryout.id_profil = profil_tryout.id_tryout
	
	where analisis_topik.id_siswa = $idsiswa and analisis_topik.status = 0 and analisis_topik.id_kategori = idkategori
	
	group by analisis_topik.id_kategori
	)as jumlah_salah,
	(
	select count(analisis_topik.status)
	from analisis_topik
	inner join kategori_tryout on analisis_topik.id_kategori = kategori_tryout.id_kategori
	inner join profil_tryout on kategori_tryout.id_profil = profil_tryout.id_tryout
	
	where analisis_topik.id_siswa = $idsiswa and analisis_topik.status = 1 and analisis_topik.id_kategori = idkategori
	
	group by analisis_topik.id_kategori
	)as jumlah_benar,
	");
	$this->db->from("kategori_tryout");
	$this->db->join("profil_tryout", "kategori_tryout.id_profil = profil_tryout.id_tryout");
	$this->db->where("profil_tryout.id_tryout", $idprofil);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_all_cbtcontest(){

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
		kelas.alias_kelas
		");
		$this->db->from("profil_tryout");
		$this->db->join("kelas", "kelas.id_kelas=profil_tryout.id_kelas");
		$this->db->where("profil_tryout.tipe", 1);
		
		$result=$this->db->get();

		return $result->result();

	}
	
function get_cbt_by_profil($idprofil){

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
		profil_tryout.keterangan,
		kelas.alias_kelas
		");
		$this->db->from("profil_tryout");
		$this->db->join("kelas", "kelas.id_kelas=profil_tryout.id_kelas");
		$this->db->where("profil_tryout.tipe", 1);
		$this->db->where("profil_tryout.id_tryout", $idprofil);
		
		$result=$this->db->get();

		return $result->row();

	}

function proses_daftar_cbt($idsiswa, $idprofil){
	$tanggaldaftar = date('Y-m-d');
	$data = array(
		'id_profil'		=> $idprofil,
		'id_siswa'		=> $idsiswa,
		'status'		=> 0,
		'tgl_daftar'	=> $tanggaldaftar
	);
	$daftar 	= $this->db->insert("pembayaran_cbt", $data);
	
	return $this->db->insert_id();
}

function cari_daftar_cbt_by_siswa_and_profil($idsiswa, $idprofil){
	$this->db->select('*');
	$this->db->from('pembayaran_cbt');
	
	$query = $this->db->get();
	return $query->row();
}

function get_info_pembayaran_cbt($iddaftar){
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
	$this->db->where('pembayaran_cbt.id_bayar_cbt', $iddaftar);
	
	$query = $this->db->get();
	return $query->row();
}

function proses_bukti_cbt($idsiswa, $iddaftar, $namafile){
	$tglbayar = date('Y-m-d');
	$data = array(
		'bukti'		=> $namafile,
		'tgl_bayar'	=> $tglbayar,
		'status'	=> 1
		
	);
	$this->db->where('id_siswa', $idsiswa);
	$this->db->where('id_bayar_cbt', $iddaftar);
	$this->db->update('pembayaran_cbt', $data);
}


//sagab    
    public function cek_status_pembayaran($id_siswa, $id_cbt_tes) {
        $this->db->select('*');
        $this->db->from('pembayaran_cbt');        
        $this->db->where(array("id_siswa"=>$id_siswa, "id_profil"=>$id_cbt_tes));
        
        $query = $this->db->get()->row();    
        if(count($query)== 0){
            $status = 4; //data di database kosong
        }else{
        $status = $query->status;
        }
        return $status;
    }
//end sagab
function get_kelas_premium(){
	$this->db->select("*");
	$this->db->from("kelas");
	
	$result=$this->db->get();
	return $result->result();
}
}



?>