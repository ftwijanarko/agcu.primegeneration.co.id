<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lupa_password extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
		//load library in construct. Construct method will be run everytime the controller is called 
		//This library will be auto-loaded in every method in this controller. 
		//So there will be no need to call the library again in each method. 
		$this->load->library('session');
		$this->load->helper('alert_helper');
		$this->load->helper('url');
		$this->load->model('model_pg');
		$this->load->model('model_lupa_password');
  }

	public function index()
	{
		$kode_unik = isset($_GET['key']) ? $_GET['key'] : null ;

		if(!empty($kode_unik)) {
			if($kode_unik == 'expired') { alert_warning('Key pengaturan password telah terpakai/expired'); }

			$params = $this->input->post();
			if(!empty($params)) {
			//FORM INPUT HANDLER:
				if($params['katasandi'] == $params['konfirmasi']) {
					$this->recover_password($params['katasandi']);
				} 
				else {
					alert_danger("Gagal", "Konfirmasi password yang anda masukkan tidak sesuai");
				}
				redirect(current_url().'?key='.(!empty($kode_unik) ? $kode_unik : 'expired'));
			}
			else {
			//FIRST TIME RUN:
				$data = $this->model_lupa_password->cek_key($kode_unik);
				$navbar = array(
	      	'navbar_links' => $this->model_pg->get_navbar_links()
	      );

				if(!empty($data->recover_key)) {
				//set temporary session
					$recover = array('id' => $data->id_login, 'key' => $kode_unik);
					$this->session->set_tempdata('recover', $recover, 86400); //expires in 1 day
					$this->model_lupa_password->remove_key($kode_unik);
				}

				$this->load->view('pg_user/lupa_password', $navbar);
			}
			// $remove_key = $this->model_lupa_password->remove_key($kode_unik);
		}
		else {
			show_404();
		}
	}

	public function show_template()
	{
		// show_404();
		$data['data'] = $this->model_lupa_password->fetch_siswa_by_id('20');
		$data['data']->kode_unik = 'c0ntohK3yPriMEm0B1le';

		$this->load->view('preview/mail_template', $data);
		// $this->mail_configuration($data);
	}

	public function ajax_cek_email()
	{
		$email = $this->input->post('email') ? $this->input->post('email') : null;
		$result = FALSE;
	
		if(!empty($email)) {
			$siswa['data'] = $this->model_lupa_password->cek_email($email);
			$kode_unik = $this->randomKey();

			if(!empty($siswa['data'])) {
				$siswa['data']->kode_unik = $kode_unik;
				$this->model_lupa_password->simpan_key($kode_unik, $email);

				$this->mail_configuration($siswa);
				$result = TRUE;
			}
		}
		
		echo json_encode($result);
	}

	private function mail_configuration($data)
	{
		if(!empty($data)) {
			$config = array(
					'protocol' => 'smtp',					
				  'smtp_port' => 587,
				  'smtp_host' => 'mail.smtp2go.com',
				  'smtp_user' => 'helloprimemobile@gmail.com',
				  'smtp_pass' => 'bD1KKXvB3T1D', 
				  //ORI (Suspended)
				  // 'smtp_host' => 'smtp.sendgrid.net',
				  // 'smtp_user' => 'ftwijanarko',
				  // 'smtp_pass' => 'MerekaAdalah16', 

				  'mailtype' => 'html',
				  'charset' => 'iso-8859-1',
				  // 'wordwrap' => TRUE
				);

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			
			//mail contents
			$sender_name = 'Prime Mobile';
			$sender = 'help@primemobile.co.id';
			// $receiver = $data['email'];
			$receiver = $data['data']->email;
			$mail_body = $this->load->view('preview/mail_template', $data, TRUE);

			// $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
			// $this->email->set_header('Content-type', 'text/html'); 
			$this->email->from($sender, $sender_name);
			$this->email->to($receiver);
			
			$this->email->subject('Lupa password Prime Mobile?');
			$this->email->message($mail_body);

			$this->email->send();
		}
	}

	private function recover_password($password)
	{
		if(isset($_SESSION['recover']['id'])) {
			$result = $this->model_lupa_password->update_password($_SESSION['recover']['id'], $password);
			
			if($result) {
				alert_success("Password anda berhasil diperbarui, silahkan <a href='".base_url('login')."' class='label label-info'>LOGIN</a>");
				unset($_SESSION['recover']);
			}
		}
	}

	private function randomKey() 
	{
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 16; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }

	    return implode($pass); //turn the array into a string
	}

}
