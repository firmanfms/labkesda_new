<?php
/**
  * Ringkasan dari vendor_model
  *
  * Model untuk mengelola vendor
  * @author Firmansyah
  * @version 1.0
  * @package Model vendor
  *
  * @param int $id integer
  *
  * @return void
  */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
  * Ringkasan dari vendor_model
  *
  * Model untuk mengelola vendor
  * @author Firmansyah
  * @version 1.0
  * @package Model vendor
  *
  * @param int $id integer
  *
  * @return void
  */
class Vendor_model extends CI_Model
{
	/** fungsi untuk mendefinisikan tabel vendor */
    function __construct(){
        parent::__construct();
        $this->table  = 'm_vendor';
    }
	/** fungsi intuk menampilkan semua data vendor */
	function get_all()
    {
        $sql ='select * from '.$this->table.' where aktif="Y" Order by id_vendor Desc';
        $query = $this->db->query($sql);
        return $query->result();
    }
	/** fungsi intuk menampilkan data vendor berdasarkan id vendor 
	* @param int $id integer
	*/
    function get_all_detail($id)
    {
        $sql ='select * from '.$this->table.' where aktif="Y" and id_vendor="'.$id.'"';
        $query = $this->db->query($sql);
        return $query->row();
    }
	/** fungsi untuk input ke tabel vendor */
    function act_form(){
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $alamat             = $this->security->xss_clean($this->db->escape_str($this->input->post('alamat')));

        $sql    = "INSERT INTO m_vendor (nm_vendor,alamat,aktif)VALUES('".$nama."','".$alamat."','Y')";
        $query = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
	/** 
	* fungsi untuk edit ke tabel vendor 
	*/
    function act_edit(){
        $id_vendor          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_vendor')));
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $alamat             = $this->security->xss_clean($this->db->escape_str($this->input->post('alamat')));

        $sql    = "UPDATE m_vendor SET nm_vendor = '".$nama."',  alamat = '".$alamat."' WHERE id_vendor = '".$id_vendor."'";
        $query = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
	/** 
	* fungsi untuk delete ke tabel vendor 
	*/
    function act_delete(){
        $sql = "UPDATE ".$this->table." SET aktif = 'N' WHERE id_vendor = '".$this->input->post('id_vendor')."'";
        $query = $this->db->query($sql);
        return $query;
    }

}
?>