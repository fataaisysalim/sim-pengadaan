<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class About extends MY_Controller {

    private $title = "About WG System";

    public function __construct() {
        parent::__construct();
        is_logged_in();
    }

    public function index() {
        $data['sess'] = $this->authentication_root();
        $data['title'] = $this->title;
        $this->user_session('dashboard', 'about', $data);
    }

}
