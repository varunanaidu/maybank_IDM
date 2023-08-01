<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Undian extends MY_Controller {

	public function index()
	{
		$this->load->view('undian/index');
	}

	public function get_present()
	{
		$check = $this->sitemodel->view("tab_gift", "*");
		echo json_encode($check);
	}

	public function search_emp()
	{
		$registration_id = $this->input->post('registration_id');
		$check = $this->sitemodel->view('tr_grandprize', '*', ['registration_id'=>$registration_id, 'DATE(addon)'=>date('Y-m-d')]);
		if ( $check ) {$this->response['msg'] = "Anda telah mendapatkan hadiah pada tanggal " . date('d F Y H:i:s', strtotime($check[0]->addon));echo json_encode($this->response);exit;}


		$check2 = $this->sitemodel->view('view_allow_grandprize', '*', ['registration_id'=>$registration_id]);
		if ( !$check2 ) {$this->response['msg'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}


		$data['result_id']	= $check2[0]->registration_id;
		$data['result_name'] = $check2[0]->participant_name;
		$data['result_email'] = $check2[0]->participant_email;
		$data['result_wa'] = $check2[0]->participant_wa;

		$this->response['type'] = 'done';
		$this->response['data'] = $data;
		echo json_encode($this->response);
		exit;
	}

	public function search_participant()
	{
		$term = $this->input->get("term");
		// echo json_encode($term);die;
		$res = [];
		$check = $this->sitemodel->custom_query(" SELECT * FROM view_allow_grandprize WHERE participant_name LIKE CONCAT('%','".$term."','%') ");
		// echo json_encode($check);die;
		if($check){
			foreach ($check as $row) {
				$sub_res = [];
				$sub_res['id'] = $row->registration_id;
				$sub_res['text'] = $row->participant_name . ' - ' . $row->participant_email;
				$res[] = $sub_res;
			}
		}

		echo json_encode($res);
		exit;
	}


	public function get_result()
	{
		// echo json_encode($this->input->post());die;		
		$gift = $this->sitemodel->view("tab_gift", "*");

		$random = mt_rand(0, (sizeof($gift)-1));
		$data['result_id']	= $gift[$random]->gift_id;
		$data['result_name'] = $gift[$random]->gift_name;
		$data['result_file'] = $gift[$random]->gift_file;

		echo json_encode($data);
	}

	public function save_doorprize()
	{
		// echo json_encode($this->input->post());die;
		$registration_id = $this->input->post('registration_id');
		$gift_id		 = $this->input->post('gift_id');

		$data_tr = [
			'registration_id' => $registration_id,
			'gift_id'		  => $gift_id,
			'addon'			  => date('Y-m-d H:i:s'),
		];

		$tr = $this->sitemodel->insert('tr_grandprize', $data_tr);

		echo json_encode("Success Save Transaction");
	}


}
