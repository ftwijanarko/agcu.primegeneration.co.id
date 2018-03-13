<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
public function __construct(){
	parent::__construct();
	//load library in construct. Construct method will be run everytime the controller is called 
	//This library will be auto-loaded in every method in this controller. 
	//So there will be no need to call the library again in each method. 
	$this->load->helper('alert_helper');
	$this->load->model('model_pg');
	$this->load->model('model_dashboard');
}

function index(){
	$idsiswa = $this->session->userdata('id_siswa');
	$carikelas = $this->model_dashboard->get_kelas($idsiswa);
	$kelas = $carikelas->kelas;
	$data = array(
		'navbar_links'		=> $this->model_pg->get_navbar_links(),
		'analisis_mapel'	=> $this->model_dashboard->get_analisis_mapel($idsiswa),
		'analisis_waktu'	=> $this->model_dashboard->get_analisis_waktu($idsiswa),
		'kategori'			=> $this->model_dashboard->get_kategori_tryout($kelas),
		'kelas'				=> $kelas,
		'analisis_topik'	=> $this->model_dashboard->get_analisis_topik($idsiswa)
	);
	
	$this->load->view('pg_user/dashboard', $data);
}



}
?>