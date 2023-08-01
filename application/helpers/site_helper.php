<?php defined('BASEPATH') OR exit("No direct script access allowed");

if (!function_exists('esc')){
	function esc(&$value){
		$value = trim(html_escape($value));
	}
}

if (!function_exists('xss_filter')){
	function xss_filter($array){
		array_walk($array, 'esc');
	}
}

if (!function_exists('ist')){
	function ist(&$var, $default = ""){
		$t = "";
		if ( !isset($var)  || !$var ) {
			if (isset($default) && $default != "") $t = $default;
		}
		else  {  
			$t = $var;
		}
		if (is_string($t)) $t = trim($t);
		return htmlentities(stripslashes(utf8_decode($t)));
	}
}

if(!function_exists('isLogin')){
	
	function isLogin(){
		
		$CI = &get_instance();
		return $CI->session->userdata(SESS_BOOTH);
	}
}

if (!function_exists('proper_lang')){
	function proper_lang($item, $default = true){
		$explode = explode(" ", trim($item));
		$temp = [];
		$length = $default ? 3 : 2;
		foreach ($explode as $x){
			$x = strlen(trim($x)) <= $length ? strtoupper($x) : ucwords(strtolower($x));
			array_push($temp, $x);
		}
		$result = implode(" ", $temp);
		return $result;
	}
}

if (!function_exists('photo_url')){	
	function photo_url($nip = false, $thumb = false){
		// $url = 'http://192.168.100.100/media/employee/';		
		if (! $nip) 
			$nip = "sa";
		
		if ($thumb) {
			$target_file = "assets/employee/{$nip}/thumb/{$nip}.jpg";
			if ( file_exists($target_file) )
				return base_url($target_file);
		}
		$target_file = "assets/employee/{$nip}/{$nip}.jpg";
		if ( file_exists($target_file) )
			return base_url($target_file);
		$url = base_url("assets/images/g/no_photo.png");
		return $url;

	// 	$path = $thumb ? "assets/employee/{$nip}/thumb/{$nip}.jpg" : "assets/employee/{$nip}/{$nip}.jpg";
	// 	$img = file_get_contents($path);
	// 	header("Content-Type: image/jpeg");
	// 	echo $img;
	}
}

if (!function_exists('photo_url2')){	
	function photo_url2($nip = false, $thumb = false){
		// $nip = $nip ?? "sa";
		$nip;
		if ( $nip ) {
			$nip = $nip;
		}else{
			$nip = "sa";
		}
		$path = $thumb ? "assets/employee/{$nip}/thumb/{$nip}.jpg" : "assets/employee/{$nip}/{$nip}.jpg";
		$img = file_get_contents($path);
		header("Content-Type: image/jpeg");
		echo $img;
	}
}

if (!function_exists('sendEmail')){	
	function sendEmail($to, $subject, $content, $alias='', $attachment){		
				$config = array(
			'protocol' 		=> 'smtp',
			'smtp_host' 	=> 'smtp.mailgun.org',
			'smtp_port' 	=> 587,
			'smtp_user' 	=> 'noreply_recruitment@mediagroupnetwork.com',
			'smtp_pass' 	=> 'ae86b4659154b497ff2d899c180c75c8-75cd784d-9463a4a6',
			'mailtype' 		=> 'html',
			'charset' 		=> 'iso-8859-1',
			'newline'		=> "\r\n",
			'wordwrap' 		=> TRUE
		);
		$CI = &get_instance();
		$CI->load->library('email', $config);
		$CI->email->clear(TRUE);
		$CI->email->from('ess@metrotvnews.com', 'Maybank Indonesia Economic Outlook 2023');
		$CI->email->to($to);
		$CI->email->subject($subject);
		$CI->email->message($content);
		$CI->email->attach($attachment);
		return $CI->email->send();
	}
}

if (!function_exists('sendEmail_IDOCS')){	
	function sendEmail_IDOCS($to, $subject, $content){		
		$config = array(
			'protocol' 		=> 'smtp',
			'smtp_host' 	=> 'mail.metrotvnews.com',
			'smtp_port' 	=> 25,
			'smtp_user' 	=> 'ess@metrotvnews.com',
			'smtp_pass' 	=> '$Metrotv89',
			'mailtype' 		=> 'html',
			'charset' 		=> 'iso-8859-1',
			'newline'		=> "\r\n",
			'wordwrap' 		=> TRUE
		);
		$CI = &get_instance();
		$CI->load->library('email', $config);
		$CI->email->clear(TRUE);
		$CI->email->from('ess@metrotvnews.com', 'IDOCS');
		$CI->email->to($to);
		$CI->email->subject($subject);
		$CI->email->message($content);
		return $CI->email->send();

	}
}

if (!function_exists('sendEmailAuthentic')){	
	function sendEmailAuthentic($to, $subject, $content, $alias='', $attachment){		
		$config = array(
			'protocol' 		=> 'smtp',
			'smtp_host' 	=> 'smtp.mandrillapp.com',
			'smtp_port' 	=> 587,
			'smpt_crypto'	=> 'tls',
			'smtp_user' 	=> 'medcom',
			'smtp_pass' 	=> 'xg9jItZQBLJYqybrWibxwQ',
			'mailtype' 		=> 'html',
			'charset' 		=> 'iso-8859-1',
			'newline'		=> "\r\n",
			'wordwrap' 		=> TRUE
		);
		$CI = &get_instance();
		$CI->load->library('email', $config);
		$CI->email->clear(TRUE);
		$CI->email->from('noreply@myconsolnet.com', 'City of ALL');
		$CI->email->to($to);
		$CI->email->subject($subject);
		$CI->email->message($content);
		$CI->email->attach($attachment);
		return $CI->email->send();
	}
}

if (!function_exists('isValidEmailDomain')){
	function isValidEmailDomain($email){
		$email = strtolower(trim($email));
		$allowed_domain = ['metrotvnews.com'];
		if (filter_var($email, FILTER_VALIDATE_EMAIL)){
			$parts = explode('@', $email);
			$domain = array_pop($parts);
			if (in_array($domain, $allowed_domain)) return true;
		}
		return false;
	}
}

if ( !function_exists('get_client_ip_env') ){
	function get_client_ip_env() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		
		return $ipaddress;
	}
}

if ( !function_exists('getBrowser') ){
	function getBrowser() {
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";
		// First get the platform?
		if ( preg_match('/linux/i', $u_agent) )
			$platform = 'linux';
		else if ( preg_match('/macintosh|mac os x/i', $u_agent) )
			$platform = 'mac';
		else if ( preg_match('/windows|win32/i', $u_agent) )
			$platform = 'windows';
		
		// Next get the name of the useragent yes seperately and for good reason
		if( preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent) ) {
			$bname = 'Internet Explorer';
			$ub = "MSIE";
		}
		else if ( preg_match('/Firefox/i',$u_agent) ) {
			$bname = 'Mozilla Firefox';
			$ub = "Firefox";
		}
		else if( preg_match('/Chrome/i',$u_agent) ) {
			$bname = 'Google Chrome';
			$ub = "Chrome";
		}
		else if( preg_match('/Safari/i',$u_agent) ) {
			$bname = 'Apple Safari';
			$ub = "Safari";
		}
		else if( preg_match('/Opera/i',$u_agent) ) {
			$bname = 'Opera';
			$ub = "Opera";
		}
		else if( preg_match('/Netscape/i',$u_agent) ) {
			$bname = 'Netscape';
			$ub = "Netscape";
		}
		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {}
		// see how many we have
			$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub))
				$version= $matches['version'][0];
			else
				$version= $matches['version'][1];
		}
		else
			$version= $matches['version'][0];
		// check if we have a number
		if ($version==null || $version=="") {$version="?";}
		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
		);
	}
}

if ( !function_exists('searchArrayByValue') ){
	function searchArrayByValue($haystack, $field, $value){
		foreach ($haystack as $key => $val){
			if ($val->$field === $value) return $key;
		}
		return false;
	}
}