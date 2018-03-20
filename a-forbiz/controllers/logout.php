<?php

/**
 * Description of login
 *
 * @author Fachrur Rois H
 */
class Logout extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->recActivity("Logout of system", "access");
        $this->session->sess_destroy();
        $this->session->unset_userdata(md5('for_wika'));
        redirect('');
    }

}
