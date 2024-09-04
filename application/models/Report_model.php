<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_model extends CI_Model
{

    function jml_pendaftaran($tahun,$kd){
        return $this->db->query("SELECT COUNT(no_pendaftaran) jumlah FROM t_pendaftaran WHERE `status`='1' AND kd_lab='".$kd."' 
                                    AND YEAR(tgl_input)='".$tahun."'")->row()->jumlah;
    }

    function pendaftaran_pertahun($tahun1,$tahun2,$kd){
        return $this->db->query("SELECT COUNT(no_pendaftaran) jumlah,YEAR(tgl_input) tahun FROM t_pendaftaran WHERE `status`='1' AND kd_lab='".$kd."'
                                    AND YEAR(tgl_input) <= '".$tahun2."' AND YEAR(tgl_input) >= '".$tahun1."'
                                    GROUP BY YEAR(tgl_input)")->result();
    }

    function top_10_mutasi_keluar()
    {
        $sql = "SELECT c.nama AS `name`,SUM(a.qty) AS `y` FROM t_mutasi_detail a 
                JOIN t_mutasi b ON a.id_mutasi=b.id_mutasi
                JOIN m_barang c ON a.id_barang=c.id_barang
                WHERE b.approve_mutasi='1' AND b.tipe_mutasi='Keluar'
                GROUP BY a.id_barang
                ORDER BY c.nama LIMIT 10";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function last_stok(){
        $sql = "SELECT b.id_kat_barang,f.kategori as `name`,b.nama,SUM(a.qty) as `y`                    
                    FROM t_stok a
                    JOIN m_barang b ON a.id_barang=b.id_barang
                    JOIN m_lokasi c ON a.id_lokasi=c.id_lokasi
                    JOIN m_satuan d ON b.id_satuan=d.id_satuan 
                    LEFT JOIN m_lokasi_sub e ON e.id_sub_lokasi=a.id_sub_lokasi
                    LEFT JOIN m_kat_barang f ON f.id_kat_barang=b.id_kat_barang
                    WHERE a.qty <> 0 ";
        // if($id_lokasi!=''){
        //     $sql .=" AND a.id_lokasi='".$id_lokasi."' ";
        // }

        $sql    .= " GROUP BY b.id_kat_barang,f.kategori,b.nama ";
        $sql    .= " HAVING SUM(a.qty)<>0 ";
        $sql    .= " Order by b.nama ";
        return $this->db->query($sql)->result();

    }

    function last_stok_expired($id){
        $tgl_untuk_3_bulan      = date('Y-m-d', strtotime('+3 month', strtotime(dbnow(false))));
        $sql = "SELECT a.id_barang,a.tgl_transaksi,a.no_mutasi,a.tipe_mutasi,a.lot_no,a.tgl_kadaluwarsa,a.id_lokasi,a.id_sub_lokasi,SUM(a.qty)qty,
                    b.nama,b.barcode,c.lokasi,d.satuan,IF(a.tgl_kadaluwarsa!='1700-01-01',a.tgl_kadaluwarsa,'') tgl,e.tempat,
                    (SELECT harga_perolehan FROM t_mutasi_detail WHERE id_barang=a.id_barang AND (harga_perolehan<>'' OR harga_perolehan<>'0') ORDER BY id_stok DESC LIMIT 1) harga_perolehan,
                    f.kategori,f.id_kat_barang
                    FROM t_stok a
                    JOIN m_barang b ON a.id_barang=b.id_barang
                    JOIN m_lokasi c ON a.id_lokasi=c.id_lokasi
                    JOIN m_satuan d ON b.id_satuan=d.id_satuan 
                    LEFT JOIN m_lokasi_sub e ON e.id_sub_lokasi=a.id_sub_lokasi
                    LEFT JOIN m_kat_barang f ON b.id_kat_barang=f.id_kat_barang ";
        $sql    .= " WHERE a.id_barang <> 0  AND a.tgl_kadaluwarsa<>'1700-01-01' AND a.tgl_kadaluwarsa < '".$tgl_untuk_3_bulan."' AND f.id_kat_barang='".$id."' ";
        $sql    .= " GROUP BY a.id_barang,a.tgl_transaksi,a.no_mutasi,a.tipe_mutasi,a.lot_no,a.tgl_kadaluwarsa,a.id_lokasi,a.id_sub_lokasi  HAVING SUM(a.qty)<>0  ORDER BY f.kategori  ";
        return $this->db->query($sql);

    }


}   