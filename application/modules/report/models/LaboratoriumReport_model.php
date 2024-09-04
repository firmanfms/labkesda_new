<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    // 08-09-2023
    // ALTER TABLE `db_labkesda_lab`.`t_pendaftaran_detail` ADD COLUMN `nama_analis` VARCHAR(100) NULL AFTER `kadar`;
    // ALTER TABLE `db_labkesda_lab`.`t_mutu_internal` ADD COLUMN `metode_analisa` VARCHAR(150) NULL AFTER `kd_sampel`;
class LaboratoriumReport_model extends CI_Model
{
    function data_kunjungan($tahun,$bulan){
        $data   = $this->db->query("SELECT a.kd_lab,a.lab,COUNT(b.no_pendaftaran) jml_header,
                (SELECT COUNT(c1.kd_parameter) jml_detail FROM t_pendaftaran b1 LEFT JOIN t_pendaftaran_detail c1 
                ON b1.no_pendaftaran=c1.no_pendaftaran WHERE MONTH(b1.tgl_diterima)='".$bulan."' AND YEAR(b1.tgl_diterima)='".$tahun."' AND b1.status='1'
                AND a.kd_lab=b1.kd_lab GROUP BY b1.kd_lab) jml_detail
                FROM m_lab a
                LEFT JOIN t_pendaftaran b ON b.kd_lab=a.kd_lab
                WHERE a.aktif='Y' AND MONTH(b.tgl_diterima)='".$bulan."' AND YEAR(b.tgl_diterima)='".$tahun."' AND b.status='1'
                GROUP BY a.kd_lab;")->result();
        return $data;
    }
    function data_kunjungan_tanggal($dari,$sampai){
        // $data   = $this->db->query("SELECT a.kd_lab,a.lab,COUNT(b.no_pendaftaran) jml_header,
        //         (SELECT COUNT(c1.kd_parameter) jml_detail FROM t_pendaftaran b1 LEFT JOIN t_pendaftaran_detail c1 
        //         ON b1.no_pendaftaran=c1.no_pendaftaran WHERE b1.tgl_diterima BETWEEN '".$dari."' AND '".$sampai."' AND b1.status='1'
        //         AND a.kd_lab=b1.kd_lab GROUP BY b1.kd_lab) jml_detail
        //         FROM m_lab a
        //         LEFT JOIN t_pendaftaran b ON b.kd_lab=a.kd_lab
        //         WHERE a.aktif='Y' AND b.tgl_diterima BETWEEN '".$dari."' AND '".$sampai."' AND b.status='1'
        //         GROUP BY a.kd_lab;")->result();
        $sql =" SELECT a.kd_lab,a.lab,COUNT(b.no_pendaftaran) jml_header,
                 (SELECT COUNT(c1.kd_parameter) jml_detail FROM t_pendaftaran b1 LEFT JOIN t_pendaftaran_detail c1 
                 ON b1.no_pendaftaran=c1.no_pendaftaran WHERE b1.tgl_diterima BETWEEN '".$dari." 00:00:00' AND '".$sampai." 23:59:59' AND b1.status='1'
                 AND a.kd_lab=b1.kd_lab GROUP BY b1.kd_lab) jml_detail
                 FROM m_lab a
                 LEFT JOIN t_pendaftaran b ON b.kd_lab=a.kd_lab
                 WHERE a.aktif='Y' AND b.tgl_diterima BETWEEN '".$dari." 00:00:00' AND '".$sampai." 23:59:59' AND b.status='1'
                 GROUP BY a.kd_lab;";
                $data = $this->db->query($sql)->result();
                // pre($data);
        return $data;
    }
    function data_kunjungan_perlab($lab,$tahun,$bulan){
        // $data   = $this->db->query("SELECT b.kd_lab,COUNT(c.kd_parameter) jml_detail,c.kd_parameter,
        //                             d.nm_parameter,b.kd_sampel,e.nm_sampel
        //                             FROM t_pendaftaran b 
        //                             LEFT JOIN t_pendaftaran_detail c ON b.no_pendaftaran=c.no_pendaftaran
        //                             LEFT JOIN m_parameter d ON d.kd_parameter=c.kd_parameter
        //                             LEFT JOIN m_sampel e ON e.kd_sampel=b.kd_sampel
        //                             WHERE MONTH(b.tgl_diterima)='".$bulan."' AND YEAR(b.tgl_diterima)='".$tahun."' AND b.status='1' AND b.kd_lab='".$lab."'
        //                             GROUP BY c.kd_parameter
        //                             ORDER BY e.nm_sampel")->result();
        $data   = $this->db->query("SELECT b.kd_lab,b.kd_sampel,d.kd_parameter,d.nm_parameter,e.kd_kategori_parameter,e.nm_kategori_parameter,
                            COUNT(c.kd_parameter) jml_detail
                            FROM t_pendaftaran b 
                            LEFT JOIN t_pendaftaran_detail c ON b.no_pendaftaran=c.no_pendaftaran
                            LEFT JOIN m_parameter d ON d.kd_parameter=c.kd_parameter
                            LEFT JOIN m_kategori_parameter e ON e.kd_kategori_parameter=d.kd_kategori_parameter
                            WHERE MONTH(b.tgl_diterima)='".$bulan."' AND YEAR(b.tgl_diterima)='".$tahun."' AND b.status='1' AND b.kd_lab='".$lab."'
                            GROUP BY c.kd_parameter
                            ORDER BY e.nm_kategori_parameter")->result();
        return $data;
    }
    function data_kunjungan_perlab_tgl($lab,$dari,$smp){
        $data   = $this->db->query("SELECT b.kd_lab,b.kd_sampel,d.kd_parameter,d.nm_parameter,e.kd_kategori_parameter,e.nm_kategori_parameter,
                            COUNT(c.kd_parameter) jml_detail
                            FROM t_pendaftaran b 
                            LEFT JOIN t_pendaftaran_detail c ON b.no_pendaftaran=c.no_pendaftaran
                            LEFT JOIN m_parameter d ON d.kd_parameter=c.kd_parameter
                            LEFT JOIN m_kategori_parameter e ON e.kd_kategori_parameter=d.kd_kategori_parameter
                            WHERE b.tgl_diterima BETWEEN '".$dari." 00:00:00' AND '".$smp." 23:59:59' AND b.status='1' AND b.kd_lab='".$lab."'
                            GROUP BY c.kd_parameter
                            ORDER BY e.nm_kategori_parameter")->result();
        return $data;
    }
}   