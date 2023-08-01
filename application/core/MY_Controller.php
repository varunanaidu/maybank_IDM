<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

	protected $fragment  = [];
	protected $response  = [];

	protected $log_user  = '';
	protected $log_role  = 'admin';
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		
		if ($this->hasLogin()) {
			$this->log_user  = $this->session->userdata(SESS)->log_user;
			$this->fragment['log_user']  = $this->log_user;

			if ( $this->session->userdata(SESS)->log_user == 2 ) {
				$this->log_role = 'developer';
				$this->fragment['log_role'] = $this->log_role;
			}else{
				$this->log_role = 'admin';
				$this->fragment['log_role'] = $this->log_role;
			}
		}
	}
	
	function hasLogin() {
		return $this->session->userdata(SESS);
	}

	function compress_image($source_url, $destination_url, $quality) {
		$info = getimagesize($source_url);

		if ($info['mime'] == 'image/jpeg')
			$image = imagecreatefromjpeg($source_url);
		elseif ($info['mime'] == 'image/gif')
			$image = imagecreatefromgif($source_url);
		elseif ($info['mime'] == 'image/png')
			$image = imagecreatefrompng($source_url);
		imagejpeg($image, $destination_url, $quality);

		return true;
	}
}