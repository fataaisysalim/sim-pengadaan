<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Index extends MY_Controller {

    private $title = "Finance";
    private $header = "Finance";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model("finance/graph_m");
    }

    public function index() {
        $data['sess'] = $this->authentication_root();
        $data['title'] = $this->title;
        $data['header'] = $this->header;
        $data['active'] = null;
        $data['content'] = "home";
        $data['now'] = date("Y");
        $data['project'] = $this->crud_model->read_fordata(array("table" => "project p", "join" => array("project_access pa" => "pa.project_id = p.project_id"), "where" => array("md5(users_id)" => $data['sess']['users_id'])))->result();
        $data["last_activity"] = $this->crud_model->read_fordata(array("table" => "activity a", "where" => array("a.activity_ct" => "finance"), "join" => array("users u" => "u.users_id = a.users_id", "users_position up" => "up.users_position_id = u.users_position_id", "employee e" => "e.employee_id = u.employee_id"), "order" => array("a.activity_id" => "DESC"), "limit" => 12))->result();
        $data['outstanding'] = $this->crud_model->read_data("invoice", array("invoice_payment_status" => 0))->num_rows();
        $data['paid'] = $this->crud_model->read_data("invoice", array("invoice_payment_status" => 1))->num_rows();
        $data['etcCots'] = $this->crud_model->read_data("doc_control", array("actor_id" => null))->num_rows();
        $this->load->view("../index", $data);
    }

    public function transaverage($year_load = null, $project_load = null) {
        $year = isset($year_load) ? $year_load : date('Y');
        $data['year'] = $year;
        $data['average'] = $this->graph_m->transaction_average($year, $project_load);
        $average = $data['average'];
        $avg = null;
        $avg[0] = array(
            "name" => "Outstanding",
            "data" => array(
                !empty($average['outstanding']['Jan']) ? $average['outstanding']['Jan'] : 0,
                !empty($average['outstanding']['Feb']) ? $average['outstanding']['Feb'] : 0,
                !empty($average['outstanding']['Mar']) ? $average['outstanding']['Mar'] : 0,
                !empty($average['outstanding']['Apr']) ? $average['outstanding']['Apr'] : 0,
                !empty($average['outstanding']['Mei']) ? $average['outstanding']['Mei'] : 0,
                !empty($average['outstanding']['Jun']) ? $average['outstanding']['Jun'] : 0,
                !empty($average['outstanding']['Jul']) ? $average['outstanding']['Jul'] : 0,
                !empty($average['outstanding']['Agus']) ? $average['outstanding']['Agus'] : 0,
                !empty($average['outstanding']['Sept']) ? $average['outstanding']['Sept'] : 0,
                !empty($average['outstanding']['Okto']) ? $average['outstanding']['Okto'] : 0,
                !empty($average['outstanding']['Nove']) ? $average['outstanding']['Nove'] : 0,
                !empty($average['outstanding']['Des']) ? $average['outstanding']['Des'] : 0
            )
        );
        $avg[1] = array(
            "name" => "Paid",
            "data" => array(
                !empty($average['paid']['Jan']) ? $average['paid']['Jan'] : 0,
                !empty($average['paid']['Feb']) ? $average['paid']['Feb'] : 0,
                !empty($average['paid']['Mar']) ? $average['paid']['Mar'] : 0,
                !empty($average['paid']['Apr']) ? $average['paid']['Apr'] : 0,
                !empty($average['paid']['Mei']) ? $average['paid']['Mei'] : 0,
                !empty($average['paid']['Jun']) ? $average['paid']['Jun'] : 0,
                !empty($average['paid']['Jul']) ? $average['paid']['Jul'] : 0,
                !empty($average['paid']['Agus']) ? $average['paid']['Agus'] : 0,
                !empty($average['paid']['Sept']) ? $average['paid']['Sept'] : 0,
                !empty($average['paid']['Okto']) ? $average['paid']['Okto'] : 0,
                !empty($average['paid']['Nove']) ? $average['paid']['Nove'] : 0,
                !empty($average['paid']['Des']) ? $average['paid']['Des'] : 0
            )
        );
        $data['json'] = json_encode($avg, JSON_NUMERIC_CHECK);
        $this->load->view("extend/graph/invoice_transaction_average", $data);
    }

    public function transaveragefee($year_load = null, $project_load = null) {
        $year = isset($year_load) ? $year_load : date('Y');
        $data['year'] = $year;
        $data['average'] = $this->graph_m->transaction_average_fee($year, $project_load);

        $average = $data['average'];
        $avg = null;
            $avg[0] = array(
                "name" => "Fee Foreman",
                "data" => array(
                    !empty($average['fee']['Jan']) ? $average['fee']['Jan'] : 0,
                    !empty($average['fee']['Feb']) ? $average['fee']['Feb'] : 0,
                    !empty($average['fee']['Mar']) ? $average['fee']['Mar'] : 0,
                    !empty($average['fee']['Apr']) ? $average['fee']['Apr'] : 0,
                    !empty($average['fee']['Mei']) ? $average['fee']['Mei'] : 0,
                    !empty($average['fee']['Jun']) ? $average['fee']['Jun'] : 0,
                    !empty($average['fee']['Jul']) ? $average['fee']['Jul'] : 0,
                    !empty($average['fee']['Agus']) ? $average['fee']['Agus'] : 0,
                    !empty($average['fee']['Sept']) ? $average['fee']['Sept'] : 0,
                    !empty($average['fee']['Okto']) ? $average['fee']['Okto'] : 0,
                    !empty($average['fee']['Nove']) ? $average['fee']['Nove'] : 0,
                    !empty($average['fee']['Des']) ? $average['fee']['Des'] : 0
                )
            );
        $data['json'] = json_encode($avg, JSON_NUMERIC_CHECK);

        $this->load->view("extend/graph/fee_transaction_average", $data);
    }

}
