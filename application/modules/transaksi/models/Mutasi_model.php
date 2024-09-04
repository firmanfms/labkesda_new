<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mutasi_model extends CI_Model
{

    function get_all()
    {
        $sql ='SELECT a.*,b.nm_kategori_parameter,c.lab FROM m_parameter a LEFT JOIN m_kategori_parameter b ON a.kd_kategori_parameter=b.kd_kategori_parameter
                LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
                WHERE a.aktif="Y" order by a.kd_parameter DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_masuk(){
        $sql ='SELECT a.id_mutasi,a.no_mutasi,a.tgl,a.keterangan,a.id_lokasi,a.approve_mutasi,b.lokasi FROM t_mutasi a LEFT JOIN m_lokasi b
                ON a.id_lokasi=b.id_lokasi where a.status_mutasi="1" ORDER BY a.id_mutasi DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }
	
	function get_all_sumber()
    {
        $sql ='select * from m_sumber where aktif="Y" ';
        $query = $this->db->query($sql);
        return $query->result();
    }

    function act_form_masuk(){
        $new_mutasi_masuk   = $this->session->userdata('new_mutasi_masuk');

        $periode            = date('Y').date('m');
        $id_mutasi          = $this->max_id()->id_mutasi;
        $no_mutasi          = $periode.'1'.$this->max_nomor('1',$periode)->no_mutasi;
        $hari               = substr($this->input->post('tanggal'),0,2);
        $bulan              = substr($this->input->post('tanggal'),3,2);
        $tahun              = substr($this->input->post('tanggal'),6,4);
        $tanggal            = $tahun.'-'.$bulan.'-'.$hari;
        $keterangan         = $this->security->xss_clean($this->db->escape_str($this->input->post('keterangan')));
        $id_lokasi          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_lokasi')));
        $id_sub_lokasi      = $this->security->xss_clean($this->db->escape_str($this->input->post('id_sub_lokasi')));
		$id_sumber          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_sumber')));
        /*
		$sql    = "INSERT INTO t_mutasi (id_mutasi,no_mutasi,tgl,keterangan,id_lokasi,id_sub_lokasi,status_mutasi,tipe_mutasi,id_username,tgl_update,approve_mutasi)VALUES
            ('".$id_mutasi."','".$no_mutasi."','".$tanggal."','".$keterangan."','".$id_lokasi."','".$id_sub_lokasi."','1','Masuk','".$id_sumber."','".$this->current_user['id_username']."','".dbnow()."','0')";
		*/
		
		//edited by Firman
        $sql    = "INSERT INTO t_mutasi (id_mutasi,no_mutasi,tgl,keterangan,id_lokasi,id_sub_lokasi,status_mutasi,tipe_mutasi,id_sumber,id_username,tgl_update,approve_mutasi)VALUES
            ('".$id_mutasi."','".$no_mutasi."','".$tanggal."','".$keterangan."','".$id_lokasi."','".$id_sub_lokasi."','1','Masuk','".$id_sumber."','".$this->current_user['id_username']."','".dbnow()."','0')";
        $query = $this->db->query($sql);
		

        if(isset($new_mutasi_masuk['items'])){
            $items          = $new_mutasi_masuk['items'];
            foreach ($items as $key => $value) {
                $id_detail      = $this->max_id_detail()->id_mutasi_detail;
                $hari           = substr($value['kadaluarsa'],0,2);
                $bulan          = substr($value['kadaluarsa'],3,2);
                $tahun          = substr($value['kadaluarsa'],6,4);
                $harga_perolehan= str_replace(',', '', $value['harga_perolehan']);
                if($harga_perolehan!=''){
                    $harga_perolehan=  str_replace(',', '', $value['harga_perolehan']);
                }else{
                    $harga_perolehan=  0;
                }
                $tanggal        = $tahun.'-'.$bulan.'-'.$hari;
                if($tanggal=='--'){
                    $tanggal    = '1700-01-01';
                }
                $sql_detail     = "INSERT INTO t_mutasi_detail (id_mutasi_detail,id_mutasi,id_barang,qty,harga_perolehan,lot_no,tgl_kadaluwarsa)
                                VALUES('".$id_detail."','".$id_mutasi."','".$value['id_barang']."','".$value['quantity']."','".$harga_perolehan."',
                                    '".strtoupper($value['no_lot'])."','".$tanggal."')";
                $query          = $this->db->query($sql_detail);
            }
        }
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }

    function max_id(){
        $query = $this->db->query("SELECT IFNULL(MAX(id_mutasi),0)+1 id_mutasi FROM t_mutasi")->row();
        return $query;
    }

    function max_nomor($id,$periode){
        $query = $this->db->query("SELECT IFNULL(LPAD(MAX(SUBSTRING(no_mutasi,8,4))+1,4,'0'),'0001') no_mutasi FROM t_mutasi WHERE status_mutasi='".$id."' AND SUBSTRING(no_mutasi,1,6)='".$periode."'")->row();
        return $query;
    }

    function max_id_detail(){
        $query = $this->db->query("SELECT IFNULL(MAX(id_mutasi_detail),0)+1 id_mutasi_detail FROM t_mutasi_detail")->row();
        return $query;
    }

    function update_status($id,$approve){
        return $this->db->query("UPDATE t_mutasi SET approve_mutasi = '".$approve."' WHERE id_mutasi = '".$id."'");
    }

    function stok($id){
        $data   = $this->db->query("SELECT a.id_mutasi_detail,a.id_barang,a.qty,a.lot_no,a.tgl_kadaluwarsa,b.id_lokasi,b.id_sub_lokasi,b.tgl,b.no_mutasi,b.tipe_mutasi,a.harga_perolehan,b.id_sumber
                            FROM t_mutasi_detail a LEFT JOIN t_mutasi b on a.id_mutasi=b.id_mutasi WHERE a.id_mutasi='".$id."'")->result();

        // foreach ($data as $key => $value) {
        //     $this->db->query("INSERT INTO t_stok (id_barang,qty,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi)VALUE
        //             ('".$value->id_barang."','".$value->qty."','".$value->lot_no."','".$value->tgl_kadaluwarsa."','".$value->id_lokasi."','".$value->id_sub_lokasi."')");
        // }

        foreach ($data as $key => $value) {
            // $query      = $this->db->query("SELECT current_stock FROM `t_stok_detail` WHERE id_barang='".$value->id_barang."' AND id_lokasi='".$value->id_lokasi."'
            //                                 AND lot_no='".$value->lot_no."' ORDER BY id_stok DESC LIMIT 1");
            // $current    = $query->num_rows();

            // if($current==0){
            //     $old    = 0;
            // }else{
            //     $old    = $query->row()->current_stock;
            // }

            // $current_stock      = $old + $value->qty;

            // $this->db->query("INSERT INTO t_stok_detail (id_barang,tgl_transaksi,old_stock,qty_in,qty_out,current_stock,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi)
            //     VALUES
            // ('".$value->id_barang."','".$value->tgl."','".$old."','".$value->qty."','0','".$current_stock."','".$value->lot_no."','".$value->tgl_kadaluwarsa."','".$value->id_lokasi."','".$value->id_sub_lokasi."')");

            $this->db->query("INSERT INTO t_stok (id_barang,tgl_transaksi,no_mutasi,tipe_mutasi,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi,qty,
                            harga_perolehan,id_sumber)VALUES
                            ('".$value->id_barang."','".$value->tgl."','".$value->no_mutasi."','".$value->tipe_mutasi."','".strtoupper($value->lot_no)."','".$value->tgl_kadaluwarsa."','".$value->id_lokasi."','".$value->id_sub_lokasi."','".$value->qty."','".$value->harga_perolehan."',
                                '".$value->id_sumber."')");

        }

    }

    function mutasi_detail($id){
        $sql        = "SELECT a.id_mutasi_detail,a.id_mutasi,a.id_barang,b.nama,a.qty,a.lot_no,a.tgl_kadaluwarsa,c.satuan,a.harga_perolehan,a.type_adjustment 
                        FROM t_mutasi_detail a 
                        LEFT JOIN m_barang b ON a.id_barang=b.id_barang
                        LEFT JOIN m_satuan c ON b.id_satuan=c.id_satuan
                        WHERE a.id_mutasi='".$id."'";
        $query  = $this->db->query($sql);
        return $query;
    }

    function mutasi_detail_keluar($id){
        $sql        = "SELECT a.id_mutasi_detail,a.id_mutasi,a.id_barang,b.nama,SUM(a.qty)qty,a.lot_no,a.tgl_kadaluwarsa,c.satuan,a.harga_perolehan FROM t_mutasi_detail a 
                        LEFT JOIN m_barang b ON a.id_barang=b.id_barang
                        LEFT JOIN m_satuan c ON b.id_satuan=c.id_satuan
                        WHERE a.id_mutasi='".$id."' GROUP BY a.id_barang";
        $query  = $this->db->query($sql);
        return $query;
    }

    function mutasi_detail_keluar_batal($id){
        $sql        = "SELECT a.id_mutasi_detail,a.id_mutasi,a.id_barang,b.nama,a.qty,a.lot_no,a.tgl_kadaluwarsa,c.satuan,a.harga_perolehan,
                        a.type_adjustment 
                        FROM t_mutasi_detail a 
                        LEFT JOIN m_barang b ON a.id_barang=b.id_barang
                        LEFT JOIN m_satuan c ON b.id_satuan=c.id_satuan
                        WHERE a.id_mutasi='".$id."' ";
        $query  = $this->db->query($sql);
        return $query;
    }

    function mutasi_header($id){
        $sql    = "SELECT a.*,b.lokasi FROM t_mutasi a LEFT JOIN m_lokasi b ON a.id_lokasi=b.id_lokasi WHERE a.id_mutasi='".$id."'";
        $query  = $this->db->query($sql);
        return $query;
    }

    function act_edit_masuk(){
        $new_mutasi_masuk   = $this->session->userdata('new_mutasi_masuk');

        $bulan              = substr($this->input->post('tanggal'),0,2);
        $hari               = substr($this->input->post('tanggal'),3,2);
        $tahun              = substr($this->input->post('tanggal'),6,4);
        $tanggal            = $tahun.'-'.$bulan.'-'.$hari;
        $keterangan         = $this->security->xss_clean($this->db->escape_str($this->input->post('keterangan')));
        $id_lokasi          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_lokasi')));
        $id_mutasi          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_mutasi')));
        
        $sql    = "UPDATE t_mutasi SET tgl = '".$tanggal."',keterangan = '".$keterangan."',id_lokasi = '".$id_lokasi."' WHERE id_mutasi = '".$id_mutasi."'";
        $query = $this->db->query($sql);

        $delete = "DELETE FROM t_mutasi_detail WHERE id_mutasi = '".$id_mutasi."'";
        $query = $this->db->query($delete);
                    
        if(isset($new_mutasi_masuk['items'])){
            $items          = $new_mutasi_masuk['items'];
            foreach ($items as $key => $value) {
                $id_detail      = $this->max_id_detail()->id_mutasi_detail;
                $bulan          = substr($value['kadaluarsa'],0,2);
                $hari           = substr($value['kadaluarsa'],3,2);
                $tahun          = substr($value['kadaluarsa'],6,4);
                $tanggal        = $tahun.'-'.$bulan.'-'.$hari;                
                $harga_perolehan=  str_replace(',', '', $value['harga_perolehan']);
                if($tanggal=='--'){
                    $tanggal    = '1700-01-01';
                }
                $sql_detail     = "INSERT INTO t_mutasi_detail (id_mutasi_detail,id_mutasi,id_barang,qty,harga_perolehan,lot_no,tgl_kadaluwarsa)
                                VALUES('".$id_detail."','".$id_mutasi."','".$value['id_barang']."','".$value['quantity']."','".$harga_perolehan."',
                                    '".strtoupper($value['no_lot'])."','".$tanggal."')";
                $query          = $this->db->query($sql_detail);
            }
        }
        
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }

    function get_all_keluar(){
        $sql ='SELECT a.id_mutasi,a.no_mutasi,a.tgl,a.keterangan,a.id_lokasi,a.approve_mutasi,b.lokasi FROM t_mutasi a LEFT JOIN m_lokasi b
                ON a.id_lokasi=b.id_lokasi where a.status_mutasi="2" ORDER BY a.id_mutasi DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }

    function stok_barang($id){
        $query = $this->db->query(" SELECT * FROM stok_barang WHERE id_lokasi='".$id."' AND qty>=1 ")->result();                
        return $query;
    }

    function act_form_keluar(){
        $new_mutasi_keluar   = $this->session->userdata('new_mutasi_keluar');
        $periode            = date('Y').date('m');
        $id_mutasi          = $this->max_id()->id_mutasi;
        $no_mutasi          = $periode.'2'.$this->max_nomor('2',$periode)->no_mutasi;
        $hari               = substr($this->input->post('tanggal'),0,2);
        $bulan              = substr($this->input->post('tanggal'),3,2);
        $tahun              = substr($this->input->post('tanggal'),6,4);
        $tanggal            = $tahun.'-'.$bulan.'-'.$hari;
        $keterangan         = $this->security->xss_clean($this->db->escape_str($this->input->post('keterangan')));
        $no_referensi       = $this->security->xss_clean($this->db->escape_str($this->input->post('no_referensi')));
        $id_lokasi          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_lokasi')));
        $id_lokasi_tujuan   = $this->security->xss_clean($this->db->escape_str($this->input->post('id_lokasi_tujuan')));
        $id_sub_lokasi      = $this->security->xss_clean($this->db->escape_str($this->input->post('id_sub_lokasi')));
        
        $sql    = "INSERT INTO t_mutasi (id_mutasi,no_mutasi,tgl,keterangan,no_referensi,id_lokasi,id_sub_lokasi,status_mutasi,tipe_mutasi,id_username,tgl_update,approve_mutasi,id_lokasi_tujuan)
            VALUES
            ('".$id_mutasi."','".$no_mutasi."','".$tanggal."','".$keterangan."','".$no_referensi."','".$id_lokasi."','".$id_sub_lokasi."','2','Keluar','".$this->current_user['id_username']."','".dbnow()."','0','".$id_lokasi_tujuan."')";
        $query = $this->db->query($sql);

        if(isset($new_mutasi_keluar['items'])){
            $items          = $new_mutasi_keluar['items'];
            foreach ($items as $key => $value) {

                $permintaan         = $value['quantity'];
                $sisa_pengurangan   = 0;
                $cek_stok           = $this->db->query("SELECT id_stok,id_barang,SUM(qty)qty,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi,harga_perolehan 
                                        FROM `t_stok` 
                                        WHERE id_barang='".$value['id_barang']."' AND id_lokasi='".$id_lokasi."'
                                        GROUP BY id_barang,lot_no HAVING SUM(qty)>0 ORDER BY tgl_kadaluwarsa ASC")->result();

                foreach ($cek_stok as $key => $val1) {
                    $sisa_pengurangan   = $permintaan;
                    $stok           = $val1->qty;

                    $id_detail      = $this->max_id_detail()->id_mutasi_detail;
                    $hari           = substr($val1->tgl_kadaluwarsa,0,2);
                    $bulan          = substr($val1->tgl_kadaluwarsa,3,2);
                    $tahun          = substr($val1->tgl_kadaluwarsa,6,4);
                    $tanggal        = $tahun.'-'.$bulan.'-'.$hari;
                    if($tanggal=='--'){
                        $tanggal    = '1700-01-01';
                    }

                    $permintaan     = $permintaan - $val1->qty;
                    // test($permintaan.' '.$val1->qty,0);
                    if($permintaan<=0){
                        $q_in       = $sisa_pengurangan;

                        $sql_detail     = "INSERT INTO t_mutasi_detail (id_mutasi_detail,id_mutasi,id_stok,id_barang,qty,lot_no,tgl_kadaluwarsa,
                                        harga_perolehan)VALUES
                                        ('".$id_detail."','".$id_mutasi."','".$value['id_stok']."','".$value['id_barang']."','".$q_in."',
                                            '".strtoupper($val1->lot_no)."','".$val1->tgl_kadaluwarsa."','".$val1->harga_perolehan."')";
                        $query          = $this->db->query($sql_detail);    
                        // test($permintaan.' '.$val1->qty,0);
                        // test($sql_detail,0);
                        break;
                    }else{
                        $q_in       = $val1->qty;

                        $sql_detail     = "INSERT INTO t_mutasi_detail (id_mutasi_detail,id_mutasi,id_stok,id_barang,qty,lot_no,tgl_kadaluwarsa,harga_perolehan)VALUES
                                        ('".$id_detail."','".$id_mutasi."','".$value['id_stok']."','".$value['id_barang']."','".$q_in."',
                                            '".strtoupper($val1->lot_no)."','".$val1->tgl_kadaluwarsa."','".$val1->harga_perolehan."')";
                        $query          = $this->db->query($sql_detail);
                        // test($permintaan.' '.$val1->qty,0);
                        // test($sql_detail,0);
                    }

                    
                    
                }
            }
        }
        
        if($query === false){
            return "ERROR INSERTT";
        }else{
            return $query;
        }
    }

    function act_edit_keluar(){
        $new_mutasi_keluar   = $this->session->userdata('new_mutasi_keluar');

        $bulan              = substr($this->input->post('tanggal'),0,2);
        $hari               = substr($this->input->post('tanggal'),3,2);
        $tahun              = substr($this->input->post('tanggal'),6,4);
        $tanggal            = $tahun.'-'.$bulan.'-'.$hari;
        $keterangan         = $this->security->xss_clean($this->db->escape_str($this->input->post('keterangan')));
        $no_referensi       = $this->security->xss_clean($this->db->escape_str($this->input->post('no_referensi')));
        $id_lokasi          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_lokasi')));
        $id_mutasi          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_mutasi')));
        
        $sql                ="UPDATE t_mutasi SET 
                                tgl = '".$tanggal."',
                                keterangan = '".$keterangan."',
                                id_lokasi = '".$id_lokasi."',
                                no_referensi = '".$no_referensi."' 
                                WHERE id_mutasi='".$id_mutasi."'";
        $query = $this->db->query($sql);

        $delete = "DELETE FROM t_mutasi_detail WHERE id_mutasi = '".$id_mutasi."'";
        $query = $this->db->query($delete);
                    
        if(isset($new_mutasi_keluar['items'])){
            $items          = $new_mutasi_keluar['items'];
            foreach ($items as $key => $value) {

                $permintaan         = $value['quantity'];
                $sisa_pengurangan   = 0;
                $cek_stok           = $this->db->query("SELECT id_stok,id_barang,SUM(qty)qty,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi FROM `t_stok` 
                                        WHERE id_barang='".$value['id_barang']."' AND id_lokasi='".$id_lokasi."'
                                        GROUP BY id_barang,lot_no HAVING SUM(qty)>0 ORDER BY tgl_kadaluwarsa ASC")->result();

                foreach ($cek_stok as $key => $val1) {
                    $sisa_pengurangan   = $permintaan;
                    $stok           = $val1->qty;

                    $id_detail      = $this->max_id_detail()->id_mutasi_detail;
                    $hari           = substr($val1->tgl_kadaluwarsa,0,2);
                    $bulan          = substr($val1->tgl_kadaluwarsa,3,2);
                    $tahun          = substr($val1->tgl_kadaluwarsa,6,4);
                    $tanggal        = $tahun.'-'.$bulan.'-'.$hari;
                    if($tanggal=='--'){
                        $tanggal    = '1700-01-01';
                    }

                    $permintaan     = $permintaan - $val1->qty;
                    // test($permintaan.' '.$val1->qty,0);
                    if($permintaan<=0){
                        $q_in       = $sisa_pengurangan;

                        $sql_detail     = "INSERT INTO t_mutasi_detail (id_mutasi_detail,id_mutasi,id_stok,id_barang,qty,lot_no,tgl_kadaluwarsa)VALUES
                                        ('".$id_detail."','".$id_mutasi."','".$val1->id_stok."','".$value['id_barang']."','".$q_in."','".strtoupper($val1->lot_no)."',
                                            '".$val1->tgl_kadaluwarsa."')";
                        $query          = $this->db->query($sql_detail);
                        // test($permintaan.' '.$val1->qty,0);
                        // test($sql_detail,0);
                        break;
                    }else{
                        $q_in       = $val1->qty;

                        $sql_detail     = "INSERT INTO t_mutasi_detail (id_mutasi_detail,id_mutasi,id_stok,id_barang,qty,lot_no,tgl_kadaluwarsa)VALUES
                                        ('".$id_detail."','".$id_mutasi."','".$val1->id_stok."','".$value['id_barang']."','".$q_in."','".strtoupper($val1->lot_no)."',
                                            '".$val1->tgl_kadaluwarsa."')";
                        $query          = $this->db->query($sql_detail);
                        // test($permintaan.' '.$val1->qty,0);
                        // test($sql_detail,0);
                    }

                    
                    
                }
            }
        }
        
        
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }

    function stok_keluar($id){
        $data   = $this->db->query("SELECT a.id_mutasi_detail,a.id_barang,a.qty,a.lot_no,a.tgl_kadaluwarsa,b.id_lokasi,a.id_stok,b.id_lokasi_tujuan,b.id_sub_lokasi,b.tgl,
                            b.no_mutasi,b.tipe_mutasi,a.harga_perolehan
                            FROM t_mutasi_detail a LEFT JOIN t_mutasi b on a.id_mutasi=b.id_mutasi WHERE a.id_mutasi='".$id."'")->result();

        // Mengurangi Stok dari Lokasi Awal
        // foreach ($data as $key => $value) {
        //     $qty_stok   = $this->db->query("SELECT qty FROM t_stok WHERE id_stok='".$value->id_stok."'")->row()->qty;
        //     $stok_akhir = $qty_stok - $value->qty;
        //     $this->db->query("UPDATE t_stok SET qty = '".$stok_akhir."' WHERE id_stok = '".$value->id_stok."'");
        // }

        // Menambah Stok Ke Lokasi Tujuan
        // $data2   = $this->db->query("SELECT a.id_mutasi_detail,a.id_barang,a.qty,a.lot_no,a.tgl_kadaluwarsa,b.id_lokasi,b.id_lokasi_tujuan,b.id_sub_lokasi
        //                     FROM t_mutasi_detail a LEFT JOIN t_mutasi b on a.id_mutasi=b.id_mutasi WHERE a.id_mutasi='".$id."'")->result();

        // foreach ($data2 as $key => $value) {
        //     $this->db->query("INSERT INTO t_stok (id_barang,qty,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi)VALUE
        //     ('".$value->id_barang."','".$value->qty."','".$value->lot_no."','".$value->tgl_kadaluwarsa."','".$value->id_lokasi_tujuan."','".$value->id_sub_lokasi."')");
        // }

        // Mengurangi Stok di History
        foreach ($data as $key => $value) {
            // $query      = $this->db->query("SELECT current_stock FROM `t_stok_detail` WHERE id_barang='".$value->id_barang."' AND id_lokasi='".$value->id_lokasi."'
            //                                 AND lot_no='".$value->lot_no."' ORDER BY id_stok DESC LIMIT 1");
            // $current    = $query->num_rows();
            // $old        = $query->row()->current_stock;

            // $current_stock      = $old - $value->qty;

            // $this->db->query("INSERT INTO t_stok_detail (id_barang,tgl_transaksi,old_stock,qty_in,qty_out,current_stock,lot_no,tgl_kadaluwarsa,id_lokasi)VALUES
            // ('".$value->id_barang."','".$value->tgl."','".$old."','0','".$value->qty."','".$current_stock."','".$value->lot_no."','".$value->tgl_kadaluwarsa."','".$value->id_lokasi."')");

            $this->db->query("INSERT INTO t_stok (id_barang,tgl_transaksi,no_mutasi,tipe_mutasi,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi,qty,harga_perolehan)VALUES
                            ('".$value->id_barang."','".$value->tgl."','".$value->no_mutasi."','".$value->tipe_mutasi."','".strtoupper($value->lot_no)."','".$value->tgl_kadaluwarsa."','".$value->id_lokasi."','".$value->id_sub_lokasi."','-".$value->qty."','".$value->harga_perolehan."')");

        }

        // Menambah Stok di History
        // foreach ($data2 as $key => $value) {
        //     $query      = $this->db->query("SELECT current_stock FROM `t_stok_detail` WHERE id_barang='".$value->id_barang."' AND id_lokasi='".$value->id_lokasi_tujuan."'");
        //     $current    = $query->num_rows();

        //     if($current==0){
        //         $old    = 0;
        //     }else{
        //         $old    = $query->row()->current_stock;
        //     }

        //     $current_stock      = $old + $value->qty;

        //     $this->db->query("INSERT INTO t_stok_detail (id_barang,old_stock,qty_in,qty_out,current_stock,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi)VALUES
        //     ('".$value->id_barang."','".$old."','0','".$value->qty."','".$current_stock."','".$value->lot_no."','".$value->tgl_kadaluwarsa."','".$value->id_lokasi_tujuan."','".$value->id_sub_lokasi."')");
        // }

    }

    function get_all_barang($start=0,$length=10,$search='',$id) {
        // $sql = "SELECT a.request_id, a.request_no, a.request_date,a.requester,c.name dept,a.project_id,d.project_name,d.project_location FROM trn_request_01 a 
        //         LEFT JOIN db_master.mst_user_group c ON c.id_user_group=a.dept
        //         LEFT JOIN db_master.mst_project d ON d.project_id=a.project_id
        //         WHERE a.status_request='2' AND a.status_approve='1' AND (a.request_no LIKE '%".$search."%')
        //         order by a.request_no asc
        //         LIMIT ".$start.", ".$length."";

        $sql = "SELECT a.id_stok,a.id_barang,a.lot_no,a.tgl_kadaluwarsa,a.id_lokasi,a.id_barang,SUM(a.qty)qty,b.nama,c.satuan FROM t_stok a
                LEFT JOIN m_barang b ON a.id_barang=b.id_barang LEFT JOIN m_satuan c ON b.id_satuan=c.id_satuan WHERE a.id_lokasi='".$id."' AND (b.nama LIKE '%".$search."%') 
                GROUP BY a.id_barang
                ORDER BY b.nama LIMIT ".$start.", ".$length."";

        $item = $this->db->query($sql)->result();
        return is_for($item) ? $item : false;
    }

    function get_count_display($start,$length,$search = false,$id) {
        $str = '';
        if ($search) {
            $str = " AND (b.nama LIKE '%".$search."%') ";
        }

        $sql = " SELECT COUNT(a.id_stok) total FROM t_stok a LEFT JOIN m_barang b ON a.id_barang=b.id_barang WHERE a.id_lokasi='".$id."' ".$str." GROUP BY a.id_barang ";
        $item = $this->db->query($sql)->num_rows();
        return isset($item) ? $item : 0;
    }

    function get_count($id){
        $sql ="SELECT COUNT(a.id_stok) total FROM t_stok a LEFT JOIN m_barang b ON a.id_barang=b.id_barang WHERE a.id_lokasi='".$id."' GROUP BY a.id_barang ";
        $item = $this->db->query($sql)->num_rows();
        return isset($item) ? $item : 0;
    }





    function get_all_barang_adj($start=0,$length=10,$search='',$id) {
        // $sql = "SELECT a.request_id, a.request_no, a.request_date,a.requester,c.name dept,a.project_id,d.project_name,d.project_location FROM trn_request_01 a 
        //         LEFT JOIN db_master.mst_user_group c ON c.id_user_group=a.dept
        //         LEFT JOIN db_master.mst_project d ON d.project_id=a.project_id
        //         WHERE a.status_request='2' AND a.status_approve='1' AND (a.request_no LIKE '%".$search."%')
        //         order by a.request_no asc
        //         LIMIT ".$start.", ".$length."";

        $sql = "SELECT a.id_stok,a.id_barang,a.lot_no,a.tgl_kadaluwarsa,a.id_lokasi,a.id_barang,SUM(a.qty)qty,b.nama,c.satuan,a.harga_perolehan FROM t_stok a
                LEFT JOIN m_barang b ON a.id_barang=b.id_barang LEFT JOIN m_satuan c ON b.id_satuan=c.id_satuan WHERE a.id_lokasi='".$id."' AND (b.nama LIKE '%".$search."%') 
                GROUP BY a.id_barang, a.lot_no
                ORDER BY b.nama LIMIT ".$start.", ".$length."";

        $item = $this->db->query($sql)->result();
        return is_for($item) ? $item : false;
    }

    function get_count_display_adj($start,$length,$search = false,$id) {
        $str = '';
        if ($search) {
            $str = " AND (b.nama LIKE '%".$search."%') ";
        }

        $sql = " SELECT COUNT(a.id_stok) total FROM t_stok a LEFT JOIN m_barang b ON a.id_barang=b.id_barang WHERE a.id_lokasi='".$id."' ".$str." 
                 GROUP BY a.id_barang, a.lot_no";
        $item = $this->db->query($sql)->num_rows();
        return isset($item) ? $item : 0;
    }

    function get_count_adj($id){
        $sql ="SELECT COUNT(a.id_stok) total FROM t_stok a LEFT JOIN m_barang b ON a.id_barang=b.id_barang WHERE a.id_lokasi='".$id."' 
                GROUP BY a.id_barang, a.lot_no";
        $item = $this->db->query($sql)->num_rows();
        return isset($item) ? $item : 0;
    }






    function last_stok($id_lokasi,$tgl_smp){
        $sql = "SELECT a.id_barang,a.tgl_transaksi,a.no_mutasi,a.tipe_mutasi,a.lot_no,a.tgl_kadaluwarsa,a.id_lokasi,a.id_sub_lokasi,SUM(a.qty)qty,
                    b.nama,b.barcode,c.lokasi,d.satuan,IF(a.tgl_kadaluwarsa!='1700-01-01',a.tgl_kadaluwarsa,'') tgl,e.tempat,
                    (SELECT harga_perolehan FROM t_stok WHERE id_barang=a.id_barang AND (harga_perolehan<>'' OR harga_perolehan<>'0') ORDER BY tgl_transaksi DESC LIMIT 1) harga_perolehan
                    FROM t_stok a
                    JOIN m_barang b ON a.id_barang=b.id_barang
                    JOIN m_lokasi c ON a.id_lokasi=c.id_lokasi
                    JOIN m_satuan d ON b.id_satuan=d.id_satuan 
                    LEFT JOIN m_lokasi_sub e ON e.id_sub_lokasi=a.id_sub_lokasi
                    WHERE a.id_barang <> 0 ";
        if($id_lokasi!=''){
            $sql .=" AND a.id_lokasi='".$id_lokasi."' ";
        }
        if($tgl_smp!=''){
            $sql .=" AND a.tgl_transaksi <= '".$tgl_smp."' ";
        }

        $sql    .= " GROUP by a.id_lokasi,a.id_barang,a.lot_no ";
        $sql    .= " HAVING SUM(a.qty)<>0 ";
        $sql    .= " Order by c.lokasi,b.nama ";
        return $this->db->query($sql)->result();

    }

    function history_stok_barang($id_lokasi,$tgl_dari,$tgl_smp,$id_barang){
        $sql = " SELECT a.*,b.nama,b.barcode,c.lokasi,d.satuan,IF(a.tgl_kadaluwarsa!='1700-01-01',a.tgl_kadaluwarsa,'') tgl,e.tempat,
                 IFNULL((SELECT SUM(qty) FROM t_stok WHERE id_lokasi='".$id_lokasi."' AND tgl_transaksi < '".$tgl_dari."' AND id_barang=a.id_barang),0) saldo_awal
                    FROM t_stok a 
                    JOIN m_barang b ON a.id_barang=b.id_barang
                    JOIN m_lokasi c ON a.id_lokasi=c.id_lokasi
                    JOIN m_satuan d ON b.id_satuan=d.id_satuan 
                    LEFT JOIN m_lokasi_sub e ON e.id_sub_lokasi=a.id_sub_lokasi
                    WHERE a.id_barang > 0 ";
        if($id_barang!='0'){
        $sql .= " AND a.id_barang='".$id_barang."' ";
        }
        $sql .= " AND a.id_lokasi='".$id_lokasi."' ";
        // $sql .= " AND MONTH(a.tgl_transaksi)='".$month."' ";
        $sql .= " AND a.tgl_transaksi >= '".$tgl_dari."' ";
        $sql .= " AND a.tgl_transaksi <= '".$tgl_smp."' ";
        // }

        $sql .= " GROUP BY a.id_barang,a.lot_no ORDER BY a.lot_no DESC,a.id_barang,a.id_stok ";
        // test($sql,1);
        return $this->db->query($sql)->result();
    }

    function history_stok($id_lokasi){
        $sql = "SELECT a.*,b.nama,b.barcode,c.lokasi,d.satuan,IF(a.tgl_kadaluwarsa!='1700-01-01',a.tgl_kadaluwarsa,'') tgl,e.tempat FROM t_stok a
                    JOIN m_barang b ON a.id_barang=b.id_barang
                    JOIN m_lokasi c ON a.id_lokasi=c.id_lokasi
                    JOIN m_satuan d ON b.id_satuan=d.id_satuan 
                    LEFT JOIN m_lokasi_sub e ON e.id_sub_lokasi=a.id_sub_lokasi
                    WHERE a.qty > 0 ";
        if($id_lokasi!=''){
            $sql .=" AND a.id_lokasi='".$id_lokasi."' ";
        }

        $sql    .= " Order by c.lokasi,b.nama ";

        return $this->db->query($sql)->result();

    }

    function get_all_adjustment(){
        $sql ='SELECT a.id_mutasi,a.no_mutasi,a.tgl,a.keterangan,a.id_lokasi,a.approve_mutasi,b.lokasi FROM t_mutasi a LEFT JOIN m_lokasi b
                ON a.id_lokasi=b.id_lokasi where a.status_mutasi="3" ORDER BY a.id_mutasi DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }

    function act_form_adjustment(){
        $new_mutasi_masuk   = $this->session->userdata('new_mutasi_masuk');
        $periode            = date('Y').date('m');
        $id_mutasi          = $this->max_id()->id_mutasi;
        $no_mutasi          = $periode.'3'.$this->max_nomor('3',$periode)->no_mutasi;
        $hari               = substr($this->input->post('tanggal'),0,2);
        $bulan              = substr($this->input->post('tanggal'),3,2);
        $tahun              = substr($this->input->post('tanggal'),6,4);
        $tanggal            = $tahun.'-'.$bulan.'-'.$hari;
        $keterangan         = $this->security->xss_clean($this->db->escape_str($this->input->post('keterangan')));
        $id_lokasi          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_lokasi')));
        $id_sub_lokasi      = $this->security->xss_clean($this->db->escape_str($this->input->post('id_sub_lokasi')));
        
        $sql    = "INSERT INTO t_mutasi (id_mutasi,no_mutasi,tgl,keterangan,id_lokasi,id_sub_lokasi,status_mutasi,tipe_mutasi,id_username,tgl_update,approve_mutasi)VALUES
            ('".$id_mutasi."','".$no_mutasi."','".$tanggal."','".$keterangan."','".$id_lokasi."','".$id_sub_lokasi."','3','Adjustment','".$this->current_user['id_username']."','".dbnow()."','0')";
                // test($sql,1);
        $query = $this->db->query($sql);

        if(isset($new_mutasi_masuk['items'])){
            $items          = $new_mutasi_masuk['items'];
            // test($items,1);
            foreach ($items as $key => $value) {
                $id_detail      = $this->max_id_detail()->id_mutasi_detail;
                $hari           = substr($value['kadaluarsa'],0,2);
                $bulan          = substr($value['kadaluarsa'],3,2);
                $tahun          = substr($value['kadaluarsa'],6,4);
                $harga_perolehan=  ($value['harga_perolehan']!='')? str_replace(',', '', $value['harga_perolehan']) : '0';
                $tanggal        = $tahun.'-'.$bulan.'-'.$hari;
                if($tanggal=='--'){
                    $tanggal    = '1700-01-01';
                }
                $sql_detail     = "INSERT INTO t_mutasi_detail (id_mutasi_detail,id_mutasi,id_barang,qty,harga_perolehan,lot_no,tgl_kadaluwarsa,type_adjustment)
                                VALUES('".$id_detail."','".$id_mutasi."','".$value['id_barang']."','".$value['quantity']."','".$harga_perolehan."','".strtoupper($value['no_lot'])."','".$tanggal."','".$value['type_adjustment']."')";
                                    // test($sql_detail,0);
                $query          = $this->db->query($sql_detail);
            }
        }
        
        // test($new_mutasi_masuk,1);
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }

    function stok_adjustment($id){
        $data   = $this->db->query("SELECT a.id_mutasi_detail,a.id_barang,a.qty,a.lot_no,a.tgl_kadaluwarsa,b.id_lokasi,b.id_sub_lokasi,b.tgl,a.type_adjustment,
                            b.no_mutasi,a.harga_perolehan
                            FROM t_mutasi_detail a LEFT JOIN t_mutasi b on a.id_mutasi=b.id_mutasi WHERE a.id_mutasi='".$id."'")->result();

        // foreach ($data as $key => $value) {
        //     $query      = $this->db->query("SELECT * FROM t_stok WHERE id_lokasi='".$value->id_lokasi."' AND id_barang='".$value->id_barang."' AND lot_no='".$value->lot_no."'");
        //     $tdata      = $query->num_rows();
        //     $current    = $query->row();

        //     if($tdata>=1){
        //         if($value->type_adjustment=='Positif Adjustment'){
        //             $qty        = $current->qty + $value->qty;
        //         }else if($value->type_adjustment=='Negatif Adjustment'){
        //             $qty        = $current->qty - $value->qty;
        //         }

        //         $this->db->query("UPDATE t_stok SET qty = '".$qty."' WHERE id_stok = '".$current->id_stok."'");
        //     }else{
        //         $this->db->query("INSERT INTO t_stok (id_barang,qty,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi)VALUE
        //             ('".$value->id_barang."','".$qty."','".$value->lot_no."','".$value->tgl_kadaluwarsa."','".$value->id_lokasi."','".$value->id_sub_lokasi."')");
        //     }
            
        // }

        foreach ($data as $key => $value) {
            // $query      = $this->db->query("SELECT current_stock FROM `t_stok_detail` WHERE id_barang='".$value->id_barang."' AND id_lokasi='".$value->id_lokasi."'
            //                                 AND lot_no='".$value->lot_no."' ORDER BY id_stok DESC LIMIT 1");
            // $current    = $query->num_rows();

            // if($current==0){
            //     $old    = 0;
            // }else{
            //     $old    = $query->row()->current_stock;
            // }

            if($value->type_adjustment=='Positif Adjustment'){
                $current_stock      = $value->qty;
            }else if($value->type_adjustment=='Negatif Adjustment'){
                $current_stock      = '-'.$value->qty;
            }

            // $this->db->query("INSERT INTO t_stok_detail (id_barang,tgl_transaksi,old_stock,qty_in,qty_out,current_stock,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi)
            //     VALUES
            // ('".$value->id_barang."','".$value->tgl."','".$old."','".$qty_in."','".$qty_out."','".$current_stock."','".$value->lot_no."','".$value->tgl_kadaluwarsa."','".$value->id_lokasi."','".$value->id_sub_lokasi."')");

            $this->db->query("INSERT INTO t_stok (id_barang,tgl_transaksi,no_mutasi,tipe_mutasi,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi,qty,harga_perolehan)VALUES
                            ('".$value->id_barang."','".$value->tgl."','".$value->no_mutasi."','Adjustment','".strtoupper($value->lot_no)."','".$value->tgl_kadaluwarsa."','".$value->id_lokasi."','".$value->id_sub_lokasi."','".$current_stock."','".$value->harga_perolehan."')");

        }

    }

    function get_all_lokasi(){
        $sql ='SELECT a.id_mutasi,a.no_mutasi,a.tgl,a.keterangan,a.id_lokasi,a.approve_mutasi,b.lokasi FROM t_mutasi a LEFT JOIN m_lokasi b
                ON a.id_lokasi=b.id_lokasi where a.status_mutasi="4" ORDER BY a.id_mutasi DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }

    function act_form_lokasi(){
        $new_mutasi_keluar   = $this->session->userdata('new_mutasi_keluar');
        $periode            = date('Y').date('m');
        $id_mutasi          = $this->max_id()->id_mutasi;
        $no_mutasi          = $periode.'4'.$this->max_nomor('4',$periode)->no_mutasi;
        $hari               = substr($this->input->post('tanggal'),0,2);
        $bulan              = substr($this->input->post('tanggal'),3,2);
        $tahun              = substr($this->input->post('tanggal'),6,4);
        $tanggal            = $tahun.'-'.$bulan.'-'.$hari;
        $keterangan         = $this->security->xss_clean($this->db->escape_str($this->input->post('keterangan')));
        $id_lokasi          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_lokasi')));
        $id_lokasi_tujuan   = $this->security->xss_clean($this->db->escape_str($this->input->post('id_lokasi_tujuan')));
        $id_sub_lokasi      = $this->security->xss_clean($this->db->escape_str($this->input->post('id_sub_lokasi')));
        
        $sql    = "INSERT INTO t_mutasi (id_mutasi,no_mutasi,tgl,keterangan,id_lokasi,id_sub_lokasi,status_mutasi,tipe_mutasi,id_username,tgl_update,approve_mutasi,id_lokasi_tujuan)
            VALUES
            ('".$id_mutasi."','".$no_mutasi."','".$tanggal."','".$keterangan."','".$id_lokasi."','".$id_sub_lokasi."','4','Mutasi Lokasi Keluar','".$this->current_user['id_username']."','".dbnow()."','0','".$id_lokasi_tujuan."')";
        $query = $this->db->query($sql);

        if(isset($new_mutasi_keluar['items'])){
            $items          = $new_mutasi_keluar['items'];
            foreach ($items as $key => $value) {

                $permintaan         = $value['quantity'];
                $sisa_pengurangan   = 0;
                $cek_stok           = $this->db->query("SELECT id_stok,id_barang,SUM(qty)qty,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi,harga_perolehan FROM `t_stok` 
                                        WHERE id_barang='".$value['id_barang']."' AND id_lokasi='".$id_lokasi."'
                                        GROUP BY id_barang,lot_no HAVING SUM(qty)>0 ORDER BY tgl_kadaluwarsa ASC")->result();

                foreach ($cek_stok as $key => $val1) {
                    $sisa_pengurangan   = $permintaan;
                    $stok           = $val1->qty;

                    $id_detail      = $this->max_id_detail()->id_mutasi_detail;
                    $hari           = substr($val1->tgl_kadaluwarsa,0,2);
                    $bulan          = substr($val1->tgl_kadaluwarsa,3,2);
                    $tahun          = substr($val1->tgl_kadaluwarsa,6,4);
                    $tanggal        = $tahun.'-'.$bulan.'-'.$hari;
                    if($tanggal=='--'){
                        $tanggal    = '1700-01-01';
                    }

                    $permintaan     = $permintaan - $val1->qty;
                    // test($permintaan.' '.$val1->qty,0);
                    if($permintaan<=0){
                        $q_in       = $sisa_pengurangan;

                        $sql_detail     = "INSERT INTO t_mutasi_detail (id_mutasi_detail,id_mutasi,id_stok,id_barang,qty,lot_no,tgl_kadaluwarsa,harga_perolehan)VALUES
                                        ('".$id_detail."','".$id_mutasi."','".$value['id_stok']."','".$value['id_barang']."','".$q_in."',
                                            '".strtoupper($val1->lot_no)."','".$val1->tgl_kadaluwarsa."','".$val1->harga_perolehan."')";
                        $query          = $this->db->query($sql_detail);
                        // test($permintaan.' '.$val1->qty,0);
                        // test($sql_detail,0);
                        break;
                    }else{
                        $q_in       = $val1->qty;

                        $sql_detail     = "INSERT INTO t_mutasi_detail (id_mutasi_detail,id_mutasi,id_stok,id_barang,qty,lot_no,tgl_kadaluwarsa,harga_perolehan)VALUES
                                        ('".$id_detail."','".$id_mutasi."','".$value['id_stok']."','".$value['id_barang']."','".$q_in."',
                                            '".strtoupper($val1->lot_no)."','".$val1->tgl_kadaluwarsa."','".$val1->harga_perolehan."')";
                        $query          = $this->db->query($sql_detail);
                        // test($permintaan.' '.$val1->qty,0);
                        // test($sql_detail,0);
                    }

                    
                    
                }
            }
        }

        // if(isset($new_mutasi_keluar['items'])){
        //     $items          = $new_mutasi_keluar['items'];
        //     foreach ($items as $key => $value) {
        //         $id_detail      = $this->max_id_detail()->id_mutasi_detail;
        //         $hari           = substr($value['kadaluarsa'],0,2);
        //         $bulan          = substr($value['kadaluarsa'],3,2);
        //         $tahun          = substr($value['kadaluarsa'],6,4);
        //         $tanggal        = $tahun.'-'.$bulan.'-'.$hari;

        //         if($tanggal=='--'){
        //             $tanggal    = '1700-01-01';
        //         }

        //         $sql_detail     = "INSERT INTO t_mutasi_detail (id_mutasi_detail,id_mutasi,id_stok,id_barang,qty,lot_no,tgl_kadaluwarsa)VALUES
        //         ('".$id_detail."','".$id_mutasi."','".$value['id_stok']."','".$value['id_barang']."','".$value['quantity']."','".$value['no_lot']."','".$tanggal."')";

        //         $query          = $this->db->query($sql_detail);
        //     }
        // }
        
        if($query === false){
            return "ERROR INSERTT";
        }else{
            return $query;
        }
    }

    function stok_keluar_lokasi($id){
        $gd_intransit       = $this->db->query("SELECT id_lokasi AS id_intransit,lokasi FROM m_lokasi WHERE aktif='Y' AND intransit='Y'")->row();
        $id_intransit       = $gd_intransit->id_intransit;
        $lokasi             = $gd_intransit->lokasi;

        $data   = $this->db->query("SELECT a.id_mutasi_detail,a.id_barang,a.qty,a.lot_no,a.tgl_kadaluwarsa,b.id_lokasi,a.id_stok,b.id_lokasi_tujuan,
                            b.id_sub_lokasi,b.tgl,b.no_mutasi,a.harga_perolehan
                            FROM t_mutasi_detail a LEFT JOIN t_mutasi b on a.id_mutasi=b.id_mutasi WHERE a.id_mutasi='".$id."'")->result();

        // Mengurangi Stok dari Lokasi Awal
        // foreach ($data as $key => $value) {
        //     $qty_stok   = $this->db->query("SELECT qty FROM t_stok WHERE id_stok='".$value->id_stok."'")->row()->qty;
        //     $stok_akhir = $qty_stok - $value->qty;
        //     $this->db->query("UPDATE t_stok SET qty = '".$stok_akhir."' WHERE id_stok = '".$value->id_stok."'");
        // }

        // Menambah Stok Ke Lokasi Tujuan
        $data2   = $this->db->query("SELECT a.id_mutasi_detail,a.id_barang,a.qty,a.lot_no,a.tgl_kadaluwarsa,b.id_lokasi,b.id_lokasi_tujuan,b.id_sub_lokasi,
                            b.tgl,b.no_mutasi,a.harga_perolehan
                            FROM t_mutasi_detail a LEFT JOIN t_mutasi b on a.id_mutasi=b.id_mutasi WHERE a.id_mutasi='".$id."'")->result();

        // foreach ($data2 as $key => $value) {
        //     $this->db->query("INSERT INTO t_stok (id_barang,qty,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi)VALUE
        //     ('".$value->id_barang."','".$value->qty."','".$value->lot_no."','".$value->tgl_kadaluwarsa."','".$id_intransit."','".$value->id_sub_lokasi."')");
        // }

        // Mengurangi Stok di History
        foreach ($data as $key => $value) {
            // $query      = $this->db->query("SELECT current_stock FROM `t_stok_detail` WHERE id_barang='".$value->id_barang."' AND id_lokasi='".$value->id_lokasi."'
            //                                 AND lot_no='".$value->lot_no."' ORDER BY id_stok DESC LIMIT 1");
            // $current    = $query->num_rows();
            // $old        = $query->row()->current_stock;

            // $current_stock      = $old - $value->qty;

            // $this->db->query("INSERT INTO t_stok_detail (id_barang,tgl_transaksi,old_stock,qty_in,qty_out,current_stock,lot_no,tgl_kadaluwarsa,id_lokasi)VALUES
            // ('".$value->id_barang."','".$value->tgl."','".$old."','0','".$value->qty."','".$current_stock."','".$value->lot_no."','".$value->tgl_kadaluwarsa."','".$value->id_lokasi."')");

            $this->db->query("INSERT INTO t_stok (id_barang,tgl_transaksi,no_mutasi,tipe_mutasi,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi,qty,harga_perolehan)VALUES
                            ('".$value->id_barang."','".$value->tgl."','".$value->no_mutasi."','Mutasi Lokasi Keluar','".strtoupper($value->lot_no)."','".$value->tgl_kadaluwarsa."','".$value->id_lokasi."','".$value->id_sub_lokasi."','-".$value->qty."','".$value->harga_perolehan."')");

        }

        // Menambah Stok di History
        foreach ($data2 as $key => $value) {
            // $query      = $this->db->query("SELECT current_stock FROM `t_stok_detail` WHERE id_barang='".$value->id_barang."' AND id_lokasi='".$value->id_lokasi_tujuan."'");
            // $current    = $query->num_rows();

            // if($current==0){
            //     $old    = 0;
            // }else{
            //     $old    = $query->row()->current_stock;
            // }

            // $current_stock      = $old + $value->qty;

            // $this->db->query("INSERT INTO t_stok_detail (id_barang,tgl_transaksi,old_stock,qty_in,qty_out,current_stock,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi)VALUES
            // ('".$value->id_barang."','".$value->tgl."','".$old."','".$value->qty."','0','".$current_stock."','".$value->lot_no."','".$value->tgl_kadaluwarsa."','".$id_intransit."','".$value->id_sub_lokasi."')");

            $this->db->query("INSERT INTO t_stok (id_barang,tgl_transaksi,no_mutasi,tipe_mutasi,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi,qty,harga_perolehan)VALUES
                            ('".$value->id_barang."','".$value->tgl."','".$value->no_mutasi."','Mutasi Lokasi Masuk','".strtoupper($value->lot_no)."','".$value->tgl_kadaluwarsa."','".$id_intransit."','".$value->id_sub_lokasi."','".$value->qty."','".$value->harga_perolehan."')");

        }

    }

    function get_all_lokasi_masuk(){
        $sql ='SELECT a.id_mutasi,a.no_mutasi,a.tgl,a.keterangan,a.id_lokasi,a.approve_mutasi,b.lokasi FROM t_mutasi a LEFT JOIN m_lokasi b
                ON a.id_lokasi=b.id_lokasi where a.status_mutasi="5" AND a.approve_mutasi="1" ORDER BY a.id_mutasi DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_lokasi_keluar(){
        $sql ='SELECT a.id_mutasi,a.no_mutasi,a.tgl,a.keterangan,a.id_lokasi,a.approve_mutasi,b.lokasi FROM t_mutasi a LEFT JOIN m_lokasi b
                ON a.id_lokasi=b.id_lokasi where a.status_mutasi="4" ORDER BY a.id_mutasi DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }

    function stok_masuk_lokasi($id){
        $gd_intransit       = $this->db->query("SELECT id_lokasi AS id_intransit,lokasi FROM m_lokasi WHERE aktif='Y' AND intransit='Y'")->row();
        $id_intransit       = $gd_intransit->id_intransit;
        $lokasi             = $gd_intransit->lokasi;

        $data   = $this->db->query("SELECT a.id_mutasi_detail,a.id_barang,a.qty,a.lot_no,a.tgl_kadaluwarsa,b.id_lokasi,a.id_stok,b.id_lokasi_tujuan,b.id_sub_lokasi,b.tgl,
                            b.no_mutasi,a.harga_perolehan
                            FROM t_mutasi_detail a LEFT JOIN t_mutasi b on a.id_mutasi=b.id_mutasi WHERE a.id_mutasi='".$id."'")->result();

        // Mengurangi Stok dari Lokasi Awal
        // foreach ($data as $key => $value) {
        //     $qty_stok   = $this->db->query("SELECT qty FROM t_stok WHERE id_stok='".$value->id_stok."'")->row()->qty;
        //     $stok_akhir = $qty_stok - $value->qty;
        //     $this->db->query("UPDATE t_stok SET qty = '".$stok_akhir."' WHERE id_stok = '".$value->id_stok."'");
        // }

        // Menambah Stok Ke Lokasi Tujuan
        $data2   = $this->db->query("SELECT a.id_mutasi_detail,a.id_barang,a.qty,a.lot_no,a.tgl_kadaluwarsa,b.id_lokasi,b.id_lokasi_tujuan,b.id_sub_lokasi,b.tgl,b.no_mutasi,
                            a.harga_perolehan
                            FROM t_mutasi_detail a LEFT JOIN t_mutasi b on a.id_mutasi=b.id_mutasi WHERE a.id_mutasi='".$id."'")->result();

        // foreach ($data2 as $key => $value) {
        //     $this->db->query("INSERT INTO t_stok (id_barang,qty,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi)VALUE
        //     ('".$value->id_barang."','".$value->qty."','".$value->lot_no."','".$value->tgl_kadaluwarsa."','".$id_intransit."','".$value->id_sub_lokasi."')");
        // }

        // Mengurangi Stok di History
        foreach ($data as $key => $value) {
            // $query      = $this->db->query("SELECT current_stock FROM `t_stok_detail` WHERE id_barang='".$value->id_barang."' AND id_lokasi='".$value->id_lokasi."'
            //                                 AND lot_no='".$value->lot_no."' ORDER BY id_stok DESC LIMIT 1");
            // $current    = $query->num_rows();
            // $old        = $query->row()->current_stock;

            // $current_stock      = $old - $value->qty;

            // $this->db->query("INSERT INTO t_stok_detail (id_barang,tgl_transaksi,old_stock,qty_in,qty_out,current_stock,lot_no,tgl_kadaluwarsa,id_lokasi)VALUES
            // ('".$value->id_barang."','".$value->tgl."','".$old."','0','".$value->qty."','".$current_stock."','".$value->lot_no."','".$value->tgl_kadaluwarsa."','".$value->id_lokasi."')");

            $this->db->query("INSERT INTO t_stok (id_barang,tgl_transaksi,no_mutasi,tipe_mutasi,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi,qty,harga_perolehan)VALUES
                            ('".$value->id_barang."','".$value->tgl."','".$value->no_mutasi."','".$value->tipe_mutasi."','".strtoupper($value->lot_no)."','".$value->tgl_kadaluwarsa."','".$value->id_lokasi."','".$value->id_sub_lokasi."','-".$value->qty."','".$value->harga_perolehan."')");

        }

        // Menambah Stok di History
        foreach ($data2 as $key => $value) {
            // $query      = $this->db->query("SELECT current_stock FROM `t_stok_detail` WHERE id_barang='".$value->id_barang."' AND id_lokasi='".$value->id_lokasi_tujuan."'");
            // $current    = $query->num_rows();

            // if($current==0){
            //     $old    = 0;
            // }else{
            //     $old    = $query->row()->current_stock;
            // }

            // $current_stock      = $old + $value->qty;

            // $this->db->query("INSERT INTO t_stok_detail (id_barang,tgl_transaksi,old_stock,qty_in,qty_out,current_stock,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi)VALUES
            // ('".$value->id_barang."','".$value->tgl."','".$old."','".$value->qty."','0','".$current_stock."','".$value->lot_no."','".$value->tgl_kadaluwarsa."','".$id_intransit."','".$value->id_sub_lokasi."')");

            $this->db->query("INSERT INTO t_stok (id_barang,tgl_transaksi,no_mutasi,tipe_mutasi,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi,qty,harga_perolehan)VALUES
                            ('".$value->id_barang."','".$value->tgl."','".$value->no_mutasi."','".$value->tipe_mutasi."','".strtoupper($value->lot_no)."','".$value->tgl_kadaluwarsa."','".$id_intransit."','".$value->id_sub_lokasi."','".$value->qty."','".$value->harga_perolehan."')");

        }

    }

    function create_mutasi($id){
        $header         = $this->db->query("SELECT no_mutasi,tgl,keterangan,no_referensi,id_lokasi,id_sub_lokasi,id_lokasi_tujuan,status_mutasi,tipe_mutasi,id_username,tgl_update FROM t_mutasi WHERE id_mutasi='".$id."'")->row();

        $gd_intransit       = $this->db->query("SELECT id_lokasi AS id_intransit,lokasi FROM m_lokasi WHERE aktif='Y' AND intransit='Y'")->row();
        $id_intransit       = $gd_intransit->id_intransit;
        $lokasi             = $gd_intransit->lokasi;

        $periode            = date('Y').date('m');
        $id_mutasi          = $this->max_id()->id_mutasi;
        $no_mutasi          = $periode.'5'.$this->max_nomor('4',$periode)->no_mutasi;

        $tanggal            = date('Y').'-'.date('m').'-'.date('d');
        $keterangan         = $header->keterangan;
        $id_lokasi          = $header->id_lokasi;
        $id_lokasi_tujuan   = $header->id_lokasi_tujuan;
        $id_sub_lokasi      = $header->id_sub_lokasi;
		
		/*
		edited by : Firman
		$sql    = "INSERT INTO t_mutasi (id_mutasi,no_mutasi,tgl,keterangan,id_lokasi,id_sub_lokasi,status_mutasi,tipe_mutasi,id_sumber,id_username,tgl_update,approve_mutasi,id_lokasi_tujuan,no_referensi)
            VALUES
            ('".$id_mutasi."','".$no_mutasi."','".$tanggal."','".$keterangan."','".$id_lokasi_tujuan."','".$id_sub_lokasi."','5','Mutasi Lokasi Masuk','".$id_sumber."','".$this->current_user['id_username']."','".dbnow()."','1','0','".$header->no_mutasi."')";
        $query = $this->db->query($sql);*/
        
        $sql    = "INSERT INTO t_mutasi (id_mutasi,no_mutasi,tgl,keterangan,id_lokasi,id_sub_lokasi,status_mutasi,tipe_mutasi,id_sumber,id_username,tgl_update,approve_mutasi,id_lokasi_tujuan,no_referensi)
            VALUES
            ('".$id_mutasi."','".$no_mutasi."','".$tanggal."','".$keterangan."','".$id_lokasi_tujuan."','".$id_sub_lokasi."','5','Mutasi Lokasi Masuk','".$id_sumber."','".$this->current_user['id_username']."','".dbnow()."','1','0','".$header->no_mutasi."')";
        $query = $this->db->query($sql);

        $detail             = $this->db->query("SELECT id_stok,id_barang,qty,harga_perolehan,lot_no,tgl_kadaluwarsa FROM t_mutasi_detail WHERE id_mutasi='".$id."'")->result_array();

        foreach ($detail as $key => $value) {
            // test($value['id_stok'],1);
            $id_detail      = $this->max_id_detail()->id_mutasi_detail;

            $sql_detail     = "INSERT INTO t_mutasi_detail (id_mutasi_detail,id_mutasi,id_stok,id_barang,qty,lot_no,tgl_kadaluwarsa,harga_perolehan)VALUES
                                        ('".$id_detail."','".$id_mutasi."','".$value['id_stok']."','".$value['id_barang']."','".$value['qty']."',
                                            '".strtoupper($value['lot_no'])."','".$value['tgl_kadaluwarsa']."','".$value['harga_perolehan']."')";
                                            // test($sql_detail,0);
            $query          = $this->db->query($sql_detail);
        }

        return $id_mutasi;

    }

    function stok_masuk_tujuan($id,$insert_mutasi){
        $gd_intransit       = $this->db->query("SELECT id_lokasi AS id_intransit,lokasi FROM m_lokasi WHERE aktif='Y' AND intransit='Y'")->row();
        $id_intransit       = $gd_intransit->id_intransit;
        $lokasi             = $gd_intransit->lokasi;

        $data   = $this->db->query("SELECT a.id_mutasi_detail,a.id_barang,a.qty,a.lot_no,a.tgl_kadaluwarsa,b.id_lokasi,a.id_stok,b.id_lokasi_tujuan,b.id_sub_lokasi,b.tgl,
                            b.no_mutasi,a.harga_perolehan
                            FROM t_mutasi_detail a LEFT JOIN t_mutasi b on a.id_mutasi=b.id_mutasi WHERE a.id_mutasi='".$id."'")->result();

        // Mengurangi Stok dari Lokasi Awal
        // foreach ($data as $key => $value) {
        //     $qty_stok   = $this->db->query("SELECT qty FROM t_stok WHERE id_stok='".$value->id_stok."'")->row()->qty;
        //     $stok_akhir = $qty_stok - $value->qty;
        //     $this->db->query("UPDATE t_stok SET qty = '".$stok_akhir."' WHERE id_stok = '".$value->id_stok."'");
        // }

        // Menambah Stok Ke Lokasi Tujuan
        $data2   = $this->db->query("SELECT a.id_mutasi_detail,a.id_barang,a.qty,a.lot_no,a.tgl_kadaluwarsa,b.id_lokasi,b.id_lokasi_tujuan,b.id_sub_lokasi,b.tgl,b.no_mutasi,
                            a.harga_perolehan
                            FROM t_mutasi_detail a LEFT JOIN t_mutasi b on a.id_mutasi=b.id_mutasi WHERE a.id_mutasi='".$insert_mutasi."'")->result();

        // foreach ($data2 as $key => $value) {
        //     $this->db->query("INSERT INTO t_stok (id_barang,qty,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi)VALUE
        //     ('".$value->id_barang."','".$value->qty."','".$value->lot_no."','".$value->tgl_kadaluwarsa."','".$value->id_lokasi."','".$value->id_sub_lokasi."')");
        // }

        // Mengurangi Stok di History
        foreach ($data as $key => $value) {
            // $query      = $this->db->query("SELECT current_stock FROM `t_stok_detail` WHERE id_barang='".$value->id_barang."' AND id_lokasi='".$value->id_lokasi."'
            //                                 AND lot_no='".$value->lot_no."' ORDER BY id_stok DESC LIMIT 1");
            // $current    = $query->num_rows();
            // $old        = $query->row()->current_stock;

            // $current_stock      = $old - $value->qty;

            // $this->db->query("INSERT INTO t_stok_detail (id_barang,tgl_transaksi,old_stock,qty_in,qty_out,current_stock,lot_no,tgl_kadaluwarsa,id_lokasi)VALUES
            // ('".$value->id_barang."','".$value->tgl."','".$old."','0','".$value->qty."','".$current_stock."','".$value->lot_no."','".$value->tgl_kadaluwarsa."','".$id_intransit."')");

            $this->db->query("INSERT INTO t_stok (id_barang,tgl_transaksi,no_mutasi,tipe_mutasi,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi,qty,harga_perolehan)VALUES
                            ('".$value->id_barang."','".$value->tgl."','".$value->no_mutasi."','Mutasi Lokasi Keluar','".strtoupper($value->lot_no)."','".$value->tgl_kadaluwarsa."','".$id_intransit."','".$value->id_sub_lokasi."','-".$value->qty."','".$value->harga_perolehan."')");

        }

        // Menambah Stok di History
        foreach ($data2 as $key => $value) {
            // $query      = $this->db->query("SELECT current_stock FROM `t_stok_detail` WHERE id_barang='".$value->id_barang."' AND id_lokasi='".$value->id_lokasi_tujuan."'");
            // $current    = $query->num_rows();

            // if($current==0){
            //     $old    = 0;
            // }else{
            //     $old    = $query->row()->current_stock;
            // }

            // $current_stock      = $old + $value->qty;

            // $this->db->query("INSERT INTO t_stok_detail (id_barang,tgl_transaksi,old_stock,qty_in,qty_out,current_stock,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi)VALUES
            // ('".$value->id_barang."','".$value->tgl."','".$old."','".$value->qty."','0','".$current_stock."','".$value->lot_no."','".$value->tgl_kadaluwarsa."','".$id_intransit."','".$value->id_sub_lokasi."')");

            $this->db->query("INSERT INTO t_stok (id_barang,tgl_transaksi,no_mutasi,tipe_mutasi,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi,qty,harga_perolehan)VALUES
                            ('".$value->id_barang."','".$value->tgl."','".$value->no_mutasi."','Mutasi Lokasi Masuk','".strtoupper($value->lot_no)."','".$value->tgl_kadaluwarsa."','".$value->id_lokasi."','".$value->id_sub_lokasi."','".$value->qty."','".$value->harga_perolehan."')");

        }

    }

    function get_all_lokasi_keluar_view_masuk(){
        $sql ='SELECT a.id_mutasi,a.no_mutasi,a.tgl,a.keterangan,a.id_lokasi,a.approve_mutasi,b.lokasi,c.no_mutasi no_referensi
                FROM t_mutasi a 
                LEFT JOIN m_lokasi b ON a.id_lokasi=b.id_lokasi
                LEFT JOIN t_mutasi c ON a.no_mutasi=c.no_referensi
                 WHERE a.status_mutasi="4" ORDER BY a.id_mutasi DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }

    function sub_lokasi($id_lokasi,$id_barang){
        $sql ='SELECT lot_no FROM t_stok WHERE id_lokasi="'.$id_lokasi.'" AND id_barang="'.$id_barang.'" GROUP BY lot_no';
        $query = $this->db->query($sql);
        return $query->result();
    }

    function kategori_stok($id,$tgl_dari){
        $sql    = "SELECT a.no_mutasi,b.nama,b.barcode,b.kd_barang,b.id_kat_barang,b.id_satuan,b.id_vendor,b.id_kat_barang,SUM(a.qty)qty,
                    (SELECT harga_perolehan FROM t_mutasi_detail WHERE id_barang=a.id_barang AND (harga_perolehan<>'' OR harga_perolehan<>'0') ORDER BY id_stok DESC LIMIT 1) harga_perolehan,d.satuan,
                    f.kategori,f.id_kat_barang,g.kategori_sub,c.nm_vendor
                    FROM m_barang b
                    LEFT JOIN t_stok a ON a.id_barang=b.id_barang AND a.tgl_transaksi <= '".$tgl_dari."'
                    LEFT JOIN m_satuan d ON b.id_satuan=d.id_satuan 
                    LEFT JOIN m_kat_barang f ON b.id_kat_barang=f.id_kat_barang
                    LEFT JOIN m_kat_barang_sub g ON b.id_kat_barang_sub=g.id_kat_barang_sub
                    LEFT JOIN m_vendor c ON c.id_vendor=b.id_vendor
                    WHERE b.id_kat_barang='".$id."' ";
        $sql    .= " GROUP BY b.id_barang ORDER BY b.nama ";
        // test($sql,1);
        $query = $this->db->query($sql);
        return $query->result();
    }

    function pemakaian_stok_report($year,$month,$id,$sumber){

        $sql    = "SELECT b.nama,b.barcode,b.kd_barang,b.kd_ekatalog,b.id_kat_barang,b.id_satuan,b.id_vendor,b.id_kat_barang,SUM(a.qty)qty, ";
        if($sumber==1){
            $sql   .= "IFNULL((SELECT harga_barang FROM m_harga WHERE id_barang=b.id_barang AND tahun='".$year."' ORDER BY harga_id DESC LIMIT 1),0)
                    harga_perolehan ";
        }else{
            $sql   .= "IFNULL((SELECT harga_perolehan FROM t_mutasi_detail WHERE id_barang=b.id_barang AND (harga_perolehan<>'' OR harga_perolehan<>'0') 
                    ORDER BY id_stok DESC LIMIT 1),0) harga_perolehan ";
        }
        $sql   .= " ,d.satuan,f.kategori,f.id_kat_barang,g.kategori_sub,c.nm_vendor,
                IFNULL((SELECT SUM(qty)qty FROM t_stok WHERE id_barang=b.id_barang AND SUBSTR(tgl_transaksi,6,2)<'".$month."' AND 
                    YEAR(tgl_transaksi)='".$year."'),0) saldo_awal,
                IFNULL((SELECT SUM(qty)qty FROM t_stok WHERE qty>0 AND id_barang=b.id_barang AND SUBSTR(tgl_transaksi,6,2)='".$month."' AND 
                    YEAR(tgl_transaksi)='".$year."'),0) penerimaan,
                IFNULL((SELECT SUM(qty)qty FROM t_stok WHERE qty<0 AND id_barang=b.id_barang AND SUBSTR(tgl_transaksi,6,2)='".$month."' AND 
                    YEAR(tgl_transaksi)='".$year."'),0) pemakaian,
                IFNULL((SELECT ABS(SUM(qty)) qty FROM t_stok WHERE id_barang=b.id_barang AND tipe_mutasi='Keluar' AND SUBSTR(tgl_transaksi,6,2)='".$month."' AND YEAR(tgl_transaksi)='".$year."'),0) stok_akhir
                FROM m_barang b
                LEFT JOIN t_stok a ON a.id_barang=b.id_barang AND SUBSTR(a.tgl_transaksi,6,2)='".$month."' AND YEAR(a.tgl_transaksi)='".$year."'
                LEFT JOIN m_satuan d ON b.id_satuan=d.id_satuan 
                LEFT JOIN m_kat_barang f ON b.id_kat_barang=f.id_kat_barang
                LEFT JOIN m_kat_barang_sub g ON b.id_kat_barang_sub=g.id_kat_barang_sub
                LEFT JOIN m_vendor c ON c.id_vendor=b.id_vendor
                WHERE b.id_kat_barang='".$id."' ";
        $sql    .= " GROUP BY b.id_barang ORDER BY b.nama ";
        // test($sql,1);
        $query = $this->db->query($sql);
        return $query->result();
    }

    function detail_mutasi($id){
        $sql        = $this->db->query("SELECT a.*,b.* FROM t_mutasi_detail a,t_mutasi b WHERE a.id_mutasi_detail='".$id."' AND a.id_mutasi=b.id_mutasi")->row();
        return $sql;
    }

    function cek_stok_mutasi($id,$lot){
        $sql        = $this->db->query("SELECT id_barang,lot_no,SUM(qty)qty FROM t_stok WHERE id_barang='".$id."' AND lot_no='".$lot."'")->row();
        return $sql;
    }

























    






















    

}   