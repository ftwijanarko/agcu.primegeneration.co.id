<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_security extends CI_Model{
    public function is_logged_in(){
        if($this->session->userdata('is_logged_in')){
             return true;
        }else{
             // $this->session->set_flashdata('alert','Anda harus login!');
             alert_error('Error', 'Anda harus login!');
             redirect('pg_admin/login');
       }
      }
    public function parent_logged_in(){
    	if($this->session->userdata('parent_logged_in')){
    		return true;        
    	}else{
    		// $this->session->set_flashdata('alert','Anda harus login!');
    		alert_error('Error', 'Anda harus login!');
    		redirect('login');       
    	}	
    }	
	public function psep_sekolah_is_logged_in(){
        if($this->session->userdata('psep_sekolah_is_logged_in')){
             return true;
        }else{
             // $this->session->set_flashdata('alert','Anda harus login!');
             alert_error('Error', 'Anda harus login!');
             redirect('psep_sekolah/login');
       }
      }
	
	public function siswa_logged_in(){
        if($this->session->userdata('id_siswa') !== null){
             return true;
        }else{
             // $this->session->set_flashdata('alert','Anda harus login!');
             alert_error('Error', 'Anda harus login!');
             redirect('login');
       }
      }
	
	function activation_security(){
		$tanggalsekarang = date('Y-m-d');
		$idsiswa = $this->session->userdata('id_siswa');
		
		$aktivasi = $this->get_kelas_aktif($idsiswa, $tanggalsekarang);
		
		if($aktivasi > 0){
			return true;
		}else{
			redirect("user/aktivasi");
		}
	}
	
	function get_kelas_aktif($idsiswa, $tanggalsekarang){
		$this->db->select("*");
		$this->db->from('paket_aktif');
		$this->db->join('kelas', 'paket_aktif.id_kelas=kelas.id_kelas', 'left');
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where("expired_on >", $tanggalsekarang);
		
		$result = $this->db->count_all_results();
		return $result;
	}
}
?>