<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function index_get()
    {
        $check = $this->sitemodel->view('view_allow_grandprize','*');

        $this->response($check, 200);
    }

    public function gift_get()
    {
        $check = $this->sitemodel->view('tab_gift','*');

        $this->response($check, 200);
    }
}
