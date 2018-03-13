<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diagnosticreport extends CI_Controller {
	
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
		
		$config['base_url'] 				= base_url().'pg_admin/diagnosticreport/tabel_ajax/0';
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
			'navbar_title' 					=> "AGCU Test Report",
			'table_data' 						=> $this->model_agcu->fetch_all_profil(0,$offset, $limit)->result(),
			'jmleq' 								=> $this->model_agcu->count_eq(),
			'jmlls' 								=> $this->model_agcu->count_ls(),
      'paginator'    					=> $this->ajax_pagination->create_links(),
      'no'    								=> ($page - 1) * $limit + 1,
		);

		$this->load->view('pg_admin/diagnosticreport', $data);
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

		$config['base_url'] 				= base_url().'pg_admin/diagnosticreport/tabel_ajax/'.$cari.'/';
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

		$this->load->view('pg_admin/diagnosticreport_ajax', $data);
	}

	function peserta($idprofil=0){
		$this->load->library('ajax_pagination');
		
		$limit		= 20;
		$page			= 1;
		if($page == 1){
			$offset = 0;
		} else {
			$offset = ($page-1) * $limit;
		}	
		
		$config['base_url'] 				= base_url().'pg_admin/diagnosticreport/peserta_ajax/'.$idprofil.'/0';
		$config['total_rows'] 			= $this->model_agcu->fetch_all_peserta($idprofil,0)->num_rows();
		$config['per_page'] 				= $limit;
		$config['uri_segment'] 			= 6;
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
			'navbar_title' 					=> "Report Peserta AGCU Test",
			'table_data' 						=> $this->model_agcu->fetch_all_peserta($idprofil,0,$offset, $limit)->result(),
			'profildata' 						=> $this->model_agcu->fetch_profil_by_id($idprofil),
      'paginator'    					=> $this->ajax_pagination->create_links(),
      'no'    								=> ($page - 1) * $limit + 1,
		);

		$this->load->view('pg_admin/diagnosticreportpeserta', $data);
	}

	function peserta_ajax($idprofil=0,$cari=0,$page=1){
		$this->load->library('ajax_pagination');
		
		$limit		= 20;
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

		$config['base_url'] 				= base_url().'pg_admin/diagnosticreport/peserta_ajax/'.$idprofil.'/'.$cari.'/';
		$config['total_rows'] 			= $this->model_agcu->fetch_all_peserta($idprofil,$cari)->num_rows();
		$config['per_page'] 				= $limit;
		$config['uri_segment'] 			= 6;
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
			'navbar_title' 					=> "Report Peserta AGCU Test",
			'table_data' 						=> $this->model_agcu->fetch_all_peserta($idprofil, $cari, $offset, $limit)->result(),
      'paginator'    					=> $this->ajax_pagination->create_links(),
      'no'    								=> ($page - 1) * $limit + 1,
		);

		$this->load->view('pg_admin/diagnosticreportpeserta_ajax', $data);
	}

	function view($idsiswa=0,$idagcu=0,$tipe="screen"){
		$p	= $this->model_agcu->fetch_profil_by_id($idagcu);
		$idprofil = $p->id_profil_master;
		$idsiswa = $idsiswa;
		
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
		'navbar_links' 	=> $this->model_pg->get_navbar_links(),
		'infosiswa'				=> $infosiswa,
		'kategoridiagnostic'	=> $kategoridiagnostic,
		'hasildiagnostic'		=> $hasildiagnostic,
		'peringkatsiswa'		=> $peringkatsiswa,
		'datasoal'				=> $datasoal,
		'jumlahbenar'			=> $jumlahbenar,
		'jumlahhasil'			=> $jumlahhasil,
		'jumlahbenarhasil'		=> $jumlahbenarhasil,
		'analisistopik'			=> $analisistopik,
		'totalv' 				=> $totalv,
		'totala' 				=> $totala,
		'totalk' 				=> $totalk,
		'dominasi'				=> $dominasi,
		'karakteristik'			=> $karakteristik,
		'saran'					=> $saran,
		'data_eq'				=> $this->model_agcu->get_eq($idsiswa,$idprofil),
		'profildata' 			=> $this->model_agcu->fetch_profil_by_id($idagcu),
		'analisis_aq'			=> $analisis_aq,
		'analisis_eq'			=> $analisis_eq,
		'analisis_am'			=> $analisis_am,
		'idsiswa'			=> $idsiswa,
		);
		$this->load->view('pg_admin/statistik_agcu', $data);
	}

	function hasil($idprofil=0){

		$data = array(
			'navbar_title' 					=> "Input Hasil AGCU Offline",
			'table_data' 						=> $this->model_agcu->fetch_all_peserta($idprofil,0,0,0)->result(),
			'profildata' 						=> $this->model_agcu->fetch_profil_by_id($idprofil),
      'no'    								=> 1,
		);

		$this->load->view('pg_admin/diagnosticreportmanual', $data);
	}

	public function simpan_eq_offline(){
		$kelas 	= $this->input->post('kelas_eq');
		$profil 	= $this->input->post('profil_eq');
		$profilid 	= $this->input->post('profil_id');
		
		$table_data = $this->model_agcu->fetch_all_peserta($profilid,0,0,0)->result();
		foreach ($table_data as $td) {
			$idsiswa 	= $this->input->post('idsiswa_'.$td->id_siswa);

			/*HAPUS HASIL*/
			$hapushasil = $this->model_eqtest->hapus_hasil($idsiswa,$profil);
			/*HAPUS HASIL*/

			/*INSERT HASIL*/
			$datasoal = $this->model_eqtest->get_eqtest();
			$l = 1;
			$j = 1;
			foreach ($datasoal as $s) {
				$id_soal 	= $l;
				$jawaban 	= $this->input->post('eq_'.$td->id_siswa.'_'.$l);
				$insert = $this->model_eqtest->insert_jawaban($idsiswa, $id_soal, $jawaban, $profil);
				if ($jawaban != ''){
					$j++;
				}
				$l++;
			}
			$aq = $this->input->post('eq_'.$td->id_siswa.'_1') + $this->input->post('eq_'.$td->id_siswa.'_4') + $this->input->post('eq_'.$td->id_siswa.'_7') + $this->input->post('eq_'.$td->id_siswa.'_10') + $this->input->post('eq_'.$td->id_siswa.'_13') + $this->input->post('eq_'.$td->id_siswa.'_16') + $this->input->post('eq_'.$td->id_siswa.'_19') + $this->input->post('eq_'.$td->id_siswa.'_22');
			$eq = $this->input->post('eq_'.$td->id_siswa.'_2') + $this->input->post('eq_'.$td->id_siswa.'_5') + $this->input->post('eq_'.$td->id_siswa.'_8') + $this->input->post('eq_'.$td->id_siswa.'_11') + $this->input->post('eq_'.$td->id_siswa.'_14') + $this->input->post('eq_'.$td->id_siswa.'_17') + $this->input->post('eq_'.$td->id_siswa.'_20') + $this->input->post('eq_'.$td->id_siswa.'_23');
			$am = $this->input->post('eq_'.$td->id_siswa.'_3') + $this->input->post('eq_'.$td->id_siswa.'_6') + $this->input->post('eq_'.$td->id_siswa.'_9') + $this->input->post('eq_'.$td->id_siswa.'_12') + $this->input->post('eq_'.$td->id_siswa.'_15') + $this->input->post('eq_'.$td->id_siswa.'_18') + $this->input->post('eq_'.$td->id_siswa.'_21') + $this->input->post('eq_'.$td->id_siswa.'_24');
			if ($aq > 0 && $eq > 0 && $am > 0){
				$insert = $this->model_eqtest->insert_skor($idsiswa, $aq, $eq, $am, $profil);
			}

			$persentase = ($j/$l) * 100;
			if ($persentase < 5){
				/*HAPUS HASIL*/
				$hapushasil = $this->model_eqtest->hapus_hasil($idsiswa,$profil);
				/*HAPUS HASIL*/
			}
			/*INSERT HASIL*/
		}
		
		redirect('pg_admin/diagnosticreport/hasil/'.$profilid);
	}
	
	public function simpan_ls_offline(){
		$kelas 	= $this->input->post('kelas_ls');
		$profil 	= $this->input->post('profil_ls');
		$profilid 	= $this->input->post('profil_id');
		
		$table_data = $this->model_agcu->fetch_all_peserta($profilid,0,0,0)->result();
		
		foreach ($table_data as $td) {
		    
			//$idsiswa 	= $this->input->post('idsiswa_'.$td->id_siswa);
			$idsiswa = $td->id_siswa;
			/*HAPUS HASIL*/
			$hapushasil = $this->model_lstest->hapus_hasil_ls($idsiswa,$profil);
			/*HAPUS HASIL*/

			/*INSERT HASIL*/
			$datasoal = $this->model_lstest->get_lstest();
			$l = 1;
			$j = 1;
			foreach ($datasoal as $s) {
				$id_soal 	= $l;
				$jawaban 	= $this->input->post('jawabls_'.$td->id_siswa.'_'.$l);
				$insert = $this->model_lstest->insert_skor($idsiswa, $id_soal, $jawaban, $profil);
				if ($jawaban != ''){
					$j++;
				}
				$l++;
			}
			
			$persentase = ($j/$l) * 100;
			if ($persentase < 5){
				/*HAPUS HASIL*/
				$hapushasil = $this->model_lstest->hapus_hasil_ls($idsiswa,$profil);
				/*HAPUS HASIL*/
			}
			/*INSERT HASIL*/
		}
		
		redirect('pg_admin/diagnosticreport/hasil/'.$profilid);
	}
	
	public function simpan_dg_offline(){
		$kelas 	= $this->input->post('kelas_dg');
		$profil 	= $this->input->post('profil_dg');
		$profilid 	= $this->input->post('profil_id');
		$idkategori = $this->input->post('kategori_dg');
		
		$table_data = $this->model_agcu->fetch_all_peserta($profilid,0,0,0)->result();
		foreach ($table_data as $td) {
			$idsiswa 	= $this->input->post('idsiswa_'.$td->id_siswa);
			
			/*HAPUS HASIL*/
			$hapushasil = $this->model_agcu->hapus_hasil_dg($idsiswa,$idkategori);
			/*HAPUS HASIL*/

			/*INSERT HASIL*/
			$sdg = $this->model_agcu->fetch_soal_by_diagnostic($idkategori);
			$l = 1;
			$j = 1;
			foreach ($sdg as $sd) {
				/* JAWABAN */
				$id_soal 	= $this->input->post('soaldg_'.$td->id_siswa.'_'.$idkategori.'_'.$sd->id_banksoal);
				$jawaban 	= $this->input->post('jawabdg_'.$td->id_siswa.'_'.$idkategori.'_'.$sd->id_banksoal);

				if(!empty($id_soal)){
					$kunci_soal = $this->model_agcu->fetch_array_id_soal($idkategori);
					foreach ($kunci_soal as $item){
						if($item['id_banksoal'] == $id_soal){
							
							if($item['kunci'] == $jawaban){
								//input analisis topik
								$carihasildiagnostic = $this->model_agcu->carihasildiagnostic($idkategori, $idsiswa, $id_soal);

								if($carihasildiagnostic > 0){
									$edithasildiagnostic = $this->model_agcu->edithasildiagnostic($idkategori, $idsiswa, $id_soal, 1, $jawaban);
								}else{
									$inputhasildiagnostic = $this->model_agcu->inputhasildiagnostic($idkategori, $idsiswa, $id_soal, 1, $jawaban);
								}
							}else{
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
				/* JAWABAN */						
				if ($jawaban != ''){
					$j++;
				}
				$l++;
			}
			$persentase = ($j/$l) * 100;
			if ($persentase < 25){
				/*HAPUS HASIL*/
				$hapushasil = $this->model_agcu->hapus_hasil_dg($idsiswa,$idkategori);
				/*HAPUS HASIL*/
			}
			/*INSERT HASIL*/
		}
		redirect('pg_admin/diagnosticreport/hasil/'.$profilid);
	}
	
}

?>