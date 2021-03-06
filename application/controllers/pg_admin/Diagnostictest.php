<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diagnostictest extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_pg');
		$this->load->model('model_agcu');
		$this->load->model('model_eqtest');
		$this->load->model('model_lstest');
		$this->load->model('model_dashboard');
		$this->load->model('model_banksoal');
		$this->load->model('model_security');
		$this->model_security->is_logged_in();
	}

	function index(){
		$this->load->library('ajax_pagination');
		
		$limit		= 10;
		$page			= 1;
		if($page == 1){
			$offset = 0;
		} else {
			$offset = ($page-1) * $limit;
		}	
		
		$config['base_url'] 				= base_url().'pg_admin/diagnostictest/tabel_ajax/0';
		$config['total_rows'] 			= $this->model_agcu->fetch_all_profil(0)->num_rows();
		$config['per_page'] 				= $limit;
		$config['uri_segment'] 			= 5;
		$config['num_links'] 				= 3;
		$config['use_page_numbers'] = TRUE;
		$config['first_link'] 			= 'First';
		$config['last_link'] 				= 'Last';
		$config['next_link'] 				= '&gt;';
		$config['prev_link'] 				= '&lt;';
		$config['full_tag_open'] 		= "<ul class='pagination' style='width:100%;'>";
		$config['full_tag_close'] 	="</ul>";
		$config['num_tag_open'] 		= '<li>';
		$config['num_tag_close'] 		= '</li>';
		$config['cur_tag_open'] 		= "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] 		= "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] 		= "<li>";
		$config['next_tagl_close']	= "</li>";
		$config['prev_tag_open'] 		= "<li>";
		$config['prev_tagl_close']	= "</li>";
		$config['first_tag_open'] 	= "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] 		= "<li>";
		$config['last_tagl_close'] 	= "</li>";
		
		$this->ajax_pagination->initialize($config);
		$data = array(
			'navbar_title' 					=> "AGCU Test",
			'table_data' 						=> $this->model_agcu->fetch_all_profil(0,$offset, $limit)->result(),
			'jmleq' 								=> $this->model_agcu->count_eq(),
			'jmlls' 								=> $this->model_agcu->count_ls(),
      'paginator'    					=> $this->ajax_pagination->create_links(),
      'no'    								=> ($page - 1) * $limit + 1,
		);

		$this->load->view('pg_admin/profildiagnostic', $data);
	}

	function tabel_ajax($cari=0,$page=1){
		$this->load->library('ajax_pagination');
		
		$limit		= 10;
		if($page == 1){
			$offset = 0;
		} else {
			$offset = ($page-1) * $limit;
		}
		if ($this->input->post('cari') != ''){
			$cari = url_title($this->input->post('cari'),'-', true);
		} else {
			$cari = $cari;
		}

		$config['base_url'] 				= base_url().'pg_admin/diagnostictest/tabel_ajax/'.$cari.'/';
		$config['total_rows'] 			= $this->model_agcu->fetch_all_profil($cari)->num_rows();
		$config['per_page'] 				= $limit;
		$config['uri_segment'] 			= 5;
		$config['num_links'] 				= 3;
		$config['use_page_numbers'] = TRUE;
		$config['first_link'] 			= 'First';
		$config['last_link'] 				= 'Last';
		$config['next_link'] 				= '&gt;';
		$config['prev_link'] 				= '&lt;';
		$config['full_tag_open'] 		= "<ul class='pagination' style='width:100%;'>";
		$config['full_tag_close'] 	="</ul>";
		$config['num_tag_open'] 		= '<li>';
		$config['num_tag_close'] 		= '</li>';
		$config['cur_tag_open'] 		= "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] 		= "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] 		= "<li>";
		$config['next_tagl_close']	= "</li>";
		$config['prev_tag_open'] 		= "<li>";
		$config['prev_tagl_close']	= "</li>";
		$config['first_tag_open'] 	= "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] 		= "<li>";
		$config['last_tagl_close'] 	= "</li>";
		
		$this->ajax_pagination->initialize($config);
		$data = array(
			'navbar_title' 					=> "Profil Diagnostic Test",
			'table_data' 						=> $this->model_agcu->fetch_all_profil($cari, $offset, $limit)->result(),
			'jmleq' 								=> $this->model_agcu->count_eq(),
			'jmlls' 								=> $this->model_agcu->count_ls(),
      'paginator'    					=> $this->ajax_pagination->create_links(),
      'no'    								=> ($page - 1) * $limit + 1,
		);

		$this->load->view('pg_admin/profildiagnostic_ajax', $data);
	}

	/* PROFIL DIAGNOSTIC */
	function tambahprofil(){
		$this->form_validation_rules();
		$data = array(
			'navbar_title' 		=> "Tambah AGCU Test",
			'page_title'			=> "Tambah AGCU Test",
			'form_action'			=> current_url(),
			'select_sekolah' 	=> $this->model_adm->fetch_all_sekolah(),
			'select_cabang' 	=> $this->model_adm->fetch_all_cabang(),
			'select_options'	=> $this->model_adm->fetch_all_kelas(),
			'select_profil'		=> $this->model_agcu->fetch_profil_master(),
		);
		//jika tombol submit ditekan
		if($this->input->post('form_submit')){
			//routing ke proses tambah
			$this->proses_tambah();
		}else{
			//jika tidak submit
			$this->load->view('pg_admin/profilformdiagnostic', $data);
		}
	}

	public function proses_tambah(){
		$data = array(
			'page_title' 	=> "Tambah Profil Diagnostic", 
			'form_action' 	=> current_url()
		);
		//mengambil semua input dari form
		$params 				= $this->input->post(null, true);
		$profil 				= $params['profil'];
		$nama 					= $params['nama'];
		$penyelenggara 	= $params['penyelenggara'];
		$biaya					= $params['biaya'];
		$tanggal				= $params['tanggal'];
		$jam						= $params['jam'];
		$tanggal1				= $params['tanggal1'];
		$jam1						= $params['jam1'];
		$sekolah				= $params['sekolah'];
		$kelas 					= $params['kelas'];
		$keterangan	 		= $params['keterangan'];
		$type						= $params['tipe'];
		$kode						= date('ymd',strtotime($params['tanggal'])).date('h',strtotime($params['jam'])).$params['sekolah'].$params['kelas'];

		if ($this->form_validation->run() == FALSE){
			alert_error("Error", "Data gagal ditambahkan");
			$this->load->view('pg_admin/profilformdiagnostic', $data);
		}else{
			
			if($_FILES['banner']['name'] !== ""){
				$tipe 		 	= $this->cek_tipe($_FILES['banner']['type']);
				$img_path	 	= "assets/uploads/banner/";
				$namafile		= md5($nama).md5(time()).$tipe;
				
				
				$config['upload_path']		= $img_path;
				$config['allowed_types']    = 'gif|jpg|png';
				$config['file_name'] 		= $namafile;
				
				$this->load->library('upload', $config);
				$this->upload->do_upload('banner');
				
				$result = $this->model_agcu->add_profil($sekolah, $kelas, $nama, $keterangan,	$penyelenggara, $tanggal, $jam, $tanggal1, $jam1, $biaya, $namafile, $type, $kode, $profil);
				
				redirect('pg_admin/diagnostictest');
			}else{
				//passing input value to Model
				$result = $this->model_agcu->add_profil($sekolah, $kelas, $nama, $keterangan,	$penyelenggara, $tanggal, $jam, $tanggal1, $jam1, $biaya, "-", $type, $kode, $profil);
				
				redirect('pg_admin/diagnostictest');
				// echo "Status Insert: " . $result;
			}
			
			
		}
	}

	function editprofil($idprofil){
		$data = array(
			'navbar_title' 				=> "Update AGCU Test",
			'page_title'					=> "Update AGCU Test",
			'profil'							=> $this->model_agcu->fetch_profil_by_id($idprofil),
			'select_sekolah' 			=> $this->model_adm->fetch_all_sekolah(),
			'select_options'			=> $this->model_adm->fetch_all_kelas(),
			'select_cabang' 			=> $this->model_adm->fetch_all_cabang(),
			'select_profil'				=> $this->model_agcu->fetch_profil_master(),
		);
		$this->load->view('pg_admin/profil_edit_diagnostic', $data);
	}

	function proses_edit(){
		$params 				= $this->input->post(null, true);
		$idprofil 			= $params['idprofil'];
		$profil 				= $params['profil'];
		$nama 					= $params['nama'];
		$penyelenggara 	= $params['penyelenggara'];
		$biaya					= $params['biaya'];
		$tanggal				= $params['tanggal'];
		$jam						= $params['jam'];
		$tanggal1				= $params['tanggal1'];
		$jam1						= $params['jam1'];
		$sekolah				= $params['sekolah'];
		$kelas 					= $params['kelas'];
		$keterangan	 		= $params['keterangan'];
		$type						= $params['tipe'];
		$kode						= date('ymd',strtotime($params['tanggal'])).date('h',strtotime($params['jam'])).$params['sekolah'].$params['kelas'];
		
		if($_FILES['banner']['name'] !== ""){
			$tipe 		 	= $this->cek_tipe($_FILES['banner']['type']);
			$img_path	 	= "assets/uploads/banner/";
			$namafile		= md5($nama).md5(time()).$tipe;
			
			
			$config['upload_path']		= $img_path;
			$config['allowed_types']    = 'gif|jpg|png';
			$config['file_name'] 		= $namafile;
			
			$this->load->library('upload', $config);
			$this->upload->do_upload('banner');
			
			$result = $this->model_agcu->edit_profil($idprofil,	$sekolah,	$kelas, $nama, $keterangan,	$penyelenggara, $tanggal, $jam, $tanggal1, $jam1, $biaya, $namafile, $type, $kode, $profil);
			
			redirect('pg_admin/diagnostictest');
		}else{
			//passing input value to Model
			$result = $this->model_agcu->edit_profil($idprofil,	$sekolah, $kelas, $nama, $keterangan,	$penyelenggara, $tanggal, $jam, $tanggal1, $jam1, $biaya, "-", $type, $kode, $profil);
			
			redirect('pg_admin/diagnostictest');
			// echo "Status Insert: " . $result;
		}
	}

	function hapus_profil($idprofil){
		//hapus profil
		$this->model_agcu->hapus_agcu_test($idprofil);
		redirect('pg_admin/diagnostictest');
	}

	function aktifkanprofil($idprofil){
		$carikategori = $this->model_agcu->aktifkan_profil($idprofil);
		
		redirect('pg_admin/diagnostictest');
	}

	function nonaktifkanprofil($idprofil){
		$carikategori = $this->model_agcu->nonaktifkan_profil($idprofil);
		
		redirect('pg_admin/diagnostictest');
	}

	private function cek_tipe($tipe){
		if ($tipe == 'image/jpeg') 
			{ return ".jpg"; }
		else if($tipe == 'image/png') 
			{ return ".png"; }
		else 
			{ return false; }
	}

	function form_validation_rules(){
			//set validation rules untuk masing2 input
			$this->form_validation->set_rules('nama', 'nama', 'trim|required');
			$this->form_validation->set_rules('penyelenggara', 'penyelenggara', 'trim|required');
			$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
			$this->form_validation->set_rules('jam', 'jam', 'trim|required');
			$this->form_validation->set_rules('kelas', 'kelas', 'trim|required');
			//set custom error message
			$this->form_validation->set_message('required', '%s tidak boleh kosong');
	}

	function pilihprofil($idkelas){
		$profil = $this->model_agcu->fetch_profil_master($idkelas);
		
		echo '<select data-placeholder="Pilih Profil AGCU Test" id="profil" name="profil" class="form-control chosen-select" style="width: 100%;" tabindex="2">';
		echo '<option value="0">Pilih Profil AGCU Test</option>';
		foreach($profil as $p){
			echo '<option value="'.$p->id_profil_master.'" > '.$p->nama_profil.' ('.$p->kode.')</option>';
		}
		echo '</select>';
	}

	/*
	function tambah($id=0){
		$data = array(
			'kelas'	=> $this->model_agcu->get_kelas(),
			'idkat' => $id,
		);
		$this->load->view('pg_admin/diagnostic_form', $data);
	}

	function pilihmapel(){
		$idkelas = $this->uri->segment(4);
		
		$mapel = $this->model_agcu->get_mapel_by_kelas($idkelas);
		
		echo "<option value=''>-- Pilih Mata Pelajaran --</option>";
		foreach($mapel as $datamapel){
			echo "
			<option value='".$datamapel->id_mapel."'>".$datamapel->nama_mapel."</option>
			";
		}
	}

	function pilihsoal(){
		$idmapel = $this->uri->segment(4);
		
		$soal = $this->model_agcu->get_soal_by_mapel($idmapel);
		
		$no = 1;
		foreach($soal as $datasoal){
			echo "
			<tr>
				<td>".$datasoal->alias_kelas." - ".$datasoal->nama_mapel."</td>
				<td>".$datasoal->pertanyaan."</td>
				<td>".$datasoal->topik."</td>
				<td>
					<input type='checkbox' value='".$datasoal->id_banksoal."' name='pilih[]' />
				</td>
			</tr>
			";
			$no++;
		}
	}

	function ajax_soal_by_kategori($idkategori){
		
		$soal = $this->model_banksoal->fetch_bank_soal_by_kategori($idkategori);
		
		$no = 1;
		foreach($soal as $datasoal){
			echo "
			<tr>
				<td>".$datasoal->alias_kelas." - ".$datasoal->nama_mapel."</td>
				<td>".$datasoal->pertanyaan."</td>
				<td>".$datasoal->topik."</td>
				<td>
					<input type='checkbox' value='".$datasoal->id_banksoal."' name='pilih[]' />
				</td>
			</tr>
			";
			$no++;
		}
	}

	function prosestambah(){
		$params = $this->input->post(null, true);
		
		if(isset($params['pilih'])){
			$hitung_soal	= count($params['pilih']);
			$idbanksoal 	= $params['pilih'];
		}
		
		$idprofil = $params['id'];
		$idmapel 	= $params['mapel'];
		$nama 		= $params['nama'];
		$durasi 	= $params['durasi'];
		$ketuntasan = $params['ketuntasan'];
		$random 	= 0;
		$tanggal 	= NULL;
		$jam 			= NULL;
		$jumlah		= $hitung_soal;
		
		$insertkategori = $this->model_agcu->tambah_kategori($idprofil, $idmapel, $nama, $durasi, $ketuntasan, $jumlah, $random, $tanggal, $jam);
		
		$idkategori = $this->model_agcu->last_addedkategori();
		
		for($i=0; $i <= $hitung_soal - 1; $i++){
			$result = $this->model_agcu->add_soal($idkategori->id_terakhir, $idbanksoal[$i]);
		}
		redirect('pg_admin/diagnostictest');
	}

	function edit(){
		$iddiagnostic 	= $this->uri->segment(4);
		$getdiagnostic 	= $this->model_agcu->get_diagnosticbyid($iddiagnostic );
		$getidsoal 		= $this->model_agcu->get_idsoal($iddiagnostic );
		$getsoal 		= $this->model_agcu->get_soal();
		
		$data = array(
		'iddiagnostic'	=> $iddiagnostic,
		'getdiagnostic'	=> $getdiagnostic,
		'getidsoal'		=> $getidsoal,
		'getsoal'		=> $getsoal,
		'kelas'	=> $this->model_agcu->get_kelas()
		);	
		
		$this->load->view('pg_admin/diagnostic_edit', $data);
	}

	function prosesedit(){
		$params = $this->input->post(null, true);
		
		if(isset($params['pilih'])){
			$hitung_soal	= count($params['pilih']);
			$idbanksoal 	= $params['pilih'];
		}
		
		$idmapel 	= $params['mapel'];
		$iddiagnostic 	= $params['id'];
		$nama 		= $params['nama'];
		$durasi 	= $params['durasi'];
		$ketuntasan = $params['ketuntasan'];
		$random 	= 0;
		$tanggal 	= NULL;
		$jam 			= NULL;
		$jumlah		= $hitung_soal;
		
		$editkategori = $this->model_agcu->edit_kategori($iddiagnostic, $idmapel, $nama, $durasi, $ketuntasan, $jumlah, $random, $tanggal, $jam);
		
		$hapussoal = $this->model_agcu->hapus_soal_kategori($iddiagnostic);
		
		for($i=0; $i <= $hitung_soal - 1; $i++){
			$result = $this->model_agcu->add_soal($iddiagnostic, $idbanksoal[$i]);
		}
		redirect('pg_admin/diagnostictest');
	}

	function hapus($iddiagnostic){
		$hapuskategori = $this->model_agcu->hapuskategori($iddiagnostic);
		$hapussoal = $this->model_agcu->hapus_soal_kategori($iddiagnostic);
		$hapushasil = $this->model_agcu->hapus_hasil_by_diagnostic($iddiagnostic);
		redirect('pg_admin/diagnostictest');
	}

	function aktifkan($iddiagnostic){
		$this->model_agcu->aktivasi_kategori($iddiagnostic);
		redirect('pg_admin/diagnostictest');
	}

	function nonaktif($iddiagnostic){
		$this->model_agcu->nonaktif_kategori($iddiagnostic);
		redirect('pg_admin/diagnostictest');
	}

	function daftar_soal($iddiagnostic){
		$data = array(
			'datasoal'	=> $this->model_agcu->fetch_soal_by_diagnostic($iddiagnostic),
			'datatest'	=> $this->model_agcu->get_detail_kategori_diagnostic($iddiagnostic)
		);
		$this->load->view('pg_admin/diagnostic_view', $data);
	}

	function cetak_soal($iddiagnostic){
		$data = array(
			'datasoal'	=> $this->model_agcu->fetch_soal_by_diagnostic($iddiagnostic),
			'datatest'	=> $this->model_agcu->get_detail_kategori_diagnostic($iddiagnostic)
		);
		$this->load->view('pg_admin/diagnostic_cetak', $data);
	}

	function cetak_kunci($iddiagnostic){
		$data = array(
			'datasoal'	=> $this->model_agcu->fetch_soal_by_diagnostic($iddiagnostic),
			'datatest'	=> $this->model_agcu->get_detail_kategori_diagnostic($iddiagnostic)
		);
		$this->load->view('pg_admin/diagnostic_cetak_kunci', $data);
	}

	function daftar_soal_eq(){
		$data = array(
			'datasoal'	=> $this->model_agcu->fetch_soal_eq(),
			'jmleq' 		=> $this->model_agcu->count_eq(),
		);
		$this->load->view('pg_admin/eqtest_view', $data);
	}

	function cetak_soal_eq(){
		$data = array(
			'datasoal'	=> $this->model_agcu->fetch_soal_eq(),
			'jmleq' 		=> $this->model_agcu->count_eq(),
		);
		$this->load->view('pg_admin/eqtest_cetak', $data);
	}

	function cetak_kunci_eq(){
		$data = array(
			'datasoal'	=> $this->model_agcu->fetch_soal_eq(),
			'jmleq' 		=> $this->model_agcu->count_eq(),
		);
		$this->load->view('pg_admin/eqtest_cetak_kunci', $data);
	}

	function daftar_soal_ls(){
		$data = array(
			'datasoal'	=> $this->model_agcu->fetch_soal_ls(),
			'jmlls' 		=> $this->model_agcu->count_ls(),
		);
		$this->load->view('pg_admin/lstest_view', $data);
	}

	function cetak_soal_ls(){
		$data = array(
			'datasoal'	=> $this->model_agcu->fetch_soal_ls(),
			'jmlls' 		=> $this->model_agcu->count_ls(),
		);
		$this->load->view('pg_admin/lstest_cetak', $data);
	}

	function cetak_kunci_ls(){
		$data = array(
			'datasoal'	=> $this->model_agcu->fetch_soal_ls(),
			'jmlls' 		=> $this->model_agcu->count_ls(),
		);
		$this->load->view('pg_admin/lstest_cetak_kunci', $data);
	}
	*/

}

?>