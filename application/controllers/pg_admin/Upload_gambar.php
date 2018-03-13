<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_gambar extends CI_Controller{

	function __construct(){
		parent::__construct();
		  $this->load->helper(array('form', 'url'));
	}

	public function index(){
		$config['upload_path']          = 'assets/uploads/materi/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2048;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$config['overwrite']            = TRUE;

		$this->load->library('upload', $config);

		if ( !$this->upload->do_upload('filegambar')){
			$error = array('error' => $this->upload->display_errors());
		}else{
			$data 	 = $this->upload->data();
			$fileasli= explode(".", $data['file_name']);
			$ext		 = end($fileasli);
			$newname = date('Ymd').rand(1000000,9999999).'.'.$ext;
			rename('assets/uploads/materi/'.$data['file_name'], 'assets/uploads/materi/'.$newname);
			echo $newname;
		}
	}
	
}