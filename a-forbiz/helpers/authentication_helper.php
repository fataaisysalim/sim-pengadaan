<?php

if (!function_exists('is_logged_in')) {

    function is_logged_in() {
        $CI = & get_instance();
        $is_logged_in = $CI->session->userdata(md5('for_wika'));
        if (!isset($is_logged_in) || $is_logged_in != true) :
            redirect('');
        endif;
    }

    function is_filtered($level) {
        $CI = & get_instance();
        $is_logged_in = $CI->session->userdata(md5('for_wika'));
        foreach ($level as $position => $url) {
            if ($is_logged_in['position_id'] == $position) {
                redirect($url);
            }
        }
    }

    function is_filtered_mod($case) {
        if ($case < 1) {
            redirect();
        }
    }

}