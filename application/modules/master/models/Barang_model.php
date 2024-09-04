<?php
/**
  * Ringkasan dari Model Barang
  *
  * Model untuk mengelola Barang
  * @author Firmansyah
  * @version 1.0
  * @package Model Barang
  *
  * @param int $id integer
  *
  * @return void
  */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
  * Ringkasan dari Model Barang
  *
  * Model untuk mengelola Barang
  * @author Firmansyah
  * @version 1.0
  * @package Model Barang
  *
  * @param int $id integer
  *
  * @return void
  */
class Barang_model extends CI_Model
{
	/** fungsi untuk mendefinisikan tabel barang */
    function __construct(){
        parent::__construct();
        $this->table  = 'm_barang';
    }

	/** fungsi intuk menampilkan semua data barang */
	function get_all()
    {
        $sql ='SELECT a.*,b.satuan FROM '.$this->table.' a LEFT JOIN m_satuan b ON a.id_satuan=b.id_satuan WHERE a.aktif="Y" order by id_barang DESC ';
        $query = $this->db->query($sql);
        return $query->result();
    }

	/** fungsi intuk menampilkan data barang berdasarkan id barang 
	* @param integer $id 
	*/
    function get_all_detail($id)

    {
        $sql ='select * from '.$this->table.' where aktif="Y" and id_barang="'.$id.'"';
        $query = $this->db->query($sql);
        return $query->row();
    }

	/** fungsi join tabel barang dan kategori barang untuk menampilkan data barang */
    function get_all_barang()
    {
        $sql =" SELECT a.*,b.kategori,c.satuan,d.nm_vendor
                FROM m_barang a 
                LEFT JOIN m_kat_barang b ON a.id_kat_barang=b.id_kat_barang 
                LEFT JOIN m_satuan c ON a.id_satuan=c.id_satuan
                LEFT JOIN m_vendor d ON d.id_vendor=a.id_vendor
                WHERE a.aktif='Y' order by id_barang DESC ";
        $query = $this->db->query($sql);
        return $query->result();
    }

	/** fungsi untuk input ke tabel barang */
    function act_form(){
        $periode = date('Y').date('m');

        $get_items_code = $this->get_no_doc($periode);
        $barcode        = $periode.$get_items_code->nomor_dok;

        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $id_kat_barang      = $this->security->xss_clean($this->db->escape_str($this->input->post('id_kat_barang')));
        $kd_kat_barang      = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_kat_barang')));
        $id_satuan          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_satuan')));
        $id_vendor          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_vendor')));
        $lot_number         = $this->security->xss_clean($this->db->escape_str($this->input->post('lot_number')));
        $id_kat_barang_sub  = $this->security->xss_clean($this->db->escape_str($this->input->post('id_kat_barang_sub')));
        $kemasan            = $this->security->xss_clean($this->db->escape_str($this->input->post('kemasan')));
        $kd_ekatalog        = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_ekatalog')));

        if($lot_number=='true'){
            $is_lot         = 'Y';
        }else{
            $is_lot         = 'N';
        }

        $kd_barang          = $kd_kat_barang.$periode.$get_items_code->nomor_dok;

        $sql    = "INSERT INTO m_barang (kd_barang,nama,barcode,aktif,id_kat_barang,id_satuan,id_vendor,id_kat_barang_sub,is_lot,kemasan,kd_ekatalog) VALUES 
                    ('".$kd_barang."','".$nama."','".$barcode."','Y','".$id_kat_barang."','".$id_satuan."','".$id_vendor."','".$id_kat_barang_sub."','".$is_lot."','".$kemasan."','".$kd_ekatalog."')";

        $query = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
	
	/** 
	* fungsi untuk mendapatkan no dokumen
	* @param int $periode integer
	*/
    function get_no_doc($periode){
        $sql    = "SELECT IFNULL(LPAD(MAX(SUBSTRING(barcode,7,4))+1,4,'0'),'0001') nomor_dok FROM `m_barang` WHERE SUBSTRING(barcode,1,6) = '".$periode."'";
        $query  = $this->db->query($sql)->row();
        return $query;

    }

	/** 
	* fungsi untuk edit ke tabel barang 
	*/
    function act_edit(){

        $id_barang          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_barang')));
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $id_kat_barang      = $this->security->xss_clean($this->db->escape_str($this->input->post('id_kat_barang')));
        $kd_kat_barang      = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_kat_barang')));
        $id_satuan          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_satuan')));
        $id_vendor          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_vendor')));
        $lot_number         = $this->security->xss_clean($this->db->escape_str($this->input->post('lot_number')));
        $id_kat_barang_sub  = $this->security->xss_clean($this->db->escape_str($this->input->post('id_kat_barang_sub')));
        $kemasan            = $this->security->xss_clean($this->db->escape_str($this->input->post('kemasan')));
        $kd_ekatalog        = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_ekatalog')));

        if($lot_number=='true'){
            $is_lot         = 'Y';
        }else{
            $is_lot         = 'N';
        }

        $sql    = " UPDATE m_barang SET 
                        nama = '".$nama."',
                        id_kat_barang = '".$id_kat_barang."' ,
                        id_satuan = '".$id_satuan."', 
                        id_kat_barang_sub = '".$id_kat_barang_sub."',
                        id_vendor = '".$id_vendor."',
                        is_lot = '".$is_lot."' ,
                        kemasan = '".$kemasan."',
                        kd_ekatalog = '".$kd_ekatalog."'
                        WHERE id_barang = '".$id_barang."' ";
                        
        $query  = $this->db->query($sql);
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }

	/** 
	* fungsi untuk delete ke tabel barang 
	*/
    function act_delete(){
        $sql = "UPDATE m_barang SET aktif = 'N' WHERE id_barang = '".$this->input->post('id_barang')."'";
        $query = $this->db->query($sql);
        return $query;
    }

	/** 
	* fungsi untuk view detail ke tabel barang 
	* @param int @id integer
	*/
    function detail_items($id){
        $query = $this->db->query("SELECT items_id,items_code,items_name as items_nama,items_kind,items_unit,items_group,items_info,category_items,dept_authorized FROM mst_items WHERE items_id='".$id."'")->row();    
        return $query;
    }    

	/** 
	* fungsi untuk mendapatkan jumlah 
	*/
    function items_count(){
        $sql ="SELECT COUNT(items_id) total FROM mst_items WHERE is_active='1' ";
        $item = $this->db->query($sql)->row();
        return isset($item->total) ? $item->total : 0;
    }


}	