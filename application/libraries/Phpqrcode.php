<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
ini_set('error_reporting', E_ALL);
require_once APPPATH."/third_party/phpqrcode/qrlib.php";

class Phpqrcode {

	function generate($string, $dir){
		QRcode::png($string, $dir, QR_ECLEVEL_L, 4);
	}
} 