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
class Harga_model extends CI_Model
{
	/** fungsi untuk mendefinisikan tabel barang */
    function __construct(){
        parent::__construct();
        $this->table  = 'm_harga';
    }

	/** fungsi intuk menampilkan semua data barang */
	function get_all()
    {
        $sql ='SELECT a.* FROM '.$this->table.' a GROUP BY tahun order by tahun DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }

	/** fungsi intuk menampilkan data barang berdasarkan id barang 
	* @param integer $id 
	*/
    function get_all_detail($id)

    {
        $sql ='select a.*,b.* from m_barang a LEFT JOIN '.$this->table.' b ON a.id_barang=b.id_barang where tahun="'.$id.'"';
        $query = $this->db->query($sql);
        return $query->result();
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
        $id_barang          = $this->input->post('id_barang');
        $harga              = $this->input->post('harga_barang');
        $sumber_anggaran    = 'APBD';
        $tahun              = $this->input->post('tahun');

        // test($harga,1);

        foreach ($id_barang as $key => $value) {
            if($harga[$key]==''){
                $price          = 0;
            }else{
                $price          = $harga[$key];
            }
            $this->db->query("INSERT INTO ".$this->table." (id_barang,tahun,harga_barang,sumber_anggaran,tgl_input)VALUES
                ('".$value."','".$tahun."','".$price."','".$sumber_anggaran."','".dbnow()."')");
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

        $id_barang          = $this->input->post('id_barang');
        $harga              = $this->input->post('harga_barang');
        $sumber_anggaran    = 'APBD';
        $tahun              = $this->input->post('tahun');

        // test($harga,1);
        $this->db->query("DELETE FROM m_harga WHERE tahun = '".$tahun."'");

        // test($id_barang,0);
        foreach ($id_barang as $key => $value) {
            if($harga[$key]==''){
                $price          = 0;
            }else{
                $price          = $harga[$key];
            }
            // test("INSERT INTO ".$this->table." (id_barang,tahun,harga_barang,sumber_anggaran,tgl_input)VALUES
            //     ('".$value."','".$tahun."','".$price."','".$sumber_anggaran."','".dbnow()."')",0);
            $this->db->query("INSERT INTO ".$this->table." (id_barang,tahun,harga_barang,sumber_anggaran,tgl_input)VALUES
                ('".$value."','".$tahun."','".$price."','".$sumber_anggaran."','".dbnow()."')");
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