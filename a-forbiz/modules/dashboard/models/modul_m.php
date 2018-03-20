<?php

class Modul_m extends CI_Model {

    function mod_menu($id = null) {
        $data['modul'] = $this->crud_model->read_fordata(array("table" => "modul", "order" => array("modul_position" => "ASC")))->result();
        foreach ($data['modul'] as $x => $row) {
            $data['menu'][$x] = $this->crud_model->read_fordata(array("table" => "mod_menu menu", "where" => array("menu.mod_menu_status"=>1,"menu.modul_id" => $row->modul_id), "order" => array("menu.mod_menu_position" => "ASC")))->result();
            if (!empty($id)) {
                foreach ($data['menu'][$x] as $y => $z) {
                    $data['permission'][$x][$y] = $this->crud_model->read_fordata(array("table" => "mod_menu_access", "where" => array("md5(users_position_id)" => $id, "mod_menu_id" => $z->mod_menu_id)))->row();
                }
            }
        }
        return $data;
    }

    function mod_menu_active($id = null) {
        $data['modul'] = $this->crud_model->read_fordata(array("table" => "modul", "order" => array("modul_position" => "ASC")))->result();
        foreach ($data['modul'] as $x => $row) {
            $data['menu'][$x] = $this->crud_model->read_fordata(array("table" => "mod_menu menu", "join" => array("mod_menu_access mm" => "mm.mod_menu_id = menu.mod_menu_id"), "where" => array("menu.modul_id" => $row->modul_id, "md5(mm.users_position_id)" => $id), "order" => array("menu.mod_menu_position" => "ASC")))->result();
        }
        return $data;
    }

    function modul_current($id = null) {
        return $this->crud_model->read_fordata(array("table" => "modul m", "group" => array("m.modul_id"), "where" => array("mma.users_position_id" => $id,'modul_status'=>1), "join" => array("mod_menu mm" => "mm.modul_id = m.modul_id", "mod_menu_access mma" => "mma.mod_menu_id = mm.mod_menu_id"), "order" => array("m.modul_position" => "ASC")))->result();
    }

    function menu_current($id = null) {
        if(!empty($id)){
        $getfield = $this->crud_model->read_fordata(array("table" => "modul", "where" => array("modul_url" => $this->uri->segment(1))))->row();
        if(count($getfield)>0){
        $data['parent'] = $this->crud_model->read_fordata(array("table" => "mod_menu menu", "join" => array("mod_menu_access mm" => "mm.mod_menu_id = menu.mod_menu_id"), "where" => array("menu.modul_id" => $getfield->modul_id, "mm.users_position_id" => $id, "LENGTH(menu.mod_menu_position)" => 1), "order" => array("menu.mod_menu_position" => "ASC")))->result();
        foreach ($data['parent'] as $x => $row) {
            $data['current'][$x] = $this->crud_model->read_fordata(array("table" => "mod_menu menu","select"=>array("menu.mod_menu_id"), "join" => array("mod_menu_access mm" => "mm.mod_menu_id = menu.mod_menu_id"), "where" => array("menu.modul_id" => $getfield->modul_id, "mm.users_position_id" => $id, "SUBSTR(menu.mod_menu_position,1,1)" => $row->mod_menu_position, "LENGTH(menu.mod_menu_position) >" => 1), "order" => array("menu.mod_menu_position" => "ASC")))->result();
            $data['crod'][$x]= array();
            foreach ($data['current'][$x] as $z => $rx){
                array_push($data['crod'][$x], $rx->mod_menu_id);
            }
            $data['child'][$x] = $this->crud_model->read_fordata(array("table" => "mod_menu menu", "join" => array("mod_menu_access mm" => "mm.mod_menu_id = menu.mod_menu_id"), "where" => array("menu.mod_menu_status"=>1,"menu.modul_id" => $getfield->modul_id, "mm.users_position_id" => $id, "SUBSTR(menu.mod_menu_position,1,1)" => $row->mod_menu_position, "LENGTH(menu.mod_menu_position) >" => 1), "order" => array("menu.mod_menu_position" => "ASC")))->result();
        }
        return $data;
        }
        }
    }

    function restricted_menu($id) {
        return $this->crud_model->read_fordata(array("table"=>"mod_menu menu","join"=>array("mod_menu_access mm"=>"mm.mod_menu_id = menu.mod_menu_id"),"like"=>array("menu.mod_menu_url"=>$this->uri->slash_segment(1).$this->uri->segment(2)),"where"=>array("mm.users_position_id"=> $id)));
    }

}

?>