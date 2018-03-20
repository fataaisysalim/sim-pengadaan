<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Export extends MY_Controller {

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->helper(array('folarium', 'date_format'));
        $this->load->model(array('origin_model', 'monitoring_model'));
    }

    public function index() {
        //nothing to do here
    }

    public function detail($project = null, $work_order = null) {
        $data = array(
            'title_page' => 'Monitoring Subkon',
            'title_file' => 'monitoring_subkon',
            'title_company' => $this->config->item('config_client'),
            'setting_date' => date('Y-m-d')
        );
        $data['apps'] = $this->crud_model->read_data('apps', null, null)->row();
        $data['project'] = $this->crud_model->read_data('project', array('md5(project_id)' => $project), null)->row();

        $where = array(
            "md5(work_order_id)" => $work_order,
        );
        $join = array(
            "actor ac" => "ac.actor_id = wok.actor_id",
            "users us" => "us.users_id = wok.users_id",
            "project p" => "p.project_id = wok.project_id"
        );
        $data["work"] = $this->crud_model->read_data_with_false("work_order wok", $where, null, $join)->row_array();
        $data["show"] = $this->crud_model->read_data_with_false("invoice inv", $where, null, null)->result_array();


        foreach ($data['show'] as $index => $row) :
            $dum[] = $row['invoice_id'];
        endforeach;
        foreach ($data['show'] as $index => $row) :
            $data['tax'] = $this->crud_model->read_data("invoice_tax", array('invoice_id' => $row['invoice_id']), null, array('tax' => 'invoice_tax.tax_id = tax.tax_id'))->result_array();
            if (count($data['tax']) > 0) :
                foreach ($data['tax'] as $row_) :
                    $data['show'][$index]['invoice_tax'] = $data['tax'];
                endforeach;
            else:
                $data['show'][$index]['invoice_tax'] = array();
            endif;

            $data['invoice_wo'] = $this->monitoring_model->get_invoice($dum);
            if (count($data['invoice_wo']) > 0) :
                $data['show'][$index]['invoice_wo'] = $data['invoice_wo'];
            else:
                $data['show'][$index] = array();
            endif;
        endforeach;


//        if (count($data['invoice_wo']) > 0) :
//            $data['show'][$index]['invoice_wo'][] = $data['invoice_wo'];
//        else:
//            $data['show'][$index] = array();
//        endif;
//        echo '<pre>';
//        print_r($data['show']);
//        echo '</pre>';

        $work_contract = $data['work']['work_order_contract'];
        $work_dp = $data['work']['work_order_dp'];
        $work_retensi = $data['work']['work_order_retensi'];
        $work_plus = ($data['work']['work_order_extra_mode'] == 1) ? $data['work']['work_order_extra'] : 0;
        $work_min = ($data['work']['work_order_extra_mode'] == 2) ? $data['work']['work_order_extra'] : 0;
        $work_contract_total = $work_contract + $work_plus - $work_min;
        $dummy = array(
            'presentase' => 0,
            'kumulatif' => 0,
            'prenetto' => 0,
            'angsuran' => 0,
            'retensi' => 0,
            'netto' => 0,
            'ppn' => 0,
            'bruto' => 0,
            'pph' => 0,
            'penerimaan' => 0,
            'presentase_total' => 0,
            'rumus_plus' => 0,
            'rumus_minus' => 0,
        );
        $variable = array(
            'tax' => array(
                'tax_ppn' => 0,
                'tax_pph' => 0
            ),
            'downinvoice_wo' => array(
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'termin' => array(
                'sequence' => 0,
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'retensi_bayar' => array(
                'sequence' => 0,
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'last' => array(
                'sequence' => 0,
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'work_extra_plus' => array(
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'work_extra_minus' => array(
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'work_extra' => array(
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'final' => array(
                'final_account' => array(
                    'presentase' => 0,
                    'kumulatif' => 0,
                    'prenetto' => 0,
                    'angsuran' => 0,
                    'retensi' => 0,
                    'netto' => 0,
                    'ppn' => 0,
                    'bruto' => 0,
                    'pph' => 0,
                    'penerimaan' => 0
                ),
                'sisa_progress_induk' => array(
                    'presentase' => 0,
                    'kumulatif' => 0,
                    'prenetto' => 0,
                    'angsuran' => 0,
                    'retensi' => 0,
                    'netto' => 0,
                    'ppn' => 0,
                    'bruto' => 0,
                    'pph' => 0,
                    'penerimaan' => 0
                ),
                'work_extra_plus' => array(
                    'presentase' => 0,
                    'kumulatif' => 0,
                    'prenetto' => 0,
                    'angsuran' => 0,
                    'retensi' => 0,
                    'netto' => 0,
                    'ppn' => 0,
                    'bruto' => 0,
                    'pph' => 0,
                    'penerimaan' => 0
                ),
                'work_extra_minus' => array(
                    'presentase' => 0,
                    'kumulatif' => 0,
                    'prenetto' => 0,
                    'angsuran' => 0,
                    'retensi' => 0,
                    'netto' => 0,
                    'ppn' => 0,
                    'bruto' => 0,
                    'pph' => 0,
                    'penerimaan' => 0
                ),
                'final_total' => array(
                    'presentase' => 0,
                    'kumulatif' => 0,
                    'prenetto' => 0,
                    'angsuran' => 0,
                    'retensi' => 0,
                    'netto' => 0,
                    'ppn' => 0,
                    'bruto' => 0,
                    'pph' => 0,
                    'penerimaan' => 0
                ),
            ),
            'retensi' => array(
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'retensi_minus' => array(
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'retensi_total' => array(
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
            'final_total_final' => array(
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            ),
        );
        $array = array();
        $array = array(
            'tax' => array(
                'tax_ppn' => 0,
                'tax_pph' => 0
            ),
            'retensi_bayar' => array(
                'presentase' => 0,
                'kumulatif' => 0,
                'prenetto' => 0,
                'angsuran' => 0,
                'retensi' => 0,
                'netto' => 0,
                'ppn' => 0,
                'bruto' => 0,
                'pph' => 0,
                'penerimaan' => 0
            )
        );
        $count = count($data['show']);
        foreach ($data['show'] as $iro => $row) :
            foreach ($row['invoice_tax'] as $ita => $rowtax) :
                if ($rowtax['tax_name'] == 'PPN')
                    $variable['tax']['tax_ppn'] = $rowtax['tax_cuts'];
                if ($rowtax['tax_name'] == 'PPh 23')
                    $variable['tax']['tax_pph'] = $rowtax['tax_cuts'];
            endforeach;
            if ($iro == 0) :
                $array['tax'] = $variable['tax'];
                foreach ($row['invoice_wo'] as $ipa => $rowpa) :
                    if ($rowpa['invoice_wo_ct_id'] == 1) :
                        //down invoice_wo data
                        $variable['downinvoice_wo']['sequence'] = $rowpa['invoice_wo_sequence'];
                        $variable['downinvoice_wo']['presentase'] = $work_dp;
                        $variable['downinvoice_wo']['kumulatif'] = '';
                        $variable['downinvoice_wo']['prenetto'] = ($variable['downinvoice_wo']['presentase'] / 100) * $work_contract;
                        $variable['downinvoice_wo']['angsuran'] = '';
                        $variable['downinvoice_wo']['retensi'] = '';
                        $variable['downinvoice_wo']['netto'] = $variable['downinvoice_wo']['prenetto'];
                        $variable['downinvoice_wo']['ppn'] = $variable['downinvoice_wo']['netto'] * ($variable['tax']['tax_ppn'] / 100);
                        $variable['downinvoice_wo']['bruto'] = $variable['downinvoice_wo']['netto'] + $variable['downinvoice_wo']['ppn'];
                        $variable['downinvoice_wo']['pph'] = $variable['downinvoice_wo']['netto'] * ($variable['tax']['tax_pph'] / 100);
                        $variable['downinvoice_wo']['penerimaan'] = $variable['downinvoice_wo']['bruto'] - $variable['downinvoice_wo']['pph'];

                        $array['downinvoice_wo'] = $variable['downinvoice_wo'];
                    elseif ($rowpa['invoice_wo_ct_id'] == 2) :
                        $variable['termin']['sequence'] = $rowpa['invoice_wo_sequence'];
                        $variable['termin']['kumulatif'] = $rowpa['invoice_wo_percent'];
                        $variable['termin']['presentase'] = $variable['termin']['kumulatif'] - $dummy['kumulatif'];
                        $variable['termin']['prenetto'] = ($variable['termin']['presentase'] / 100) * $work_contract;
                        if ($ipa == 1):
                            $variable['termin']['prenetto'] = ($variable['termin']['kumulatif'] / 100) * $work_contract;
                        endif;
                        if ($variable['termin']['kumulatif'] == 100) :
                            $variable['termin']['prenetto'] = $variable['termin']['prenetto'] + $work_plus - $work_min;
                        endif;
                        $variable['termin']['prebagi'] = round(($variable['termin']['prenetto'] / $work_contract_total) * 100, 4);
                        $variable['termin']['angsuran'] = (- ($variable['termin']['prenetto']) * ($work_dp / 100));
                        if ($variable['termin']['kumulatif'] == 100) :
                            if ($data['work']['work_order_extra_mode'] == 1) :
                                $variable['termin']['angsuran'] = $variable['termin']['angsuran'] + ($work_plus * ($work_dp / 100));
                            elseif ($data['work']['work_order_extra_mode'] == 2) :
                                $variable['termin']['angsuran'] = $variable['termin']['angsuran'] - ($work_min * ($work_dp / 100));
                            endif;
                        endif;
                        $variable['termin']['retensi'] = (- ($variable['termin']['prenetto']) * ($work_retensi / 100));
                        $variable['termin']['netto'] = $variable['termin']['prenetto'] + $variable['termin']['angsuran'] + $variable['termin']['retensi'];
                        $variable['termin']['ppn'] = $variable['termin']['netto'] * ($variable['tax']['tax_ppn'] / 100);
                        $variable['termin']['bruto'] = $variable['termin']['netto'] + $variable['termin']['ppn'];
                        $variable['termin']['pph'] = $variable['termin']['netto'] * ($variable['tax']['tax_pph'] / 100);
                        $variable['termin']['penerimaan'] = $variable['termin']['bruto'] - $variable['termin']['pph'];

                        $array['termin']['termin_' . $ipa] = $variable['termin'];
                        $dummy['kumulatif'] = $variable['termin']['kumulatif'];
                        $dummy['prenetto'] = $variable['termin']['prenetto'];
                        $dummy['presentase_total'] = $dummy['presentase_total'] + $variable['termin']['prebagi'];
                    elseif ($rowpa['invoice_wo_ct_id'] == 3) :
                        $variable['retensi_bayar']['sequence'] = $rowpa['invoice_wo_sequence'];
                        $variable['retensi_bayar']['presentase'] = $rowpa['invoice_wo_percent'];
                        $variable['retensi_bayar']['kumulatif'] = '';
                        $variable['retensi_bayar']['prenetto'] = ($variable['retensi_bayar']['presentase'] / 100) * $work_contract_total;
                        $variable['retensi_bayar']['angsuran'] = 0;
                        $variable['retensi_bayar']['retensi'] = $variable['retensi_bayar']['prenetto'];
                        $variable['retensi_bayar']['netto'] = $variable['retensi_bayar']['prenetto'];
                        $variable['retensi_bayar']['ppn'] = $variable['retensi_bayar']['netto'] * ($variable['tax']['tax_ppn'] / 100);
                        $variable['retensi_bayar']['bruto'] = $variable['retensi_bayar']['netto'] + $variable['retensi_bayar']['ppn'];
                        $variable['retensi_bayar']['pph'] = $variable['retensi_bayar']['netto'] * ($variable['tax']['tax_pph'] / 100);
                        $variable['retensi_bayar']['penerimaan'] = $variable['retensi_bayar']['bruto'] - $variable['retensi_bayar']['pph'];

                        $array['retensi_bayar'] = $variable['retensi_bayar'];
                    endif;
                    if ($rowpa['invoice_wo_ct_id'] != 3) :
                        $variable['last']['sequence'] = $variable['last']['sequence'] + $variable['termin']['sequence'];
                        $variable['last']['presentase'] = $variable['last']['presentase'] + $variable['termin']['presentase'];
                        $variable['last']['kumulatif'] = $variable['last']['kumulatif'] + $variable['termin']['kumulatif'];
                        $variable['last']['prenetto'] = $variable['last']['prenetto'] + $variable['termin']['prenetto'];
                        $variable['last']['angsuran'] = $variable['last']['angsuran'] + $variable['termin']['angsuran'];
                        $variable['last']['retensi'] = $variable['last']['retensi'] + $variable['termin']['retensi'];
                        $variable['last']['netto'] = $variable['last']['netto'] + $variable['termin']['netto'];
                        $variable['last']['ppn'] = $variable['last']['ppn'] + $variable['termin']['ppn'];
                        $variable['last']['bruto'] = $variable['last']['bruto'] + $variable['termin']['bruto'];
                        $variable['last']['pph'] = $variable['last']['pph'] + $variable['termin']['pph'];
                        $variable['last']['penerimaan'] = $variable['last']['penerimaan'] + $variable['termin']['penerimaan'];
                    endif;
                endforeach;
                $array['last'] = $variable['last'];

            endif;
        endforeach;

        $variable['work_extra_plus']['prenetto'] = $work_plus;
        $variable['work_extra_plus']['presentase'] = round(($work_plus / $work_contract_total) * 100, 4);
        $variable['work_extra_plus']['kumulatif'] = 0;
        $variable['work_extra_plus']['angsuran'] = (($variable['work_extra_plus']['prenetto']) * ($work_dp / 100));
        $variable['work_extra_plus']['retensi'] = (-($variable['work_extra_plus']['prenetto']) * ($work_retensi / 100));
        $variable['work_extra_plus']['netto'] = $variable['work_extra_plus']['prenetto'] + $variable['work_extra_plus']['angsuran'] + $variable['work_extra_plus']['retensi'];
        $variable['work_extra_plus']['ppn'] = $variable['work_extra_plus']['netto'] * ($variable['tax']['tax_ppn'] / 100);
        $variable['work_extra_plus']['bruto'] = $variable['work_extra_plus']['netto'] + $variable['work_extra_plus']['ppn'];
        $variable['work_extra_plus']['pph'] = $variable['work_extra_plus']['netto'] * ($variable['tax']['tax_pph'] / 100);
        $variable['work_extra_plus']['penerimaan'] = $variable['work_extra_plus']['bruto'] - $variable['work_extra_plus']['pph'];

        $variable['work_extra_minus']['prenetto'] = (-($work_min));
        $variable['work_extra_minus']['presentase'] = round(($work_min / $work_contract_total) * 100, 4);
        $variable['work_extra_minus']['kumulatif'] = 0;
        $variable['work_extra_minus']['angsuran'] = (($variable['work_extra_minus']['prenetto']) * ($work_dp / 100));
        $variable['work_extra_minus']['retensi'] = (-($variable['work_extra_minus']['prenetto']) * ($work_retensi / 100));
        $variable['work_extra_minus']['netto'] = $variable['work_extra_minus']['prenetto'] + $variable['work_extra_minus']['angsuran'] + $variable['work_extra_minus']['retensi'];
        $variable['work_extra_minus']['ppn'] = $variable['work_extra_minus']['netto'] * ($variable['tax']['tax_ppn'] / 100);
        $variable['work_extra_minus']['bruto'] = $variable['work_extra_minus']['netto'] + $variable['work_extra_minus']['ppn'];
        $variable['work_extra_minus']['pph'] = $variable['work_extra_minus']['netto'] * ($variable['tax']['tax_pph'] / 100);
        $variable['work_extra_minus']['penerimaan'] = $variable['work_extra_minus']['bruto'] - $variable['work_extra_minus']['pph'];

        $variable['work_extra']['prenetto'] = $variable['work_extra_plus']['prenetto'] + $variable['work_extra_minus']['prenetto'];
        $variable['work_extra']['presentase'] = $dummy['presentase_total'];
        $variable['work_extra']['kumulatif'] = 0;
        $variable['work_extra']['angsuran'] = (($variable['work_extra']['prenetto']) * ($work_dp / 100));
        $variable['work_extra']['retensi'] = (-($variable['work_extra']['prenetto']) * ($work_retensi / 100));
        $variable['work_extra']['netto'] = $variable['work_extra']['prenetto'] + $variable['work_extra']['angsuran'] + $variable['work_extra']['retensi'];
        $variable['work_extra']['ppn'] = $variable['work_extra']['netto'] * ($variable['tax']['tax_ppn'] / 100);
        $variable['work_extra']['bruto'] = $variable['work_extra']['netto'] + $variable['work_extra']['ppn'];
        $variable['work_extra']['pph'] = $variable['work_extra']['netto'] * ($variable['tax']['tax_pph'] / 100);
        $variable['work_extra']['penerimaan'] = $variable['work_extra']['bruto'] - $variable['work_extra']['pph'];

        $variable['final']['final_account']['presentase'] = 0;
        $variable['final']['final_account']['kumulatif'] = 0;
        $variable['final']['final_account']['prenetto'] = $work_contract_total;
        $variable['final']['final_account']['angsuran'] = (-($work_contract) * ($work_dp / 100));
        $variable['final']['final_account']['retensi'] = (-($variable['final']['final_account']['prenetto']) * ($work_retensi / 100));
        $variable['final']['final_account']['netto'] = $variable['final']['final_account']['prenetto'] + $variable['final']['final_account']['angsuran'] + $variable['final']['final_account']['retensi'];
        $variable['final']['final_account']['ppn'] = $variable['final']['final_account']['netto'] * ($variable['tax']['tax_ppn'] / 100);
        $variable['final']['final_account']['bruto'] = $variable['final']['final_account']['netto'] + $variable['final']['final_account']['ppn'];
        $variable['final']['final_account']['pph'] = $variable['final']['final_account']['netto'] * ($variable['tax']['tax_pph'] / 100);
        $variable['final']['final_account']['penerimaan'] = $variable['final']['final_account']['bruto'] - $variable['final']['final_account']['pph'];

        $variable['final']['sisa_progress_induk']['presentase'] = 0;
        $variable['final']['sisa_progress_induk']['kumulatif'] = 0;
        $variable['final']['sisa_progress_induk']['prenetto'] = $work_contract - $variable['last']['prenetto'];
        $variable['final']['sisa_progress_induk']['angsuran'] = (-($variable['final']['sisa_progress_induk']['prenetto']) * ($work_dp / 100));
        $variable['final']['sisa_progress_induk']['retensi'] = (-($variable['final']['sisa_progress_induk']['prenetto']) * ($work_retensi / 100));
        $variable['final']['sisa_progress_induk']['netto'] = $variable['final']['sisa_progress_induk']['prenetto'] + $variable['final']['sisa_progress_induk']['angsuran'] + $variable['final']['sisa_progress_induk']['retensi'];
        $variable['final']['sisa_progress_induk']['ppn'] = $variable['final']['sisa_progress_induk']['netto'] * ($variable['tax']['tax_ppn'] / 100);
        $variable['final']['sisa_progress_induk']['bruto'] = $variable['final']['sisa_progress_induk']['netto'] + $variable['final']['sisa_progress_induk']['ppn'];
        $variable['final']['sisa_progress_induk']['pph'] = $variable['final']['sisa_progress_induk']['netto'] * ($variable['tax']['tax_pph'] / 100);
        $variable['final']['sisa_progress_induk']['penerimaan'] = $variable['final']['sisa_progress_induk']['bruto'] - $variable['final']['sisa_progress_induk']['pph'];

        $variable['final']['work_extra_plus']['presentase'] = 0;
        $variable['final']['work_extra_plus']['kumulatif'] = 0;
        $variable['final']['work_extra_plus']['prenetto'] = $work_plus;
        $variable['final']['work_extra_plus']['angsuran'] = 0;
        $variable['final']['work_extra_plus']['retensi'] = $variable['work_extra_plus']['retensi'];
        $variable['final']['work_extra_plus']['netto'] = $variable['work_extra_plus']['netto'];
        $variable['final']['work_extra_plus']['ppn'] = $variable['work_extra_plus']['ppn'];
        $variable['final']['work_extra_plus']['bruto'] = $variable['work_extra_plus']['bruto'];
        $variable['final']['work_extra_plus']['pph'] = $variable['work_extra_plus']['pph'];
        $variable['final']['work_extra_plus']['penerimaan'] = $variable['work_extra_plus']['penerimaan'];

        $variable['final']['work_extra_minus']['presentase'] = 0;
        $variable['final']['work_extra_minus']['kumulatif'] = 0;
        $variable['final']['work_extra_minus']['prenetto'] = -$work_min;
        $variable['final']['work_extra_minus']['angsuran'] = 0;
        $variable['final']['work_extra_minus']['retensi'] = $variable['work_extra_minus']['retensi'];
        $variable['final']['work_extra_minus']['netto'] = $variable['work_extra_minus']['netto'];
        $variable['final']['work_extra_minus']['ppn'] = $variable['work_extra_minus']['ppn'];
        $variable['final']['work_extra_minus']['bruto'] = $variable['work_extra_minus']['bruto'];
        $variable['final']['work_extra_minus']['pph'] = $variable['work_extra_minus']['pph'];
        $variable['final']['work_extra_minus']['penerimaan'] = $variable['work_extra_minus']['penerimaan'];

        if ($variable['work_extra']['presentase'] == 100) :
            $dummy['rumus_plus'] = -($variable['final']['work_extra_plus']['prenetto'] * ($work_dp / 100));
            $dummy['rumus_minus'] = ($variable['final']['work_extra_minus']['prenetto'] * ($work_dp / 100));
        endif;

        $variable['final']['final_total']['presentase'] = $variable['final']['sisa_progress_induk']['presentase'] + $variable['final']['work_extra_plus']['presentase'] + $variable['final']['work_extra_minus']['presentase'] + $variable['final']['final_total']['presentase'];
        $variable['final']['final_total']['kumulatif'] = $variable['final']['sisa_progress_induk']['kumulatif'] + $variable['final']['work_extra_plus']['kumulatif'] + $variable['final']['work_extra_minus']['kumulatif'] + $variable['final']['final_total']['kumulatif'];
        $variable['final']['final_total']['prenetto'] = $variable['final']['sisa_progress_induk']['prenetto'] + $variable['final']['work_extra_plus']['prenetto'] + $variable['final']['work_extra_minus']['prenetto'] + $variable['final']['final_total']['prenetto'];
        $variable['final']['final_total']['angsuran'] = $variable['final']['sisa_progress_induk']['angsuran'] + $variable['final']['work_extra_plus']['angsuran'] + $variable['final']['work_extra_minus']['angsuran'] + $variable['final']['final_total']['angsuran'];
        if ($data['work']['work_order_extra_mode'] == 1) :
            $variable['final']['final_total']['angsuran'] = $variable['final']['final_total']['angsuran'] + $dummy['rumus_plus'];
        elseif ($data['work']['work_order_extra_mode'] == 2) :
            $variable['final']['final_total']['angsuran'] = $variable['final']['final_total']['angsuran'] - $dummy['rumus_minus'];
        endif;
        $variable['final']['final_total']['retensi'] = $variable['final']['sisa_progress_induk']['retensi'] + $variable['final']['work_extra_plus']['retensi'] + $variable['final']['work_extra_minus']['retensi'] + $variable['final']['final_total']['retensi'];
        $variable['final']['final_total']['netto'] = $variable['final']['final_total']['prenetto'] + $variable['final']['final_total']['angsuran'] + $variable['final']['final_total']['retensi'];
        $variable['final']['final_total']['ppn'] = $variable['final']['final_total']['netto'] * ($variable['tax']['tax_ppn'] / 100);
        $variable['final']['final_total']['bruto'] = $variable['final']['final_total']['netto'] + $variable['final']['final_total']['ppn'];
        $variable['final']['final_total']['pph'] = $variable['final']['final_total']['netto'] * ($variable['tax']['tax_pph'] / 100);
        ;
        $variable['final']['final_total']['penerimaan'] = $variable['final']['final_total']['bruto'] - $variable['final']['final_total']['pph'];

        $variable['retensi']['presentase'] = $work_retensi;
        $variable['retensi']['kumulatif'] = 0;
        $variable['retensi']['prenetto'] = $work_contract_total * ($work_retensi / 100);
        $variable['retensi']['angsuran'] = 0;
        $variable['retensi']['retensi'] = $variable['retensi']['prenetto'];
        $variable['retensi']['netto'] = $variable['retensi']['retensi'];
        $variable['retensi']['ppn'] = $variable['retensi']['netto'] * ($variable['tax']['tax_ppn'] / 100);
        $variable['retensi']['bruto'] = $variable['retensi']['netto'] + $variable['retensi']['ppn'];
        $variable['retensi']['pph'] = $variable['retensi']['netto'] * ($variable['tax']['tax_pph'] / 100);
        $variable['retensi']['penerimaan'] = $variable['retensi']['bruto'] - $variable['retensi']['pph'];

        $variable['retensi_total']['presentase'] = $variable['retensi']['presentase'] - $variable['retensi_bayar']['presentase'];
        $variable['retensi_total']['kumulatif'] = 0;
        $variable['retensi_total']['prenetto'] = $variable['retensi']['prenetto'] - $variable['retensi_bayar']['prenetto'];
        $variable['retensi_total']['angsuran'] = 0;
        $variable['retensi_total']['retensi'] = $variable['retensi']['retensi'] - $variable['retensi_bayar']['retensi'];
        $variable['retensi_total']['netto'] = $variable['retensi']['netto'] - $variable['retensi_bayar']['netto'];
        $variable['retensi_total']['ppn'] = $variable['retensi']['ppn'] - $variable['retensi_bayar']['ppn'];
        $variable['retensi_total']['bruto'] = $variable['retensi']['bruto'] - $variable['retensi_bayar']['bruto'];
        $variable['retensi_total']['pph'] = $variable['retensi']['pph'] - $variable['retensi_bayar']['pph'];
        $variable['retensi_total']['penerimaan'] = $variable['retensi']['penerimaan'] - $variable['retensi_bayar']['penerimaan'];

        $variable['retensi_minus']['presentase'] = 0;
        $variable['retensi_minus']['kumulatif'] = 0;
        $variable['retensi_minus']['prenetto'] = 0;
        $variable['retensi_minus']['angsuran'] = $variable['final']['final_total']['angsuran'] + $variable['last']['angsuran'];
        $variable['retensi_minus']['retensi'] = $variable['final']['final_total']['retensi'] + $variable['last']['retensi'];
        $variable['retensi_minus']['netto'] = $variable['downinvoice_wo']['netto'] + $variable['final']['final_total']['netto'] + $variable['last']['netto'] + $variable['retensi']['netto'];
        $variable['retensi_minus']['ppn'] = $variable['downinvoice_wo']['ppn'] + $variable['final']['final_total']['ppn'] + $variable['last']['ppn'] + $variable['retensi']['ppn'];
        $variable['retensi_minus']['bruto'] = $variable['downinvoice_wo']['bruto'] + $variable['final']['final_total']['bruto'] + $variable['last']['bruto'] + $variable['retensi']['bruto'];
        $variable['retensi_minus']['pph'] = $variable['downinvoice_wo']['pph'] + $variable['final']['final_total']['pph'] + $variable['last']['pph'] + $variable['retensi']['pph'];
        $variable['retensi_minus']['penerimaan'] = $variable['downinvoice_wo']['penerimaan'] + $variable['final']['final_total']['penerimaan'] + $variable['last']['penerimaan'] + $variable['retensi']['penerimaan'];


        $variable['final_total_final']['presentase'] = 0;
        $variable['final_total_final']['kumulatif'] = 0;
        $variable['final_total_final']['prenetto'] = 0;
        $variable['final_total_final']['angsuran'] = 0;
        $variable['final_total_final']['retensi'] = 0;
        $variable['final_total_final']['netto'] = $variable['downinvoice_wo']['netto'] + $variable['work_extra']['netto'];
        $variable['final_total_final']['ppn'] = $variable['downinvoice_wo']['ppn'] + $variable['work_extra']['ppn'];
        $variable['final_total_final']['bruto'] = $variable['downinvoice_wo']['bruto'] + $variable['work_extra']['bruto'];
        $variable['final_total_final']['pph'] = $variable['downinvoice_wo']['pph'] + $variable['work_extra']['pph'];
        $variable['final_total_final']['penerimaan'] = $variable['downinvoice_wo']['penerimaan'] + $variable['work_extra']['penerimaan'];

        $array['work_extra_plus'] = $variable['work_extra_plus'];
        $array['work_extra_minus'] = $variable['work_extra_minus'];
        $array['work_extra'] = $variable['work_extra'];
        $array['final'] = $variable['final'];
        $array['retensi'] = $variable['retensi'];
        $array['retensi_minus'] = $variable['retensi_minus'];
        $array['retensi_total'] = $variable['retensi_total'];
        $array['final_total_final'] = $variable['final_total_final'];

        $data['array'] = $array;

        $data['content'] = "finance/monitoring/export/export_work_order";
        $this->load->view($data['content'], $data);
    }

    public function monitoring_equipment($project = null, $actor = null) {
        $array = array();
        $date = array();
        $variable = array();
        $array_total = array();
        $variable_total = array();
        $date_total = array();

        $data = array(
            'title_page' => 'Gudang Alat',
            'title_file' => 'gudang_alat',
            'title_company' => $this->config->item('config_client'),
            'setting_date' => date('Y-m-d')
        );
        $data['apps'] = $this->crud_model->read_data('apps', null, null)->row();
        $data['project'] = $this->crud_model->read_data('project', array('md5(project_id)' => $project), null)->row();
        $data['actor'] = $this->crud_model->read_data('actor', array('md5(actor_id)' => $actor), null)->row();

        $join = array(
            "equipt_transaction et" => array("et.equipt_transaction_id = st.equipt_transaction_id", "LEFT"),
            "equipment eq" => array("eq.equipment_id = st.equipment_id", "LEFT"),
        );
        $where = array(
            "md5(st.project_id)" => "$project",
            "md5(et.actor_id)" => "$actor",
        );
        $group = 'st.equipment_id';
        $select = 'st.equipment_id, equipment_name, equipment_type';
        $order = array('st.equipment_id' => 'asc');
        $show = $this->crud_model->read_data("equipment_stock st", $where, $order, $join, null, $group, $select)->result_array();
        foreach ($show as $index => $row) :
            $variable[] = $row;
            $variable_total[] = $row;
            $variable[$index]['equipment_price'] = 0;
            $variable[$index]['equipment_entry'] = 0;
            $variable[$index]['equipment_exit'] = 0;
            $variable[$index]['equipment_rest'] = 0;
            $variable[$index]['equipment_datediff'] = 0;
            $variable[$index]['equipment_subtotal'] = 0;
            $variable_total[$index]['equipment_total'] = 0;
            $variable_total[$index]['equipment_rest'] = 0;
            $variable_total[$index]['equipment_pay'] = 0;
        endforeach;

        $where_date = array(
            'MONTH(equipment_stock_date)' => date('m'),
            "md5(st.project_id)" => "$project",
            "md5(et.actor_id)" => "$actor",
        );
        $group_date = 'DATE(st.equipment_stock_date)';
        $select_date = 'DATE(st.equipment_stock_date) as equipment_stock_date';
        $order_date = array('DATE(st.equipment_stock_date)' => 'asc');
        $show_date = $this->crud_model->read_data("equipment_stock st", $where_date, $order_date, $join, null, $group_date, $select_date)->result_array();
        foreach ($show_date as $index => $row) :
            $array[$index]['equipment_stock_date'] = $row['equipment_stock_date'];
            $date[] = $row['equipment_stock_date'];
        endforeach;
        foreach ($array as $index => $row) :
            $array[$index]['equipment_stock_detail'] = $variable;
        endforeach;

        $where_total = array(
            'MONTH(debt_date)' => date('m'),
            "md5(project_id)" => $project,
            "md5(actor_id)" => $actor,
        );
        $group_total = 'DATE(debt_date)';
        $select_total = 'DATE(debt_date) AS debt_date';
        $order_total = array('DATE(debt_date)' => 'asc');
        $show_total = $this->crud_model->read_data("debt", $where_total, $order_total, null, null, $group_total, $select_total)->result_array();

        foreach ($show_total as $index => $row) :
            $array_total[$index]['debt_date'] = $row['debt_date'];
            $date_total[] = $row['debt_date'];
        endforeach;
        foreach ($array_total as $index => $row) :
            $array_total[$index]['debt_detail'] = $variable_total;
        endforeach;

        $count_array = count($array);
        foreach ($array as $index => $row) :
            foreach ($array[$index]['equipment_stock_detail'] as $vainde => $varow) :
                $where_pertdate = array(
                    'DATE(equipment_stock_date)' => $row['equipment_stock_date'],
                    'st.equipment_id' => $varow['equipment_id'],
                    "md5(st.project_id)" => $project,
                    "md5(et.actor_id)" => $actor,
                );
                $group_pertdate = 'st.equipment_id';
                $order_pertdate = array('st.equipment_id' => 'asc');
                $select_pertdate = 'st.equipment_id, equipment_stock_price, COALESCE(SUM(equipment_stock_entry),0) as equipment_stock_entry, COALESCE(SUM(equipment_stock_exit),0) as equipment_stock_exit, COALESCE(SUM(equipment_stock_rest),0) as equipment_stock_rest,'
                        . 'datediff(NOW(), equipment_stock_date) as equipment_stock_datediff';
                $show_pertdate = $this->crud_model->read_data_with_false("equipment_stock st", $where_pertdate, $order_pertdate, $join, null, $group_pertdate, $select_pertdate)->row_array();
                if (count($show_pertdate) > 0) :
                    $array[$index]['equipment_stock_detail'][$vainde]['equipment_price'] = $show_pertdate['equipment_stock_price'];
                    $array[$index]['equipment_stock_detail'][$vainde]['equipment_entry'] = $show_pertdate['equipment_stock_entry'];
                    $array[$index]['equipment_stock_detail'][$vainde]['equipment_rest'] = $show_pertdate['equipment_stock_rest'];
                    $array[$index]['equipment_stock_detail'][$vainde]['equipment_datediff'] = $show_pertdate['equipment_stock_datediff'];
                    $array[$index]['equipment_stock_detail'][$vainde]['equipment_subtotal'] = $show_pertdate['equipment_stock_datediff'] * ($show_pertdate['equipment_stock_price'] * $show_pertdate['equipment_stock_rest']);
                endif;
                if (($index + 1) == $count_array) :
                endif;
            endforeach;
        endforeach;


        $count_array_total = count($array_total);
        foreach ($array_total as $index => $row) :
            foreach ($array_total[$index]['debt_detail'] as $vainde => $varow) :
                $where_pertotal = array(
                    'DATE(debt_date)' => $row['debt_date'],
                    'deb.equipment_id' => $varow['equipment_id'],
                    "md5(deb.project_id)" => $project,
                    "md5(deb.actor_id)" => $actor,
                );
                $group_pertotal = 'deb.equipment_id';
                $order_pertotal = array('deb.equipment_id' => 'asc');
                $select_pertotal = 'deb.equipment_id, COALESCE(SUM(debt_total),0) as debt_total, COALESCE(SUM(debt_rest),0) as debt_rest';
                $show_pertotal = $this->crud_model->read_data_with_false("debt deb", $where_pertotal, $order_pertotal, null, null, $group_pertotal, $select_pertotal)->row_array();
                if (count($show_pertotal) > 0) :
                    $array_total[$index]['debt_detail'][$vainde]['equipment_total'] = $show_pertotal['debt_total'];
                    $array_total[$index]['debt_detail'][$vainde]['equipment_rest'] = $show_pertotal['debt_rest'];
                    $array_total[$index]['debt_detail'][$vainde]['equipment_pay'] = $show_pertotal['debt_total'] - $show_pertotal['debt_rest'];
                endif;
                if (($index + 1) == $count_array_total) :
                endif;
            endforeach;
        endforeach;

        $data['head'] = $variable;
        $data['array'] = $array;
        $data['array_total'] = $array_total;

//        echo '<pre>';
//        print_r($array);
//        print_r($array_total);
//        echo '</pre>';

        $data['content'] = "finance/monitoring/export/export_equipment";
        $this->load->view($data['content'], $data);
    }

}
