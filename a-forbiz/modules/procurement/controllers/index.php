<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Index extends MY_Controller {

    private $title = "Procurement";
    private $header = "Procurement";

    public function __construct() {
        parent::__construct();
        is_logged_in();
    }

    public function index() {
		die('a');
        $data['sess'] = $this->authentication_root();
        $data['title'] = $this->title;
        $data['header'] = $this->header;
        $data['active'] = null;
        $data['content'] = "home";
        $data['features'] = "procurement";
        $this->load->view("../index", $data);
    }

}
