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
class Lokasi_sub_model extends CI_Model
{
	/** fungsi untuk mendefinisikan tabel lokasi */
    function __construct(){
        parent::__construct();
        $this->table  = 'm_lokasi_sub';
    }
	/** fungsi intuk menampilkan semua data lokasi */
	function get_all()
    {
        $sql ='select * from '.$this->table.' a, m_lokasi b where a.aktif="Y" AND a.id_lokasi=b.id_lokasi Order by a.id_sub_lokasi Desc';
        $query = $this->db->query($sql);
        return $query->result();
    }
	/** fungsi intuk menampilkan data lokasi berdasarkan id lokasi 
	* @param int $id integer
	*/
    function get_all_detail($id)
    {
        $sql ='select * from '.$this->table.' where aktif="Y" and id_sub_lokasi="'.$id.'"';
        $query = $this->db->query($sql);
        return $query->row();
    }
	/** fungsi untuk input ke tabel lokasi */
    function act_form(){
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $id_lokasi          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_lokasi')));

        $sql    = "INSERT INTO m_lokasi_sub (id_lokasi,tempat,aktif)VALUES('".$id_lokasi."','".$nama."','Y')";
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
        $id_sub_lokasi      = $this->security->xss_clean($this->db->escape_str($this->input->post('id_sub_lokasi')));
        $id_lokasi          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_lokasi')));
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));

        $sql    = "UPDATE m_lokasi_sub SET tempat = '".$nama."', id_lokasi = '".$id_lokasi."' WHERE id_sub_lokasi = '".$id_sub_lokasi."'";
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
        $sql = "UPDATE ".$this->table." SET aktif = 'N' WHERE id_sub_lokasi = '".$this->input->post('id_sub_lokasi')."'";
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