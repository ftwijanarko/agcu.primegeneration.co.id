<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
		$this->load->helper('alert_helper');
    $this->load->model('model_pg');
		$this->load->model('model_login');
		$this->load->model('model_signup');
  }

	function index(){
		if (empty($this->session->userdata('id_siswa'))){
				redirect('login');
		}
		
		$idsiswa = $this->session->userdata('id_siswa');
		
		if($idsiswa == ""){
			$data = array(
				'navbar_links' => $this->model_pg->get_navbar_links(),
				'select_sekolah'  => $this->model_pg->fetch_all_sekolah(),
			  'select_kelas'  	=> $this->model_pg->fetch_all_kelas(),
			  'select_provinsi'	=> $this->model_signup->get_provinsi()
				);
			$this->load->view('pg_user/homebaru', $data);
		}else{
			redirect('user/dashboard');
		}
	}

}
