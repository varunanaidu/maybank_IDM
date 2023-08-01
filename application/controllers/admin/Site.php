<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MY_Controller {

	public function index(){

		if (!$this->hasLogin()) {
			redirect('admin/site/login');
		}

		$this->fragment['js'] = [ 
			base_url('assets/js/pages/admin/site.js') 
		];

		$this->fragment['pagename'] = 'admin/pages/index.php';

		$registration = $this->sitemodel->view('view_registration', '*');
		$this->fragment['registration'] = ( $registration ? sizeof($registration) : 0 );

		/*$attendance_one = $this->sitemodel->custom_query("SELECT COUNT(registration_id) AS TOTAL FROM view_booth_attendance WHERE DATE(attendance_date) = '2023-02-15' GROUP BY registration_id ");
		$this->fragment['attendance_one'] = ( $attendance_one != 0 ? $attendance_one[0]->TOTAL : 0 );

		$attendance_two = $this->sitemodel->custom_query("SELECT COUNT(registration_id) AS TOTAL FROM view_booth_attendance WHERE DATE(attendance_date) = '2023-02-16' GROUP BY registration_id ");
		$this->fragment['attendance_two'] = ( $attendance_two != 0 ? $attendance_two[0]->TOTAL : 0 );

		$attendance_three = $this->sitemodel->custom_query("SELECT COUNT(registration_id) AS TOTAL FROM view_booth_attendance WHERE DATE(attendance_date) = '2023-02-17' GROUP BY registration_id ");
		$this->fragment['attendance_three'] = ( $attendance_three != 0 ? $attendance_three[0]->TOTAL : 0 );

		$attendance_four = $this->sitemodel->custom_query("SELECT COUNT(registration_id) AS TOTAL FROM view_booth_attendance WHERE DATE(attendance_date) = '2023-02-18' GROUP BY registration_id ");
		$this->fragment['attendance_four'] = ( $attendance_four != 0 ? $attendance_four[0]->TOTAL : 0 );

		$attendance_five = $this->sitemodel->custom_query("SELECT COUNT(registration_id) AS TOTAL FROM view_booth_attendance WHERE DATE(attendance_date) = '2023-02-19' GROUP BY registration_id ");
		$this->fragment['attendance_five'] = ( $attendance_five != 0 ? $attendance_five[0]->TOTAL : 0 );
		*/

		$pengunjung = [];
		$booth = $this->sitemodel->view('tab_booth', '*');
		if ( $booth ) {
			foreach ($booth as $row) {
				$temp = [];
				$temp['booth_number'] = $row->booth_number;
				$check_total = $this->sitemodel->view('view_booth_attendance', '*');
				if (!$check_total) {
					$temp['total'] = 0;
				}else{
					$temp['total'] = sizeof($check_total);
				}

				$pengunjung[] = $temp;
			}
		}
		$this->fragment['pengunjung'] = $pengunjung;


		$this->load->view('admin/layout/main-site', $this->fragment);
	}

	public function login(){
		if( $this->hasLogin() ) redirect();
		$this->load->view('admin/login_page');
	}

	public function signin()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_name','Username','required');
		$this->form_validation->set_rules('user_pass','Password','required');

		if ($this->form_validation->run() == false) {
			$this->response['msg'] = validation_errors();
			echo json_encode($this->response);
			exit;
		}

		$user_name = $this->input->post('user_name');
		$user_pass = md5($this->input->post('user_pass'));

		$check = $this->sitemodel->view('tab_user', '*', ['user_name'=>$user_name]);
		if (!$check) {$this->response['msg'] = "No user found.";echo json_encode($this->response);exit;}

		if ( $user_pass != $check[0]->user_pass ) {
			$this->response['msg'] = "Invalid username or password.";
			echo json_encode($this->response);
			exit;					
		}

		$data_sess = [
			'log_user'	=> $check[0]->user_id,
		];

		$this->session->set_userdata(SESS, (object)$data_sess);
		$this->response['type'] = 'done';
		$this->response['msg'] = "Successfully login.";
		echo json_encode($this->response);
	}

	public function signout()
	{
		$this->session->sess_destroy();
		redirect ( base_url() );
	}
}
