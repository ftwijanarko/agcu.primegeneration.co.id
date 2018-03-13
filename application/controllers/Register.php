<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
		//load library in construct. Construct method will be run everytime the controller is called 
		//This library will be auto-loaded in every method in this controller. 
		//So there will be no need to call the library again in each method. 
		$this->load->helper('alert_helper');
		$this->load->model('model_pg');
  }

	public function index()
	{
		$data = array(
			'navbar_links' => $this->model_pg->get_navbar_links() 
			);

		$this->load->view('pg_user/register', $data);
	}

}
