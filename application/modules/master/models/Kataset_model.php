<?php
/**
  * Ringkasan dari Katbarang_model
  *
  * Model untuk mengelola Kategori barang
  * @author Firmansyah
  * @version 1.0
  * @package Model Kategori Barang
  *
  * @param int $id integer
  *
  * @return void
  */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
  * Ringkasan dari Katbarang_model
  *
  * Model untuk mengelola Kategori barang
  * @author Firmansyah
  * @version 1.0
  * @package Model Kategori Barang
  *
  * @param int $id integer
  *
  * @return void
  */
class Kataset_model extends CI_Model
{
	/** fungsi untuk mendefinisikan tabel kategori barang */
	function __construct(){
        parent::__construct();
        $this->table  = 'm_kat_aset';
    }
	/** fungsi intuk menampilkan semua data kategori barang */
    function get_all()
    {
        $sql ='select * from '.$this->table.' where aktif="Y" ';
        $query = $this->db->query($sql);
        return $query->result();
    }
	/** fungsi untuk input ke tabel kategori barang */
    function act_form(){
        $id         = $this->db->query("SELECT IFNULL(MAX(id_kat_barang),0)+1 id FROM m_kat_aset")->row()->id;
        $nama       = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));

        $sql    = "INSERT INTO m_kat_aset (id_kat_barang,kategori,aktif)VALUES('".$id."','".$nama."','Y')";
        $query = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }

	/** 
	* fungsi untuk delete ke tabel kategori barang 
	*/
    function act_delete(){
        $sql = "UPDATE ".$this->table." SET aktif='N' WHERE id_kat_barang = '".$this->input->post('id_kat_barang')."'";
        //test($sql,1);
        $query = $this->db->query($sql);
        return $query;
    }
	/** fungsi intuk menampilkan data barang berdasarkan id kategori barang 
	* @param int $id integer
	*/
    function detail_katkategori($id){
        $query = $this->db->query("SELECT * FROM ".$this->table." WHERE id_kat_barang='".$id."'")->row();
        return $query;
    }
	/** 
	* fungsi untuk edit ke tabel kategori barang 
	*/
    function act_edit(){
        $sql    = "UPDATE m_kat_aset 
                    SET
                    kategori = '".$this->input->post("nama")."'                    
                    WHERE
                    id_kat_barang = '".$this->input->post("id_kat_barang")."'";
                    
        $query = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }

}	