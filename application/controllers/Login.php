<?php
/**
* 
*/
class Login extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();
    $this->load->model("model_login");
    $this->load->model("model_poin");
    $this->load->model("model_pg");
    $this->load->model("model_pembayaran");
    $this->load->library("form_validation");
    $this->load->library("session");
    $this->load->helper("alert_helper");
    $this->load->helper("socmed_helper");
  }

  function index()
  {
    $data = array(
      'navbar_links' => $this->model_pg->get_navbar_links(),
      );

    $this->load->view("pg_user/login", $data);
  }

  function do_login()
  {
    $this->form_validation_rules(); 

    if ($this->form_validation->run() == FALSE) 
    {
      alert_error("Gagal Login", "Terjadi Kesalahan Saat Login");
      redirect("login");
    } 
    else 
    {
			$params = $this->input->post(null, true);
		
			$do_login = $this->model_login->cek_login($params['username'], $params['password']);
			if($do_login != null)
		  { 
				$this->set_siswa_akses($do_login);
				redirect("user/dashboard");
		  }
		  else
		  {
				alert_error("Gagal Login", "Username dan/atau password yang anda masukan tidak sesuai");
				redirect("login");
		  }
      
    }
  }

  private function set_siswa_akses($do_login)
  {
    //get user access
    $siswa_access = $this->model_login->cek_user_akses($do_login['id_siswa']);

    // proses set session
    $this->session->set_userdata($do_login);
    // $this->session->set_userdata();
  }

  private function form_validation_rules()
  {
    //set validation rules for each input
    $this->form_validation->set_rules('username', 'Username', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    //set custom error message
    $this->form_validation->set_message('required', '%s tidak boleh kosong');
  }

  private function cek_masa_aktif($data)
  {
    $sedang_aktif = TRUE;

    if(date('Y-m-d') > $data->expired_on) //paket telah melebihi expiration date
    {
      // return $data->id_kelas.", " . date('Y-m-d').", " . $data->expired_on."<br>";
      $result = $this->model_login->set_to_inactive($data->id_paket_aktif);
      print_r($result);

      if($result)
        { $sedang_aktif = FALSE; }
      
    }
    return $sedang_aktif;
  }

	function login_from_signup($username, $password, $nama){
		$do_login = $this->model_login->cek_login($username, $password);
		if($do_login != null)
			{ 
				$this->set_siswa_akses($do_login);		
				redirect("user/dashboard");
			}
			else
			{
				alert_error("Gagal Login", "Username dan/atau password yang anda masukan tidak sesuai");
				redirect("login");
			}
	}

}
?>
