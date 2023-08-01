<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grandprize extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->select 		= '*';
		$this->from   		= 'view_report_grandprize_choosen';
		$this->order_by   	= ['granprize2_id'=>'DESC'];
		$this->order 		= ['', '', 'participant_name', 'participant_email', 'participant_wa', 'addon'];
		$this->search 		= ['', '', 'participant_name', 'participant_email', 'participant_wa', 'addon'];

	}

	public function index(){

		if (!$this->hasLogin()) {
			redirect('admin/site/login');
		}

		$this->fragment['js'] = [ 
			base_url('assets/js/pages/admin/grandprize.js') 
		];

		$this->fragment['pagename'] = 'admin/pages/grandprize.php';
		$this->load->view('admin/layout/main-site', $this->fragment);
	}

	public function view()
	{
		$filter = false;
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		if ($start_date != '' && $end_date != '') {
			$filter = [
				'start_date' => $start_date,
				'end_date'   => $end_date,
			];
		}

		$data = array();
		$res = $this->sitemodel->get_datatable($this->select, $this->from, $this->order_by, $this->search, $this->order, $filter);
		$q = $this->db->last_query();
		$a = 1;

		foreach ($res as $row) {
			$col = array();
			$col[] = '';
			$col[] = '';
			$col[] = $row->participant_name;
			$col[] = $row->participant_email;
			$col[] = $row->participant_wa;
			$col[] = ($row->addon ? date('d/m/Y H:i:s', strtotime($row->addon)) : '-' );
			$data[] = $col;
			$a++;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->sitemodel->get_datatable_count_all($this->from),
			"recordsFiltered" 	=> $this->sitemodel->get_datatable_count_filtered($this->select, $this->from, $this->order_by, $this->search, $this->order, $filter),
			"data" 				=> $data,
			"q"					=> $q

		);
		echo json_encode($output);
		exit;
	}
}