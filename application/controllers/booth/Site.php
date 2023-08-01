<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
	}

	public function index()
	{
		if (!isLogin()) {
			redirect('booth/site/login');
		}

		$this->load->view('booth/index');
	}

	public function find()
	{
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		/*** Params ***/
		/*** Required Area ***/
		$key = $this->input->post("key");
		/*** Optional Area ***/
		/*** Validate Area ***/
		if ( empty($key) ){$this->response['msg'] = "Invalid parameter.";echo json_encode($this->response);exit;}
		/*** Accessing DB Area ***/
		$check = $this->sitemodel->view('view_registration', '*', ['participant_id'=>$key] );
		if (!$check) {$this->response['msg'] = "Data tidak ditemukan.";echo json_encode($this->response);exit;}
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = $check;
		echo json_encode($this->response);
		exit;
	}

	public function save_attendance()
	{
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		$participant_id = $this->input->post('participant_id');
		$registration_id = $this->input->post('registration_id');
		$booth_id = $this->session->userdata(SESS_BOOTH)->booth_id;

		$check = $this->sitemodel->view('view_booth_attendance', '*', ['registration_id'=>$registration_id, 'DATE(attendance_date)'=>date('Y-m-d')]);
		if ($check) {
			$this->response['msg'] = 'Anda telah melakukan verifikasi kehadiran pada tanggal ' . PHP_EOL . date('d F Y H:i:s', strtotime($check[0]->attendance_date));
			echo json_encode($this->response);exit;
		}

		$data_tr = [
			'registration_id' => $registration_id,
			'booth_id'		  => $booth_id,
			'attendance_date' => date('Y-m-d H:i:s')
		];

		$attendance_id = $this->sitemodel->insert('tr_attendance', $data_tr);

		$this->response['msg'] = 'Successfuly insert data';
		$this->response['attendance_id'] = $attendance_id;
		$this->response['type'] = 'done';

		echo json_encode($this->response);
		exit;
	}

	public function login()
	{
		$data['booth'] = $this->sitemodel->view('tab_booth', '*');
		$this->load->view('booth/login', $data);
	}

	public function signin()
	{
		// echo json_encode($this->input->post());die;
		$booth_id = $this->input->post('booth_id');

		if ( $booth_id == "" ) {
			echo json_encode(["msg"=>"Pilih Booth"]);
			exit;
		}

		$check = $this->sitemodel->view('tab_booth', '*', ['booth_id'=>$booth_id]);

		$data = [
			'booth_id' => $booth_id,
			'booth_number' => $check[0]->booth_number,
			'booth_status' => 'Logged',
			'type' => 'done'
		];

		$this->session->set_userdata(SESS_BOOTH, (object)$data);

		echo json_encode($data);
		exit;
	}

	public function signout(){
		
		$this->session->unset_userdata(SESS_BOOTH);
		redirect(base_url('booth'));
	}

}
