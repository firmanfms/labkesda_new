<?php
/**
  * Ringkasan dari Laboratorium_model
  *
  * Model untuk mengelola Laboratorium
  * @author Firmansyah
  * @version 1.0
  * @package Model Laboratorium
  *
  * @param int $id integer
  *
  * @return void
  */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
  * Ringkasan dari Laboratorium_model
  *
  * Model untuk mengelola Laboratorium
  * @author Firmansyah
  * @version 1.0
  * @package Model Laboratorium
  *
  * @param int $id integer
  *
  * @return void
  */
class Laboratorium_model extends CI_Model
{
	/** fungsi untuk mendefinisikan tabel laboratorium */
    function __construct(){
        parent::__construct();
        $this->table  = 'm_lab';
    }
	/** fungsi intuk menampilkan semua data laboratorium */
	function get_all()
    {
        $sql ='select * from '.$this->table.' where aktif="Y" Order by kd_lab Desc';
        $query = $this->db->query($sql);
        return $query->result();
    }
	/** fungsi intuk menampilkan data barang berdasarkan id laboratorium 
	* @param int $id integer
	*/
    function get_all_detail($id)
    {
        $sql ='select * from '.$this->table.' where aktif="Y" and kd_lab="'.$id.'"';
        $query = $this->db->query($sql);
        return $query->row();
    }
	/** fungsi intuk menampilkan semua data paramater	*/
    function get_all_parameter()
    {
        $sql =" SELECT a.kd_kategori_parameter,a.nm_kategori_parameter,a.zorder,a.kd_lab,b.lab FROM ".$this->table." a LEFT JOIN m_lab b ON a.kd_lab=b.kd_lab ";
        $query = $this->db->query($sql);
        return $query->result();
    }
	/** fungsi untuk input ke tabel laboratorium */
    function act_form(){

        $kd_lab             = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_lab')));
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));

        $sql    = "INSERT INTO m_lab (kd_lab,lab,aktif)VALUES('".$kd_lab."','".$nama."','Y')";

        $query = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
	/** fungsi untuk membuat penomoran  */
    function get_no_doc($periode){
        $sql    = "SELECT IFNULL(LPAD(MAX(SUBSTRING(barcode,7,4))+1,4,'0'),'0001') nomor_dok FROM ".$this->table." WHERE SUBSTRING(barcode,1,6) = '".$periode."'";
        $query  = $this->db->query($sql)->row();
        return $query;

    }
	/** 
	* fungsi untuk edit ke tabel laboratorium 
	*/
    function act_edit(){

        $nama           = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $kd_lab_old     = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_lab_old')));
        $kd_lab         = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_lab')));

        $sql    = "UPDATE m_lab SET kd_lab = '".$kd_lab."',lab = '".$nama."' WHERE kd_lab = '".$kd_lab_old."'";
        $query  = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
	/** 
	* fungsi untuk delete ke tabel laboratorium 
	*/
    function act_delete(){
        $sql = "UPDATE ".$this->table." SET aktif = 'N' WHERE kd_lab = '".$this->input->post('kd_lab')."'";
        $query = $this->db->query($sql);
        return $query;
    }

}
?>