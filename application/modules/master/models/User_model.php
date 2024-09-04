<?php
/**
  * Ringkasan dari Lokasi_model
  *
  * Model untuk mengelola Lokasi
  * @author Firmansyah
  * @version 1.0
  * @package Model Lokasi
  *
  * @param int $id integer
  *
  * @return void
  */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
  * Ringkasan dari Lokasi_model
  *
  * Model untuk mengelola Lokasi
  * @author Firmansyah
  * @version 1.0
  * @package Model Lokasi
  *
  * @param int $id integer
  *
  * @return void
  */
class User_model extends CI_Model
{
	/** fungsi untuk mendefinisikan tabel lokasi */
    function __construct(){
        parent::__construct();
        $this->table  = 'm_user';
        $this->table2  = 'm_user_level';
    }
    function get_level(){
        $sql ='select * from '.$this->table2.' a';
        $query = $this->db->query($sql);
        return $query->result();
    }
	/** fungsi intuk menampilkan semua data lokasi */
	function get_all()
    {
        $sql ='select * from '.$this->table.' a WHERE a.aktif="Y" ORDER BY a.id_username Desc';
        $query = $this->db->query($sql);
        return $query->result();
    }
	/** fungsi intuk menampilkan data lokasi berdasarkan id lokasi 
	* @param int $id integer
	*/
    function get_detail($id)
    {
        $sql ='select * from '.$this->table.' a WHERE a.aktif="Y" AND id_username='.$id.' ORDER BY a.id_username Desc';
        $query = $this->db->query($sql);
        return $query->row();
    }
    function get_all_detail($id)
    {
        $sql ='select * from '.$this->table.' where aktif="Y" and id_sub_lokasi="'.$id.'"';
        $query = $this->db->query($sql);
        return $query->row();
    }
	/** fungsi untuk input ke tabel lokasi */
    function act_form(){
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $username           = $this->security->xss_clean($this->db->escape_str($this->input->post('username')));
        $password           = $this->security->xss_clean($this->db->escape_str($this->input->post('password')));
        $level              = $this->security->xss_clean($this->db->escape_str($this->input->post('level')));
        $approve_level      = $this->security->xss_clean($this->db->escape_str($this->input->post('approve_level')));
        
        $sql    = "INSERT INTO ".$this->table." (nama,username,password,level,aktif,app_level)VALUES('".$nama."','".$username."','".$password."','".$level."','Y','".$approve_level."')";
        // test($sql,1);
        $query = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
	/** 
     * fungsi untuk edit ke tabel lokasi 
     */
    function act_edit(){
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $username           = $this->security->xss_clean($this->db->escape_str($this->input->post('username')));
        $password           = $this->security->xss_clean($this->db->escape_str($this->input->post('password')));
        $level              = $this->security->xss_clean($this->db->escape_str($this->input->post('level')));
        $id_username        = $this->security->xss_clean($this->db->escape_str($this->input->post('id_username')));
        $approve_level      = $this->security->xss_clean($this->db->escape_str($this->input->post('approve_level')));

        $sql    = "UPDATE ".$this->table." SET nama = '".$nama."', username = '".$username."', level = '".$level."', app_level = '".$approve_level."' WHERE id_username = '".$id_username."'";
        $query = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
	/** 
	* fungsi untuk delete ke tabel lokasi 
	*/
    function act_delete(){
        $sql = "UPDATE ".$this->table." SET aktif = 'N' WHERE id_username = '".$this->input->post('id_username')."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function sub_lokasi($id){
        $sql ='select * from '.$this->table.' a, m_lokasi b where a.aktif="Y" AND a.id_lokasi=b.id_lokasi AND a.id_lokasi='.$id.' Order by a.id_sub_lokasi Desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

}
?>