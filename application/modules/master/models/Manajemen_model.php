<?php
/**
  * Ringkasan dari Manajemen_model
  *
  * Model untuk mengelola Manajemen
  * @author Firmansyah
  * @version 1.0
  * @package Model Manajemen
  *
  * @param int $id integer
  *
  * @return void
  */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
  * Ringkasan dari Manajemen_model
  *
  * Model untuk mengelola Manajemen
  * @author Firmansyah
  * @version 1.0
  * @package Model Manajemen
  *
  * @param int $id integer
  *
  * @return void
  */
class Manajemen_model extends CI_Model
{
	/** fungsi untuk mendefinisikan tabel manajemen */
    function __construct(){
        parent::__construct();
        $this->table  = 'm_manajemen';
    }
	/** fungsi intuk menampilkan semua data manajemen */
	function get_all()
    {
        $sql ='select * from '.$this->table.' where aktif="Y" Order by id_manajemen Desc';
        $query = $this->db->query($sql);
        return $query->result();
    }
	/** fungsi intuk menampilkan data manajemen berdasarkan id manajemen 
	* @param int $id integer
	*/
    function get_all_detail($id)
    {
        $sql ='select * from '.$this->table.' where aktif="Y" and id_manajemen="'.$id.'"';
        $query = $this->db->query($sql);
        return $query->row();
    }
	/** fungsi untuk input ke tabel manajemen */
    function act_form(){

        $nip                = $this->security->xss_clean($this->db->escape_str($this->input->post('nip')));
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $jabatan            = $this->security->xss_clean($this->db->escape_str($this->input->post('jabatan')));

        $sql    = "INSERT INTO m_manajemen (nip,nama,jabatan,aktif)VALUES('".$nip."','".$nama."','".$jabatan."','Y')";
        $query = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
	/** 
	* fungsi untuk edit ke tabel manajemen 
	*/
    function act_edit(){

        $id_manajemen       = $this->security->xss_clean($this->db->escape_str($this->input->post('id_manajemen')));
        $nip                = $this->security->xss_clean($this->db->escape_str($this->input->post('nip')));
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $jabatan            = $this->security->xss_clean($this->db->escape_str($this->input->post('jabatan')));

        $sql    = "UPDATE m_manajemen SET nip='".$nip."',nama='".$nama."',jabatan='".$jabatan."' WHERE id_manajemen='".$id_manajemen."'";
        $query = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
	/** 
	* fungsi untuk delete ke tabel manajemen 
	*/
    function act_delete(){
        $sql = "UPDATE ".$this->table." SET aktif = 'N' WHERE id_manajemen = '".$this->input->post('id_manajemen')."'";
        $query = $this->db->query($sql);
        return $query;
    }

}
?>