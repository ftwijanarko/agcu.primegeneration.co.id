<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agcutest extends CI_Controller {
	public function __construct(){
		parent::__construct();
		//load library in construct. Construct method will be run everytime the controller is called 
		//This library will be auto-loaded in every method in this controller. 
		//So there will be no need to call the library again in each method. 
		$this->load->helper('alert_helper');
		$this->load->model('model_pg');
		$this->load->model('model_agcu');
		$this->load->model('model_eqtest');
		$this->load->model('model_lstest');
		$this->load->model('model_dashboard');
	}
	function index(){
		redirect('agcutest/events');
	}

	function events(){
		$idsiswa = $this->session->userdata('id_siswa');
		if($idsiswa == ""){
			redirect('login');
		}
		$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
		$carikelas = $this->model_dashboard->get_kelas($idsiswa);
		$kelas = $carikelas->kelas;
		if ($this->session->userdata('profilagcu') == NULL){
			$kode = $this->input->post('kode');
		} else {
			$kode = $this->session->userdata('profilagcu');
		}
		$getprofil = $this->model_agcu->get_profil_kode($kode);
		
		if ($getprofil == NULL){
			$this->session->set_flashdata('pesan','Kode Aktivasi yang anda masukkan sudah tidak valid');
			redirect('user/dashboard');
		} else {
			if ($this->session->userdata('profilagcu') == NULL){
				$this->session->set_userdata("profilagcu", $kode);
			}
			$idprofil = $getprofil->id_profil_master;
			$getpaketaktif = $this->model_agcu->get_paket_aktif($idsiswa,$idprofil);
			if ($getpaketaktif == '0'){
				$this->model_agcu->add_paket_aktif($idsiswa,$kode,$idprofil);
			}
						
			$kategoridiagnostic = $this->model_agcu->get_diagnosticbykelas($kelas,$idprofil);
			$datasoal = $this->model_agcu->get_jumlahsoal();
			
			foreach($kategoridiagnostic as $diagnostic){
				$idprofil = $diagnostic->id_profil;
			}

			$cek_eq = $this->model_agcu->cek_eq($idsiswa,$idprofil);
			$cek_ls = $this->model_agcu->cek_ls($idsiswa,$idprofil);
				
			if($cek_eq == 0){
				$hasileq = 0;
			}else{
				$hasileq = 1;
			}
			
			if($cek_ls == 50){
				$hasills = 1;
			}else{
				$hasills = 0;
			}
			
			$jumlahsoaldiagnostic = $this->model_agcu->get_jumlah_soal_diagnostic($kelas,$idprofil);
			
			$jumlahsoaldikerjakan = $this->model_agcu->get_jumlah_soal_diagnostic_dikerjakan($idsiswa,$idprofil);
			
			$data = array(
				'infosiswa'				=> $infosiswa,
				'navbar_links'		=> $this->model_pg->get_navbar_links(),
				'kelas'						=> $kelas,
				'hasileq'					=> $hasileq,
				'hasills'					=> $hasills,
				'jumlahsoaldiagnostic'	=> $jumlahsoaldiagnostic,
				'jumlahsoaldikerjakan'	=> $jumlahsoaldikerjakan,
				'kategoridiagnostic'		=> $kategoridiagnostic,
				'idprofil'				=> $idprofil,
				'datasoal'				=> $datasoal,
				'avail'						=> 1,
			);
		}
			
		$this->load->view('pg_user/agcu_home', $data);
	}

	function mulaieqtest($id){
		$data = array(
			'navbar_links' 	=> $this->model_pg->get_navbar_links(),
			'data_soal'		=> $this->model_eqtest->get_eqtest(),
			'idprofil'			=> $id,
		);
		
		$no = 1;
		for($i=0; $i<=24; $i++){
			$id_eq = "eq_".$no;
			if(isset($_SESSION[$id_eq])){
				unset($_SESSION[$id_eq]);
			}
		}
		
		$this->load->view('pg_user/eqtest_mulai', $data);
	}

	function mulailstest($id){
		$idsiswa = $this->session->userdata('id_siswa');
		$hapushasil = $this->model_lstest->hapus_ls($idsiswa);
		
		$data = array(
			'navbar_links' 	=> $this->model_pg->get_navbar_links(),
			'data_soal'		=> $this->model_lstest->get_lstest(),
			'idprofil'			=> $id,
		);
		
		$this->load->view('pg_user/lstest_mulai', $data);
	}

	function mulailstest2($id){
		$idsiswa = $this->session->userdata('id_siswa');
		
		$data = array(
			'navbar_links' 	=> $this->model_pg->get_navbar_links(),
			'data_soal'		=> $this->model_lstest->get_lstest2(),
			'idprofil'			=> $id,
		);
		
		
		$this->load->view('pg_user/lstest_mulai2', $data);
	}

	public function ajax_check_jawaban_eq(){
		$result 	= "No data";
		$id_soal 	= $this->input->post('id');
		$jawaban 	= $this->input->post('jawaban');
		$idsiswa = $this->session->userdata('id_siswa');
		$idprofil = $this->input->post('idprofil');
		
		if(!empty($id_soal) && !empty($jawaban)){
			$id_eq = "eq_".$id_soal;
			$_SESSION[$id_eq] = $jawaban;
			$insert = $this->model_eqtest->insert_jawaban($idsiswa, $id_soal, $jawaban, $idprofil);
			$result = "benar";
		}
		echo $result;
	}

	public function ajax_check_jawaban_ls(){
		$result 	= "No data";
		$id_soal 	= $this->input->post('id');
		$jawaban 	= $this->input->post('jawaban');
		$idsiswa = $this->session->userdata('id_siswa');
		$idprofil = $this->input->post('idprofil');
		

		$insert = $this->model_lstest->insert_skor($idsiswa, $id_soal, $jawaban, $idprofil);
		$result = "benar";
			
		echo $result;
	}

	public function penilaian_eq(){
		$submit = $_POST['submit_form_soal'];
		if(!$submit){	
			redirect($_SERVER['HTTP_REFERER']);
		}	

		$aq = $_SESSION["eq_1"]+$_SESSION["eq_4"]+$_SESSION["eq_7"]+$_SESSION["eq_10"]+$_SESSION["eq_13"]+$_SESSION["eq_16"]+$_SESSION["eq_19"]+$_SESSION["eq_22"];
		
		$eq = $_SESSION["eq_2"]+$_SESSION["eq_5"]+$_SESSION["eq_8"]+$_SESSION["eq_11"]+$_SESSION["eq_14"]+$_SESSION["eq_17"]+$_SESSION["eq_20"]+$_SESSION["eq_23"];
		
		$am = $_SESSION["eq_3"]+$_SESSION["eq_6"]+$_SESSION["eq_9"]+$_SESSION["eq_12"]+$_SESSION["eq_15"]+$_SESSION["eq_18"]+$_SESSION["eq_21"]+$_SESSION["eq_24"];
		
		$idsiswa = $this->session->userdata('id_siswa');
		
		$idprofil = $_POST['idprofil'];
		
		$insert = $this->model_eqtest->insert_skor($idsiswa, $aq, $eq, $am, $idprofil);
		
		redirect('agcutest');
	}

	public function hasillstest(){
		$idsiswa = $this->session->userdata('id_siswa');
		$skor = $this->model_lstest->skor($idsiswa);
		
		foreach($skor as $dataskor){
			$hasil[$dataskor->no] = $dataskor->skor;
		}
		
		$v1 = $hasil[11] + $hasil[12] + $hasil[13] + $hasil[14] + $hasil[15] + $hasil[16] + $hasil[17] + $hasil[18] + $hasil[19] + $hasil[20];
		
		$a1 = $hasil[21] + $hasil[22] + $hasil[23] + $hasil[24] + $hasil[25] + $hasil[26] + $hasil[27] + $hasil[28] + $hasil[29] + $hasil[30] + $hasil[31];
		
		$k1 = $hasil[21] + $hasil[22] + $hasil[23] + $hasil[24] + $hasil[25] + $hasil[26] + $hasil[27] + $hasil[28] + $hasil[29] + $hasil[30] + $hasil[31];
		
		$no = 1;
		for($i=1; $i<=50; $i++){
			if($hasil[$no] == "V"){
				if(!isset($v2)){
					$v2 = 1;
				}else{
					$v2 += 1;
				}
			}
			$no++;
		}
		
		$x = 1;
		for($i=1; $i<=50; $i++){
			if($hasil[$x] == "A"){
				if(!isset($a2)){
					$a2 = 1;
				}else{
					$a2 += 1;
				}
			}
			$x++;
		}
		
		$y = 1;
		for($i=1; $i<=50; $i++){
			if($hasil[$y] == "K"){
				if(!isset($k2)){
					$k2 = 1;
				}else{
					$k2 += 1;
				}
			}
			$y++;
		}
		
		$totalv = $v1 + $v2;
		$totala = $a1 + $a2;
		$totalk = $k1 + $k2;
		
		$karakteristikv = '';
		$karakteristika = '';
		$karakteristikk = '';
		
		
		if($totalv > $totala and $totalv > $totalk){
			$dominasi = "V";
			$karakteristik = 'Rapi dan teratur - Berbicara dengan cepat - Mampu membuat rencana dan mengatur jangka panjang dengan baik - Teliti dan rinci - Mementingkan penampilan - Lebih mudah mengingat apa yang dilihat daripada apa yang didengar - Mengingat sesuatu berdasarkan asosiasi visual - Memiliki kemampuan mengeja huruf dengan sangat baik - Biasanya tidak mudah terganggu oleh keributan atau suara berisik ketika sedang belajar - Sulit menerima instruksi verbal (oleh karena itu seringkali ia minta instruksi secara tertulis) - Merupakan pembaca yang cepat dan tekun - Lebih suka membaca daripada dibacakan - Dalam memberikan respon terhadap segala sesuatu, ia selalu bersikap waspada, membutuhkan penjelasan menyeluruh tentang tujuan dan berbagai hal lain yang berkaitan - Jika sedang berbicara di telpon ia suka membuat coretan - coretan tanpa arti selama berbicara - Lupa menyampaikan pesan verbal kepada orang lain - Sering menjawab pertanyaan dengan jawaban singkat " ya" atau "tidak” - Lebih suka mendemonstrasikan sesuatu daripada berpidato/ berceramah - Lebih tertarik pada bidang seni (lukis, pahat, gambar) dari pada musik - Sering kali mengetahui apa yang harus dikatakan, tetapi tidak pandai menulis kandalam kata - kata - Kadang-kadang kehilangan konsentrasi ketika mereka ingin memperhatikan';
			
			$saran = 'Buatlah Peta Konsep pelajaran dengan mulai dari tema besar di tengah halaman, menggunakan kata - kata penting, menggunakan simbol, warna, kata, gambar yang mencolok dan lakukan ini dengan gayamu sendiri - Dalam mencatat pelajaran, gunakan tanda - tanda, gambar dan warna untuk menandai hal - hal penting agar dapat dengan mudah dilihat lagi jika akan mempelajarinya dilain waktu - Untuk membantu mengingat apa yang baru dibaca dan didengar , duduklah dengan santai dan bayangkan dalam pikiran apa yang baru dibaca/didengar';
		}elseif($totala > $totalv and $totala > $totalk){
			$dominasi = "A";
			$karakteristik = 'Sering berbicara sendiri ketika sedang bekerja (belajar) - Mudah terganggu oleh keributan atau suara berisik - Menggerakan bibir dan menguc apkan tulisan di buku ketika membaca - Lebih senang mendengarkan (dibacakan) daripada membaca - Jika membaca maka lebih senang membaca dengan suara keras - Dapat mengulangi atau menirukan nada, irama dan warna suara - Mengalami kesulitan untuk menuliskan s esuatu, tetapi sangat pandai dalam bercerita - Berbicara dalam irama yang terpola dengan baik - berbicara dengan sangat fasih - Lebih menyukai seni musik dibandingkan seni yang lainnya - Belajar dengan mendengarkan dan mengingat apa yang didiskusikan darip ada apa yang dilihat - Senang berbicara, berdiskusi dan menjelaskan sesuatu secara panjang lebar - Mengalami kesulitan jika harus dihadapkan pada tugas - tugas yang berhubungan dengan visualisasi - Lebih pandai mengeja atau mengucapkan kata - kata dengan keras daripada menuliskannya - Lebih suka humor atau gurauan lisan daripada membaca buku humor/komik';
			
			$saran = 'Bacalah pelajaran dengan cara baca yang dramatis - Cobalah menyanyikannya dengan irama iklan atau musik - Merangkum pelajaran dengan diucapkan lantang atau direkam dalam kaset / CD dan didengarkan menggunakan walkman saat ke sekolah -  Saat membaca dengan lantang, perhatikan intonasi, penekanan khusus, cobalah berbisik dan cobalah untuk memejamkan mata untuk belajar membayangkan apa yang dibaca';
		}elseif($totalk > $totalv and $totalk > $totala){
			$dominasi = "K";
			$karakteristik = 'Berbicara dengan perlahan - Menanggapi perhatian fisik - Menyentuh orang lain untuk mendapatkan perhatian mereka - Berdiri dekat ketika sedang berbicara dengan orang lain - Banyak gerak fisik -  Memiliki perkembangan awal otot-otot yang besar - Belajar melalui praktek langsung atau manipulasi - Menghafalkan sesuatu dengan cara berjalan atau melihat langsung - Menggunakan jari untuk menunjukka apa yang dibaca ketika sedang membaca - Banyak menggunakan bahasa tubuh (non verbal) - Tidak dapat duduk diam di suatu tempat untuk waktu yang lama - Sulit membaca peta kecuali ia memang pernah ke tempat tersebut - Menggunakan ka ta - kata yang mengandung aksi - Pada umumnya tulisannya jelek - Menyukai kegiatan atau permainan yang menyibukkan (secara fisik) - Ingin melakukan segala sesuatu';
			
			$saran = 'Cobalah belajar dalam kelompok untuk membentuk suasana bermain peran dari pelajaran yang dibahas - Tulislah poin - poin penting dari pelajaran dalam bentuk kartu - kartu yang disusun secara logis -  Buatlah semacam percobaan atau model dari apa yang sedang kamu pelajari - Libatkan tubuh dalam belajar dengan mencoba meniru apa yang dipelajari dengan gaya guru saat menyampaikan materi - Setiap kali membaca atau mendengarkan seseorang berbicara, bangkitlah untuk sedikit bergerak setiap 15 - 20 menit sekali';
		}elseif($totalv == $totala and $totalv > $totalk){
			$dominasi = "VA";
			$karakteristik = 'Rapi dan teratur - Berbicara dengan c epat - Mampu membuat rencana dan mengatur jangka panjang dengan baik - Teliti dan rinci - Mementingkan penampilan - Lebih mudah mengingat apa yang dilihat daripada apa yang didengar - Mengingat sesuatu berdasarkan asosiasi visual - Memiliki kemampuan menge ja huruf dengan sangat baik - Biasanya tidak mudah terganggu oleh keributan atau suara berisik ketika sedang belajar - Sulit menerima instruksi verbal (oleh karena itu seringkali ia minta instruksi secara tertulis) - Merupakan pembaca yang cepat dan tekun - Lebih suka membaca daripada dibacakan - Dalam memberikan respon terhadap segala sesuatu, ia selalu bersikap waspada , membutuhkan penjelasan menyeluruh tentang tujuan dan berbagai hal lain yang berkaitan - Jika sedang berbicara di telpon ia suka membuat c oretan - coretan tanpa arti selama berbicara - Lupa menyampaikan pesan verbal kepada orang lain - Sering menjawab pertanyaan dengan jawaban singkat "ya" atau "tidak” - Lebih suka mendemonstrasikan sesuatu daripada berpidato/ berceramah - Lebih tertarik pada bidang seni (lukis, pahat, gambar) dari pada musik - Sering kali menegtahui apa yang harus dikatakan, tetapi tidak pandai menuliskan dalam kata - kata - Kadang - kadang kehilangan konsentrasi ketika mereka ingin memperhatikan - Sering berbicara sendiri ketika sedang bekerja (belajar) - Mudah terganggu oleh keributan atau suara berisik - Menggerakan bibir dan mengucapkan tulisan di buku ketika membaca - Lebih senang mendengarkan (dibacakan) daripada membaca - Jika membaca maka lebih senang membaca dengan suara k eras - Dapat mengulangi atau menirukan nada, irama dan warna suara - Mengalami kesulitan untuk menuliskan sesuatu, tetapi sangat pandai dalam bercerita - Berbicara dalam irama yang terpola dengan baik - berbicara dengan sangat fasih - Lebih menyukai seni m usik dibandingkan seni yang lainnya - Belajar dengan mendengarkan dan mengingat apa yang didiskusikan daripada apa yang dilihat - Senang berbicara, berdiskusi dan menjelaskan sesuatu secara panjang lebar - Mengalami kesulitan jika harus dihadapkan pada tug as - tugas yang berhubungan dengan visualisasi - Lebih pandai mengeja atau mengucapkan kata - kata dengan keras daripada menuliskannya - Lebih suka humor atau gurauan lisan daripada membaca buku humor/komik.';
			
			$saran = 'Buatlah Peta Konsep pelajaran dengan mulai dari tema besar di tengah halaman, menggunakan kata - kata penting, menggunakan simbol, warna, kata, gambar yang mencolok dan lakukan ini dengan gayamu sendiri - Dalam mencatat pelajaran, gunakan tanda - tanda, gambar dan warna untuk menandai hal - hal penting agar dapat dengan mudah dilihat lagi jika akan mempelajarinya dilain waktu - Untuk membantu mengingat apa yang baru dibaca dan didengar , duduklah dengan santai dan bayangkan dalam pikiran apa yang baru dibaca/didengar - Bacalah pelajaran dengan cara baca yang dramatis - Cobalah menyanyikannya dengan irama iklan atau musik - Merangkum pelajaran dengan diucapkan lantang atau direkam dalam kaset / CD dan didengarkan menggunakan walkman saat ke sekolah -  Saat membaca dengan lantang, perhatikan intonasi, penekanan khusus, cobalah berbisik dan cobalah untuk memejamkan mata untuk belajar membayangkan apa yang dibaca';
		}elseif($totalv == $totalk and $totalv > $totala){
			$dominasi = "VK";
			$karakteristik = 'Rapi dan teratur - Berbicara dengan cepat - Mampu membuat rencana dan mengatur jangka panjang dengan baik - Teliti dan rinci - Mementingkan penampilan - Lebih mudah mengingat apa yang dilihat daripada apa yang didengar - Mengingat sesuatu berdasarkan asosiasi visual - Memiliki kemampuan mengeja huruf dengan sangat baik - Biasanya tidak mudah terganggu oleh keributan atau suara berisik ketika sedang belajar - Sulit menerima instruksi verbal (oleh karena itu seringkali ia minta instruksi secara tertulis) - Merupakan pembaca yang cepat dan tekun - Lebih suka membaca daripada dibacakan - Dalam memberikan respon terhadap segala sesuatu, ia selalu bersikap waspada, membutuhkan penjelasan menyeluruh tentang tujuan dan berbagai hal lain yang berkaitan - Jika sedang berbicara di telpon ia suka membuat coretan - coretan tanpa arti selama berbicara - Lupa menyampaikan pesan verbal kepada orang lain - Sering menjawab pertanyaan dengan jawaban singkat " ya" atau "tidak” - Lebih suka mendemonstrasikan sesuatu daripada berpidato/ berceramah - Lebih tertarik pada bidang seni (lukis, pahat, gambar) dari pada musik - Sering kali mengetahui apa yang harus dikatakan, tetapi tidak pandai menulis kandalam kata - kata - Kadang-kadang kehilangan konsentrasi ketika mereka ingin memperhatikan - Berbicara dengan perlahan - Menanggapi perhatian fisik - Menyentuh orang lain untuk mendapatkan perhatian mereka - Berdiri dekat ketika sedang berbicara dengan orang lain - Banyak gerak fisik -  Memiliki perkembangan awal otot-otot yang besar - Belajar melalui praktek langsung atau manipulasi - Menghafalkan sesuatu dengan cara berjalan atau melihat langsung - Menggunakan jari untuk menunjukka apa yang dibaca ketika sedang membaca - Banyak menggunakan bahasa tubuh (non verbal) - Tidak dapat duduk diam di suatu tempat untuk waktu yang lama - Sulit membaca peta kecuali ia memang pernah ke tempat tersebut - Menggunakan ka ta - kata yang mengandung aksi - Pada umumnya tulisannya jelek - Menyukai kegiatan atau permainan yang menyibukkan (secara fisik) - Ingin melakukan segala sesuatu';
			
			$saran = 'Buatlah Peta Konsep pelajaran dengan mulai dari tema besar di tengah halaman, menggunakan kata - kata penting, menggunakan simbol, warna, kata, gambar yang mencolok dan lakukan ini dengan gayamu sendiri - Dalam mencatat pelajaran, gunakan tanda - tanda, gambar dan warna untuk menandai hal - hal penting agar dapat dengan mudah dilihat lagi jika akan mempelajarinya dilain waktu - Untuk membantu mengingat apa yang baru dibaca dan didengar , duduklah dengan santai dan bayangkan dalam pikiran apa yang baru dibaca/didengar - Cobalah belajar dalam kelompok untuk membentuk suasana bermain peran dari pelajaran yang dibahas - Tulislah poin - poin penting dari pelajaran dalam bentuk kartu - kartu yang disusun secara logis -  Buatlah semacam percobaan atau model dari apa yang sedang kamu pelajari - Libatkan tubuh dalam belajar dengan mencoba meniru apa yang dipelajari dengan gaya guru saat menyampaikan materi - Setiap kali membaca atau mendengarkan seseorang berbicara, bangkitlah untuk sedikit bergerak setiap 15 - 20 menit sekali';
		}elseif($totala == $totalk and $totala > $totalv){
			$dominasi = "AK";
			$karakteristik = 'Sering berbicara sendiri ketika sedang bekerja (belajar) - Mudah terganggu oleh keributan atau suara berisik - Menggerakan bibir dan menguc apkan tulisan di buku ketika membaca - Lebih senang mendengarkan (dibacakan) daripada membaca - Jika membaca maka lebih senang membaca dengan suara keras - Dapat mengulangi atau menirukan nada, irama dan warna suara - Mengalami kesulitan untuk menuliskan s esuatu, tetapi sangat pandai dalam bercerita - Berbicara dalam irama yang terpola dengan baik - berbicara dengan sangat fasih - Lebih menyukai seni musik dibandingkan seni yang lainnya - Belajar dengan mendengarkan dan mengingat apa yang didiskusikan darip ada apa yang dilihat - Senang berbicara, berdiskusi dan menjelaskan sesuatu secara panjang lebar - Mengalami kesulitan jika harus dihadapkan pada tugas - tugas yang berhubungan dengan visualisasi - Lebih pandai mengeja atau mengucapkan kata - kata dengan keras daripada menuliskannya - Lebih suka humor atau gurauan lisan daripada membaca buku humor/komik - Berbicara dengan perlahan - Menanggapi perhatian fisik - Menyentuh orang lain untuk mendapatkan perhatian mereka - Berdiri dekat ketika sedang berbicara dengan orang lain - Banyak gerak fisik -  Memiliki perkembangan awal otot-otot yang besar - Belajar melalui praktek langsung atau manipulasi - Menghafalkan sesuatu dengan cara berjalan atau melihat langsung - Menggunakan jari untuk menunjukka apa yang dibaca ketika sedang membaca - Banyak menggunakan bahasa tubuh (non verbal) - Tidak dapat duduk diam di suatu tempat untuk waktu yang lama - Sulit membaca peta kecuali ia memang pernah ke tempat tersebut - Menggunakan ka ta - kata yang mengandung aksi - Pada umumnya tulisannya jelek - Menyukai kegiatan atau permainan yang menyibukkan (secara fisik) - Ingin melakukan segala sesuatu';
			
			$saran = 'Bacalah pelajaran dengan cara baca yang dramatis - Cobalah menyanyikannya dengan irama iklan atau musik - Merangkum pelajaran dengan diucapkan lantang atau direkam dalam kaset / CD dan didengarkan menggunakan walkman saat ke sekolah -  Saat membaca dengan lantang, perhatikan intonasi, penekanan khusus, cobalah berbisik dan cobalah untuk memejamkan mata untuk belajar membayangkan apa yang dibaca - Cobalah belajar dalam kelompok untuk membentuk suasana bermain peran dari pelajaran yang dibahas - Tulislah poin - poin penting dari pelajaran dalam bentuk kartu - kartu yang disusun secara logis -  Buatlah semacam percobaan atau model dari apa yang sedang kamu pelajari - Libatkan tubuh dalam belajar dengan mencoba meniru apa yang dipelajari dengan gaya guru saat menyampaikan materi - Setiap kali membaca atau mendengarkan seseorang berbicara, bangkitlah untuk sedikit bergerak setiap 15 - 20 menit sekali';
		}elseif($totalv == $totala and $totalv == $totalk){
			$dominasi = "VAK";
			$karakteristik = 'Rapi dan teratur - Berbicara dengan c epat - Mampu membuat rencana dan mengatur jangka panjang dengan baik - Teliti dan rinci - Mementingkan penampilan - Lebih mudah mengingat apa yang dilihat daripada apa yang didengar - Mengingat sesuatu berdasarkan asosiasi visual - Memiliki kemampuan menge ja huruf dengan sangat baik - Biasanya tidak mudah terganggu oleh keributan atau suara berisik ketika sedang belajar - Sulit menerima instruksi verbal (oleh karena itu seringkali ia minta instruksi secara tertulis) - Merupakan pembaca yang cepat dan tekun - Lebih suka membaca daripada dibacakan - Dalam memberikan respon terhadap segala sesuatu, ia selalu bersikap waspada , membutuhkan penjelasan menyeluruh tentang tujuan dan berbagai hal lain yang berkaitan - Jika sedang berbicara di telpon ia suka membuat c oretan - coretan tanpa arti selama berbicara - Lupa menyampaikan pesan verbal kepada orang lain - Sering menjawab pertanyaan dengan jawaban singkat "ya" atau "tidak” - Lebih suka mendemonstrasikan sesuatu daripada berpidato/ berceramah - Lebih tertarik pada bidang seni (lukis, pahat, gambar) dari pada musik - Sering kali menegtahui apa yang harus dikatakan, tetapi tidak pandai menuliskan dalam kata - kata - Kadang - kadang kehilangan konsentrasi ketika mereka ingin memperhatikan<br>
			Sering berbicara sendiri ketika sedang bekerja (belajar) - Mudah terganggu oleh keributan atau suara berisik - Menggerakan bibir dan mengucapkan tulisan di buku ketika membaca - Lebih senang mendengarkan (dibacakan) daripada membaca - Jika membaca maka lebih senang membaca dengan suara k eras - Dapat mengulangi atau menirukan nada, irama dan warna suara - Mengalami kesulitan untuk menuliskan sesuatu, tetapi sangat pandai dalam bercerita - Berbicara dalam irama yang terpola dengan baik - berbicara dengan sangat fasih - Lebih menyukai seni m usik dibandingkan seni yang lainnya - Belajar dengan mendengarkan dan mengingat apa yang didiskusikan daripada apa yang dilihat - Senang berbicara, berdiskusi dan menjelaskan sesuatu secara panjang lebar - Mengalami kesulitan jika harus dihadapkan pada tug as - tugas yang berhubungan dengan visualisasi - Lebih pandai mengeja atau mengucapkan kata - kata dengan keras daripada menuliskannya - Lebih suka humor atau gurauan lisan daripada membaca buku humor/komik.<br>
			Berbicara dengan perlahan - Menanggapi perhatian fisik - Menyentuh orang lain untuk mendapatkan perhatian mereka - Berdiri dekat ketika sedang berbicara dengan orang lain - Banyak gerak fisik -  Memiliki perkembangan awal otot-otot yang besar - Belajar melalui praktek langsung atau manipulasi - Menghafalkan sesuatu dengan cara berjalan atau melihat langsung - Menggunakan jari untuk menunjukka apa yang dibaca ketika sedang membaca - Banyak menggunakan bahasa tubuh (non verbal) - Tidak dapat duduk diam di suatu tempat untuk waktu yang lama - Sulit membaca peta kecuali ia memang pernah ke tempat tersebut - Menggunakan ka ta - kata yang mengandung aksi - Pada umumnya tulisannya jelek - Menyukai kegiatan atau permainan yang menyibukkan (secara fisik) - Ingin melakukan segala sesuatu';
			
			$saran = 'Buatlah Peta Konsep pelajaran dengan mulai dari tema besar di tengah halaman, menggunakan kata - kata penting, menggunakan simbol, warna, kata, gambar yang mencolok dan lakukan ini dengan gayamu sendiri - Dalam mencatat pelajaran, gunakan tanda - tanda, gambar dan warna untuk menandai hal - hal penting agar dapat dengan mudah dilihat lagi jika akan mempelajarinya dilain waktu - Untuk membantu mengingat apa yang baru dibaca dan didengar , duduklah dengan santai dan bayangkan dalam pikiran apa yang baru dibaca/didengar<br>
			Bacalah pelajaran dengan cara baca yang dramatis - Cobalah menyanyikannya dengan irama iklan atau musik - Merangkum pelajaran dengan diucapkan lantang atau direkam dalam kaset / CD dan didengarkan menggunakan walkman saat ke sekolah -  Saat membaca dengan lantang, perhatikan intonasi, penekanan khusus, cobalah berbisik dan cobalah untuk memejamkan mata untuk belajar membayangkan apa yang dibaca<br>
			Cobalah belajar dalam kelompok untuk membentuk suasana bermain peran dari pelajaran yang dibahas - Tulislah poin - poin penting dari pelajaran dalam bentuk kartu - kartu yang disusun secara logis -  Buatlah semacam percobaan atau model dari apa yang sedang kamu pelajari - Libatkan tubuh dalam belajar dengan mencoba meniru apa yang dipelajari dengan gaya guru saat menyampaikan materi - Setiap kali membaca atau mendengarkan seseorang berbicara, bangkitlah untuk sedikit bergerak setiap 15 - 20 menit sekali';
		}
		
		$data = array(
			'navbar_links'	=> $this->model_pg->get_navbar_links(),
			'totalv' 		=> $totalv,
			'totala' 		=> $totala,
			'totalk' 		=> $totalk,
			'dominasi'		=> $dominasi,
			'karakteristik'	=> $karakteristik,
			'saran'			=> $saran
		);
		
		$this->load->view('pg_user/hasil_ls', $data);
	}

	function hasileqtest(){
		
		$idsiswa = $this->session->userdata('id_siswa');
		
		$data_eq = $this->model_agcu->get_eq($idsiswa);
		
		if($data_eq->skor_aq < 7){
			$analisis_aq = "Mudah gelisah, bingung dan sering cemas - Sering kehilangan rasa humor - Menyalahkan diri sendiri terhadap berbagai kegagalan - Analisisnya dangkal ";
		}elseif($data_eq->skor_aq <= 11){
			$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan cenderung kurang berkembang - Mudah kehilangan ketenangan - Sering kecewa terhadap kesalahan sendiri - Mudah kehilangan keseimbangan emosi ";
		}elseif($data_eq->skor_aq <= 21){
			$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan cenderung berkembang - Peningkatan daya tahan emosi tergantung lingkungan - Perlu melatih ketenangan ";
		}elseif($data_eq->skor_aq <= 26){
			$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan cukup baik - Terkadang menyerah tapi jarang mengalami kebingungan - Mempunyai ketenangan yang tidak mudah goyah - Tetap mampu mengambil keputusan yang akurat";
		}elseif($data_eq->skor_aq <= 32){
			$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan sangat tinggi - Tidak akan stress kecuali kondisi sangat tragis - Mempunyai ketenangan yang sangat kuat - Tetap berorientasi pada tujuan";
		}
		
		if($data_eq->skor_eq < 7){
			$analisis_eq = "Tidak mampu memahami dinamika kelompok - Kesulitan memahami perasaan orang lain - Kurang kemauan untuk membantu kesulitan orang lain - Sering tegang menghadapi tekanan ";
		}elseif($data_eq->skor_eq <= 11){
			$analisis_eq = "Cenderung menolak perubahan - Kurang mampu mengendalikan perasaan - Cenderung egois - Selalu mengambil untung di setiap kesempatan - Kurang luwes dalam bergaul ";
		}elseif($data_eq->skor_eq <= 21){
			$analisis_eq = "Memiliki keterbukaan terhadap perubahan lingkungan - Memiliki semangat yang cukup baik - Mampu mendeteksi perasaan dan perspektif orang lain ";
		}elseif($data_eq->skor_eq <= 26){
			$analisis_eq = "Mampu menyemangati dirinya dan orang lain - Memiliki toleransi terhadap kekurangan orang lain - Mampu memelihara norma kejujuran dan integritas - Memiliki teknik persuasi yang baik ";
		}elseif($data_eq->skor_eq <= 32){
			$analisis_eq = "Memiliki rasa empati yang tinggi pada kesulitan orang lain - Mempu mengendalikan perasaannya - memiliki semangat yang tinggi dalam kondisi apapun";
		}
		
		if($data_eq->skor_am < 7){
			$analisis_am = "Tidak ada kemauan untuk berprestasi - Merasa yakin bahwa prestasinya selama ini sudah cukup - Tidak pernah instrospeksi diri ";
		}elseif($data_eq->skor_am <= 11){
			$analisis_am = "Jarang mendapatkan atau menginginkan prestasi tertentu - Tidak ada semangat bersaing - Biasanya menginginkan hasil seketika - Biasanya menjadi trouble maker";
		}elseif($data_eq->skor_am <= 21){
			$analisis_am = "Tidak ada prestasi yang istimewa - Kurang semangat bersaing - Cepat puas terhadap hasil yang diperoleh - Hanya berorientasi pada melaksanakan instruksi dengan benar ";
		}elseif($data_eq->skor_am <= 26){
			$analisis_am = "Memiliki kecenderungan high achiever dan rasa percaya diri cukup - Memiliki misi yang jelas dan terukur - Mampu memberi penghargaan terhadap hasil karya orang lain ";
		}elseif($data_eq->skor_am <= 32){
			$analisis_am = "High achiever, penuh rasa percaya diri dan optimis - Punya misi yang jelas untuk jangka panjang - Memiliki apresiasi yang tinggi terhadap hasil karya orang lain";
		}
		
		$data = array(
			'navbar_links'	=> $this->model_pg->get_navbar_links(),
			'data_eq'		=> $this->model_agcu->get_eq($idsiswa),
			'analisis_aq'	=> $analisis_aq,
			'analisis_eq'	=> $analisis_eq,
			'analisis_am'	=> $analisis_am
		);
		
		$this->load->view('pg_user/hasil_eq', $data);
	}

	function diagnostictest(){
		$idsiswa = $this->session->userdata('id_siswa');
		if($idsiswa == ""){
			redirect("login");
		}
		$carikelas = $this->model_dashboard->get_kelas($idsiswa);
		$kelas = $carikelas->kelas;
		$kategoridiagnostic = $this->model_agcu->get_diagnosticbykelas($kelas);
		$datasoal = $this->model_agcu->get_jumlahsoal();
		
		$data = array(
			'navbar_links'	=> $this->model_pg->get_navbar_links(),
			'kategoridiagnostic'	=> $kategoridiagnostic,
			'datasoal'				=> $datasoal
		);
		
		
		$this->load->view('pg_user/diagnostictest_home', $data);
	}

	function mulaidiagnostic($iddiagnostic){
		$idsiswa		= $this->session->userdata('id_siswa');
		$cariwaktu = $this->model_agcu->cari_waktu($iddiagnostic, $idsiswa);
		
		$terjawab 		= $this->model_agcu->cari_terjawab($iddiagnostic, $idsiswa);
		if($cariwaktu !== 0){
			if(isset($terjawab)){
				$data = array(
					'navbar_links'	=> $this->model_pg->get_navbar_links(),
					'data_soal'		=> $this->model_agcu->fetch_soal_by_diagnostic($iddiagnostic),
					'durasi'		=> $this->model_agcu->get_timer($iddiagnostic),
					'elapsed_time'	=> $this->model_agcu->cari_waktu($iddiagnostic, $idsiswa),
					'terjawab'		=> $terjawab
				);
			}else{
				$data = array(
					'navbar_links'	=> $this->model_pg->get_navbar_links(),
					'data_soal'		=> $this->model_agcu->fetch_soal_by_diagnostic($iddiagnostic),
					'durasi'		=> $this->model_agcu->get_timer($iddiagnostic),
					'elapsed_time'	=> $this->model_agcu->cari_waktu($iddiagnostic, $idsiswa)
				);
			}
		}else{
			$data = array(
				'navbar_links'	=> $this->model_pg->get_navbar_links(),
				'data_soal'		=> $this->model_agcu->fetch_soal_by_diagnostic($iddiagnostic),
				'durasi'		=> $this->model_agcu->get_timer($iddiagnostic)
			);
		}
		
		$idsiswa = $this->session->userdata('id_siswa');
		if($idsiswa == ""){
			redirect("login");
		}
		
		
		if(isset($_SESSION['benar'])){
			unset($_SESSION['benar']);
		}
		if(isset($_SESSION['salah'])){
			unset($_SESSION['salah']);
		}
		//set session kategori_tryout
		if(isset($_SESSION['id_kategori'])){
			unset($_SESSION['id_kategori']);
		}
		$_SESSION['id_diagnostic'] = $iddiagnostic;
		
		$id_kelas = $this->model_agcu->get_mapel_by_diagnostic($iddiagnostic);
		

		$session = array(
			'data_latihan' => array(
				'sedang_mengerjakan' 	=> true,
				'skor'					=> 0,
				'id_materi'				=> $iddiagnostic,
			),
			'kunci_soal' => $this->model_agcu->fetch_array_id_soal($iddiagnostic) 
			);
		$this->session->set_userdata($session);
		session_write_close();


		$this->load->view('pg_user/diagnostic_mulai', $data);
	}

	function penilaian(){
		$iddiagnostic 	= $_SESSION['id_diagnostic'];
		$idsiswa		= $this->session->userdata('id_siswa');
		
		if($iddiagnostic == ""){
			redirect('diagnostictest');
		}
		$jumlahsoal  = $this->model_agcu->cari_jumlahsoal_by_diagnostic($iddiagnostic, $idsiswa);
		
		$jumlahbenar = $this->model_agcu->cari_diagnostic_benar_by_diagnostic($iddiagnostic, $idsiswa);
		
		$jumlahsalah = $this->model_agcu->cari_diagnostic_salah_by_diagnostic($iddiagnostic, $idsiswa);
		
		$cariketuntasan = $this->model_agcu->get_diagnosticbyid($iddiagnostic);
		$ketuntasan = $cariketuntasan->ketuntasan;
		
		$skor = round(($jumlahbenar / $jumlahsoal) * 100,2);
		
		if($skor >= $ketuntasan){
			$tuntas = 1;
		}elseif($skor < $ketuntasan){
			$tuntas = 0;
		}
		
		$data = array(
			'navbar_links' 	=> $this->model_pg->get_navbar_links(),
			'skor' 		=> $skor,
			'tuntas'	=> $tuntas
		);
		unset($_SESSION['id_diagnostic']);
		
		$this->load->view('pg_user/diagnostic_selesai', $data);
		
	}

	function hasil_diagnostic(){
		$idsiswa = $this->session->userdata('id_siswa');
		if($idsiswa == ""){
			redirect("login");
		}
		
		$carikelas = $this->model_dashboard->get_kelas($idsiswa);
		$kelas = $carikelas->kelas;
		
		$kategoridiagnostic = $this->model_agcu->get_diagnosticbykelas($kelas);
		$datasoal = $this->model_agcu->get_jumlahsoal();
		
		$jumlahbenar = $this->model_agcu->get_jumlah_benar($idsiswa);
		
		$jumlahhasil = $this->model_agcu->get_jumlah_hasil();
		$jumlahbenarhasil = $this->model_agcu->get_jumlah_benar_hasil();
		
		$analisistopik = $this->model_agcu->get_analisis_topik($idsiswa);
		$data = array(
			'navbar_links'			=> $this->model_pg->get_navbar_links(),
			'kategoridiagnostic'	=> $kategoridiagnostic,
			'datasoal'				=> $datasoal,
			'jumlahbenar'			=> $jumlahbenar,
			'jumlahhasil'			=> $jumlahhasil,
			'jumlahbenarhasil'		=> $jumlahbenarhasil,
			'analisistopik'			=> $analisistopik
		);
		$this->load->view('pg_user/hasil_diagnostic', $data);
	}

	public function transformTime($min){
	$ctime = DateTime::createFromFormat('i', $min);
	$ntime= $ctime->format('H:i:s');
	return $ntime;
	}

	function average_time($total, $count, $rounding = 0) {
			$total = explode(":", strval($total));
			if (count($total) !== 3) return false;
			$sum = $total[0]*60*60 + $total[1]*60 + $total[2];
			$average = $sum/(float)$count;
			$hours = floor($average/3600);
			$minutes = floor(fmod($average,3600)/60);
			$seconds = number_format(fmod(fmod($average,3600),60),(int)$rounding);
			return $hours.":".$minutes.":".$seconds;
	}


	public function ajax_check_jawaban(){
		$result 	= "No data";
		$id_soal 	= $this->input->post('id');
		$jawaban 	= $this->input->post('jawaban');
		$idkategori = $_SESSION['id_diagnostic'];
		
		$idsiswa = $this->session->userdata('id_siswa');

		if(!empty($id_soal) && !empty($jawaban)){
			$kunci_soal = $this->session->userdata('kunci_soal');
			foreach ($kunci_soal as $item){
				if($item['id_banksoal'] == $id_soal){
					
					if($item['kunci'] == $jawaban){
						if(!isset($_SESSION['benar'])){
							$_SESSION['benar'] = 1;
						}else{
							$benar = $_SESSION['benar'];
							$_SESSION['benar'] = $benar + 1;
						}
						$result = "benar";

						//input analisis topik
						$carihasildiagnostic = $this->model_agcu->carihasildiagnostic($idkategori, $idsiswa, $id_soal);

						if($carihasildiagnostic > 0){
							$edithasildiagnostic = $this->model_agcu->edithasildiagnostic($idkategori, $idsiswa, $id_soal, 1, $jawaban);
						}else{
							$inputhasildiagnostic = $this->model_agcu->inputhasildiagnostic($idkategori, $idsiswa, $id_soal, 1, $jawaban);
						}

					}else{
						$result = "salah";
						if(!isset($_SESSION['salah'])){
							$_SESSION['salah'] = 1;
						}else{
							$salah = $_SESSION['salah'];
							$_SESSION['salah'] = $salah + 1;
						}

						//input analisis topik
						$carihasildiagnostic = $this->model_agcu->carihasildiagnostic($idkategori, $idsiswa, $id_soal);

						if($carihasildiagnostic > 0){
							$edithasildiagnostic = $this->model_agcu->edithasildiagnostic($idkategori, $idsiswa, $id_soal, 0, $jawaban);
						}else{
							$inputhasildiagnostic = $this->model_agcu->inputhasildiagnostic($idkategori, $idsiswa, $id_soal, 0, $jawaban);
						}


					}
				}

			}
		}
		echo $result;
	}

	function statistik($idprofil){
		$idsiswa = $this->session->userdata('id_siswa');
		if($idsiswa == ""){
			redirect('login');
		}
		
		$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
		$carikelas = $this->model_dashboard->get_kelas($idsiswa);
		$kelas = $carikelas->kelas;
		
		$kategoridiagnostic = $this->model_agcu->get_diagnosticbykelas($kelas,$idprofil);
		$datasoal = $this->model_agcu->get_jumlahsoal();
		
		$jumlahbenar = $this->model_agcu->get_jumlah_benar($idsiswa);
		
		$jumlahhasil = $this->model_agcu->get_jumlah_hasil();
		$jumlahbenarhasil = $this->model_agcu->get_jumlah_benar_hasil();
		
		$analisistopik = $this->model_agcu->get_analisis_topik($idsiswa);
		
		
		$skor = $this->model_lstest->skor($idsiswa,$idprofil);
		$hasildiagnostic = $this->model_agcu->get_ordered_hasildiagnostic();
		$peringkatsiswa = $this->model_agcu->get_peringkatsiswabykelas($kelas,$idprofil);
		
		foreach($skor as $dataskor){
			$hasil[$dataskor->no] = $dataskor->skor;
		}
		
		$v1 = $hasil[11] + $hasil[12] + $hasil[13] + $hasil[14] + $hasil[15] + $hasil[16] + $hasil[17] + $hasil[18] + $hasil[19] + $hasil[20];
		
		$a1 = $hasil[21] + $hasil[22] + $hasil[23] + $hasil[24] + $hasil[25] + $hasil[26] + $hasil[27] + $hasil[28] + $hasil[29] + $hasil[30] + $hasil[31];
		
		$k1 = $hasil[21] + $hasil[22] + $hasil[23] + $hasil[24] + $hasil[25] + $hasil[26] + $hasil[27] + $hasil[28] + $hasil[29] + $hasil[30] + $hasil[31];
		
		$no = 1;
		for($i=1; $i<=50; $i++){
			if($hasil[$no] == "V"){
				if(!isset($v2)){
					$v2 = 1;
				}else{
					$v2 += 1;
				}
			}
			$no++;
		}
		
		$x = 1;
		for($i=1; $i<=50; $i++){
			if($hasil[$x] == "A"){
				if(!isset($a2)){
					$a2 = 1;
				}else{
					$a2 += 1;
				}
			}
			$x++;
		}
		
		$y = 1;
		for($i=1; $i<=50; $i++){
			if($hasil[$y] == "K"){
				if(!isset($k2)){
					$k2 = 1;
				}else{
					$k2 += 1;
				}
			}
			$y++;
		}
		
		$totalv = $v1 + $v2;
		$totala = $a1 + $a2;
		$totalk = $k1 + $k2;
		
		$karakteristikv = '';
		$karakteristika = '';
		$karakteristikk = '';
		
		
		if($totalv > $totala and $totalv > $totalk){
			$dominasi = "V";
			$karakteristik = 'Rapi dan teratur - Berbicara dengan cepat - Mampu membuat rencana dan mengatur jangka panjang dengan baik - Teliti dan rinci - Mementingkan penampilan - Lebih mudah mengingat apa yang dilihat daripada apa yang didengar - Mengingat sesuatu berdasarkan asosiasi visual - Memiliki kemampuan mengeja huruf dengan sangat baik - Biasanya tidak mudah terganggu oleh keributan atau suara berisik ketika sedang belajar - Sulit menerima instruksi verbal (oleh karena itu seringkali ia minta instruksi secara tertulis) - Merupakan pembaca yang cepat dan tekun - Lebih suka membaca daripada dibacakan - Dalam memberikan respon terhadap segala sesuatu, ia selalu bersikap waspada, membutuhkan penjelasan menyeluruh tentang tujuan dan berbagai hal lain yang berkaitan - Jika sedang berbicara di telpon ia suka membuat coretan - coretan tanpa arti selama berbicara - Lupa menyampaikan pesan verbal kepada orang lain - Sering menjawab pertanyaan dengan jawaban singkat " ya" atau "tidak” - Lebih suka mendemonstrasikan sesuatu daripada berpidato/ berceramah - Lebih tertarik pada bidang seni (lukis, pahat, gambar) dari pada musik - Sering kali mengetahui apa yang harus dikatakan, tetapi tidak pandai menulis kandalam kata - kata - Kadang-kadang kehilangan konsentrasi ketika mereka ingin memperhatikan';
			
			$saran = 'Buatlah Peta Konsep pelajaran dengan mulai dari tema besar di tengah halaman, menggunakan kata - kata penting, menggunakan simbol, warna, kata, gambar yang mencolok dan lakukan ini dengan gayamu sendiri - Dalam mencatat pelajaran, gunakan tanda - tanda, gambar dan warna untuk menandai hal - hal penting agar dapat dengan mudah dilihat lagi jika akan mempelajarinya dilain waktu - Untuk membantu mengingat apa yang baru dibaca dan didengar , duduklah dengan santai dan bayangkan dalam pikiran apa yang baru dibaca/didengar';
		}elseif($totala > $totalv and $totala > $totalk){
			$dominasi = "A";
			$karakteristik = 'Sering berbicara sendiri ketika sedang bekerja (belajar) - Mudah terganggu oleh keributan atau suara berisik - Menggerakan bibir dan menguc apkan tulisan di buku ketika membaca - Lebih senang mendengarkan (dibacakan) daripada membaca - Jika membaca maka lebih senang membaca dengan suara keras - Dapat mengulangi atau menirukan nada, irama dan warna suara - Mengalami kesulitan untuk menuliskan s esuatu, tetapi sangat pandai dalam bercerita - Berbicara dalam irama yang terpola dengan baik - berbicara dengan sangat fasih - Lebih menyukai seni musik dibandingkan seni yang lainnya - Belajar dengan mendengarkan dan mengingat apa yang didiskusikan darip ada apa yang dilihat - Senang berbicara, berdiskusi dan menjelaskan sesuatu secara panjang lebar - Mengalami kesulitan jika harus dihadapkan pada tugas - tugas yang berhubungan dengan visualisasi - Lebih pandai mengeja atau mengucapkan kata - kata dengan keras daripada menuliskannya - Lebih suka humor atau gurauan lisan daripada membaca buku humor/komik';
			
			$saran = 'Bacalah pelajaran dengan cara baca yang dramatis - Cobalah menyanyikannya dengan irama iklan atau musik - Merangkum pelajaran dengan diucapkan lantang atau direkam dalam kaset / CD dan didengarkan menggunakan walkman saat ke sekolah -  Saat membaca dengan lantang, perhatikan intonasi, penekanan khusus, cobalah berbisik dan cobalah untuk memejamkan mata untuk belajar membayangkan apa yang dibaca';
		}elseif($totalk > $totalv and $totalk > $totala){
			$dominasi = "K";
			$karakteristik = 'Berbicara dengan perlahan - Menanggapi perhatian fisik - Menyentuh orang lain untuk mendapatkan perhatian mereka - Berdiri dekat ketika sedang berbicara dengan orang lain - Banyak gerak fisik -  Memiliki perkembangan awal otot-otot yang besar - Belajar melalui praktek langsung atau manipulasi - Menghafalkan sesuatu dengan cara berjalan atau melihat langsung - Menggunakan jari untuk menunjukka apa yang dibaca ketika sedang membaca - Banyak menggunakan bahasa tubuh (non verbal) - Tidak dapat duduk diam di suatu tempat untuk waktu yang lama - Sulit membaca peta kecuali ia memang pernah ke tempat tersebut - Menggunakan ka ta - kata yang mengandung aksi - Pada umumnya tulisannya jelek - Menyukai kegiatan atau permainan yang menyibukkan (secara fisik) - Ingin melakukan segala sesuatu';
			
			$saran = 'Cobalah belajar dalam kelompok untuk membentuk suasana bermain peran dari pelajaran yang dibahas - Tulislah poin - poin penting dari pelajaran dalam bentuk kartu - kartu yang disusun secara logis -  Buatlah semacam percobaan atau model dari apa yang sedang kamu pelajari - Libatkan tubuh dalam belajar dengan mencoba meniru apa yang dipelajari dengan gaya guru saat menyampaikan materi - Setiap kali membaca atau mendengarkan seseorang berbicara, bangkitlah untuk sedikit bergerak setiap 15 - 20 menit sekali';
		}elseif($totalv == $totala and $totalv > $totalk){
			$dominasi = "VA";
			$karakteristik = 'Rapi dan teratur - Berbicara dengan c epat - Mampu membuat rencana dan mengatur jangka panjang dengan baik - Teliti dan rinci - Mementingkan penampilan - Lebih mudah mengingat apa yang dilihat daripada apa yang didengar - Mengingat sesuatu berdasarkan asosiasi visual - Memiliki kemampuan menge ja huruf dengan sangat baik - Biasanya tidak mudah terganggu oleh keributan atau suara berisik ketika sedang belajar - Sulit menerima instruksi verbal (oleh karena itu seringkali ia minta instruksi secara tertulis) - Merupakan pembaca yang cepat dan tekun - Lebih suka membaca daripada dibacakan - Dalam memberikan respon terhadap segala sesuatu, ia selalu bersikap waspada , membutuhkan penjelasan menyeluruh tentang tujuan dan berbagai hal lain yang berkaitan - Jika sedang berbicara di telpon ia suka membuat c oretan - coretan tanpa arti selama berbicara - Lupa menyampaikan pesan verbal kepada orang lain - Sering menjawab pertanyaan dengan jawaban singkat "ya" atau "tidak” - Lebih suka mendemonstrasikan sesuatu daripada berpidato/ berceramah - Lebih tertarik pada bidang seni (lukis, pahat, gambar) dari pada musik - Sering kali menegtahui apa yang harus dikatakan, tetapi tidak pandai menuliskan dalam kata - kata - Kadang - kadang kehilangan konsentrasi ketika mereka ingin memperhatikan - Sering berbicara sendiri ketika sedang bekerja (belajar) - Mudah terganggu oleh keributan atau suara berisik - Menggerakan bibir dan mengucapkan tulisan di buku ketika membaca - Lebih senang mendengarkan (dibacakan) daripada membaca - Jika membaca maka lebih senang membaca dengan suara k eras - Dapat mengulangi atau menirukan nada, irama dan warna suara - Mengalami kesulitan untuk menuliskan sesuatu, tetapi sangat pandai dalam bercerita - Berbicara dalam irama yang terpola dengan baik - berbicara dengan sangat fasih - Lebih menyukai seni m usik dibandingkan seni yang lainnya - Belajar dengan mendengarkan dan mengingat apa yang didiskusikan daripada apa yang dilihat - Senang berbicara, berdiskusi dan menjelaskan sesuatu secara panjang lebar - Mengalami kesulitan jika harus dihadapkan pada tug as - tugas yang berhubungan dengan visualisasi - Lebih pandai mengeja atau mengucapkan kata - kata dengan keras daripada menuliskannya - Lebih suka humor atau gurauan lisan daripada membaca buku humor/komik.';
			
			$saran = 'Buatlah Peta Konsep pelajaran dengan mulai dari tema besar di tengah halaman, menggunakan kata - kata penting, menggunakan simbol, warna, kata, gambar yang mencolok dan lakukan ini dengan gayamu sendiri - Dalam mencatat pelajaran, gunakan tanda - tanda, gambar dan warna untuk menandai hal - hal penting agar dapat dengan mudah dilihat lagi jika akan mempelajarinya dilain waktu - Untuk membantu mengingat apa yang baru dibaca dan didengar , duduklah dengan santai dan bayangkan dalam pikiran apa yang baru dibaca/didengar - Bacalah pelajaran dengan cara baca yang dramatis - Cobalah menyanyikannya dengan irama iklan atau musik - Merangkum pelajaran dengan diucapkan lantang atau direkam dalam kaset / CD dan didengarkan menggunakan walkman saat ke sekolah -  Saat membaca dengan lantang, perhatikan intonasi, penekanan khusus, cobalah berbisik dan cobalah untuk memejamkan mata untuk belajar membayangkan apa yang dibaca';
		}elseif($totalv == $totalk and $totalv > $totala){
			$dominasi = "VK";
			$karakteristik = 'Rapi dan teratur - Berbicara dengan cepat - Mampu membuat rencana dan mengatur jangka panjang dengan baik - Teliti dan rinci - Mementingkan penampilan - Lebih mudah mengingat apa yang dilihat daripada apa yang didengar - Mengingat sesuatu berdasarkan asosiasi visual - Memiliki kemampuan mengeja huruf dengan sangat baik - Biasanya tidak mudah terganggu oleh keributan atau suara berisik ketika sedang belajar - Sulit menerima instruksi verbal (oleh karena itu seringkali ia minta instruksi secara tertulis) - Merupakan pembaca yang cepat dan tekun - Lebih suka membaca daripada dibacakan - Dalam memberikan respon terhadap segala sesuatu, ia selalu bersikap waspada, membutuhkan penjelasan menyeluruh tentang tujuan dan berbagai hal lain yang berkaitan - Jika sedang berbicara di telpon ia suka membuat coretan - coretan tanpa arti selama berbicara - Lupa menyampaikan pesan verbal kepada orang lain - Sering menjawab pertanyaan dengan jawaban singkat " ya" atau "tidak” - Lebih suka mendemonstrasikan sesuatu daripada berpidato/ berceramah - Lebih tertarik pada bidang seni (lukis, pahat, gambar) dari pada musik - Sering kali mengetahui apa yang harus dikatakan, tetapi tidak pandai menulis kandalam kata - kata - Kadang-kadang kehilangan konsentrasi ketika mereka ingin memperhatikan - Berbicara dengan perlahan - Menanggapi perhatian fisik - Menyentuh orang lain untuk mendapatkan perhatian mereka - Berdiri dekat ketika sedang berbicara dengan orang lain - Banyak gerak fisik -  Memiliki perkembangan awal otot-otot yang besar - Belajar melalui praktek langsung atau manipulasi - Menghafalkan sesuatu dengan cara berjalan atau melihat langsung - Menggunakan jari untuk menunjukka apa yang dibaca ketika sedang membaca - Banyak menggunakan bahasa tubuh (non verbal) - Tidak dapat duduk diam di suatu tempat untuk waktu yang lama - Sulit membaca peta kecuali ia memang pernah ke tempat tersebut - Menggunakan ka ta - kata yang mengandung aksi - Pada umumnya tulisannya jelek - Menyukai kegiatan atau permainan yang menyibukkan (secara fisik) - Ingin melakukan segala sesuatu';
			
			$saran = 'Buatlah Peta Konsep pelajaran dengan mulai dari tema besar di tengah halaman, menggunakan kata - kata penting, menggunakan simbol, warna, kata, gambar yang mencolok dan lakukan ini dengan gayamu sendiri - Dalam mencatat pelajaran, gunakan tanda - tanda, gambar dan warna untuk menandai hal - hal penting agar dapat dengan mudah dilihat lagi jika akan mempelajarinya dilain waktu - Untuk membantu mengingat apa yang baru dibaca dan didengar , duduklah dengan santai dan bayangkan dalam pikiran apa yang baru dibaca/didengar - Cobalah belajar dalam kelompok untuk membentuk suasana bermain peran dari pelajaran yang dibahas - Tulislah poin - poin penting dari pelajaran dalam bentuk kartu - kartu yang disusun secara logis -  Buatlah semacam percobaan atau model dari apa yang sedang kamu pelajari - Libatkan tubuh dalam belajar dengan mencoba meniru apa yang dipelajari dengan gaya guru saat menyampaikan materi - Setiap kali membaca atau mendengarkan seseorang berbicara, bangkitlah untuk sedikit bergerak setiap 15 - 20 menit sekali';
		}elseif($totala == $totalk and $totala > $totalv){
			$dominasi = "AK";
			$karakteristik = 'Sering berbicara sendiri ketika sedang bekerja (belajar) - Mudah terganggu oleh keributan atau suara berisik - Menggerakan bibir dan menguc apkan tulisan di buku ketika membaca - Lebih senang mendengarkan (dibacakan) daripada membaca - Jika membaca maka lebih senang membaca dengan suara keras - Dapat mengulangi atau menirukan nada, irama dan warna suara - Mengalami kesulitan untuk menuliskan s esuatu, tetapi sangat pandai dalam bercerita - Berbicara dalam irama yang terpola dengan baik - berbicara dengan sangat fasih - Lebih menyukai seni musik dibandingkan seni yang lainnya - Belajar dengan mendengarkan dan mengingat apa yang didiskusikan darip ada apa yang dilihat - Senang berbicara, berdiskusi dan menjelaskan sesuatu secara panjang lebar - Mengalami kesulitan jika harus dihadapkan pada tugas - tugas yang berhubungan dengan visualisasi - Lebih pandai mengeja atau mengucapkan kata - kata dengan keras daripada menuliskannya - Lebih suka humor atau gurauan lisan daripada membaca buku humor/komik - Berbicara dengan perlahan - Menanggapi perhatian fisik - Menyentuh orang lain untuk mendapatkan perhatian mereka - Berdiri dekat ketika sedang berbicara dengan orang lain - Banyak gerak fisik -  Memiliki perkembangan awal otot-otot yang besar - Belajar melalui praktek langsung atau manipulasi - Menghafalkan sesuatu dengan cara berjalan atau melihat langsung - Menggunakan jari untuk menunjukka apa yang dibaca ketika sedang membaca - Banyak menggunakan bahasa tubuh (non verbal) - Tidak dapat duduk diam di suatu tempat untuk waktu yang lama - Sulit membaca peta kecuali ia memang pernah ke tempat tersebut - Menggunakan ka ta - kata yang mengandung aksi - Pada umumnya tulisannya jelek - Menyukai kegiatan atau permainan yang menyibukkan (secara fisik) - Ingin melakukan segala sesuatu';
			
			$saran = 'Bacalah pelajaran dengan cara baca yang dramatis - Cobalah menyanyikannya dengan irama iklan atau musik - Merangkum pelajaran dengan diucapkan lantang atau direkam dalam kaset / CD dan didengarkan menggunakan walkman saat ke sekolah -  Saat membaca dengan lantang, perhatikan intonasi, penekanan khusus, cobalah berbisik dan cobalah untuk memejamkan mata untuk belajar membayangkan apa yang dibaca - Cobalah belajar dalam kelompok untuk membentuk suasana bermain peran dari pelajaran yang dibahas - Tulislah poin - poin penting dari pelajaran dalam bentuk kartu - kartu yang disusun secara logis -  Buatlah semacam percobaan atau model dari apa yang sedang kamu pelajari - Libatkan tubuh dalam belajar dengan mencoba meniru apa yang dipelajari dengan gaya guru saat menyampaikan materi - Setiap kali membaca atau mendengarkan seseorang berbicara, bangkitlah untuk sedikit bergerak setiap 15 - 20 menit sekali';
		}elseif($totalv == $totala and $totalv == $totalk){
			$dominasi = "VAK";
			$karakteristik = 'Rapi dan teratur - Berbicara dengan c epat - Mampu membuat rencana dan mengatur jangka panjang dengan baik - Teliti dan rinci - Mementingkan penampilan - Lebih mudah mengingat apa yang dilihat daripada apa yang didengar - Mengingat sesuatu berdasarkan asosiasi visual - Memiliki kemampuan menge ja huruf dengan sangat baik - Biasanya tidak mudah terganggu oleh keributan atau suara berisik ketika sedang belajar - Sulit menerima instruksi verbal (oleh karena itu seringkali ia minta instruksi secara tertulis) - Merupakan pembaca yang cepat dan tekun - Lebih suka membaca daripada dibacakan - Dalam memberikan respon terhadap segala sesuatu, ia selalu bersikap waspada , membutuhkan penjelasan menyeluruh tentang tujuan dan berbagai hal lain yang berkaitan - Jika sedang berbicara di telpon ia suka membuat c oretan - coretan tanpa arti selama berbicara - Lupa menyampaikan pesan verbal kepada orang lain - Sering menjawab pertanyaan dengan jawaban singkat "ya" atau "tidak” - Lebih suka mendemonstrasikan sesuatu daripada berpidato/ berceramah - Lebih tertarik pada bidang seni (lukis, pahat, gambar) dari pada musik - Sering kali menegtahui apa yang harus dikatakan, tetapi tidak pandai menuliskan dalam kata - kata - Kadang - kadang kehilangan konsentrasi ketika mereka ingin memperhatikan<br>
			Sering berbicara sendiri ketika sedang bekerja (belajar) - Mudah terganggu oleh keributan atau suara berisik - Menggerakan bibir dan mengucapkan tulisan di buku ketika membaca - Lebih senang mendengarkan (dibacakan) daripada membaca - Jika membaca maka lebih senang membaca dengan suara k eras - Dapat mengulangi atau menirukan nada, irama dan warna suara - Mengalami kesulitan untuk menuliskan sesuatu, tetapi sangat pandai dalam bercerita - Berbicara dalam irama yang terpola dengan baik - berbicara dengan sangat fasih - Lebih menyukai seni m usik dibandingkan seni yang lainnya - Belajar dengan mendengarkan dan mengingat apa yang didiskusikan daripada apa yang dilihat - Senang berbicara, berdiskusi dan menjelaskan sesuatu secara panjang lebar - Mengalami kesulitan jika harus dihadapkan pada tug as - tugas yang berhubungan dengan visualisasi - Lebih pandai mengeja atau mengucapkan kata - kata dengan keras daripada menuliskannya - Lebih suka humor atau gurauan lisan daripada membaca buku humor/komik.<br>
			Berbicara dengan perlahan - Menanggapi perhatian fisik - Menyentuh orang lain untuk mendapatkan perhatian mereka - Berdiri dekat ketika sedang berbicara dengan orang lain - Banyak gerak fisik -  Memiliki perkembangan awal otot-otot yang besar - Belajar melalui praktek langsung atau manipulasi - Menghafalkan sesuatu dengan cara berjalan atau melihat langsung - Menggunakan jari untuk menunjukka apa yang dibaca ketika sedang membaca - Banyak menggunakan bahasa tubuh (non verbal) - Tidak dapat duduk diam di suatu tempat untuk waktu yang lama - Sulit membaca peta kecuali ia memang pernah ke tempat tersebut - Menggunakan ka ta - kata yang mengandung aksi - Pada umumnya tulisannya jelek - Menyukai kegiatan atau permainan yang menyibukkan (secara fisik) - Ingin melakukan segala sesuatu';
			
			$saran = 'Buatlah Peta Konsep pelajaran dengan mulai dari tema besar di tengah halaman, menggunakan kata - kata penting, menggunakan simbol, warna, kata, gambar yang mencolok dan lakukan ini dengan gayamu sendiri - Dalam mencatat pelajaran, gunakan tanda - tanda, gambar dan warna untuk menandai hal - hal penting agar dapat dengan mudah dilihat lagi jika akan mempelajarinya dilain waktu - Untuk membantu mengingat apa yang baru dibaca dan didengar , duduklah dengan santai dan bayangkan dalam pikiran apa yang baru dibaca/didengar<br>
			Bacalah pelajaran dengan cara baca yang dramatis - Cobalah menyanyikannya dengan irama iklan atau musik - Merangkum pelajaran dengan diucapkan lantang atau direkam dalam kaset / CD dan didengarkan menggunakan walkman saat ke sekolah -  Saat membaca dengan lantang, perhatikan intonasi, penekanan khusus, cobalah berbisik dan cobalah untuk memejamkan mata untuk belajar membayangkan apa yang dibaca<br>
			Cobalah belajar dalam kelompok untuk membentuk suasana bermain peran dari pelajaran yang dibahas - Tulislah poin - poin penting dari pelajaran dalam bentuk kartu - kartu yang disusun secara logis -  Buatlah semacam percobaan atau model dari apa yang sedang kamu pelajari - Libatkan tubuh dalam belajar dengan mencoba meniru apa yang dipelajari dengan gaya guru saat menyampaikan materi - Setiap kali membaca atau mendengarkan seseorang berbicara, bangkitlah untuk sedikit bergerak setiap 15 - 20 menit sekali';
		}
		
		$data_eq = $this->model_agcu->get_eq($idsiswa,$idprofil);
		
		if($data_eq->skor_aq < 7){
			$analisis_aq = "Mudah gelisah, bingung dan sering cemas - Sering kehilangan rasa humor - Menyalahkan diri sendiri terhadap berbagai kegagalan - Analisisnya dangkal ";
		}elseif($data_eq->skor_aq <= 11){
			$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan cenderung kurang berkembang - Mudah kehilangan ketenangan - Sering kecewa terhadap kesalahan sendiri - Mudah kehilangan keseimbangan emosi ";
		}elseif($data_eq->skor_aq <= 21){
			$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan cenderung berkembang - Peningkatan daya tahan emosi tergantung lingkungan - Perlu melatih ketenangan ";
		}elseif($data_eq->skor_aq <= 26){
			$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan cukup baik - Terkadang menyerah tapi jarang mengalami kebingungan - Mempunyai ketenangan yang tidak mudah goyah - Tetap mampu mengambil keputusan yang akurat";
		}elseif($data_eq->skor_aq <= 32){
			$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan sangat tinggi - Tidak akan stress kecuali kondisi sangat tragis - Mempunyai ketenangan yang sangat kuat - Tetap berorientasi pada tujuan";
		}
		
		if($data_eq->skor_eq < 7){
			$analisis_eq = "Tidak mampu memahami dinamika kelompok - Kesulitan memahami perasaan orang lain - Kurang kemauan untuk membantu kesulitan orang lain - Sering tegang menghadapi tekanan ";
		}elseif($data_eq->skor_eq <= 11){
			$analisis_eq = "Cenderung menolak perubahan - Kurang mampu mengendalikan perasaan - Cenderung egois - Selalu mengambil untung di setiap kesempatan - Kurang luwes dalam bergaul ";
		}elseif($data_eq->skor_eq <= 21){
			$analisis_eq = "Memiliki keterbukaan terhadap perubahan lingkungan - Memiliki semangat yang cukup baik - Mampu mendeteksi perasaan dan perspektif orang lain ";
		}elseif($data_eq->skor_eq <= 26){
			$analisis_eq = "Mampu menyemangati dirinya dan orang lain - Memiliki toleransi terhadap kekurangan orang lain - Mampu memelihara norma kejujuran dan integritas - Memiliki teknik persuasi yang baik ";
		}elseif($data_eq->skor_eq <= 32){
			$analisis_eq = "Memiliki rasa empati yang tinggi pada kesulitan orang lain - Mempu mengendalikan perasaannya - memiliki semangat yang tinggi dalam kondisi apapun";
		}
		
		if($data_eq->skor_am < 7){
			$analisis_am = "Tidak ada kemauan untuk berprestasi - Merasa yakin bahwa prestasinya selama ini sudah cukup - Tidak pernah instrospeksi diri ";
		}elseif($data_eq->skor_am <= 11){
			$analisis_am = "Jarang mendapatkan atau menginginkan prestasi tertentu - Tidak ada semangat bersaing - Biasanya menginginkan hasil seketika - Biasanya menjadi trouble maker";
		}elseif($data_eq->skor_am <= 21){
			$analisis_am = "Tidak ada prestasi yang istimewa - Kurang semangat bersaing - Cepat puas terhadap hasil yang diperoleh - Hanya berorientasi pada melaksanakan instruksi dengan benar ";
		}elseif($data_eq->skor_am <= 26){
			$analisis_am = "Memiliki kecenderungan high achiever dan rasa percaya diri cukup - Memiliki misi yang jelas dan terukur - Mampu memberi penghargaan terhadap hasil karya orang lain ";
		}elseif($data_eq->skor_am <= 32){
			$analisis_am = "High achiever, penuh rasa percaya diri dan optimis - Punya misi yang jelas untuk jangka panjang - Memiliki apresiasi yang tinggi terhadap hasil karya orang lain";
		}
		
		$data = array(
		'navbar_links' 		=> $this->model_pg->get_navbar_links(),
		'infosiswa'				=> $infosiswa,
		'kategoridiagnostic'	=> $kategoridiagnostic,
		'hasildiagnostic'	=> $hasildiagnostic,
		'peringkatsiswa'	=> $peringkatsiswa,
		'datasoal'				=> $datasoal,
		'jumlahbenar'			=> $jumlahbenar,
		'jumlahhasil'			=> $jumlahhasil,
		'jumlahbenarhasil'		=> $jumlahbenarhasil,
		'analisistopik'		=> $analisistopik,
		'totalv' 					=> $totalv,
		'totala' 					=> $totala,
		'totalk' 					=> $totalk,
		'dominasi'				=> $dominasi,
		'karakteristik'		=> $karakteristik,
		'saran'						=> $saran,
		'data_eq'					=> $this->model_agcu->get_eq($idsiswa,$idprofil),
		'profildata' 			=> $this->model_agcu->fetch_profil_by_id($idprofil),
		'analisis_aq'			=> $analisis_aq,
		'analisis_eq'			=> $analisis_eq,
		'analisis_am'			=> $analisis_am
		);
		$this->load->view('pg_user/statistik_agcu', $data);
	}

	function simpanwaktu(){
		$waktu = "0:0:1";
		sscanf($waktu, "%d:%d:%d", $hours, $minutes, $seconds);

		$time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
		
		$waktu = $time_seconds / 60;
		
		$iddiagnostic = $_SESSION['id_diagnostic'];
		$idsiswa = $this->session->userdata('id_siswa');
		//$simpanwaktu = $this->model_fronttryout->simpan_waktu($iddiagnostic, $idsiswa, $waktu);
		//$angka = 256.66666666666666666 + $waktu;
		$cariwaktu = $this->model_agcu->cari_waktu($iddiagnostic, $idsiswa);
		
		if($cariwaktu !== 0){
			$waktuterakhir = $cariwaktu->elapsed_time + $waktu;
			$simpanwaktu = $this->model_agcu->simpan_waktu($iddiagnostic, $idsiswa, $waktuterakhir);
		}else{
			$simpanwaktu = $this->model_agcu->simpan_waktu($iddiagnostic, $idsiswa, $waktu);
		}
		
		$cariwaktulagi = $this->model_agcu->cari_waktu($iddiagnostic, $idsiswa);
		//$testwaktu = $cariwaktulagi->elapsed_time + $waktu;
		//echo "<p>".$waktu;
		//echo "<p>".$cariwaktulagi->elapsed_time;
	}

}
?>