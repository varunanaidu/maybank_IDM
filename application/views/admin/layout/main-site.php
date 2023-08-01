<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('admin/layout/layout-top');
$this->load->view($pagename);
$this->load->view('admin/layout/layout-bot'); ?>