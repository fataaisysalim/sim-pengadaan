<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->flush_cache();
    }

     public function listing($sess) {
        $where="";
        if($sess['users']->users_divisi <> 1){
            $where=" WHERE role_id='".$sess['users']->users_divisi."'";
        }
        $data=$this->db->query("SELECT * FROM mog INNER JOIN users ON users.users_id = procurement.user_id $where");;
        return $data->result();
    }

    public function getNameProject($idProject) {
        $data=$this->db->query("SELECT project_name from project where project_id='$idProject'");
        return $data->row();
    }
     public function getNameSupplier($idSupplier) {
        $data=$this->db->query("SELECT actor_name from actor where actor_id='$idSupplier'");
        return $data;
    }

     public function filterTabs($noPengajuan,$tglAwal,$tglAkhir, $jenis, $supplier, $jenis_material,$volume, $operator) {
        //--INNER join mog_dt ON mog_dt.mog_id = mog.mog_id
            //--INNER JOIN material_sub ON material_sub.material_sub_id = mog_dt.material_sub_id
        $sql="SELECT * from mog 
            INNER JOIN project ON project.project_id = mog.project_id
            INNER JOIN actor ON actor.actor_id = mog.actor_id
            
            where 1=1 ";
        if(!empty($noPengajuan)){
            $sql.=" OR no_pengajuan like '%$noPengajuan%'"   ;
        }
        if(!empty($jenis)){
            $sql.=" OR jenis_procurement like '%$jenis%'"   ;
        }
        if(!empty($supplier)){
            $sql.=" OR actor_name like '%$supplier%'"   ;
        }
        if(!empty($jenis_material)){
            //$sql.=" OR material_sub_name like '%$jenis_material%'"   ;
            $sql.=" OR EXISTS (SELECT material_sub_name FROM mog_dt 
                INNER JOIN material_sub ON material_sub.material_sub_id = mog_dt.material_sub_id
                WHERE material_sub_name
                like '%$jenis_material%')"   ;
        }
        if(!empty($volume)){
            //$sql.=" OR SUM(mog_dt_volume) '$operator' '$volume'"  ; 
            $sql.=" OR EXISTS (SELECT material_sub_name FROM mog_dt 
                INNER JOIN material_sub ON material_sub.material_sub_id = mog_dt.material_sub_id
                WHERE SUM(mog_dt_volume) '$operator' '$volume')"   ;
        }
        if($tglAwal!=null){
            $sql.=" OR tanggal_spb BETWEEN '$tglAwal' AND '$tglAkhir'";
        }
        $data= $this->db->query($sql);
        return $data->result();
    }

    public function insert_data($table, $fordata) {
        return $this->db->insert($table, $fordata);
    }

    public function update_data($table, $content, $selection = null) {
        if (!empty($selection)) {
            $this->db->where($selection, $content[$selection]);
        }
        $this->db->update($table, $content);
    }

    public function update_fordata($table, $content, $where = null) {
        if (isset($where)) {
            $this->db->where($where);
        }
        return $this->db->update($table, $content);
    }

    public function read_fordata($fordata = NULL) {
        if (isset($fordata['select'])) {
            $this->db->select($fordata['select'], false);
        }

        if (!empty($fordata['limit'])) {
            $this->db->limit($fordata['limit']);
        }

        if (isset($fordata['where'])) {
            $this->db->where($fordata['where']);
        }

        if (isset($fordata['or_where'])) {
            $this->db->or_where($fordata['or_where']);
        }

        if (isset($fordata['like'])) {
            foreach ($fordata['like'] as $column => $inisiasi) {
                if (is_array($inisiasi)) {
                    $this->db->like($column, $inisiasi[0], $inisiasi[1]);
                } else {
                    $this->db->like($column, $inisiasi);
                }
            }
        }

        if (isset($fordata['group'])) {
            $this->db->group_by($fordata['group']);
        }

        if (isset($fordata['join'])) {
            foreach ($fordata['join'] as $tabled => $inisiasi) {
                if (is_array($inisiasi)) {
                    $this->db->join($tabled, $inisiasi[0], $inisiasi[1]);
                } else {
                    $this->db->join($tabled, $inisiasi);
                }
            }
        }

        if (isset($fordata['order'])) {
            foreach ($fordata['order'] as $condition => $act) {
                $this->db->order_by($condition, $act);
            }
        }

        if (is_array($fordata['table'])) {
            $get = $this->db->get($fordata['table'][0], $foradata['table'][1], $foradata['table'][2]);
        } else {
            $get = $this->db->get($fordata['table']);
        }

        return $get;
    }

    public function read_data($table, $fordata = null, $orderby = null, $joined = null, $limit = null, $group = null, $select = null) {
        if (isset($select)) {
            $this->db->select($select);
        }
        if (!empty($limit)) {
            $this->db->limit($limit);
        }
        if (isset($fordata)) {
            $this->db->where($fordata);
        }
        if (!empty($group)) {
            $this->db->group_by("$group");
        }
        if (isset($joined)) {
            foreach ($joined as $tabled => $inisiasi) {
                if (is_array($inisiasi)) {
                    $this->db->join($tabled, $inisiasi[0], $inisiasi[1]);
                } else {
                    $this->db->join($tabled, $inisiasi);
                }
            }
        }
        if (isset($orderby)) {
            foreach ($orderby as $condition => $act) {
                $this->db->order_by($condition, $act);
            }
        }
        if (is_array($table)) {
            $get = $this->db->get($table[0], $table[1], $table[2]);
        } else {
            $get = $this->db->get($table);
        }
        return $get;
    }

    public function delete_data($table, $data = null) {
        if (isset($data)) {
            $this->db->where($data);
        }
        return $this->db->delete($table);
    }

    public function json_autocomplete($search, $table, $column) {
        $sql = "SELECT * FROM $table WHERE $column LIKE '%$search%'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function check_exist($table, $data) {
        $this->db->where($data);
        $sql = $this->db->get($table)->num_rows();
        if ($sql > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function upload($path = null, $fupload_name, $var = null, $tmp_name = null, $width = null) {
        $vdir_upload = !empty($path) ? "./assets/$path/" : "./assets/image/";
        $vfile_upload = $vdir_upload . $fupload_name;
        $variable = empty($var) ? 'foto' : $var;
        $tmp_name = $_FILES[$variable]['tmp_name'];
        $s = move_uploaded_file($tmp_name, $vfile_upload);
        //$tipe_file = $_FILES["$variable"]['type'];
//        if ($tipe_file == "image/png") {
//            $im_src = imagecreatefrompng($vfile_upload);
//            $src_width = imageSX($im_src);
//            $src_height = imageSY($im_src);
//            $dst_width = isset($width) ? $width : 505;
//            $dst_height = ($dst_width / $src_width) * $src_height;
//            $im = imagecreatetruecolor($dst_width, $dst_height);
////            imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
//            $nm = imagepng($im, $vdir_upload . "" . $fupload_name);
//            imagedestroy($im_src);
//            imagedestroy($im);
//        }
        if ($s == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function unlink($file, $path = null) {
        $folder = isset($path) ? "$path/" : "image/";
        $cek_file = file_exists("assets/$folder/$file");
        if ($cek_file) {
            unlink("assets/$folder/$file");
        }
    }

    public function get_id($table, $column, $data) {
        $this->db->where($data);
        $sql = $this->db->get($table);
        if ($sql->num_rows() > 0) {
            $column = $column;
            return $sql->row()->$column;
        } else {
            return NULL;
        }
    }

    public function read_data_with_false($table, $fordata = null, $orderby = null, $joined = null, $limit = null, $group = null, $select = null) {
        if (isset($select)) {
            $this->db->select($select, FALSE);
        }
        if (!empty($limit)) {
            $this->db->limit($limit);
        }
        if (isset($fordata)) {
            $this->db->where($fordata);
        }
        if (!empty($group)) {
            $this->db->group_by("$group");
        }
        if (isset($joined)) {
            foreach ($joined as $tabled => $inisiasi) {
                if (is_array($inisiasi)) {
                    $this->db->join($tabled, $inisiasi[0], $inisiasi[1]);
                } else {
                    $this->db->join($tabled, $inisiasi);
                }
            }
        }
        if (isset($orderby)) {
            foreach ($orderby as $condition => $act) {
                $this->db->order_by($condition, $act);
            }
        }
        if (is_array($table)) {
            $get = $this->db->get($table[0], $table[1], $table[2]);
        } else {
            $get = $this->db->get($table);
        }
        return $get;
    }

    public function getLastNoBapb(){
        $q = $this->db->query("select MAX(RIGHT(no_bapb,6)) as kd_max from mog");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
        return "BAPB-".$kd;
    }

     public function getLastNoPengajuan(){
        $q = $this->db->query("select MAX(RIGHT(no_bapb,6)) as kd_max from mog");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "000001";
        }
        $array_bulan = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $bulan = $array_bulan[date('n')];
        return $kd."/DAN/UTR/".$bulan."/".date('Y');
    }

}
