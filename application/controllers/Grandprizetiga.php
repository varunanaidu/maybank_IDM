<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL);

require_once APPPATH . 'vendor/autoload.php';

class Grandprizetiga extends MY_Controller {

	public function index()
	{
		$data['gift'] = $this->sitemodel->view('tab_gift', '*');
		$this->load->view('grandprize/index3', $data);
	}

	public function button()
	{
		$data['gift'] = $this->sitemodel->view('tab_gift', '*');
		$this->load->view('grandprize/button', $data);
	}

	public function get_participant()
	{
		$check = $this->sitemodel->view('view_allow_grandprize_choosen','*');
		echo json_encode($check);
	}

	public function search_participant()
	{
		$term = $this->input->get("term");
		// echo json_encode($term);die;
		$res = [];
		$check = $this->sitemodel->custom_query("SELECT * FROM view_allow_grandprize_choosen WHERE participant_name LIKE '%".$term."%' OR participant_email LIKE '%".$term."%' ");
		// echo json_encode($check);die;
		if($check){
			foreach ($check as $row) {
				$sub_res = [];
				$sub_res['id'] = $row->registration_id;
				$sub_res['text'] = $row->participant_name.' - '.$row->participant_email;
				$res[] = $sub_res;
			}
		}

		echo json_encode($res);
		exit;
	}


	public function get_result()
	{
		$check = $this->sitemodel->view('view_allow_grandprize_choosen','*');
		if ( $check && $check != 0 ) {
			$random = mt_rand(0, (sizeof($check)-1));
			$data['result_id']	= $check[$random]->registration_id;
			$data['result_name'] = $check[$random]->participant_name;
			$data['result_email'] = $check[$random]->participant_email;
			$data['result_wa'] = $check[$random]->participant_wa;
			
			echo json_encode($data);
		}
	}

	public function get_selected_result()
	{
		$registration_id = $this->input->post('registration_id');
		$check = $this->sitemodel->view('view_allow_grandprize2','*', ['registration_id'=>$registration_id]);
		$data['result_id']	= $check[0]->registration_id;
		$data['result_name'] = $check[0]->participant_name;
		$data['result_email'] = $check[0]->participant_email;
		$data['result_wa'] = $check[0]->participant_wa;

		$options = [
			'cluster'	=> 'ap1',
			'useTLS'	=> true
		];

		$pusher = new Pusher\Pusher(
			'57b1c37d7c00671cbe6f',
			'fc2a347238ded0a1a0ae',
			'1300980',
			$options
		);

		$event = $pusher->trigger('channel1', 'event', ['message'=>'selected_result', 'data'=>$data], null, true);
		echo json_encode($event);
	}

	public function save_tr()
	{
		// echo json_encode($this->input->post());die;
		$registration_id = $this->input->post('registration_id');

		$data_tr = [
			'registration_id' 	=> $registration_id,
			'addon'				=> date('Y-m-d H:i:s'),
		];

		$tr = $this->sitemodel->insert('tr_grandprize_choosen', $data_tr);

		echo json_encode("Success Save Transaction");
	}

	public function button_start()
	{
		$options = [
			'cluster'	=> 'ap1',
			'useTLS'	=> true
		];

		$pusher = new Pusher\Pusher(
			'57b1c37d7c00671cbe6f',
			'fc2a347238ded0a1a0ae',
			'1300980',
			$options
		);

		$event = $pusher->trigger('channel1', 'event', ['message'=>'start'], null, true);
		echo json_encode($event);
	}

	public function button_stop()
	{
		$options = [
			'cluster'	=> 'ap1',
			'useTLS'	=> true
		];

		$pusher = new Pusher\Pusher(
			'57b1c37d7c00671cbe6f',
			'fc2a347238ded0a1a0ae',
			'1300980',
			$options
		);

		$event = $pusher->trigger('channel1', 'event', ['message'=>'stop'], null, true);
		echo json_encode($event);
	}

	public function change_gift()
	{
		$gift_id = $this->input->post('gift_id');
		$gift = $this->sitemodel->view('tab_gift', '*', ['gift_id'=>$gift_id]);
		$options = [
			'cluster'	=> 'ap1',
			'useTLS'	=> true
		];

		$pusher = new Pusher\Pusher(
			'57b1c37d7c00671cbe6f',
			'fc2a347238ded0a1a0ae',
			'1300980',
			$options
		);

		$event = $pusher->trigger('channel1', 'event', ['message'=>'change_gift', 'gift'=>$gift], null, true);
		echo json_encode($event);
	}

	public function test_get_api()
	{
		$this->load->library('guzzle');

		$data = $this->guzzle->guzzle_metrofest();

		echo json_encode($data);
	}


}
