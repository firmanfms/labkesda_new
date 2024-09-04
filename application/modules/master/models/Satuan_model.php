<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Satuan_model extends CI_Model
{

	function __construct(){
        parent::__construct();
        $this->table  = 'm_satuan';
    }

    function get_all()
    {
        $sql ='select * from '.$this->table;
        $query = $this->db->query($sql);
        return $query->result();
    }

    function act_form(){
        $name           = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));

        $sql    = " INSERT INTO m_satuan (satuan) VALUES('".$name."')";
        // test($sql,1);
        $query = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }

    function act_delete_js(){
        $sql = "UPDATE m_satuan SET is_active='0', pic_edit = '".$this->current_user['user_id']."', edit_time = '".dbnow()."' WHERE project_id = '".$this->input->post('project_id')."'";
        //test($sql,1);
        $query = $this->db->query($sql);
        return $query;
    }

    function detail_satuan($id){
        $query = $this->db->query("SELECT * FROM m_satuan WHERE id_satuan='".$id."'")->row();
        return $query;
    }

    function act_edit(){
        $name           = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));

        $sql    = "UPDATE m_satuan
                    SET 
                      satuan = '".$name."'
                    WHERE id_satuan = '".$this->security->xss_clean($this->db->escape_str($this->input->post('id_satuan')))."'";
        //test($sql,1);
        $query = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }

}	