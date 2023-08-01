<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antigen extends MY_Controller {

	public function index(){

		$this->load->view('antigen/index');
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
		$check = $this->sitemodel->view('view_registration', '*', ['participant_nip'=>$key]);
		if (!$check) {$this->response['msg'] = "No data found.";echo json_encode($this->response);exit;}
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = $check;
		echo json_encode($this->response);
		exit;
	}

	public function save_antigen()
	{
		// echo json_encode($this->input->post());die;
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}

		$registration_id 	= $this->input->post('registration_id');
		$antigen 		 	= $this->input->post('antigen');
		$participant_nip 	= $this->input->post('participant_nip');
		$participant_nik 	= $this->input->post('participant_nik');
		$participant_name 	= $this->input->post('participant_name');

		$check_nik = $this->sitemodel->view('view_registration', '*', ['registration_id'=>$registration_id]);
		if ( !$check_nik ) {$this->response['msg'] = "Data tidak ditemukan";echo json_encode($this->response);exit;}

		$check_antigen = $this->sitemodel->view('view_registration', '*', ['registration_id'=>$registration_id]);
		if ($check_antigen && $check_antigen[0]->is_antigen != 0 ) {
			$hasil = $check_antigen[0]->is_antigen;
			$hasil_antigen = ( ($hasil == 1) ? 'Negatif' : 'Positif' );
			$this->response['msg'] = "Anda telah melakukan antigen pada tanggal " . date('d/m/Y H:i:s', strtotime($check_antigen[0]->antigen_datetime)) . " dengan hasil " . $hasil_antigen;
			echo json_encode($this->response);exit;
		}

		$data = [
			'is_antigen' => $antigen,
			'antigen_datetime' => date('Y-m-d H:i:s'),
			'modion' => date('Y-m-d H:i:s'),
		];

		$update = $this->sitemodel->update('tr_registration', $data, ['registration_id'=>$registration_id]);

		/*** Result Area ***/
		$this->response['type'] = 'done';
		echo json_encode($this->response);
		exit;
	}
}
