<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_security');
		$this->model_security->is_logged_in();
  }

	function index(){
		$data = array(
			'navbar_title' 	=> "Manajemen User",
			'data_table' 	=> $this->model_adm->fetch_all_user()
		);

		$this->load->view('pg_admin/user', $data);
	}

	function tambah(){
		$data = array(
			'navbar_title' 	=> "Manajemen User",
			'data_cabang' 	=> $this->model_adm->fetch_all_cabang()
		);

		$this->load->view('pg_admin/user_form', $data);
	}


	function proses_tambah(){
		$params = $this->input->post(null, true);
		
		$username 	= $params['username'];
		$password 	= $params['password'];
		$repassword = $params['repassword'];
		$level 			= $params['level'];
		$jabatan 		= $params['jabatan'];
		$nama 			= $params['nama'];
		$cabang 		= $params['cabang'];
		$status 		= $params['status'];
		
		if($password !== $repassword){
			alert_error("Gagal Register", "Password tidak sama");
			redirect("pg_admin/user/tambah");
		}
		
		$cariuserpass = $this->model_adm->cari_user($username, $password);
		
		if($cariuserpass === FALSE){
			$prosestambah = $this->model_adm->tambah_user($username, md5($password), $level, $jabatan, $cabang, $nama, $status);
			alert_success("Berhasil", "User Berhasil Ditambahkan");
			redirect('pg_admin/user');
		}
		else{				
			alert_error("Error", "Username Sudah ada yang memakai, pakai username yang lain!");
			redirect('pg_admin/user/tambah');
		}
	}

	function edit($iduser){
		$data = array(
			'navbar_title' 	=> "Manajemen Akun",
			'user'			=> $this->model_adm->get_user_by_id($iduser),
			'data_cabang' 	=> $this->model_adm->fetch_all_cabang()
		);
		
		$this->load->view('pg_admin/user_edit', $data);
	}

	function proses_edit(){
		$params = $this->input->post(null, true);
		
		$iduser 		= $params['iduser'];
		$username 	= $params['username'];
		$level 			= $params['level'];
		$jabatan 		= $params['jabatan'];
		$nama 			= $params['nama'];
		$cabang 		= $params['cabang'];
		$status 		= $params['status'];
		
		$prosestambah = $this->model_adm->edit_user($iduser, $username, $level, $jabatan, $cabang, $nama, $status);
		alert_success("Berhasil", "User Berhasil Dirubah");
		redirect('pg_admin/user');
	}

	function edit_password($iduser){
		$data = array(
			'navbar_title' 	=> "Manajemen Akun",
			'user'			=> $this->model_adm->get_user_by_id($iduser)
		);
		
		$this->load->view('pg_admin/user_edit_password', $data);
	}

	function proses_edit_password(){
		$params = $this->input->post(null, true);
		
		$iduser 		= $params['iduser'];
		$password 	= $params['password'];
		$repassword = $params['repassword'];
		
		if($password !== $repassword){
			alert_error("Gagal Register", "Password tidak sama");
			redirect("pg_admin/user/edit_password/".$iduser);
		}
		$prosestambah = $this->model_adm->edit_password_user($iduser, $password);
		alert_success("Berhasil", "Password User Berhasil Dirubah");
		redirect('pg_admin/user');
	}

	function hapus($iduser, $from=''){
		$proseshapus = $this->model_adm->hapus_user($iduser);
		if ($from == 'konselor'){
			redirect('pg_admin/user/konselor');
		} else {
			redirect('pg_admin/user');
		}
	}

	function konselor(){
		$data = array(
			'navbar_title' 	=> "Manajemen Konselor",
			'active' 	=> "konselor",
			'data_table' 	=> $this->model_adm->fetch_all_konselor()
		);

		$this->load->view('pg_admin/konselor', $data);
	}

	function tambah1(){
		$data = array(
			'navbar_title' 	=> "Manajemen Konselor",
			'active' 	=> "konselor",
			'data_cabang' 	=> $this->model_adm->fetch_all_cabang()
		);

		$this->load->view('pg_admin/konselor_form', $data);
	}


	function proses_tambah1(){
		$params = $this->input->post(null, true);
		
		$username 	= $params['username'];
		$password 	= $params['password'];
		$repassword = $params['repassword'];
		$level 			= $params['level'];
		$jabatan 		= $params['jabatan'];
		$nama 			= $params['nama'];
		$cabang 		= $params['cabang'];
		$status 		= $params['status'];
		$kode 			= $params['kode'];
		$tptlhr 		= $params['tpt_lahir'];
		$tgllhr 		= $params['tgl_lahir'];
		
		$cariuserpass = $this->model_adm->cari_user($username, $password);
		
		if($cariuserpass === FALSE){
			$prosestambah = $this->model_adm->tambah_user($username, md5($password), $level, $jabatan, $cabang, $nama, $status, $kode, $tptlhr, $tgllhr);
			alert_success("Berhasil", "User Berhasil Ditambahkan");
			redirect('pg_admin/user/konselor');
		}
		else{				
			alert_error("Error", "Username Sudah ada yang memakai, pakai username yang lain!");
			redirect('pg_admin/user/tambah1');
		}
	}

	function edit1($iduser){
		$data = array(
			'navbar_title' 	=> "Manajemen Akun",
			'active' 	=> "konselor",
			'user'			=> $this->model_adm->get_user_by_id($iduser),
			'data_cabang' 	=> $this->model_adm->fetch_all_cabang()
		);
		
		$this->load->view('pg_admin/konselor_edit', $data);
	}

	function proses_edit1(){
		$params = $this->input->post(null, true);
		
		$iduser 		= $params['iduser'];
		$username 	= $params['username'];
		$level 			= $params['level'];
		$jabatan 		= $params['jabatan'];
		$nama 			= $params['nama'];
		$cabang 		= $params['cabang'];
		$status 		= $params['status'];
		$kode 			= $params['kode'];
		$tptlhr 		= $params['tpt_lahir'];
		$tgllhr 		= $params['tgl_lahir'];
		
		$prosestambah = $this->model_adm->edit_user($iduser, $username, $level, $jabatan, $cabang, $nama, $status, $kode, $tptlhr, $tgllhr);
		alert_success("Berhasil", "User Berhasil Dirubah");
		redirect('pg_admin/user/konselor');
	}

}
