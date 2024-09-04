<?php
/**
  * Ringkasan dari keterangan_model
  *
  * Model untuk mengelola keterangan
  * @author Firmansyah
  * @version 1.0
  * @package Model keterangan
  *
  * @param int $id integer
  *
  * @return void
  */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
  * Ringkasan dari keterangan_model
  *
  * Model untuk mengelola keterangan
  * @author Firmansyah
  * @version 1.0
  * @package Model keterangan
  *
  * @param int $id integer
  *
  * @return void
  */
class Keterangan_model extends CI_Model
{
	/** fungsi untuk mendefinisikan tabel keterangan */
    function __construct(){
        parent::__construct();
        $this->table  = 'm_keterangan';
    }
	/** fungsi intuk menampilkan semua data keterangan */
	function get_all()
    {
        $sql ='select * from '.$this->table.' where aktif="Y" Order by id_keterangan Desc';
        $query = $this->db->query($sql);
        return $query->result();
    }
	/** fungsi intuk menampilkan data keterangan berdasarkan id keterangan 
	* @param int $id integer
	*/
    function get_all_detail($id)
    {
        $sql ='select * from '.$this->table.' where aktif="Y" and id_keterangan="'.$id.'"';
        $query = $this->db->query($sql);
        return $query->row();
    }
	/** fungsi untuk input ke tabel keterangan */
    function act_form(){
        $kd_lab             = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_lab')));
        $keterangan         = $this->input->post('keterangan');
        $catatan            = $this->input->post('catatan');
        $versi              = $this->input->post('versi');
          $keterangan2         = $this->input->post('keterangan2');
        $catatan2            = $this->input->post('catatan2');
        $aktif              = "Y";
        $sql    = "INSERT INTO m_keterangan (kd_lab,keterangan,catatan,keterangan2,catatan2,versi,aktif)VALUES
        ('".$kd_lab."','".$keterangan."','".$catatan."','".$keterangan2."','".$catatan2."','".$versi."','".$aktif."')";
        $query = $this->db->query($sql);
        echo $this->db->last_query();
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
	/** 
	* fungsi untuk edit ke tabel keterangan 
	*/
    function act_edit(){
        $id_keterangan       = $this->security->xss_clean($this->db->escape_str($this->input->post('id_keterangan')));
        $kd_lab             = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_lab')));
        $keterangan         = $this->input->post('keterangan');
        $catatan            = $this->input->post('catatan');
        $keterangan2         = $this->input->post('keterangan2');
        $catatan2            = $this->input->post('catatan2');
        $versi              = $this->input->post('versi');
    $sql    = "UPDATE m_keterangan SET
                        kd_lab = '".$kd_lab."',
                        keterangan = '".$keterangan."',
                        catatan = '".$catatan."',
                         keterangan2 = '".$keterangan2."',
                        catatan2 = '".$catatan2."',
                        versi = '".$versi."'
                    WHERE id_keterangan = '".$id_keterangan."'";
                    // test($sql,1);
        $query = $this->db->query($sql);
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
	/** 
	* fungsi untuk delete ke tabel keterangan 
	*/
    function act_delete(){
        $sql = "UPDATE ".$this->table." SET aktif = 'N' WHERE id_keterangan = '".$this->input->post('id_keterangan')."'";
        $query = $this->db->query($sql);
        return $query;
    }
    function get_detail_keterangan($versi,$kd)
    {
        $sql ='select * from '.$this->table.' where aktif="Y" and versi="'.$versi.'" AND kd_lab="'.$kd.'"';
        $query = $this->db->query($sql);
        return $query->row();
    }
}
?>