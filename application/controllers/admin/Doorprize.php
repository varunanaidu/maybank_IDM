<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doorprize extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->select 		= '*';
		$this->from   		= 'view_report_undian';
		$this->order_by   	= ['undian_id'=>'DESC'];
		$this->order 		= ['undian_id', 'emp_name', 'emp_nip', 'emp_department', 'present_name', 'addon'];
		$this->search 		= ['undian_id', 'emp_name', 'emp_nip', 'emp_department', 'present_name', 'addon'];

	}

	public function index(){

		if (!$this->hasLogin()) {
			redirect('admin/site/login');
		}

		$this->fragment['js'] = [ 
			base_url('assets/js/pages/admin/doorprize.js') 
		];

		$this->fragment['pagename'] = 'admin/pages/doorprize.php';
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
			$col[] = '<button class="btn btn-danger btn-delete" data-id="'.$row->undian_id.'"><i class="fas fa-minus-circle"></i></button>';
			$col[] = $row->emp_name;
			$col[] = $row->emp_nip;
			$col[] = $row->emp_department;
			$col[] = $row->present_name;
			$col[] = $row->addon;
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
		$check = $this->sitemodel->view($this->from, $this->select, ['undian_id'=>$key]);
		if (!$check) {$this->response['msg'] = "No data found.";echo json_encode($this->response);exit;}
		// Delete 
		$data = [
			'is_taken_doorprize' => 0,
			'taken_doorprize_datetime' => NULL
		];
		$delete = $this->sitemodel->update('tr_undian', $data, ['undian_id'=>$key]);
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = "Berhasil menghapus data.";
		echo json_encode($this->response);
		exit;
	}
}
