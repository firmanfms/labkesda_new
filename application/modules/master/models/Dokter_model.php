<?php
/**
  * Ringkasan dari Dokter_model
  *
  * Model untuk mengelola Dokter
  * @author Firmansyah
  * @version 1.0
  * @package Model Dokter
  *
  * @param int $id integer
  *
  * @return void
  */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
  * Ringkasan dari Dokter_model
  *
  * Model untuk mengelola Dokter
  * @author Firmansyah
  * @version 1.0
  * @package Model Dokter
  *
  * @param int $id integer
  *
  * @return void
  */
class Dokter_model extends CI_Model
{
	/** fungsi untuk mendefinisikan tabel dokter */
    function __construct(){
        parent::__construct();
        $this->table  = 'm_dokter';
    }
	
	/** fungsi intuk menampilkan semua data dokter */
	function get_all()
    {
        $sql ='select * from '.$this->table.' where aktif="Y" Order by nm_dokter Desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

	/** fungsi intuk menampilkan data barang berdasarkan id dokter 
	* @param int $id integer
	*/
    function get_all_detail($id)
    {
        $sql ='select * from '.$this->table.' where aktif="Y" and id_dokter="'.$id.'"';
        $query = $this->db->query($sql);
        return $query->row();
    }

	/** fungsi untuk input ke tabel dokter */
    function act_form(){

        $id_dokter          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_dokter')));
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $alamat             = $this->security->xss_clean($this->db->escape_str($this->input->post('alamat')));

        $sql    = "INSERT INTO m_dokter (id_dokter,nm_dokter,alamat,aktif)VALUES('".$id_dokter."','".$nama."','".$alamat."','Y')";

        $query = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }

	/** 
	* fungsi untuk edit ke tabel dokter 
	*/
    function act_edit(){

        $id_dokter          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_dokter')));
        $id_dokter_old      = $this->security->xss_clean($this->db->escape_str($this->input->post('id_dokter_old')));
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $alamat             = $this->security->xss_clean($this->db->escape_str($this->input->post('alamat')));

        $sql    = "UPDATE m_dokter SET id_dokter='".$id_dokter."',nm_dokter='".$nama."',alamat='".$alamat."' WHERE id_dokter='".$id_dokter_old."'";

        $query = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }

	/** 
	* fungsi untuk delete ke tabel dokter 
	*/
    function act_delete(){
        $sql = "UPDATE ".$this->table." SET aktif = 'N' WHERE id_dokter = '".$this->input->post('id_dokter')."'";
        $query = $this->db->query($sql);
        return $query;
    }

}
?>