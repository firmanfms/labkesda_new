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
class Katbarangsub_model extends CI_Model
{
	/** fungsi untuk mendefinisikan tabel lokasi */
    function __construct(){
        parent::__construct();
        $this->table  = 'm_kat_barang_sub';
    }
	/** fungsi intuk menampilkan semua data lokasi */
	function get_all()
    {
        $sql ='select * from '.$this->table.' a LEFT JOIN m_kat_barang b ON a.id_kat_barang=b.id_kat_barang 
                where a.aktif="Y" ORDER BY a.id_kat_barang_sub Desc';
        $query = $this->db->query($sql);
        return $query->result();
    }
	/** fungsi intuk menampilkan data lokasi berdasarkan id lokasi 
	* @param int $id integer
	*/
    function get_all_detail($id)
    {
        $sql ='select * from '.$this->table.' where aktif="Y" and id_kat_barang_sub="'.$id.'"';
        $query = $this->db->query($sql);
        return $query->row();
    }
	/** fungsi untuk input ke tabel lokasi */
    function act_form(){
        $nama                   = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $id_kat_barang          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_kat_barang')));

        $sql    = "INSERT INTO ".$this->table." (id_kat_barang,kategori_sub,aktif)VALUES('".$id_kat_barang."','".$nama."','Y')";
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
        $id_kat_barang_sub  = $this->security->xss_clean($this->db->escape_str($this->input->post('id_kat_barang_sub')));
        $id_kat_barang      = $this->security->xss_clean($this->db->escape_str($this->input->post('id_kat_barang')));
        $id_lokasi          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_lokasi')));
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));

        $sql    = "UPDATE ".$this->table." SET kategori_sub = '".$nama."', id_kat_barang = '".$id_kat_barang."' WHERE id_kat_barang_sub = '".$id_kat_barang_sub."'";
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
        $sql = "UPDATE ".$this->table." SET aktif = 'N' WHERE id_kat_barang_sub = '".$this->input->post('id_kat_barang_sub')."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function sub_kategori($id){
        $sql ='select * from '.$this->table.' a LEFT JOIN m_kat_barang b ON a.id_kat_barang=b.id_kat_barang 
                where a.aktif="Y" AND b.id_kat_barang = '.$id.' ORDER BY a.id_kat_barang_sub Desc';
        $query = $this->db->query($sql);
        return $query->result();
    }


}
?>