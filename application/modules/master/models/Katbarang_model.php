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
class Katbarang_model extends CI_Model
{
	/** fungsi untuk mendefinisikan tabel kategori barang */
	function __construct(){
        parent::__construct();
        $this->table  = 'm_kat_barang';
    }
	/** fungsi intuk menampilkan semua data kategori barang */
    function get_all()
    {
        $sql ='select * from '.$this->table.' where aktif="Y" order by id_kat_barang DESC ';
        $query = $this->db->query($sql);
        return $query->result();
    }
    function get_all_json()
    {
        $sql ='select kategori from '.$this->table.' where aktif="Y" ';
        $query = $this->db->query($sql);
        return $query->result();
    }
	/** fungsi untuk input ke tabel kategori barang */
    function act_form(){
        $id             = $this->db->query("SELECT IFNULL(MAX(id_kat_barang),0)+1 id FROM m_kat_barang")->row()->id;
        $nama           = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $kd_kat_barang  = strtoupper($this->security->xss_clean($this->db->escape_str($this->input->post('kd_kat_barang'))));

        $sql    = "INSERT INTO m_kat_barang (id_kat_barang,kd_kat_barang,kategori,aktif)VALUES('".$id."','".$kd_kat_barang."','".$nama."','Y')";
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
        $sql    = "UPDATE m_kat_barang 
                    SET
                    kategori = '".$this->input->post("nama")."',                 
                    kd_kat_barang = '".strtoupper($this->input->post("kd_kat_barang"))."'                    
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