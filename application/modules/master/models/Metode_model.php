<?php
/**
  * Ringkasan dari Metode_model
  *
  * Model untuk mengelola Metode
  * @author Firmansyah
  * @version 1.0
  * @package Model Metode
  *
  * @param int $id integer
  *
  * @return void
  */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
  * Ringkasan dari Metode_model
  *
  * Model untuk mengelola Metode
  * @author Firmansyah
  * @version 1.0
  * @package Model Metode
  *
  * @param int $id integer
  *
  * @return void
  */
class Metode_model extends CI_Model
{
	/** fungsi untuk mendefinisikan tabel metode */
    function get_all()
    {
        $sql ='SELECT a.*,b.nm_kategori_parameter,c.lab FROM m_parameter a LEFT JOIN m_kategori_parameter b ON a.kd_kategori_parameter=b.kd_kategori_parameter
                LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
                WHERE a.aktif="Y" order by a.kd_parameter DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }
    function get_all_by_jenis($jenis)
    {
        $sql ='SELECT b.`nm_kategori_parameter`,b.zorder kat_zorder,a.* FROM m_parameter a 
                LEFT JOIN m_kategori_parameter b ON a.`kd_kategori_parameter`=b.`kd_kategori_parameter`
                WHERE a.aktif="Y" AND a.kd_lab="'.$jenis.'" ORDER BY b.`zorder` asc,a.`zorder` asc';
        $query = $this->db->query($sql);
        return $query->result();
    }
    function get_all_by_sampel($sampel)
    {
        $sampel         = $this->security->xss_clean($this->db->escape_str('%"'.$sampel.'"%'));
        // test($sampel,1);
        $sql ='SELECT b.`nm_kategori_parameter`,a.* FROM m_parameter a 
                LEFT JOIN m_kategori_parameter b ON a.`kd_kategori_parameter`=b.`kd_kategori_parameter`
                WHERE a.aktif="Y" AND b.kd_sampel LIKE "'.$sampel.'" ORDER BY b.`zorder` asc,a.`zorder` asc';
        $query = $this->db->query($sql);
        return $query->result();
    }
    function get_all_by_sampel_old($sampel)
    {
        $sampel         = $this->security->xss_clean($this->db->escape_str('%"'.$sampel.'"%'));
        // test($sampel,1);
        $sql ='SELECT b.`nm_kategori_parameter`,a.*,"" as no_pendaftaran FROM m_parameter a 
                LEFT JOIN m_kategori_parameter b ON a.`kd_kategori_parameter`=b.`kd_kategori_parameter`
                WHERE a.aktif="Y" AND b.kd_sampel LIKE "'.$sampel.'" ORDER BY b.`nm_kategori_parameter`,a.`nm_parameter`';
        $query = $this->db->query($sql);
        return $query->result();
    }
    function get_all_by_sampel_ll($sampel,$id)
    {
        $sampel         = $this->security->xss_clean($this->db->escape_str('%"'.$sampel.'"%'));
        // test($sampel,1);
        $sql ='SELECT b.`nm_kategori_parameter`,a.*,c.no_pendaftaran FROM m_parameter a 
                LEFT JOIN m_kategori_parameter b ON a.`kd_kategori_parameter`=b.`kd_kategori_parameter`
                LEFT JOIN t_pendaftaran_detail c ON a.`kd_parameter`=c.`kd_parameter` AND c.`no_pendaftaran`= "'.$id.'"
                WHERE a.aktif="Y" AND b.kd_sampel LIKE "'.$sampel.'" ORDER BY b.`nm_kategori_parameter`,a.`nm_parameter`';
        $query = $this->db->query($sql);
        return $query->result();
    }
    function get_all_by_jenis_detail($jenis,$id)
    {
        $sql ='SELECT c.`nm_kategori_parameter`,a.*,b.no_pendaftaran FROM m_parameter a 
                LEFT JOIN t_pendaftaran_detail b ON a.`kd_parameter`=b.`kd_parameter` AND b.`no_pendaftaran`= "'.$id.'"
                LEFT JOIN m_kategori_parameter c ON a.`kd_kategori_parameter`=c.`kd_kategori_parameter`
                WHERE a.aktif="Y" AND a.kd_lab="'.$jenis.'" 
                ORDER BY c.`zorder` asc,a.`zorder` asc';
        $query = $this->db->query($sql);
        return $query->result();
    }
	/** fungsi untuk input ke tabel metode */
    function act_form(){
        $new_metode   = $this->session->userdata('new_metode');
        // test($new_metode,1);
        // ALTER TABLE `db_labkesda_lab`.`m_parameter` ADD COLUMN `nilai_min` DECIMAL(13,2) NULL AFTER `metode_analisa5`, ADD COLUMN `nilai_max` DECIMAL(13,2) NULL AFTER `nilai_min`;
        // echo $kadar;
        function convert_symbol_to_entity($kadar) {
            $kadar = str_replace('<', '&lt;', $kadar);
            $kadar = str_replace('≤', '&le;', $kadar);
            $kadar = str_replace('>', '&gt;', $kadar);
            $kadar = str_replace('≥', '&ge;', $kadar);
            return $kadar;
        }
        // echo $kadar;
        $kd_parameter       = $this->max_id()->kd_parameter;
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $satuan             = $this->security->xss_clean($this->db->escape_str($this->input->post('satuan')));
        $kadar              = $this->security->xss_clean($this->db->escape_str($this->input->post('kadar')));
        $kadar              = convert_symbol_to_entity($kadar);
        $metode_analisa1    = $this->security->xss_clean($this->db->escape_str($this->input->post('metode_analisa1')));
        $metode_analisa2    = $this->security->xss_clean($this->db->escape_str($this->input->post('metode_analisa2')));
        $metode_analisa3    = $this->security->xss_clean($this->db->escape_str($this->input->post('metode_analisa3')));
        $metode_analisa4    = $this->security->xss_clean($this->db->escape_str($this->input->post('metode_analisa4')));
        $metode_analisa5    = $this->security->xss_clean($this->db->escape_str($this->input->post('metode_analisa5')));
        $alias              = $this->security->xss_clean($this->db->escape_str($this->input->post('alias')));
        $akreditas          = $this->security->xss_clean($this->db->escape_str($this->input->post('akreditas')));
        $harga              = $this->security->xss_clean($this->db->escape_str($this->input->post('harga')));
        $jumlah             = $this->security->xss_clean($this->db->escape_str($this->input->post('jumlah')));
        $zoder              = $this->security->xss_clean($this->db->escape_str($this->input->post('zoder')));
        $kd_kategori_parameter       = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_kategori_parameter')));
        $kd_lab             = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_lab')));
        $nilai_min          = $this->security->xss_clean($this->db->escape_str($this->input->post('nilai_min')));
        $nilai_max          = $this->security->xss_clean($this->db->escape_str($this->input->post('nilai_max')));
        if(isset($new_metode['items'])){
            $items          = $new_metode['items'];
            foreach ($items as $key => $value) {
                // $id_detail      = $this->max_id_detail()->id_metode_detail;
                $sql_detail     = "INSERT INTO db_labkesda_lab.m_kadar (deskripsi_kadar,kd_parameter,kd_kategori_parameter,kd_lab,
                                                    nilai_minimum,nilai_maksimum,aktif)VALUES
                ('".$value['deskripsi_kadar']."','".$kd_parameter."','".$kd_kategori_parameter."','".$kd_lab."','".$value['min_kadar']."','".$value['max_kadar']."','".$value['aktif']."')";
                // test($sql_detail,1);
                $query          = $this->db->query($sql_detail);
            }
        }
        // echo $kd_lab; exit();
        if($kd_lab == 'LK'){
            $sql    = "INSERT INTO m_parameter (kd_parameter,nm_parameter,satuan,kadar,metode_analisa,metode_analisa2,metode_analisa3,metode_analisa4,
                                    metode_analisa5,alias,kd_kategori_parameter,kd_lab,akreditasi,harga,jml_pengecekan,zorder,aktif ) VALUES
                ('".$kd_parameter."','".$nama."','".$satuan."','".$kadar."','".$metode_analisa1."','".$metode_analisa2."','".$metode_analisa3."',
                '".$metode_analisa4."','".$metode_analisa5."','".$alias."','".$kd_kategori_parameter."','".$kd_lab."','".$akreditas."','".$harga."',
                '".$jumlah."','".$zoder."','Y' )";
        $query = $this->db->query($sql);
        }else{
             $sql    = "INSERT INTO m_parameter (kd_parameter,nm_parameter,satuan,kadar,metode_analisa,metode_analisa2,metode_analisa3,metode_analisa4,
                                    metode_analisa5,alias,kd_kategori_parameter,kd_lab,akreditasi,harga,jml_pengecekan,zorder,aktif,nilai_min,
                                    nilai_max) VALUES
                ('".$kd_parameter."','".$nama."','".$satuan."','".$kadar."','".$metode_analisa1."','".$metode_analisa2."','".$metode_analisa3."',
                '".$metode_analisa4."','".$metode_analisa5."','".$alias."','".$kd_kategori_parameter."','".$kd_lab."','".$akreditas."','".$harga."',
                '".$jumlah."','".$zoder."','Y','".$nilai_min."','".$nilai_max."')";
        $query = $this->db->query($sql);
        }
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
    function max_id_detail(){
        $query = $this->db->query("SELECT IFNULL(MAX(id_metode_detail),0)+1 id_metode_detail FROM m_parameter_detail")->row();
        return $query;
    }
    function max_id(){
        $query = $this->db->query("SELECT MAX(kd_parameter)+1 kd_parameter FROM m_parameter")->row();
        return $query;
    }
	/** 
	* fungsi untuk delete ke tabel metode 
	*/
    function act_delete(){
        $sql = "UPDATE m_parameter SET aktif = 'N' WHERE kd_parameter = '".$this->input->post('kd_parameter')."'";
        $query = $this->db->query($sql);
        return $query;
    }
	/** fungsi intuk menampilkan detail metode berdasarkan id metode 
	* @param int $id integer
	*/
    function metode_detail($id){
        $sql    = "SELECT * FROM m_kadar WHERE kd_parameter='".$id."' AND aktif='Y'";
        $query  = $this->db->query($sql);
        return $query;
    }
	/** fungsi intuk menampilkan header metode berdasarkan id metode 
	* @param int $id integer
	*/
    function metode_header($id){
        $sql    = "SELECT * FROM m_parameter WHERE kd_parameter='".$id."'";
        $query  = $this->db->query($sql);
        return $query;
    }
	/** 
	* fungsi untuk edit ke tabel metode 
	*/
    function act_edit(){
        $new_metode   = $this->session->userdata('new_metode');
        $kd_parameter          = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_parameter')));
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $satuan             = $this->security->xss_clean($this->db->escape_str($this->input->post('satuan')));
        $kadar              = $this->security->xss_clean($this->db->escape_str($this->input->post('kadar')));
        $metode_analisa1     = $this->security->xss_clean($this->db->escape_str($this->input->post('metode_analisa1')));
        $metode_analisa2     = $this->security->xss_clean($this->db->escape_str($this->input->post('metode_analisa2')));
        $metode_analisa3     = $this->security->xss_clean($this->db->escape_str($this->input->post('metode_analisa3')));
        $metode_analisa4     = $this->security->xss_clean($this->db->escape_str($this->input->post('metode_analisa4')));
        $metode_analisa5     = $this->security->xss_clean($this->db->escape_str($this->input->post('metode_analisa5')));
        $alias              = $this->security->xss_clean($this->db->escape_str($this->input->post('alias')));
        $akreditas          = $this->security->xss_clean($this->db->escape_str($this->input->post('akreditas')));
        $harga              = $this->security->xss_clean($this->db->escape_str($this->input->post('harga')));
        $jumlah             = $this->security->xss_clean($this->db->escape_str($this->input->post('jumlah')));
        $zoder              = $this->security->xss_clean($this->db->escape_str($this->input->post('zoder')));
        $kd_kategori_parameter       = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_kategori_parameter')));
        $kd_lab             = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_lab')));
        $nilai_min          = $this->security->xss_clean($this->db->escape_str($this->input->post('nilai_min')));
        $nilai_max          = $this->security->xss_clean($this->db->escape_str($this->input->post('nilai_max')));
        // $sql    = "INSERT INTO m_parameter (kd_parameter,nm_parameter,satuan,kadar,metode_analisa,alias,kd_kategori_parameter,kd_lab,akreditasi,harga,jml_pengecekan,zorder,aktif)VALUES
        //         ('".$kd_parameter."','".$nama."','".$satuan."','".$kadar."','".$metode_analisa."','".$alias."','".$kd_kategori_parameter."','".$kd_lab."','".$akreditas."','".$harga."','".$jumlah."','".$zoder."','Y')";
        if($kd_lab == 'LK'){
               $sql    = "UPDATE m_parameter
                    SET nm_parameter = '".$nama."',
                        satuan = '".$satuan."',
                        kadar = '".$kadar."',
                        metode_analisa = '".$metode_analisa1."',
                        metode_analisa2 = '".$metode_analisa2."',
                        metode_analisa3 = '".$metode_analisa3."',
                        metode_analisa4 = '".$metode_analisa4."',
                        metode_analisa5 = '".$metode_analisa5."',
                        alias = '".$alias."',
                        kd_kategori_parameter = '".$kd_kategori_parameter."',
                        kd_lab = '".$kd_lab."',
                        akreditasi = '".$akreditas."',
                        harga = '".$harga."',
                        jml_pengecekan = '".$jumlah."',
                        zorder = '".$zoder."'
                    where kd_parameter = '".$kd_parameter."'";
        }else {
             $sql    = "UPDATE m_parameter
                    SET nm_parameter = '".$nama."',
                        satuan = '".$satuan."',
                        kadar = '".$kadar."',
                        metode_analisa = '".$metode_analisa1."',
                        metode_analisa2 = '".$metode_analisa2."',
                        metode_analisa3 = '".$metode_analisa3."',
                        metode_analisa4 = '".$metode_analisa4."',
                        metode_analisa5 = '".$metode_analisa5."',
                        alias = '".$alias."',
                        kd_kategori_parameter = '".$kd_kategori_parameter."',
                        kd_lab = '".$kd_lab."',
                        akreditasi = '".$akreditas."',
                        harga = '".$harga."',
                        jml_pengecekan = '".$jumlah."',
                        zorder = '".$zoder."',
                        nilai_min = '".$nilai_min."',
                        nilai_max = '".$nilai_max."'
                    where kd_parameter = '".$kd_parameter."'";  # code...
        }
        // $delete = "DELETE FROM m_kadar WHERE kd_parameter = '".$kd_parameter."'";
        // $query = $this->db->query($delete);
        if(isset($new_metode['items'])){
            $items          = $new_metode['items'];
            foreach ($items as $key => $value) {
                $cek_detail     = $this->db->query("SELECT * FROM m_kadar WHERE id_kadar='".$value['no_hasil']."'")->num_rows();
                if($cek_detail==1){
                    $sql_detail     = "UPDATE
                                          m_kadar
                                        SET
                                          deskripsi_kadar = '".$value['deskripsi_kadar']."',
                                          kd_parameter = '".$kd_parameter."',
                                          kd_kategori_parameter = '".$kd_kategori_parameter."',
                                          nilai_minimum = '".$value['min_kadar']."',
                                          nilai_maksimum = '".$value['max_kadar']."',
                                          aktif = '".$value['aktif']."'
                                        WHERE id_kadar = '".$value['no_hasil']."'";
                }else{
                    $sql_detail     = "INSERT INTO m_kadar (deskripsi_kadar,kd_parameter,kd_kategori_parameter,kd_lab,
                                                    nilai_minimum,nilai_maksimum,aktif)VALUES
                    ('".$value['deskripsi_kadar']."','".$kd_parameter."','".$kd_kategori_parameter."','".$kd_lab."','".$value['min_kadar']."','".$value['max_kadar']."','Y')";
                }
                // $id_detail      = $this->max_id_detail()->id_metode_detail;
                // test($sql_detail,1);
                $query          = $this->db->query($sql_detail);
                // echo $this->db->last_query(). ' <br> ';
            }
        }
        $query = $this->db->query($sql);
        //  echo $this->db->last_query(). ' <br> ';
        //  exit();
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
    function kind_supplier(){
        $sql ='SELECT   supplier_kind_id,kind_name FROM mst_supplier_kind WHERE is_active=1';
        $query = $this->db->query($sql);
        return $query->result();
    }
    function detail_supplier($id){
        $query = $this->db->query("SELECT supplier_id,supplier_code,supplier_kind_id,supplier_name,npwp,siup,address,city,contact1,contact2,contact3,email1,email2,pic_sales,top,
                                    supplier_info,is_ppn,file_npwp FROM mst_supplier WHERE supplier_id='".$id."'")->row();
        return $query;
    }
    function detail_items_supplier($id){
        $query = $this->db->query("SELECT a.items_id item_id,b.items_name item_name,a.items_price FROM mst_supplier_items a,mst_items b WHERE a.supplier_id='".$id."' AND a.items_id=b.items_id")->result();
        return $query;
    }
    function jumlah_items_supplier($id){
        $query = $this->db->query("SELECT a.items_id item_id,b.items_name item_name,a.items_price FROM mst_supplier_items a,mst_items b WHERE a.supplier_id='".$id."' AND a.items_id=b.items_id")->num_rows();
        return $query;
    }
    function get_supplier_id(){
        $query = $this->db->query("SELECT IFNULL(MAX(supplier_id)+1,1) supplier_id FROM mst_supplier")->row();
        return $query;
    }
    function get_nomor_dok($tahun){
        $query = $this->db->query("SELECT IFNULL(LPAD(MAX(SUBSTRING(supplier_code,7,5))+1,5,'0'),'00001') nomor_dok FROM mst_supplier WHERE SUBSTR(supplier_code,3,4)='".$tahun."'")->row();
        return $query;
    }
}   