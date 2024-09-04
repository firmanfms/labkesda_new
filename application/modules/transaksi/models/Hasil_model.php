<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    // 08-09-2023
    // ALTER TABLE `db_labkesda_lab`.`t_pendaftaran_detail` ADD COLUMN `nama_analis` VARCHAR(100) NULL AFTER `kadar`;
    // ALTER TABLE `db_labkesda_lab`.`t_mutu_internal` ADD COLUMN `metode_analisa` VARCHAR(150) NULL AFTER `kd_sampel`;
class Hasil_model extends CI_Model
{
    function update_sudah_cetak($nomor){
        $sql ="UPDATE t_pendaftaran SET status_cetak='1' WHERE no_pendaftaran='".$nomor."' ";
        // echo $sql;
        $query = $this->db->query($sql);
        return $this->db->affected_rows();
    }
    function get_all()
    {
        $sql ='SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,
                a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input
                FROM t_pendaftaran20191121 a 
                LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
                LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
                LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
                WHERE a.status="1"
                ORDER BY a.tgl_input DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }
    function get_all_klinik()
    {
        $sql ='SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,
        a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,REPLACE(a.no_pendaftaran,"/","-") nopendaftar,e.status_approve
        ,MAX(e.urutan_pengujian) max_urutan,
        (SELECT status_approve FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran) status_approve_query,
        IFNULL((SELECT COUNT(nilai) AS nilai_jumlah FROM t_pendaftaran_detail WHERE nilai<>"" AND no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran),0) jumlah_nilai,
        (SELECT COUNT(nilai) AS nilai_jumlah FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran) jumlah_detail
        FROM t_pendaftaran a 
        LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
        LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
        LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
        LEFT JOIN t_pendaftaran_detail e ON a.no_pendaftaran = e.no_pendaftaran
        WHERE a.status="1" AND a.kd_lab="LK" 
        GROUP BY a.no_pendaftaran
        ORDER BY a.tgl_input DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }
    function get_all_klinik_tahun($tahun)
    {
        $sql ='SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,
        a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,REPLACE(a.no_pendaftaran,"/","-") nopendaftar,e.status_approve
        ,MAX(e.urutan_pengujian) max_urutan,
        (SELECT status_approve FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran) status_approve_query,
        IFNULL((SELECT COUNT(nilai) AS nilai_jumlah FROM t_pendaftaran_detail WHERE nilai<>"" AND no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran),0) jumlah_nilai,
        (SELECT COUNT(nilai) AS nilai_jumlah FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran) jumlah_detail
        , ifnull(status_cetak,0) status_cetak
        FROM t_pendaftaran a 
        LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
        LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
        LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
        LEFT JOIN t_pendaftaran_detail e ON a.no_pendaftaran = e.no_pendaftaran
        WHERE a.status="1" AND a.kd_lab="LK" AND YEAR(a.tgl_diterima) = "'.$tahun.'"
        GROUP BY a.no_pendaftaran
        ORDER BY a.tgl_input DESC';
        $query = $this->db->query($sql);
        // print_r($query->result());exit();
        return $query->result();
    }
    function get_all_klinik_tahun_status($tahun , $status_cetak)
    {
        $sql ='SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,
        a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,REPLACE(a.no_pendaftaran,"/","-") nopendaftar,e.status_approve
        ,MAX(e.urutan_pengujian) max_urutan,
        (SELECT status_approve FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran) status_approve_query,
        IFNULL((SELECT COUNT(nilai) AS nilai_jumlah FROM t_pendaftaran_detail WHERE nilai<>"" AND no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran),0) jumlah_nilai,
        (SELECT COUNT(nilai) AS nilai_jumlah FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran) jumlah_detail
        , ifnull(status_cetak,0) status_cetak
        FROM t_pendaftaran a 
        LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
        LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
        LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
        LEFT JOIN t_pendaftaran_detail e ON a.no_pendaftaran = e.no_pendaftaran
        WHERE a.status="1" AND a.kd_lab="LK" AND YEAR(a.tgl_diterima) = "'.$tahun.'" AND ifnull(status_cetak ,0) = "'.$status_cetak.'"
        GROUP BY a.no_pendaftaran
        ORDER BY a.tgl_input DESC';
        $query = $this->db->query($sql);
        // print_r($query->result());exit();
        return $query->result();
    }
    function get_all_lingkungan()
    {
        $sql ='SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,
        a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,REPLACE(a.no_pendaftaran,"/","-") nopendaftar,e.status_approve
        ,MAX(e.urutan_pengujian) max_urutan,
        (SELECT status_approve FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran) status_approve_query,
        IFNULL((SELECT COUNT(nilai) AS nilai_jumlah FROM t_pendaftaran_detail WHERE nilai<>"" AND no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran),0) jumlah_nilai,
        (SELECT COUNT(nilai) AS nilai_jumlah FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran) jumlah_detail
        FROM t_pendaftaran a 
        LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
        LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
        LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
        LEFT JOIN t_pendaftaran_detail e ON a.no_pendaftaran = e.no_pendaftaran
        WHERE a.status="1" AND a.kd_lab="LL" 
        GROUP BY a.no_pendaftaran
        ORDER BY a.tgl_input DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }
    function get_all_lingkungan_tahun($tahun){
        $sql ='SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,
        a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,REPLACE(a.no_pendaftaran,"/","-") nopendaftar,e.status_approve
        ,MAX(e.urutan_pengujian) max_urutan,
        (SELECT status_approve FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran) status_approve_query,
        IFNULL((SELECT COUNT(nilai) AS nilai_jumlah FROM t_pendaftaran_detail WHERE nilai<>"" AND no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran),0) jumlah_nilai,
        (SELECT COUNT(nilai) AS nilai_jumlah FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran) jumlah_detail
        FROM t_pendaftaran a 
        LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
        LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
        LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
        LEFT JOIN t_pendaftaran_detail e ON a.no_pendaftaran = e.no_pendaftaran
        WHERE a.status="1" AND a.kd_lab="LL" AND YEAR(a.tgl_diterima) = "'.$tahun.'"
        GROUP BY a.no_pendaftaran
        ORDER BY a.tgl_input DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }
    function get_all_lingkungan_tahun_status($tahun,$status_cetak){
        $sql ='SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,
        a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,REPLACE(a.no_pendaftaran,"/","-") nopendaftar,e.status_approve
        ,MAX(e.urutan_pengujian) max_urutan,
        (SELECT status_approve FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran) status_approve_query,
        IFNULL((SELECT COUNT(nilai) AS nilai_jumlah FROM t_pendaftaran_detail WHERE nilai<>"" AND no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran),0) jumlah_nilai,
        (SELECT COUNT(nilai) AS nilai_jumlah FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran) jumlah_detail
        , ifnull(status_cetak,0) status_cetak
        FROM t_pendaftaran a 
        LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
        LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
        LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
        LEFT JOIN t_pendaftaran_detail e ON a.no_pendaftaran = e.no_pendaftaran
        WHERE a.status="1" AND a.kd_lab="LL" AND YEAR(a.tgl_diterima) = "'.$tahun.'" AND ifnull(status_cetak ,0) = "'.$status_cetak.'"
        GROUP BY a.no_pendaftaran
        ORDER BY a.tgl_input DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }
    function get_all_maknum(){
        $sql ='SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,
        a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,REPLACE(a.no_pendaftaran,"/","-") nopendaftar,e.status_approve
        ,MAX(e.urutan_pengujian) max_urutan,
        (SELECT status_approve FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran) status_approve_query,
        IFNULL((SELECT COUNT(nilai) AS nilai_jumlah FROM t_pendaftaran_detail WHERE nilai<>"" AND no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran),0) jumlah_nilai,
        (SELECT COUNT(nilai) AS nilai_jumlah FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran) jumlah_detail
        FROM t_pendaftaran a 
        LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
        LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
        LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
        LEFT JOIN t_pendaftaran_detail e ON a.no_pendaftaran = e.no_pendaftaran
        WHERE a.status="1" AND a.kd_lab="LM" 
        GROUP BY a.no_pendaftaran
        ORDER BY a.tgl_input DESC';
        $query = $this->db->query($sql);
        return $query->result();
        // $sql ='SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,
        // a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,REPLACE(a.no_pendaftaran,"/","-") nopendaftar,e.status_approve
        // ,MAX(e.urutan_pengujian) max_urutan,
        // (SELECT count(nilai) nilai FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY nilai) nilai_jumlah,
        // (SELECT status_approve FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran) status_approve_query
        // FROM t_pendaftaran a 
        // LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
        // LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
        // LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
        // LEFT JOIN t_pendaftaran_detail e ON a.no_pendaftaran = e.no_pendaftaran
        // WHERE a.status="1" AND a.kd_lab="LM" 
        // GROUP BY a.no_pendaftaran
        // ORDER BY a.tgl_input DESC';
        // $query = $this->db->query($sql);
        // return $query->result();
    }
    function get_all_maknum_tahun($tahun){
        $sql ='SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,
        a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,REPLACE(a.no_pendaftaran,"/","-") nopendaftar,e.status_approve
        ,MAX(e.urutan_pengujian) max_urutan,
        (SELECT status_approve FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran) status_approve_query,
        IFNULL((SELECT COUNT(nilai) AS nilai_jumlah FROM t_pendaftaran_detail WHERE nilai<>"" AND no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran),0) jumlah_nilai,
        (SELECT COUNT(nilai) AS nilai_jumlah FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran) jumlah_detail
        FROM t_pendaftaran a 
        LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
        LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
        LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
        LEFT JOIN t_pendaftaran_detail e ON a.no_pendaftaran = e.no_pendaftaran
        WHERE a.status="1" AND a.kd_lab="LM" AND YEAR(a.tgl_diterima) = "'.$tahun.'"
        GROUP BY a.no_pendaftaran
        ORDER BY a.tgl_input DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }
    function get_all_maknum_tahun_status($tahun,$status_cetak){
        $sql ='SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,
        a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,REPLACE(a.no_pendaftaran,"/","-") nopendaftar,e.status_approve
        ,MAX(e.urutan_pengujian) max_urutan,
        (SELECT status_approve FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran) status_approve_query,
        IFNULL((SELECT COUNT(nilai) AS nilai_jumlah FROM t_pendaftaran_detail WHERE nilai<>"" AND no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran),0) jumlah_nilai,
        (SELECT COUNT(nilai) AS nilai_jumlah FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND urutan_pengujian=MAX(e.urutan_pengujian) GROUP BY no_pendaftaran) jumlah_detail,
        ifnull(a.status_cetak,0) status_cetak
        FROM t_pendaftaran a 
        LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
        LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
        LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
        LEFT JOIN t_pendaftaran_detail e ON a.no_pendaftaran = e.no_pendaftaran
        WHERE a.status="1" AND a.kd_lab="LM" AND YEAR(a.tgl_diterima) = "'.$tahun.'" AND ifnull(a.status_cetak ,0) = "'.$status_cetak.'"
        GROUP BY a.no_pendaftaran
        ORDER BY a.tgl_input DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }
    function get_all_masuk(){
        $sql ='SELECT a.id_mutasi,a.no_mutasi,a.tgl,a.keterangan,a.id_lokasi,a.approve_mutasi,b.lokasi FROM t_mutasi a LEFT JOIN m_lokasi b
                ON a.id_lokasi=b.id_lokasi where a.status_mutasi="1" ORDER BY a.id_mutasi DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }
    function max_nomor($kd_lab,$m,$y){
        $query = $this->db->query("SELECT IFNULL(LPAD(MAX(SUBSTRING(no_pendaftaran,12,5))+1,5,'0'),'00001') nomor FROM t_pendaftaran WHERE kd_lab='".$kd_lab."' 
                                    AND MONTH(tgl_input)='".$m."' AND YEAR(tgl_input)='".$y."'")->row();
        return $query;
    }
    function header_hasil($id){
        $query      = $this->db->query("SELECT a.*,b.nm_sampel,b.keterangan sampel_ket FROM t_pendaftaran a LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel 
                                        WHERE a.no_pendaftaran='".$id."'")->row();
        return $query;
    }
    function detail_hasil($id){
        $query      = $this->db->query("SELECT a.*,b.*,c.nm_kategori_parameter FROM t_pendaftaran_detail a LEFT JOIN m_parameter b ON a.kd_parameter=b.kd_parameter
                                        LEFT JOIN m_kategori_parameter c ON a.kd_kategori_parameter=c.kd_kategori_parameter WHERE a.no_pendaftaran='".$id."'")->Result();
        return $query;
    }
    function detail_hasil_new($id,$urut){
        //merubah nilai dari semual a.kadar menjadi b,kadar
        $query      = $this->db->query("SELECT a.*,a.metode_analisa hasil_analisa,b.nm_parameter,b.satuan,b.kadar,c.nm_kategori_parameter,
                                        b.metode_analisa,b.metode_analisa2,b.metode_analisa3,b.metode_analisa4,b.metode_analisa5,a.nama_analis,
                                        IFNULL(b.nilai_min,0)nilai_min,IFNULL(b.nilai_max,0)nilai_max
                                        FROM t_pendaftaran_detail a 
                                        LEFT JOIN m_parameter b ON a.kd_parameter=b.kd_parameter
                                        LEFT JOIN m_kategori_parameter c ON a.kd_kategori_parameter=c.kd_kategori_parameter WHERE a.no_pendaftaran='".$id."' AND a.urutan_pengujian='".$urut."'  ORDER BY c.`zorder` asc,b.`zorder` asc ")->Result();
                                        // test("SELECT a.*,b.*,c.nm_kategori_parameter FROM t_pendaftaran_detail a LEFT JOIN m_parameter b ON a.kd_parameter=b.kd_parameter
                                        // LEFT JOIN m_kategori_parameter c ON a.kd_kategori_parameter=c.kd_kategori_parameter WHERE a.no_pendaftaran='".$id."' AND a.urutan_pengujian='".$urut."'",0);
        // echo $this->db->last_query();
        return $query;
    }
    function detail_hasil_klinik($id,$urut){
        $query      = $this->db->query("SELECT a.*,a.metode_analisa hasil_analisa,b.nm_parameter,b.satuan,b1.nilai_maksimum as kadar,c.nm_kategori_parameter,
                                        b.metode_analisa,b.metode_analisa2,b.metode_analisa3,b.metode_analisa4,b.metode_analisa5,a.nama_analis,
                                        IFNULL(b1.nilai_minimum,0)nilai_min,IFNULL(b1.nilai_maksimum,0)nilai_max,b1.deskripsi_kadar , a.kadar as kadar2
                                        FROM t_pendaftaran_detail a 
                                        LEFT JOIN m_parameter b ON a.kd_parameter=b.kd_parameter
                                        LEFT JOIN m_kadar b1 ON b1.`id_kadar`=a.`kadar`
                                        LEFT JOIN m_kategori_parameter c ON a.kd_kategori_parameter=c.kd_kategori_parameter WHERE a.no_pendaftaran='".$id."' AND a.urutan_pengujian='".$urut."'  ORDER BY c.`zorder` asc,b.`zorder` asc ")->Result();
            //  echo $this->db->last_query(); exit();
                                        // test("SELECT a.*,b.*,c.nm_kategori_parameter FROM t_pendaftaran_detail a LEFT JOIN m_parameter b ON a.kd_parameter=b.kd_parameter
                                        // LEFT JOIN m_kategori_parameter c ON a.kd_kategori_parameter=c.kd_kategori_parameter WHERE a.no_pendaftaran='".$id."' AND a.urutan_pengujian='".$urut."'",0);
        return $query;
    }
      function detail_hasil_klinik_urutsebelumnya($id,$urut){
        $query      = $this->db->query("SELECT a.*,a.metode_analisa hasil_analisa,b.nm_parameter,b.satuan,b1.nilai_maksimum as kadar,c.nm_kategori_parameter,
                                        b.metode_analisa,b.metode_analisa2,b.metode_analisa3,b.metode_analisa4,b.metode_analisa5,a.nama_analis,
                                        IFNULL(b1.nilai_minimum,0)nilai_min,IFNULL(b1.nilai_maksimum,0)nilai_max,b1.deskripsi_kadar , a.kadar as kadar2
                                        FROM t_pendaftaran_detail a 
                                        LEFT JOIN m_parameter b ON a.kd_parameter=b.kd_parameter
                                        LEFT JOIN m_kadar b1 ON b1.`id_kadar`=a.`kadar`
                                        LEFT JOIN m_kategori_parameter c ON a.kd_kategori_parameter=c.kd_kategori_parameter WHERE a.no_pendaftaran='".$id."' AND a.urutan_pengujian='".$urut."'  ORDER BY c.`zorder` asc,b.`zorder` asc ")->Result();
             echo $this->db->last_query(); exit();
                                        // test("SELECT a.*,b.*,c.nm_kategori_parameter FROM t_pendaftaran_detail a LEFT JOIN m_parameter b ON a.kd_parameter=b.kd_parameter
                                        // LEFT JOIN m_kategori_parameter c ON a.kd_kategori_parameter=c.kd_kategori_parameter WHERE a.no_pendaftaran='".$id."' AND a.urutan_pengujian='".$urut."'",0);
        return $query;
    }
    function detail_hasil_new_maknum($id,$urut){
        $query      = $this->db->query("SELECT a.*,a.metode_analisa hasil_analisa,b.nm_parameter,b.satuan,b.kadar m_kadar,c.nm_kategori_parameter,
                                        b.metode_analisa,b.metode_analisa2,b.metode_analisa3,b.metode_analisa4,b.metode_analisa5,
                                        IFNULL(b.nilai_min,0)nilai_min,IFNULL(b.nilai_max,0)nilai_max
                                        FROM t_pendaftaran_detail a 
                                        LEFT JOIN m_parameter b ON a.kd_parameter=b.kd_parameter
                                        LEFT JOIN m_kategori_parameter c ON a.kd_kategori_parameter=c.kd_kategori_parameter 
                                        WHERE a.no_pendaftaran='".$id."' AND a.urutan_pengujian='".$urut."'   
                                        ORDER BY c.`zorder` asc,b.`zorder` asc ")->Result();
                                        // test("SELECT a.*,b.*,c.nm_kategori_parameter FROM t_pendaftaran_detail a LEFT JOIN m_parameter b ON a.kd_parameter=b.kd_parameter
                                        // LEFT JOIN m_kategori_parameter c ON a.kd_kategori_parameter=c.kd_kategori_parameter WHERE a.no_pendaftaran='".$id."' AND a.urutan_pengujian='".$urut."'",0);
        return $query;
    }
    function detail_hasil_par($id){
        $query      = $this->db->query("SELECT a.*,b.nm_parameter,c.nm_kategori_parameter,a.nama_analis,IFNULL(b.nilai_min,0)nilai_min,
                                        IFNULL(b.nilai_max,0)nilai_max , b.kadar as kadar_param  FROM t_pendaftaran_detail a 
                                        LEFT JOIN m_parameter b ON a.kd_parameter=b.kd_parameter
                                        LEFT JOIN m_kategori_parameter c ON a.kd_kategori_parameter=c.kd_kategori_parameter WHERE a.no_pendaftaran='".$id."' GROUP BY a.kd_kategori_parameter 
										order by c.zorder asc")->Result();
        // echo $this->db->last_query();
        return $query;
    }
    function detail_hasil_par_mikro($id){
        $query      = $this->db->query("SELECT a.*,b.nm_parameter,c.nm_kategori_parameter FROM t_pendaftaran_detail a LEFT JOIN m_parameter b ON a.kd_parameter=b.kd_parameter
                                        LEFT JOIN m_kategori_parameter c ON a.kd_kategori_parameter=c.kd_kategori_parameter WHERE a.no_pendaftaran='".$id."' 
                                        AND c.kd_kategori_parameter IN (17,32) GROUP BY a.kd_kategori_parameter")->Result();
        return $query;
    }
    function update_lingkungan_act(){
        $no      = $this->security->xss_clean($this->db->escape_str($this->input->post('no')));
        for ($x = 1; $x <= $no; $x++) {
            $no_pendaftaran     = $this->security->xss_clean($this->db->escape_str($this->input->post('no_pendaftaran')[$x]));
            $kd_parameter       = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_parameter')[$x]));
            $ket                = $this->security->xss_clean($this->db->escape_str($this->input->post('keterangan')[$x]));
            $hasil              = $this->security->xss_clean($this->db->escape_str($this->input->post('hasil')[$x]));
            $metode_analisa     = $this->security->xss_clean($this->db->escape_str($this->input->post('metode_analisa')[$x]));
            $nama_analis        = $this->security->xss_clean($this->db->escape_str($this->input->post('nama_analis')[$x]));
            $detail_id      = $this->security->xss_clean($this->db->escape_str($this->input->post('detail_id')[$x]));
            $kd_parameter_old= $this->security->xss_clean($this->db->escape_str($this->input->post('kd_parameter_old')[$x]));
            $this->db->query("UPDATE t_pendaftaran_detail SET nilai = '".$hasil."',ket = '".$ket."',metode_analisa = '".$metode_analisa."',
                           nama_analis = '".$nama_analis."', kd_parameter = '".$kd_parameter."'
            WHERE detail_id = '".$detail_id."' ");
            // $this->db->query("UPDATE t_pendaftaran_detail SET nilai = '".$hasil."',ket = '".$ket."',metode_analisa = '".$metode_analisa."',
            //         nama_analis = '".$nama_analis."' 
            //         WHERE no_pendaftaran = '".$no_pendaftaran."' AND kd_parameter = '".$kd_parameter."'");
        }
    }
    function update_maknum_act(){
        $no      = $this->security->xss_clean($this->db->escape_str($this->input->post('no')));
        // test($no,1);
        for ($x = 1; $x <= $no; $x++) {
            $no_pendaftaran = $this->security->xss_clean($this->db->escape_str($this->input->post('no_pendaftaran')[$x]));
            $kd_parameter   = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_parameter')[$x]));
            $ket            = $this->security->xss_clean($this->db->escape_str($this->input->post('keterangan')[$x]));
            $hasil          = $this->security->xss_clean($this->db->escape_str($this->input->post('hasil')[$x]));
            $nama_analis    = $this->security->xss_clean($this->db->escape_str($this->input->post('nama_analis')[$x]));
            $metode_analisa      = $this->input->post('metode_analisa')[$x];
            $kadar      = $this->input->post('kadar')[$x];
            $detail_id      = $this->security->xss_clean($this->db->escape_str($this->input->post('detail_id')[$x]));
            $kd_parameter_old= $this->security->xss_clean($this->db->escape_str($this->input->post('kd_parameter_old')[$x]));
            $this->db->query("UPDATE t_pendaftaran_detail SET nilai = '".$hasil."',ket = '".$ket."',metode_analisa = '".$metode_analisa."',
                            kadar = '".$kadar."',nama_analis = '".$nama_analis."', kd_parameter = '".$kd_parameter."'
            WHERE detail_id = '".$detail_id."' ");
            // $this->db->query("UPDATE t_pendaftaran_detail SET nilai = '".$hasil."',ket = '".$ket."',metode_analisa = '".$metode_analisa."',kadar = '".$kadar."', nama_analis = '".$nama_analis."' WHERE no_pendaftaran = '".$no_pendaftaran."' AND kd_parameter = '".$kd_parameter."'");
        }
    }
    function update_klinik_act(){
        $no      = $this->security->xss_clean($this->db->escape_str($this->input->post('no')));
        // test($no,1);
        // for ($x = 1; $x <= $no; $x++) {
        // }
        for ($x = 1; $x <= $no; $x++) {
            if($this->input->post('metode_analisa')[$x]){
                $metode_analisa      = $this->input->post('metode_analisa')[$x];    
            }else{
                $metode_analisa      = '';
            }
            $no_pendaftaran = $this->security->xss_clean($this->db->escape_str($this->input->post('no_pendaftaran')[$x]));
            $kd_parameter   = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_parameter')[$x]));
            $ket            = $this->security->xss_clean($this->db->escape_str($this->input->post('keterangan')[$x]));
            $hasil          = $this->security->xss_clean($this->db->escape_str($this->input->post('hasil')[$x]));
            $nama_analis    = $this->security->xss_clean($this->db->escape_str($this->input->post('nama_analis')[$x]));
            $detail_id      = $this->security->xss_clean($this->db->escape_str($this->input->post('detail_id')[$x]));
            $id_kadar      = $this->security->xss_clean($this->db->escape_str($this->input->post('id_kadar')[$x]));
            $kd_parameter_old= $this->security->xss_clean($this->db->escape_str($this->input->post('kd_parameter_old')[$x]));
            $this->db->query("UPDATE t_pendaftaran_detail SET nilai = '".$hasil."',ket = '".$ket."',metode_analisa = '".$metode_analisa."',
                            nama_analis = '".$nama_analis."', kd_parameter = '".$kd_parameter."', kadar = '".$id_kadar."'
            WHERE detail_id = '".$detail_id."' ");
        }
    }
    function insert_klinik_act(){
        $no      = $this->security->xss_clean($this->db->escape_str($this->input->post('no')));
        $urut    = $this->security->xss_clean($this->db->escape_str($this->input->post('urut')));
        // test($no,1);
        pre($this->input->post());
        for ($x = 1; $x <= $no; $x++) {
            $no_pendaftaran = $this->security->xss_clean($this->db->escape_str($this->input->post('no_pendaftaran')[$x]));
            $kd_parameter   = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_parameter')[$x]));
            $cek_data       = $this->db->query("SELECT * FROM t_pendaftaran_detail WHERE no_pendaftaran='".$no_pendaftaran."' AND kd_parameter='".$kd_parameter."'")->row();
            $kd_kategori_parameter     = $cek_data->kd_kategori_parameter;
            $ket        = $cek_data->ket;
            $urutan     = $urut+1;
            $ket            = $this->security->xss_clean($this->db->escape_str($this->input->post('keterangan')[$x]));
            $hasil          = $this->security->xss_clean($this->db->escape_str($this->input->post('hasil')[$x]));
            $metode_analisa = $this->security->xss_clean($this->db->escape_str($this->input->post('metode_analisa')[$x]));
            $kadar          = '';
                $m_parameter                = $this->db->query("SELECT kd_kategori_parameter,harga FROM m_parameter WHERE kd_parameter='".$kd_parameter ."'")->row();
                // $kd_kategori_parameter      = $m_parameter->kd_kategori_parameter;
                $harga                      = $m_parameter->harga;
            if($this->input->post('id_kadar')[$x]){
                $kadar          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_kadar')[$x]));
            }
            $nama_analis    = $this->security->xss_clean($this->db->escape_str($this->input->post('nama_analis')[$x]));
            $this->db->query("INSERT INTO t_pendaftaran_detail (no_pendaftaran,kd_parameter,nilai,nilai2,kd_kategori_parameter,ket,status_approve,urutan_pengujian,metode_analisa,kadar,nama_analis , harga )
            VALUES('".$no_pendaftaran."','".$kd_parameter."','".$hasil."','','".$kd_kategori_parameter."','".$ket."','1','".$urutan."','".$metode_analisa."','".$kadar."','".$nama_analis."'  ,'".$harga."'  )");
            // echo $this->db->last_query();
            // exit();
        }
    }
    function get_all_lab($tanggal)
    {
        $sql ='SELECT a.no_pendaftaran,a.kd_parameter,b.`nm_parameter`,c.`tgl_input` FROM t_pendaftaran_detail a 
        LEFT JOIN m_parameter b ON b.`kd_parameter`=a.`kd_parameter`
        LEFT JOIN t_pendaftaran c ON a.`no_pendaftaran`=c.`no_pendaftaran`
        WHERE tgl_input LIKE "'.$tanggal.'%"
        GROUP BY a.`no_pendaftaran`,a.`kd_parameter`
        ORDER BY a.`kd_parameter` ASC';
        // test($sql,1);
        $query = $this->db->query($sql);
        return $query->result();
    }
    function get_all_lab_new($tanggal,$kd_lab,$nomor)
    {
        $sql ='SELECT a.no_pendaftaran,a.kd_parameter,b.`nm_parameter`,c.`tgl_input` FROM t_pendaftaran_detail a 
        LEFT JOIN m_parameter b ON b.`kd_parameter`=a.`kd_parameter`
        LEFT JOIN t_pendaftaran c ON a.`no_pendaftaran`=c.`no_pendaftaran`
        WHERE c.tgl_input LIKE "'.$tanggal.'%" ';
        if($kd_lab!=''){
            $sql .= 'AND c.kd_lab="'.$kd_lab.'"';
        }
		else if ($nomor!=''){
            $sql .= 'AND a.no_pendaftaran="'.$nomor.'"';
        }
        $sql .= 'GROUP BY a.`no_pendaftaran`,a.`kd_parameter`
        ORDER BY a.`kd_parameter` ASC';
        // test($sql,1);
        $query = $this->db->query($sql);
        return $query->result();
    }
    function get_all_lab_new_tanpa_tanggal( $kd_lab,$nomor)
    {
        $sql ='SELECT a.no_pendaftaran,a.kd_parameter,b.`nm_parameter`,c.`tgl_input` FROM t_pendaftaran_detail a 
        LEFT JOIN m_parameter b ON b.`kd_parameter`=a.`kd_parameter`
        LEFT JOIN t_pendaftaran c ON a.`no_pendaftaran`=c.`no_pendaftaran`
        WHERE
        1=1 ';  
        // -- c.tgl_input LIKE "'.$tanggal.'%" ';
        if($kd_lab!=''){
            $sql .= 'AND c.kd_lab="'.$kd_lab.'"';
        }
		else if ($nomor!=''){
            $sql .= 'AND a.no_pendaftaran="'.$nomor.'"';
        }
        $sql .= 'GROUP BY a.`no_pendaftaran`,a.`kd_parameter`
        ORDER BY a.`kd_parameter` ASC';
        // test($sql,1);
        $query = $this->db->query($sql);
        return $query->result();
    }
    function mutu_internal_view(){
        return $this->db->query("SELECT b.`nm_parameter`,c.`nm_sampel`,a.* FROM t_mutu_internal a 
        LEFT JOIN m_parameter b ON a.`kd_parameter`=b.`kd_parameter`
        LEFT JOIN m_sampel c ON a.`kd_sampel`=c.`kd_sampel`
        WHERE a.aktif='Y' ORDER BY a.id_mutu_internal DESC")->result();
    }
    function act_pemantauan(){
        $list         = $this->input->post('no_pendaftaran');
        // test($list,1);
        foreach ($list as $key => $value) {
            $no_pendaftaran     = $value;
            $kd_sampel          = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_sampel')[$key]));
            $metode_analisa     = $this->security->xss_clean($this->db->escape_str($this->input->post('metode_analisa')[$key]));
            $kd_parameter       = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_parameter')[$key]));
            $rpd                = $this->security->xss_clean($this->db->escape_str($this->input->post('rpd')[$key]));
            $p1                 = $this->security->xss_clean($this->db->escape_str($this->input->post('p1')[$key]));
            $p2                 = $this->security->xss_clean($this->db->escape_str($this->input->post('p2')[$key]));
            $blanko             = $this->security->xss_clean($this->db->escape_str($this->input->post('blanko')[$key]));
            $rec                = $this->security->xss_clean($this->db->escape_str($this->input->post('rec')[$key]));
            $crm                = $this->security->xss_clean($this->db->escape_str($this->input->post('crm')[$key]));
            $save               = $this->db->query("INSERT INTO db_labkesda_lab.t_mutu_internal (no_pendaftaran,kd_parameter,kd_sampel,metode_analisa,tgl_input,rpd,p1,p2,blanko,rec,crm,input_time,input_pic,aktif)VALUES
            ('".$no_pendaftaran."','".$kd_parameter."','".$kd_sampel."','".$metode_analisa."','".dbnow(false)."','".$rpd."','".$p1."','".$p2."','".$blanko."','".$rec."','".$crm."','".dbnow()."','".$this->current_user['id_username']."','Y')");
        }
    }
    function act_delete_pemantauan(){
        $id_mutu_internal = $this->input->post('id_mutu_internal');
        $this->db->query("UPDATE `t_mutu_internal` SET `aktif` = 'N' WHERE `id_mutu_internal` = '".$id_mutu_internal."'");
    }
    function mutu_internal_detail($id){
        return $this->db->query("SELECT b.`nm_parameter`,c.`nm_sampel`,a.* FROM t_mutu_internal a 
        LEFT JOIN m_parameter b ON a.`kd_parameter`=b.`kd_parameter`
        LEFT JOIN m_sampel c ON a.`kd_sampel`=c.`kd_sampel`
        WHERE a.aktif='Y' AND a.id_mutu_internal='".$id."' ORDER BY a.id_mutu_internal DESC")->result_array();
    }
    function act_pemantauan_update(){
        $list         = $this->input->post('no_pendaftaran');
        // test($list,1);
        // foreach ($list as $key => $value) {
            $id_mutu_internal   = $this->security->xss_clean($this->db->escape_str($this->input->post('id_mutu_internal')));
            $rpd                = $this->security->xss_clean($this->db->escape_str($this->input->post('rpd')));
            $p1                 = $this->security->xss_clean($this->db->escape_str($this->input->post('p1')));
            $p2                 = $this->security->xss_clean($this->db->escape_str($this->input->post('p2')));
            $blanko             = $this->security->xss_clean($this->db->escape_str($this->input->post('blanko')));
            $rec                = $this->security->xss_clean($this->db->escape_str($this->input->post('rec')));
            $crm                = $this->security->xss_clean($this->db->escape_str($this->input->post('crm')));
            $save               = $this->db->query("UPDATE t_mutu_internal SET
                                  rpd = '".$rpd."',
                                  p1 = '".$p1."',
                                  p2 = '".$p2."',
                                  blanko = '".$blanko."',
                                  rec = '".$rec."',
                                  crm = '".$crm."',
                                  edit_time = '".dbnow()."',
                                  edit_pic = '".$this->current_user['id_username']."'
                                WHERE id_mutu_internal = '".$id_mutu_internal."'");
        // }
    }
}   