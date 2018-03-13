<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class User extends CI_Controller {



	public function __construct()

  {

    parent::__construct();

		//load library in construct. Construct method will be run everytime the controller is called 

		//This library will be auto-loaded in every method in this controller. 

		//So there will be no need to call the library again in each method. 

		$this->load->library('form_validation');

		$this->load->helper('alert_helper');

		$this->load->model('model_pg');

		$this->load->model('model_paket');

		$this->load->model('model_voucher');

		$this->load->model('model_pembayaran');
		
		$this->load->model('model_dashboard');
		$this->load->model('model_signup');
		$this->load->model('model_poin');
		$this->load->model('model_bonus');
		$this->load->model('model_tryout');
		$this->load->model('model_psep');
		$this->load->model('model_pr');

  }



	public function index()

	{

		$data = array(

			'infosiswa' => $this->model_dashboard->get_info_siswa($this->session->userdata('id_siswa')),	

			'navbar_links' => $this->model_pg->get_navbar_links(),

			'data_user' 	 => $this->model_pg->get_data_user($this->session->userdata('id_siswa')),

			);



		$this->load->view('pg_user/user_profil', $data);

	}



	public function ubah_profil()

	{
		$idsiswa = $this->session->userdata('id_siswa');
	
		if($idsiswa == ""){
			redirect('login');
		}
		$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
		
		$carikelas = $this->model_dashboard->get_kelas($idsiswa);
		$kelas = $carikelas->kelas;
		
		$tanggalsekarang = date('Y-m-d');
		$kelasaktif = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
		
		$skl = $this->model_signup->get_sekolah_by_kota_row($infosiswa->sekolah_id);
		$data = array(
			'infosiswa'		=> $infosiswa,
			'kotasiswa'		=> $skl->kota_id,
			'provsiswa'		=> $skl->provinsi_id,
			'kelasaktif'	=> $kelasaktif,
			'navbar_links' 	=> $this->model_pg->get_navbar_links(),
			'select_provinsi'	=> $this->model_signup->get_provinsi(),
			'select_kabupaten'	=> $this->model_signup->get_kota_by_provinsi(0),
			'select_sekolah'	=> $this->model_signup->get_sekolah_by_kota(0),
			'select_kelas'	=> $this->model_signup->cari_kelas_by_jenjang(0),
		);


		$this->load->view('pg_user/user_ubahprofil', $data);

	}




	public function do_ubah_profil()

	{

		$data = array(

			'navbar_links' => $this->model_pg->get_navbar_links(),

			'data_user' 	 => $this->model_pg->get_data_user($_SESSION['id_siswa']),

      'select_sekolah'  => $this->model_pg->fetch_all_sekolah(),

      'select_kelas'  => $this->model_pg->fetch_all_kelas()

			);



		//checking if user has logged in

		if($_SESSION['id_siswa'])  

		{

			$this->form_validation_rules('profil');

			$foto 	= $this->upload_file('foto_profil', $_SESSION['id_siswa']);

			

			if($this->form_validation->run() == TRUE)

			{

				$params = $this->input->post(null, true);

				$data_siswa = array(

								'nama_siswa' 		=> $params['namalengkap'] ? $params['namalengkap'] : '', 

								'email' 		 		=> $params['email'] ? $params['email'] : '', 

								'telepon' 	 		=> $params['nohp'] ? $params['nohp'] : '', 

								'telepon_ortu' 	=> $params['nohp_ortu'] ? $params['nohp_ortu'] : '', 

								'sekolah_id' 		=> $params['sekolah'] ? $params['sekolah'] : '', 

								'kelas' 				=> $params['kelas'] ? $params['kelas'] : '', 

								'foto' 		 	 		=> $foto ? $foto : ''

							);

				$data_login_siswa = array(

								'username' 	 => $params['pengguna'] ? $params['pengguna'] : '', 

								'password' 	 => $params['katasandi'] ? md5($params['katasandi']) : ''

							);

				

				// for testing purpose

				// echo "w/o filter:<br>";

				// print_r($data_siswa);

				// echo "<br>";

				// print_r($data_login_siswa);

				// echo "<br>";

				// echo "<br>";

				// echo "w/ filter:<br>";

				// print_r(array_filter($data_siswa));

				// echo "<br>";

				// print_r(array_filter($data_login_siswa));

				// echo "<br>";

				// echo "<pre>";

				// print_r($_SESSION);

				// echo "</pre>";

				// die();



				$result = $this->model_pg->update_data_user($_SESSION['id_siswa'], $data_siswa, $data_login_siswa);



				if($result) 

					{

						//updating session

						$session_update = array_filter($data_siswa);

						$this->session->set_userdata($session_update);



						$session_update = array_filter($data_login_siswa);

						$this->session->set_userdata($session_update);

						$this->session->unset_userdata(array('telepon', 'telepon_ortu', 'password'));

						

						alert_success('Berhasil!', 'Profil berhasil diubah'); 

					}

				else

					{ alert_error('Gagal!', 'Profil gagal diubah'); }

			}

			else

			{

				alert_error('Gagal!', 'Profil gagal diubah');

			}

		}



		redirect('user/ubah_profil');

	}



	private function form_validation_rules($form)

	{

		if($form)

		{

			switch ($form) {

				case 'beli':

					//set validation rules for each input

					// $this->form_validation->set_rules('id_bank', 'Kategori Materi', 'trim|required');

					// $this->form_validation->set_rules('no_rek', 'Mata Pelajaran', 'trim|required');

					

					//set custom error message

					// $this->form_validation->set_message('required', '%s tidak boleh kosong');

					break;



				case 'aktivasi':

					//set validation rules for each input

					$this->form_validation->set_rules('kode_aktivasi', 'Nomor Aktivasi', 'trim|required');

					$this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');

					

					//set custom error message

					$this->form_validation->set_message('required', '%s tidak boleh kosong');

					break;



				case 'profil':

					//set validation rules for each input

					$this->form_validation->set_rules('namalengkap', 'Nama Lengkap', 'trim|required');

					$this->form_validation->set_rules('email', 'Email', 'trim|required');

					$this->form_validation->set_rules('pengguna', 'Username', 'trim|required');

					$this->form_validation->set_rules('nohp', 'Telepon', 'trim|numeric');

					$this->form_validation->set_rules('nohp_ortu', 'Telepon Orang Tua', 'trim|numeric');

					$this->form_validation->set_rules('sekolah', 'Sekolah', 'trim|required');

					$this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');

					

					//set custom error message

					$this->form_validation->set_message('required', '%s tidak boleh kosong');

					break;

				

				default:

					# code...

					break;

			}

		}

	}



	private function upload_file($keperluan='', $id_siswa='')

	{

		$result 	= null;

		$config['overwrite'] = FALSE;

		switch ($keperluan) {

			case 'file_bukti':

				$tipe 			= $this->cek_tipe_upload($_FILES['file_bukti']['type']);

				$img_path		= "assets/uploads/verifikasi/";

				$img_name		= "verifikasi_".substr(sha1(substr(md5($_FILES['file_bukti']['name']),0,4).getrandmax()), 0, 7).$tipe;

				$input_name 	= 'file_bukti';

				$view 			= 'pg_user/user_bayar';

				break;



			case 'foto_profil':

				$config['overwrite'] = TRUE;

				$tipe 		 	= $this->cek_tipe($_FILES['foto']['type']);

				$img_path	 	= "assets/uploads/foto_siswa/";

				$img_name		= $id_siswa.md5(time()).$tipe;

				$input_name = 'foto';

				$view 			= 'pg_user/user_ubahprofil';

				break;

			

			default:

				$img_path  	= '';

				$img_name  	= '';

				$input_name = '';

				$view 			= '';

				break;

		}

		

		$config['upload_path']		= $img_path;

		$config['allowed_types']	= "png|jpg|pdf";

		$config['file_name']			= $img_name;



		$this->load->library('upload', $config);

		$this->upload->initialize($config);



		if (!$this->upload->do_upload($input_name)) 

		{

			$error = array('error' => $this->upload->display_errors());

			$this->load->view($view, $error);

			// $this->upload->display_errors();

		}

		else {

			$result = $img_name;
			
			if ($keperluan == 'foto_profil'){
				$this->load->library('image_lib');
				$config1['image_library'] 	= 'gd2';
				$config1['source_image'] 	= 'assets/uploads/foto_siswa/'.$result;
				$config1['new_image'] 		= 'assets/uploads/foto_siswa/'.$result;
				$config1['maintain_ratio'] 	= TRUE;
				$config1['width'] 			= 200;
				$config1['height'] 			= 300;
				$this->image_lib->initialize($config1);
				$this->image_lib->resize();
				$this->image_lib->clear();
			}
		
		}



		return $result;

	}



	private function cek_tipe($tipe)

	{

		if ($tipe == 'image/jpeg') 

			{ return ".jpg"; }

		

		else if($tipe == 'image/png') 

			{ return ".png"; }

		

		else 

			{ return false; }

	}
	
	private function cek_tipe_upload($tipe)

	{

		if ($tipe == 'image/jpeg') 

			{ return ".jpg"; }

		

		else if($tipe == 'image/png') 

			{ return ".png"; }

		else if($tipe == 'application/pdf') 

			{ return ".pdf"; }

		else 

			{ return false; }

	}



	private function cek_expired($id_pembelian)

	{

		$pembelian = $this->model_pembayaran->get_pembelian($id_pembelian);

		

		if (strtotime($pembelian->expired_on) <= strtotime(date('Y-m-d H:i:00')) && ($pembelian->status == 0)) 

		{

			//set status to "dibatalkan"

			$this->model_pembayaran->update_status("3", $id_pembelian);

		}

	}



	private function update_session_akses()

	{

		$this->load->model('model_login');

		if(isset($_SESSION['id_siswa']))

    { 

      //get user access

      $siswa_access = $this->model_login->cek_user_akses($_SESSION['id_siswa']);



      $akses_kelas = array();

      foreach ($siswa_access as $item) {

        // if (strtolower($item->tipe) == 'reguler') {

        if ($item->tipe == 0 || $item->tipe == 2) { //0 = reguler || 2 = indihome

          $akses_kelas['reguler'][] = $item->id_kelas;

        }

        // if (strtolower($item->tipe) == 'premium') {

        if ($item->tipe == 1) { //1 = premium 

          $akses_kelas['premium'][] = $item->id_kelas;

        }

      }

      // proses set session

      $this->session->set_userdata('akses', $akses_kelas);

    }

	}



	function logout()

	{

		$this->session->sess_destroy();

		redirect(base_url());

	}



	function ajax_select_kelas()

  {

    $id = $this->input->post('id', true) ? $this->input->post('id', true) : null;

    

    if($id)

    {

      $sekolah = $this->model_pg->fetch_sekolah_by_id($id);

      $dynamic_options = $this->model_pg->fetch_kelas_by_jenjang($sekolah->jenjang);



      if($dynamic_options){

        echo "<option value='' disabled selected>Pilih Kelas...</option>";

        foreach ($dynamic_options as $item) {

          echo "<option value='" . $item->id_kelas . "'> $item->alias_kelas </option>";

        }

      }

      else

      {

        echo "<option value='' disabled='disabled'>Tidak ada data</option>";

      }

    }

    else{

      return false;

    }

  }



	function dashboard(){
		$id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;
		$idsiswa = $this->session->userdata('id_siswa');
		
		if($idsiswa == ""){
			redirect('login');
		}
		$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
		
		$carikelas = $this->model_dashboard->get_kelas($idsiswa);
		$kelas = $carikelas->kelas;
		
		$akses = $this->session->userdata('akses');
		$tanggalsekarang = date('Y-m-d');
			
		$data = array(
			'infosiswa'				=> $infosiswa,
			'quote' 				=> $this->model_bonus->fetch_random_quote(), //limit = 5
			'select_provinsi'		=> $this->model_signup->get_provinsi(),
		);
		
		$this->load->view('pg_user/dashboard_user', $data);
	}

	function pilihmapel($idkelas){
		$carimapel = $this->model_dashboard->get_mapel_by_kelas($idkelas);
		foreach($carimapel as $mapel){
			echo "
				<li class='pilih' id='".$mapel->id_mapel."'><a href='#dropmapel' id='asdasdasd'>".$mapel->nama_mapel."<span class='circle' style='background-color:#e6353c;'></span></a></li>
			";
		}
	?>
	<script>
	$(function(){
		$(".pilih").click(function() {
			$("#materi").html("<img src='<?php echo base_url('assets/pg_user/images/gears.gif');?>' style='margin: 0 auto; width: 75px;' />"); 
			$("#materi").load("materi/" + $(this).attr('id'));
		});
	});
	</script>
	<?php
	}

	function lihatmapel($idkelas){
		$carimapel = $this->model_dashboard->get_mapel_by_kelas($idkelas);
		
		echo "
		<button class='btn btn-danger kembalikelas'>Kembali</button>
		<div class='col-lg-12'>
		<p>&nbsp;
		<p>&nbsp;
		</div>";
		foreach($carimapel as $mapel){
			echo "
				<div class='mapel-container'>
					<div class='content'>
							<h4>$mapel->nama_mapel</h4>
						<button class='btn btn-danger btn-pilihmapel' style='float: right; margin: 15px 0;' id='$mapel->id_mapel'>Lihat Materi</button>
					</div>
				</div>
			";
		}
	?>
	<script>
	$(function(){
		$(".btn-pilihmapel").click(function() {
			$("#materi").html("<img src='<?php echo base_url('assets/pg_user/images/gears.gif');?>' style='margin: 0 auto; width: 75px;' />"); 
			$("#materi").load("materi/" + $(this).attr('id'));
		});
		$(".kembalikelas").click(function() {
			$("#materi").html("<img src='<?php echo base_url('assets/pg_user/images/gears.gif');?>' style='margin: 0 auto; width: 75px;' />"); 
			$("#materi").load("kembalikelas");
		});
	});
	</script>
	<?php
	}


	function kembalikelas(){
		$idsiswa = $this->session->userdata('id_siswa');
		
		$tanggalsekarang = date('Y-m-d');
		
		$akses = $this->session->userdata('akses');
		
		if(array_key_exists('premium', $akses)){
			$kelasaktif = $this->model_dashboard->get_kelas_premium();
		}else{
			$kelasaktif = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
		}
		
		foreach($kelasaktif as $kelas){
		?>
			<div class="mapel-container">
				<div class="content">
						<h4><?php echo $kelas->alias_kelas;?></h4>
					<button class="btn btn-danger btn-kelas" type="submit" style="float: right; margin: 15px 0;" id="<?php echo $kelas->id_kelas;?>">Lihat Mata Pelajaran</button>
				</div>
			</div>
		<?php
		}
	?>
	<script>
	$(function(){
		$(".btn-kelas").click(function() {
			$("#materi").html("<img src='<?php echo base_url('assets/pg_user/images/gears.gif');?>' style='margin: 0 auto; width: 75px;' />"); 
			$("#materi").load("lihatmapel/" + $(this).attr('id'));
		});
	});
	</script>
	<?php
	}

	function proses_edit_profil(){
		$idsiswa = $this->session->userdata('id_siswa');
		$params = $this->input->post(null, true);
		
		$nama			= $params['nama'];
		$phone			= $params['phone'];
		$email			= $params['email'];
		$jeniskelamin	= $params['gender'];
		$alamat			= $params['alamat'];
		
		if($_FILES['foto']['name'] !== ""){
			$tipe 		 	= $this->cek_tipe($_FILES['foto']['type']);
			$img_path	 	= "assets/uploads/foto_siswa/";
			$namafile		= $idsiswa.md5(time()).$tipe;
			
			
			$config['upload_path']		= $img_path;
			$config['allowed_types']    = 'gif|jpg|png';
			$config['file_name'] 		= $namafile;
			
			$this->load->library('upload', $config);
			$this->upload->do_upload('foto');
			
			$this->load->library('image_lib');
			$config1['image_library'] 	= 'gd2';
			$config1['source_image'] 	= 'assets/uploads/foto_siswa/'.$namafile;
			$config1['new_image'] 		= 'assets/uploads/foto_siswa/'.$namafile;
			$config1['maintain_ratio'] 	= TRUE;
			$config1['width'] 			= 200;
			$config1['height'] 			= 300;
			$this->image_lib->initialize($config1);
			$this->image_lib->resize();
			$this->image_lib->clear();
					
			$edit = $this->model_dashboard->edit_profil($idsiswa, $nama, $phone, $email, $jeniskelamin, $alamat, $namafile);
			
			redirect('user');
		}else{
			$edit = $this->model_dashboard->edit_profil($idsiswa, $nama, $phone, $email, $jeniskelamin, $alamat, "");
			
			redirect('user');
		}
	}
	
	function kelasbyjenjang($jenjang){
		$carikelas = $this->model_dashboard->cari_kelas_by_jenjang($jenjang);
		
		foreach($carikelas as $kelas){
			echo "
			<option value='".$kelas->id_kelas."'>".$kelas->alias_kelas."</option>
			";
		}
	}

	function kelasbysekolah($sekolah){
		$carisekolah = $this->model_dashboard->cari_sekolah($sekolah);
		
		
		$carikelas = $this->model_dashboard->cari_kelas_by_jenjang($carisekolah->jenjang);
		
		foreach($carikelas as $kelas){
			echo "
			<option value='".$kelas->id_kelas."'>".$kelas->alias_kelas."</option>
			";
		}
	}

	function proses_edit_sekolah(){
		$idsiswa = $this->session->userdata('id_siswa');
		$params = $this->input->post(null, true);
		
		$jenis	= $params['jenis'];
		
		if($jenis == "lama"){
			$sekolah 	= $params['sekolah'];
			$kelas 		= $params['kelas'];
			
			$editsekolah = $this->model_dashboard->edit_sekolah_siswa($sekolah, $kelas, $idsiswa);
		}elseif($jenis == "baru"){
			$kota 		= $params['kota'];
			$sekolah 	= $params['sekolahbaru'];
			$jenjang 	= $params['jenjang'];
			$kelas 		= $params['kelas'];
			
			$editsekolah = $this->model_dashboard->edit_sekolah_siswa_baru($kota, $jenjang, $sekolah, $kelas, $idsiswa);
		}
		
		redirect('user');
	}
	
	function liveskor(){
		$idsiswa 	= $this->session->userdata('id_siswa');
		
		$data = array(
			'navbar_links'		=> $this->model_pg->get_navbar_links(),
			'infosiswa'			=> $this->model_dashboard->get_info_siswa($idsiswa),
			'dataprofil'		=> $this->model_dashboard->cari_profil_tryout()
		);
		
		$this->load->view('pg_user/live_skor', $data);
	}
	
	function listprofil($idprofil){
		$totalsoal		= $this->model_dashboard->total_soal_byprofil($idprofil);
		$dataperingkat 	= $this->model_dashboard->peringkat($idprofil);
		
		$no = 1;
		foreach($dataperingkat as $peringkat){
			
			$datasiswa = $this->model_dashboard->data_peringkat($peringkat->id_siswa, $idprofil);
			
			
			if(isset($peringkat->waktu_kerja)){
				$waktu = round($peringkat->waktu_kerja / 60, 2);
		?>
			<tr>
				<td><?php echo $no; ?></td>
				<td>
				<?php
				if($datasiswa->foto !== ""){
				?>
				<img src="<?php echo base_url('assets/uploads/foto_siswa/'.$datasiswa->foto); ?>" style="width: 75px;"></img>
				<?php
				}else{
				?>
				<img src="<?php echo base_url('assets/dashboard/images/profile.jpg'); ?>" style="width: 75px;"></img>
				<?php
				}
				?>
					
				</td>
				<td>
				
				<?php 
				if($peringkat->id_siswa == $this->session->userdata('id_siswa')){
					echo "<b>".$datasiswa->nama_siswa."</b>"; 
				}else{
					echo $datasiswa->nama_siswa;
				}
				?>
				</td>
				
				<td class="text-center"><?php echo $datasiswa->nama_sekolah; ?><br> <?php echo $datasiswa->nama_kota; ?> - <?php echo $datasiswa->nama_provinsi; ?></td>
				<td class="text-center"><?php echo $waktu; ?> Menit</td>
				<td class="text-center"><?php echo number_format($peringkat->jumlah_bobot_benar, 2, '.', ''); ?>
				
				</td>
				<td class="text-center"><?php echo number_format(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 2, '.', ''); ?>%</td>
			</tr>
		<?php
			}
		$no++;
		}
	}

	function listrekap($idprofil){
		$totalsoal		= $this->model_dashboard->total_soal_byprofil($idprofil);
		$dataperingkat 	= $this->model_dashboard->peringkat($idprofil);
		
		$no = 1;
		foreach($dataperingkat as $peringkat){
			
			$datasiswa = $this->model_dashboard->data_peringkat($peringkat->id_siswa, $idprofil);
			
			
			if(isset($peringkat->waktu_kerja)){
				$waktu = round($peringkat->waktu_kerja / 60, 2);
		?>
			<tr>
				<td><?php echo $no; ?></td>
				<td>
				
				<?php 
				if($peringkat->id_siswa == $this->session->userdata('id_siswa')){
					echo "<b>".$datasiswa->nama_siswa."</b>"; 
				}else{
					echo $datasiswa->nama_siswa;
				}
				?>
				</td>
				
				<td class="text-center"><?php echo $datasiswa->nama_sekolah; ?><br> <?php echo $datasiswa->nama_kota; ?> - <?php echo $datasiswa->nama_provinsi; ?></td>
				
				<?php
					$datanilai = $this->model_dashboard->rekap_nilai($idprofil, $peringkat->id_siswa);
				
					foreach($datanilai as $nilai){
					?>
						<td><?php echo number_format($nilai->jumlah_bobot_benar, 2, '.', '');?></td>
					<?php
					}
				?>
				
				<td class="text-center">
				<?php
				if($peringkat->jumlah_bobot_benar > 100){
					echo "100.00";
				}else{
					echo number_format($peringkat->jumlah_bobot_benar, 2, '.', '');
				}
				?>
				</td>
				<td class="text-center"><?php echo number_format(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 2, '.', ''); ?>%</td>
				<td class="text-center"><?php echo $waktu; ?> Menit</td>
			</tr>
		<?php
			}
		$no++;
		}
	}


	function ganti_password(){
		$idsiswa = $this->session->userdata('id_siswa');
		$params = $this->input->post(null, true);
		
		$oldpassword = $params['oldpassword'];
		$newpassword = $params['newpassword'];
		$renewpassword = $params['renewpassword'];
		
		if($newpassword == $renewpassword){
			$caripasslama = $this->model_pg->cari_password_lama($idsiswa, $oldpassword);
			if(!empty($caripasslama)){
				//echo "old password cocok";
				$this->model_pg->ganti_password($caripasslama->id_login, $newpassword);
				alert_success('Berhasil!', 'Password telah diganti');
				redirect('user/ubah_profil');
			}else{
				//echo "old password tidak cocok";
				alert_error('Gagal!', 'Password lama salah');
				redirect('user/ubah_profil');
			}	
		}else{
			alert_error('Gagal!', 'Perulangan password baru tidak sama');
			redirect('user/ubah_profil');
			//echo "perulangan tidak sama";
		}
		
	}

}

