<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends MY_Controller {

	public function index(){

		 $this->load->view('registration/index');
		
		// if ( date('Y-m-d H:i:s') < '2021-11-26 00:00:00' ) {
		// 	$this->load->view('registration/index');
		// }else{
		// 	$this->load->view('registration/index2');
		// }
	}

	public function registered($id)
	{
		$data['participant'] = $this->sitemodel->view('view_registration', '*', ['registration_id'=>$id]);
		$this->load->view('registration/registered', $data);
	}

	public function save()
	{
		// echo json_encode($this->input->post());die;
		// if ( date('Y-m-d H:i:s') > '2021-11-25 00:00:00' ) {
		// 	$this->response['msg'] = "Batas pendaftaran telah berakhir. Anda belum beruntung";
		// 	echo json_encode($this->response);exit;
		// }
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}

		$participant_name 			= $this->input->post('participant_name');
		$company_name 				= $this->input->post('company_name');
		$participant_email 			= $this->input->post('participant_email');
		$participant_wa 			= $this->input->post('participant_wa');
		$participant_manager 		= $this->input->post('participant_manager');
		

		$check_nik = $this->sitemodel->view('view_participants', '*', ['participant_email'=>$participant_email]);
		if ($check_nik) {$this->response['msg'] = "Anda telah melakukan pendaftaran !";echo json_encode($this->response);exit;}

		$data = [
			'participant_name'			=> $participant_name,
			'company_name'				=> $company_name,
			'participant_email'			=> $participant_email,
			'participant_wa'			=> $participant_wa,
			'participant_manager'		=> $participant_manager,
			'participant_qr'			=> '',
			'addon'						=> date('Y-m-d H:i:s'),
		];

		$participant_id = $this->sitemodel->insert('tab_participants', $data);

		$target_dir = 'assets/public/registran/'.$participant_id.'/';
		$participant_qr = md5($participant_id).".png";
		$data_update['participant_qr'] = $participant_qr;
		$files = $target_dir.$participant_qr;
		
		if (!file_exists($target_dir)) {
			mkdir($target_dir, 0777, true);
		}

		$this->load->library('phpqrcode');
		$qr = $this->phpqrcode->generate($participant_id, $target_dir.$participant_qr);

		// echo json_encode($qr);die;
		$update = $this->sitemodel->update('tab_participants', $data_update, ['participant_id'=>$participant_id]);


		$data_registration = [
			'participant_id' => $participant_id,
			'addon'			 => date('Y-m-d H:i:s'),
			'modion'		 => date('Y-m-d H:i:s'),
		];
		
		$registration = $this->sitemodel->insert('tr_registration', $data_registration);
		$check = $this->sitemodel->view('view_registration', '*', ['registration_id'=>$registration]);
		$files = base_url('assets/public/registran/'.$check[0]->registration_id.'/'.$check[0]->participant_qr);
		# send email
		$subject = 'Registrasi Maybank Indonesia Economic Outlook 2023';
		$data_email['email']['content'] = $this->sitemodel->view('view_registration', '*', ['registration_id'=>$registration]);
		$data_email['page'] = 'registration';
		$content = $this->load->view('emails/template', $data_email, true);

		$isSent = sendEmail($participant_email, $subject, $content, "Registrasi City of ALL", $files);
		//$isSent = sendEmailAuthentic($participant_email, $subject, $content, "Pendaftaran Pameran", $files);
		
		if (! $isSent) {
			$this->response['msg'] = "Oops, we failed to send an email to." . $participant_email;
		}else{
			$this->response['msg'] = "Email has been sent to." . $participant_email;
		}

		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['id'] = $registration;
		echo json_encode($this->response);
		exit;
	}
}
