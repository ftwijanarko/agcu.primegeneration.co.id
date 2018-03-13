<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quote extends CI_Controller {

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
		$this->load->model('model_security');
		$this->model_security->is_logged_in();
  }

	public function index()
	{
		$data = array(
			'navbar_title' 	=> "Quotes",
			'form_action' 	=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
			'table_data' 		=> $this->model_adm->fetch_all_quotes()
			);

		$this->load->view('pg_admin/quotes', $data);
	}

	public function manajemen($aksi)
	{
		//$aksi contains the value needed (tambah/ubah) to direct user to Add/Edit form
		if($aksi)
		{
			//Trigger form submission validation rules
			$this->form_validation_rules();

			switch ($aksi) {
				case 'tambah':
					$data = array(
					'navbar_title'	=> "Manajemen Quote",
					'page_title' 		=> "Tambah Quote",
					'form_action' 	=> current_url()
					);

					//Form materi submit handler. See if the user is attempting to submit a form or not
					if($this->input->post('form_submit')) 
					{
						//Form is submitted. Now routing to proses_tambah method
						$this->proses_tambah();
					}
					else 
					{
						//No form is submitted. Displaying the form page
						$this->load->view('pg_admin/quotes_form', $data);
					}
					break;

				case 'ubah':
					//Passing id value from GET '?id' to variable '$id'
					$id = $this->input->get('id') ? $this->input->get('id') : null ;
					
					$data = array(
					'navbar_title'	=> "Manajemen Quote",
					'page_title' 		=> "Ubah Quote",
					'form_action' 	=> current_url() . "?id=$id"
					);

					//Redirect to quote if id is not exist
					if(!$id)
					{
						redirect('pg_admin/quote');
					}
					else 
					{
						//Calling values from database by id and pass them to View
						//fetching quote by id
						$data['data'] = $this->model_adm->fetch_quote_by_id($id);

						//Form submit handler. See if the user is attempting to submit a form or not
						if($this->input->post('form_submit')) 
						{
							//Form is submitted. Now routing to proses_tambah method
							$this->proses_ubah($id);
						}
						else 
						{
							//No form is submitted. Displaying the form page
							$this->load->view('pg_admin/quotes_form', $data);
						}
					}
					break;
				
				default:
					redirect('pg_admin/quote');
					break;
			}
		}
		else
		{
			redirect('pg_admin/quote');
		}

	}

	public function proses_tambah()
	{
		//set the page title
		$data = array(
			'page_title' 	=> "Tambah Quote", 
			'form_action' => current_url()
			);

		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params = $this->input->post(null, true);
		$data_model = array(
									'quote' => $params['quote'],
									'tokoh' => $params['tokoh'],
									);
		
		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			alert_error("Error", "Data gagal ditambahkan");
			$this->load->view('pg_admin/quotes_form', $data);
		}
		else 
		{
			//passing input value to Model
			$result = $this->model_adm->add_quote($data_model);
			alert_success("Sukses", "Data berhasil ditambahkan");
			redirect('pg_admin/quote');
			// echo "Status Insert: " . $result;
		}	
	}

	public function proses_ubah($id)
	{
		//set the page title
		$data = array(
			'page_title' 	=> "Ubah Quote",
			'form_action' => current_url(). "?id=$id"
			);

		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params = $this->input->post(null, true);
		$data_model = array(
									'quote' => $params['quote'],
									'tokoh' => $params['tokoh'],
									);

		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			alert_error("Error", "Data gagal diubah");
			$this->load->view('pg_admin/quotes_form', $data);
		}
		else 
		{
			//passing input value to Model
			$result = $this->model_adm->update_quote($id, $data_model);
			alert_success("Sukses", "Data berhasil diubah");
			redirect('pg_admin/quote');
		}	
	}

	public function proses_hapus()
  {

    if($this->input->post('deleteRow_submit'))
    {
      //set form validation rules 
      $this->form_validation->set_rules('hidden_row_id', "Nomor Baris", 'trim|required|numeric');

      if($this->form_validation->run())
      {
        $id   = $this->input->post('hidden_row_id');
        $result = $this->model_adm->delete_quote($id);
        
        alert_success('Sukses', "Data berhasil dihapus");
        redirect('pg_admin/quote');
      }
    }
    
    alert_danger('Error', "Data gagal dihapus");
    redirect('pg_admin/quote');
  }

	function form_validation_rules()
	{
		//set validation rules for each input
		$this->form_validation->set_rules('tokoh', 'Tokoh', 'trim|required');
		$this->form_validation->set_rules('quote', 'Quote', 'trim|required');
		//set custom error message
		$this->form_validation->set_message('required', '%s tidak boleh kosong');
	}

}
