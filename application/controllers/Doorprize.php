<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doorprize extends MY_Controller {

	public function index(){

		$this->load->view('doorprize/index');
	}

	public function find(){
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		/*** Params ***/
		/*** Required Area ***/
		$key = $this->input->post("key");
		/*** Optional Area ***/
		/*** Validate Area ***/
		if ( empty($key) ){$this->response['msg'] = "Invalid parameter.";echo json_encode($this->response);exit;}
		/*** Accessing DB Area ***/
		$check = $this->sitemodel->view('view_registration', '*', ['participant_nip'=>$key, 'is_verify'=>1]);
		if (!$check) {$this->response['msg'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = $check;
		echo json_encode($this->response);
		exit;
	}

	public function save_doorprize()
	{
		// echo json_encode($this->input->post());die;
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}

		$registration_id 	= $this->input->post('registration_id');
		$participant_nip 	= $this->input->post('participant_nip');
		$participant_name 	= $this->input->post('participant_name');

		$check_nik = $this->sitemodel->view('view_registration', '*', ['registration_id'=>$registration_id, 'is_verify'=>1]);
		if ( !$check_nik ) {$this->response['msg'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}

		$check_attendance = $this->sitemodel->view('view_registration', '*', ['registration_id'=>$registration_id, 'is_verify'=>1, 'is_taken_doorprize'=>1]);
		if ( $check_attendance ) {
			$this->response['msg'] = "Anda telah melakukan mengambil doorprize pada pukul ".date('d/m/Y H:i:s', strtotime($check_attendance[0]->taken_doorprize_datetime));
			echo json_encode($this->response);
			exit;
		}

		$data = [
			'is_taken_doorprize' 		=> 1,
			'taken_doorprize_datetime' 	=> date('Y-m-d H:i:s'),
			'modion' 					=> date('Y-m-d H:i:s'),
		];

		$update = $this->sitemodel->update('tr_registration', $data, ['registration_id'=>$registration_id]);

		/*** Result Area ***/
		$this->response['type'] = 'done';
		echo json_encode($this->response);
		exit;
	}
}
