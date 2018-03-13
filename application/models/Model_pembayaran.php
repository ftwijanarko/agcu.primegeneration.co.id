<?php 

/**
* 
*/
class Model_pembayaran extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function fetch_all_table_data($tabel)
	{
		$query = $this->db->get($tabel);
		
		return $query->result();
	}

	function simpan($data_pembelian, $detail_pembelian)
	{
		//insert data into table pembelian
		$query = $this->db->insert('pembelian', $data_pembelian);
		
		$pembelian_id = $this->db->insert_id();
		if($pembelian_id)
		{
			$grand_total  = 0;
			$no_tagihan		= 'PM'.date('md').$pembelian_id.date('s'); //pattern is PM,month,day,id_pembelian,seconds  

			foreach ($detail_pembelian as $item) 
			{
				//count grand total
				$grand_total = $grand_total + ($item['jumlah'] * $item['harga_satuan']);
				//insert each item into table pembelian_detail
				$data = array(
					'pembelian_id' => $pembelian_id, 
					'paket_id' 		 => $item['id_paket'], 
					'harga_satuan' => $item['harga_satuan'], 
					'jumlah' 		 	 => $item['jumlah']
					);
				$query = $this->db->insert('pembelian_detail', $data);
			}

			//update data total_harga in table Pembelian
			$this->db->set('no_tagihan', $no_tagihan);
			$this->db->set('total_harga', $grand_total);
			$this->db->where('id_pembelian', $pembelian_id);
			$this->db->update('pembelian');
		}
		
		return $pembelian_id;
	}

	function get_pembelian($id_pembelian)
	{
		$this->db->select("*");
		$this->db->from("pembelian");
		$this->db->join("siswa", "siswa.id_siswa = pembelian.siswa_id");
		$this->db->where("pembelian.id_pembelian", $id_pembelian);
		$query = $this->db->get();

		return $query->row();
	}

	function get_pembelian_umum($id_pembelian)
	{
		$this->db->select("*");
		$this->db->from("pembelian");
		$this->db->where("pembelian.id_pembelian", $id_pembelian);
		$query = $this->db->get();

		return $query->row();
	}

	function get_detail_pembelian($id_pembelian)
	{
		$this->db->select("paket.kode_paket, paket.durasi, paket.tipe, pembelian_detail.harga_satuan, pembelian_detail.jumlah");
		$this->db->from("pembelian_detail");
		$this->db->join("paket", "paket.id_paket = pembelian_detail.paket_id");
		$this->db->where("pembelian_detail.pembelian_id", $id_pembelian);
		$query = $this->db->get();

		return $query->result();
	}

	function get_pembelian_by_siswa($id_siswa)
	{
		$this->db->select("*");
		$this->db->from("pembelian");
		$this->db->where("pembelian.siswa_id", $id_siswa);
		$query = $this->db->get();

		return $query->result();
	}
	function get_tagihan_by_siswa($id_siswa)
	{
		$this->db->select("*");
		$this->db->from("pembelian");
		$this->db->where("pembelian.siswa_id", $id_siswa);
		$this->db->where("pembelian.status", 0);
		$query = $this->db->get();

		return $query->result();
	}

	function cek_siswa_by_pembelian($id_pembelian)
	{
		$this->db->select("pembelian.siswa_id");
		$this->db->from("pembelian");
		$this->db->where("pembelian.id_pembelian", $id_pembelian);
		$query = $this->db->get();

		return !empty($query->row()->siswa_id) ? $query->row()->siswa_id : null;
	}

	function get_info_paket_aktif($id_pembayaran){
		$this->db->select("paket_aktif.expired_on,paket.durasi, paket.tipe, paket.harga");
		$this->db->from("paket_aktif");
		$this->db->join("paket", "paket.id_paket=paket_aktif.id_paket");
		$this->db->where("id_pembayaran", $id_pembayaran);
		$result=$this->db->get();

		return $result->result();
	}

	function get_info_paket($id_pembayaran){
		$this->db->select("paket.durasi, paket.tipe, paket.harga");
		$this->db->from("pembayaran");
		$this->db->join("paket", "paket.id_paket=pembayaran.id_paket");
		$this->db->where("id_pembayaran", $id_pembayaran);
		$result=$this->db->get();

		return $result->result();
	}

	function update_status($status, $id_pembelian)
	{
		$data = array('status' => $status);
		$this->db->where('id_pembelian', $id_pembelian);
		$result = $this->db->update("pembelian", $data);

		return $result;
	}

	function update_file_bukti($file, $id_pembayaran)
	{
		$data = array(
							"file_bukti"	=> $file,
							"status"			=> 1 //menunggu konfirmasi admin
						);
		$this->db->where("id_pembelian", $id_pembayaran);

		$query = $this->db->update("pembelian", $data);
		return $query;
	}
	
	function get_info_pembayaran($id_pembelian){
		$this->db->select("pembelian.id_pembelian, pembelian.no_tagihan, pembelian.siswa_id, pembelian.kelas_id, pembelian.metode_pembayaran, pembelian.total_harga, pembelian.file_bukti, pembelian.status, pembelian.timestamp, pembelian.expired_on, pembelian_detail.id_detail, pembelian_detail.pembelian_id, pembelian_detail.paket_id, pembelian_detail.jumlah, pembelian_detail.harga_satuan, siswa.nama_siswa, siswa.email, pembelian.email as email_umum");
		$this->db->from("pembelian");
		$this->db->join("pembelian_detail", "pembelian_detail.pembelian_id=pembelian.id_pembelian");
		$this->db->join("siswa", "pembelian.siswa_id = siswa.id_siswa","left");
		$this->db->where("pembelian.id_pembelian", $id_pembelian);
		$result=$this->db->get();

		return $result->result();
	}
	
	function aktivasi_voucher($idpaket, $idkelas, $keterangan, $idpembelian){
		/*
		$a = mt_rand(10000000,99999999);
		$random = "PG".$a;
		
		$data = array(
						'paket_id' 		=> $idpaket,
						'id_kelas'	 	=> $idkelas,
						'kode_voucher' 	=> $random,
						'ket' 			=> $keterangan,
						'status' 		=> '0',
						'id_pembelian'	=> $idpembelian
					 );
		$result=$this->db->insert('voucher', $data);

		return $result;
		*/
		
	    	$this->db->set('id_pembelian', $idpembelian);
		$this->db->where('kode_voucher >', 0);
		$this->db->where('no_aktivasi >', 0);
		$this->db->where('paket_id', $idpaket);
		$this->db->where('ket', $keterangan);
		$this->db->where('id_pembelian', 0);
		$this->db->where('status', 0);
		$this->db->order_by('kode_voucher', 'ASC');
		$this->db->limit(1, 0);
		$query = $this->db->update('voucher');
		
		return $query;
	}
	
	function cari_voucher($idpembelian){
			$this->db->select("
			voucher.kode_voucher,
			voucher.no_aktivasi,
			paket.durasi,
			paket.tipe
			");
			$this->db->from("voucher");
			$this->db->join("paket", "voucher.paket_id = paket.id_paket");
			$this->db->where("voucher.id_pembelian", $idpembelian);
			$result=$this->db->get();

			return $result->result();
	}
	
	function hapus_pembayaran($idpembelian){
		$this->db->delete('pembelian', array('id_pembelian' => $idpembelian));
		$this->db->delete('pembelian_detail', array('pembelian_id' => $idpembelian));
	}
	
	//SAGAB
    function riwayat_join_cbt($id_siswa) {
        $this->db->select("*");
        $this->db->from("pembayaran_cbt");
        $this->db->where("id_siswa", $id_siswa);
        $query = $this->db->get();

        return $query->result();
    }

    function jenis_tes_cbt($id_tryout) {
        $this->db->select("nama_profil,biaya");
        $this->db->from("profil_tryout");
        $this->db->where(array("id_tryout" => $id_tryout));
        $query = $this->db->get()->row();
        if (count($query) == 0) {
            $nilai_kembalian = "" . "_" . "";
        } else {
            $nama_tryout = $query->nama_profil;
            $biaya = $query->biaya;
            $nilai_kembalian = $nama_tryout . "_" . $biaya;
        }
        return $nilai_kembalian;
    }

    function titik_pemisah_uang($nilai_anggaran) {

        if ($nilai_anggaran == '') {
            $hasilnya = '0';
        } else if ($nilai_anggaran == '0') {
            $hasilnya = '0';
        } else if (strpos($nilai_anggaran, '.') != true) {
            $hasilnya = number_format($nilai_anggaran, 0, ",", ".");
        } else if (strpos($nilai_anggaran, '.') == true) {
            $pecah_data = explode(".", $nilai_anggaran);
            $nilai_anggaran_asli_tanpa_koma = $pecah_data[0];
            $angka_dibelakang_koma = $pecah_data[1];
            if ($angka_dibelakang_koma == '000') {
                $hasilnya = number_format($nilai_anggaran, 0, ",", ".");
            } else {
                $load_mentah = number_format($nilai_anggaran, 3, ",", ".");
                $pecah_load = explode(",", $load_mentah);
                $hasilnya = $pecah_load[0] . "<b>" . "," . $pecah_load[1];
            }
        }

        return $hasilnya;
    }

    //END SAGAB
	
}
