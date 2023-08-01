<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spinwheel extends MY_Controller {

	public function index()
	{
		// $this->load->view('spinwheel/index');
		// $this->load->view('spinwheel/index2');
		$this->load->view('spinwheel/index3');
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
		$participant_id = $this->input->post('participant_id');
		$check_emp = $this->sitemodel->view('view_allow_spinwheel', '*', ['participant_id'=>$participant_id]);
		
		$check;
		if ( $check_emp[0]->is_flag == 1 ) {
			$check = $this->sitemodel->custom_query("CALL list_present('0') ");
		}else{
			$check = $this->sitemodel->custom_query("CALL list_present('') ");
		}

		$random = mt_rand(0, sizeof($check));
		$data['result_id']	= $check[$random]->gift_id;
		$data['result_name'] = $check[$random]->gift_name;
		/*$data['result_type'] = $check[$random]->present_type;
		$data['result_image'] = $check[$random]->present_image;*/

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
