<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antigen extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->select 		= '*';
		$this->from   		= 'view_report_antigen';
		$this->order_by   	= ['registration_id'=>'DESC'];
		$this->order 		= ['registration_id', 'participant_name', 'participant_birth_date', 'participant_gender', 'participant_nik', 'participant_addr', 'participant_wa', 'participant_email', 'is_antigen', 'antigen_datetime'];
		$this->search 		= ['registration_id', 'participant_name', 'participant_birth_date', 'participant_gender', 'participant_nik', 'participant_addr', 'participant_wa', 'participant_email', 'is_antigen', 'antigen_datetime'];

	}

	public function index(){

		if (!$this->hasLogin()) {
			redirect('admin/site/login');
		}

		$this->fragment['js'] = [ 
			base_url('assets/js/pages/admin/antigen.js') 
		];

		$this->fragment['pagename'] = 'admin/pages/antigen.php';
		$this->load->view('admin/layout/main-site', $this->fragment);
	}

	public function view()
	{
		$data = array();
		$res = $this->sitemodel->get_datatable($this->select, $this->from, $this->order_by, $this->search, $this->order);
		$q = $this->db->last_query();
		$a = 1;

		foreach ($res as $row) {
			$col = array();
			$col[] = '<button class="btn btn-danger btn-delete" data-id="'.$row->registration_id.'"><i class="fas fa-minus-circle"></i></button>';
			$col[] = $row->participant_name;
			$col[] = $row->participant_birth_date;
			$col[] = ($row->participant_gender == 1 ? 'Laki-Laki': ($row->participant_gender == 2 ? 'Perempuan' : 'Perempuan'));
			$col[] = $row->participant_nik;
			$col[] = $row->participant_addr;
			$col[] = $row->participant_wa;
			$col[] = $row->participant_email;
			$col[] = ($row->is_antigen == 0 ? 'Belum Melakukan' : ($row->is_antigen == 1 ? 'Negatif' : 'Positif') );
			$col[] = ($row->antigen_datetime ? date('d/m/Y H:i:s', strtotime($row->antigen_datetime)) : '-' );
			$data[] = $col;
			$a++;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->sitemodel->get_datatable_count_all($this->from),
			"recordsFiltered" 	=> $this->sitemodel->get_datatable_count_filtered($this->select, $this->from, $this->order_by, $this->search, $this->order),
			"data" 				=> $data,
			"q"					=> $q

		);
		echo json_encode($output);
		exit;
	}

	public function delete(){
		// echo json_encode($this->input->post());die;
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}

		if ( $this->log_role != 'developer' ){$this->response['msg'] = "Maaf anda belum beruntung.";echo json_encode($this->response);exit;}
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		/*** Params ***/
		/*** Required Area ***/
		$key = $this->input->post("key");
		/*** Optional Area ***/
		/*** Validate Area ***/
		if ( empty($key) ){$this->response['msg'] = "Invalid parameter.";echo json_encode($this->response);exit;}
		/*** Accessing DB Area ***/
		$check = $this->sitemodel->view($this->from, $this->select, ['participant_id'=>$key]);
		if (!$check) {$this->response['msg'] = "No data found.";echo json_encode($this->response);exit;}
		// Delete 
		$data = [
			'is_antigen' => 0,
			'antigen_datetime' => NULL
		];
		$delete = $this->sitemodel->update('tr_registration', $data, ['registration_id'=>$key]);
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = "Berhasil menghapus data.";
		echo json_encode($this->response);
		exit;
	}
}