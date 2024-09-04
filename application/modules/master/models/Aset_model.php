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
class Aset_model extends CI_Model
{
	/** fungsi untuk mendefinisikan tabel barang */
    function __construct(){
        parent::__construct();
        $this->table   = 'm_assets';
        $this->table2  = 'm_kondisi';
        $this->table3  = 'm_sumber';
    }

	/** fungsi intuk menampilkan semua data barang */
	function get_all()
    {
        $sql =' SELECT a.*,b.sumber,c.kondisi,d.lokasi,e.kategori FROM '.$this->table.' a
                JOIN m_sumber b ON a.id_sumber=b.id_sumber
                JOIN m_kondisi c ON a.id_kondisi=c.id_kondisi
                JOIN m_lokasi_assets d ON a.id_lokasi=d.id_lokasi
                JOIN m_kat_barang e ON a.id_kat_barang=e.id_kat_barang WHERE a.aktif="Y" ';
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_kondisi()
    {
        $sql ='select * from '.$this->table2.' where aktif="Y" ';
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_sumber()
    {
        $sql ='select * from '.$this->table3.' where aktif="Y" ';
        $query = $this->db->query($sql);
        return $query->result();
    }

	/** fungsi intuk menampilkan data barang berdasarkan id barang 
	* @param integer $id 
	*/
    function get_all_detail($id)

    {
        $sql ='select * from '.$this->table.' where id_assets="'.$id.'"';
        $query = $this->db->query($sql);
        return $query->row();
    }

	/** fungsi join tabel barang dan kategori barang untuk menampilkan data barang */
    function get_all_barang()
    {
        $sql =" SELECT a.*,b.kategori,c.satuan FROM m_barang a LEFT JOIN m_kat_barang b ON a.id_kat_barang=b.id_kat_barang LEFT JOIN m_satuan c ON a.id_satuan=c.id_satuan
                WHERE a.aktif='Y' ";
        $query = $this->db->query($sql);
        return $query->result();
    }

	/** fungsi untuk input ke tabel barang */
    function act_form(){
        $periode = date('Y');
        $get_items_code = $this->get_no_doc($periode);
        $barcode        = 'MA'.$periode.$get_items_code->nomor_dok;

        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $merk               = $this->security->xss_clean($this->db->escape_str($this->input->post('merk')));
        $serial_number      = $this->security->xss_clean($this->db->escape_str($this->input->post('serial_number')));
        $tgl_perolehan      = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_perolehan')));
        $harga_perolehan    = $this->security->xss_clean($this->db->escape_str($this->input->post('harga_perolehan')));
        $id_sumber          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_sumber')));
        $id_kondisi         = $this->security->xss_clean($this->db->escape_str($this->input->post('id_kondisi')));
        $id_lokasi          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_lokasi')));
        $id_kat_barang      = $this->security->xss_clean($this->db->escape_str($this->input->post('id_kat_barang')));
        $jumlah             = $this->security->xss_clean($this->db->escape_str($this->input->post('jumlah')));
        $tipe_aset          = $this->security->xss_clean($this->db->escape_str($this->input->post('tipe_aset')));

        $sql    = "INSERT INTO ".$this->table."
                    (`nama`,`kd_assets`,`merk`,`serial_number`,`tgl_perolehan`,`harga_perolehan`,`id_sumber`,`id_kondisi`,`id_lokasi`,`jumlah`,`aktif`,
                    `id_kat_barang`,`id_satuan`,`tipe_aset`)VALUES
                    ('".$nama."','".$barcode."','".$merk."','".$serial_number."','".$tgl_perolehan."','".$harga_perolehan."','".$id_sumber."','".$id_kondisi."','".$id_lokasi."','".$jumlah."','Y','".$id_kat_barang."','0','".$tipe_aset."')";

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
        $sql    = "SELECT IFNULL(LPAD(MAX(SUBSTRING(kd_assets,7,5))+1,5,'0'),'0001') nomor_dok FROM `m_assets` WHERE SUBSTRING(kd_assets,3,4) = '".$periode."'";
        $query  = $this->db->query($sql)->row();
        return $query;
    }

	/** 
	* fungsi untuk edit ke tabel barang 
	*/
    function act_edit(){

        $id_assets          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_assets')));
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $merk               = $this->security->xss_clean($this->db->escape_str($this->input->post('merk')));
        $serial_number      = $this->security->xss_clean($this->db->escape_str($this->input->post('serial_number')));
        $tgl_perolehan      = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_perolehan')));
        $harga_perolehan    = $this->security->xss_clean($this->db->escape_str($this->input->post('harga_perolehan')));
        $id_sumber          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_sumber')));
        $id_kondisi         = $this->security->xss_clean($this->db->escape_str($this->input->post('id_kondisi')));
        $id_lokasi          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_lokasi')));
        $id_kat_barang      = $this->security->xss_clean($this->db->escape_str($this->input->post('id_kat_barang')));
        $tipe_aset          = $this->security->xss_clean($this->db->escape_str($this->input->post('tipe_aset')));
        $jumlah             = $this->security->xss_clean($this->db->escape_str($this->input->post('jumlah')));

        $sql    = "UPDATE ".$this->table." 
                    SET 
                    `nama` = '".$nama."', 
                    `merk` = '".$merk."', 
                    `serial_number` = '".$serial_number."', 
                    `tgl_perolehan` = '".$tgl_perolehan."', 
                    `harga_perolehan` = '".$harga_perolehan."', 
                    `id_sumber` = '".$id_sumber."', 
                    `id_kondisi` = '".$id_kondisi."', 
                    `id_lokasi` = '".$id_lokasi."', 
                    `jumlah` = '".$jumlah."', 
                    `id_kat_barang` = '".$id_kat_barang."', 
                    `tipe_aset` = '".$tipe_aset."', 
                    `id_satuan` = '0'   
                    WHERE
                    `id_assets` = '".$id_assets."'";
                    
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
        $sql = "UPDATE ".$this->table." SET aktif = 'N' WHERE id_assets = '".$this->input->post('id_assets')."'";
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

    function report(){
        $sql = "SELECT a.nama,a.kd_assets,a.merk,a.serial_number,year(a.tgl_perolehan)tahun_perolehan,a.harga_perolehan,a.id_sumber,a.id_kondisi,a.id_lokasi,a.jumlah,a.id_kat_barang,
                b.sumber,c.kondisi,d.lokasi,d.lokasi,e.kategori
                FROM m_assets a
                LEFT JOIN m_sumber b ON a.id_sumber = b.id_sumber
                LEFT JOIN m_kondisi c ON c.id_kondisi = a.id_kondisi
                LEFT JOIN m_lokasi_assets d ON a.id_lokasi=d.id_lokasi
                LEFT JOIN m_kat_aset e ON a.id_kat_barang=e.id_kat_barang
                WHERE a.aktif='Y'";
        return $this->db->query($sql)->result();
    }

    function report_categori(){
        $sql = "SELECT a.nama,a.kd_assets,a.merk,a.serial_number,year(a.tgl_perolehan)tahun_perolehan,a.harga_perolehan,a.id_sumber,a.id_kondisi,a.id_lokasi,
                a.jumlah,a.id_kat_barang,a.jumlah,b.sumber,c.kondisi,d.lokasi,d.lokasi,e.kategori,a.tipe_aset
                FROM m_assets a
                LEFT JOIN m_sumber b ON a.id_sumber = b.id_sumber
                LEFT JOIN m_kondisi c ON c.id_kondisi = a.id_kondisi
                LEFT JOIN m_lokasi_assets d ON a.id_lokasi=d.id_lokasi
                LEFT JOIN m_kat_aset e ON a.id_kat_barang=e.id_kat_barang
                WHERE a.aktif='Y'";
        return $this->db->query($sql)->result();
    }


}	