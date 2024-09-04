<?php
/**
  * Ringkasan dari Sampel_model
  *
  * Model untuk mengelola Sampel
  * @author Firmansyah
  * @version 1.0
  * @package Model Sampel
  *
  * @param int $id integer
  *
  * @return void
  */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
  * Ringkasan dari Sampel_model
  *
  * Model untuk mengelola Sampel
  * @author Firmansyah
  * @version 1.0
  * @package Model Sampel
  *
  * @param int $id integer
  *
  * @return void
  */
class Sampel_model extends CI_Model
{
	/** fungsi untuk mendefinisikan tabel sampel */
    function __construct(){
        parent::__construct();
        $this->table  = 'm_sampel';
    }
	/** fungsi intuk menampilkan semua data sampel */
	function get_all()
    {
        $sql ='select * from '.$this->table.' where aktif="Y" ';
        $query = $this->db->query($sql);
        return $query->result();
    }
    function get_all_by_lab($lab)
    {
        $sql ='select * from '.$this->table.' where aktif="Y" AND kd_lab="'.$lab.'" ';
        $query = $this->db->query($sql);
        return $query->result();
    }
	/** fungsi intuk menampilkan data sampel berdasarkan id sampel 
	* @param int $id integer
	*/
    function get_detail($id)
    {
        $sql ='select * from '.$this->table.' where kd_sampel="'.$id.'"';
        $query = $this->db->query($sql);
        return $query->row();
    }
	/** fungsi intuk menampilkan semua data sampel dijoinkan ke tabel laboratorium */
    function get_all_sampel()
    {
        $sql =" SELECT a.*,b.lab FROM ".$this->table." a  LEFT JOIN m_lab b ON a.kd_lab=b.kd_lab WHERE a.aktif='Y' ORDER BY a.kd_sampel DESC ";
        $query = $this->db->query($sql);
        return $query->result();
    }
	/** fungsi untuk input ke tabel sampel */
    function act_form(){
        
        $nama           = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $kd_lab         = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_lab')));
        $keterangan     = $this->security->xss_clean($this->db->escape_str($this->input->post('keterangan')));

        $sql    = "INSERT INTO m_sampel (nm_sampel,kd_lab,keterangan,aktif)VALUES('".$nama."','".$kd_lab."','".$keterangan."','Y')";

        $query = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }

    }
	/** fungsi untuk mendapatkan no dokumen */
    function get_no_doc($periode){
        $sql    = "SELECT IFNULL(LPAD(MAX(SUBSTRING(barcode,7,4))+1,4,'0'),'0001') nomor_dok FROM ".$this->table." WHERE SUBSTRING(barcode,1,6) = '".$periode."'";
        $query  = $this->db->query($sql)->row();
        return $query;

    }
	/** 
	* fungsi untuk edit ke tabel sampel 
	*/
    function act_edit(){

        $nama           = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $kd_sampel      = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_sampel')));
        $kd_lab         = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_lab')));
        $keterangan     = $this->security->xss_clean($this->db->escape_str($this->input->post('keterangan')));

        $sql    = "UPDATE m_sampel SET nm_sampel = '".$nama."' ,kd_lab = '".$kd_lab."' ,keterangan = '".$keterangan."' WHERE kd_sampel = '".$kd_sampel."'";
        $query  = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
	/** 
	* fungsi untuk delete ke tabel sampel 
	*/
    function act_delete(){
        $sql = "UPDATE m_sampel SET aktif = 'N' WHERE kd_sampel = '".$this->input->post('kd_sampel')."'";
        $query = $this->db->query($sql);
        return $query;
    }

}
?>