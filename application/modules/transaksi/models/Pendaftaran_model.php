<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Pendaftaran_model extends CI_Model
{
    function get_all()
    {
        $sql ='SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,
                a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,
                (SELECT COUNT(*) jmlh FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND nilai<>"") AS jmlh
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
                a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,REPLACE(a.no_pendaftaran,"/","-") nopendaftar,
                (SELECT COUNT(*) jmlh FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND nilai<>"") AS jmlh , jenis_spesimen , status_bayar
                FROM t_pendaftaran a 
                LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
                LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
                LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
                WHERE a.status="1" AND a.kd_lab="LK"
                ORDER BY a.tgl_input DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }
    function get_all_lingkungan()
    {
        $sql ='SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,
                a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,REPLACE(a.no_pendaftaran,"/","-") nopendaftar,
                (SELECT COUNT(*) jmlh FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND nilai<>"") AS jmlh , status_bayar
                FROM t_pendaftaran a 
                LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
                LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
                LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
                WHERE a.status="1" AND a.kd_lab="LL"
                ORDER BY a.tgl_input DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }
    function get_all_maknum(){
        $sql ='SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,
                a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,REPLACE(a.no_pendaftaran,"/","-") nopendaftar,
                (SELECT COUNT(*) jmlh FROM t_pendaftaran_detail WHERE no_pendaftaran=a.no_pendaftaran AND nilai<>"") AS jmlh , status_bayar
                FROM t_pendaftaran a 
                LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
                LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
                LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
                WHERE a.status="1" AND a.kd_lab="LM"
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
                                     AND YEAR(tgl_input)='".$y."'")->row();
        return $query;
    }
    function act_form_klinik(){
        $new_klinik   = $this->session->userdata('new_klinik');
        // test($new_klinik,1);
        // LK/2019/11/00001
        $kd_lab             = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_lab')));
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $alamat             = $this->security->xss_clean($this->db->escape_str($this->input->post('alamat')));
        $telp               = $this->security->xss_clean($this->db->escape_str($this->input->post('telp')));
        $kd_sampel          = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_sampel')));
        $uraian_sampel      = $this->security->xss_clean($this->db->escape_str($this->input->post('uraian_sampel')));
        $ket_sampel         = $this->security->xss_clean($this->db->escape_str($this->input->post('ket_sampel')));
        $kondisi            = $this->security->xss_clean($this->db->escape_str($this->input->post('kondisi')));
        $banyak             = $this->security->xss_clean($this->db->escape_str($this->input->post('banyak')));
        $jns_analisa        = $this->security->xss_clean($this->db->escape_str($this->input->post('jns_analisa')));
        // $umur               = $this->security->xss_clean($this->db->escape_str($this->input->post('umur')));
        $dokter             = $this->security->xss_clean($this->db->escape_str($this->input->post('dokter')));
        $diagnosa           = $this->security->xss_clean($this->db->escape_str($this->input->post('diagnosa')));
        $jns_kelamin        = $this->security->xss_clean($this->db->escape_str($this->input->post('jns_kelamin')));
        $lokasi             = $this->security->xss_clean($this->db->escape_str($this->input->post('lokasi')));
        $jenis_spesimen     = $this->security->xss_clean($this->db->escape_str($this->input->post('jenis_spesimen')));
        $volume             = $this->security->xss_clean($this->db->escape_str($this->input->post('volume')));
        $no_pendaftaran     = $kd_lab.'/'.date('Y').'/'.date('m').'/'.$this->max_nomor($kd_lab,date('m'),date('Y'))->nomor;
        $keterangan         = $this->security->xss_clean($this->db->escape_str($this->input->post('keterangan')));
        if($this->input->post('tgl_diterima')!=''){
            $tgl_diterima   = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_diterima')));
        }else{
            $tgl_diterima   = '0000-00-00';
        }
        if($this->input->post('tgl_pengujian')!=''){
            $tgl_pengujian  = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_pengujian')));
        }else{
            $tgl_pengujian  = '0000-00-00';
        }
        if($this->input->post('tgl_selesai')!=''){
            $tgl_selesai    = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_selesai')));
        }else{
            $tgl_selesai    = '0000-00-00';
        }
        // $tgl_selesai        = date('Y-m-d', strtotime('+1 days', strtotime($tgl_diterima)));
        // test($tgl_selesai.' '.$tgl_diterima,1);
        $tgl_spesimen       = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_spesimen')));
        $tgl_lahir          = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_lahir')));
        $kd_parameter          = '0';
        $tanggal_lahir  = date('Y-m-d', strtotime($tgl_lahir));
        $birthDate      = new \DateTime($tanggal_lahir);
        $today          = new \DateTime("today");
        $umur           = 0;
        if ($birthDate < $today) {
            $umur       = $today->diff($birthDate)->y;
        }
        $sql    = "INSERT INTO t_pendaftaran
                    (no_pendaftaran,nama,alamat,telp,uraian_sampel,kd_sampel,kondisi,banyak,tgl_diterima,tgl_pengujian,tgl_selesai,kd_lab,kd_parameter,jns_analisa,
                    tgl_input,`status`,ket_sampel,umur,dokter,diagnosa_klinik,jns_kelamin,telepon,tgl_lahir,tgl_spesimen,id_username,lokasi,volume,jenis_spesimen,keterangan)VALUES
                    ('".$no_pendaftaran."','".$nama."','".$alamat."','".$telp."','".$uraian_sampel."','".$kd_sampel."','".$kondisi."','".$banyak."',
                    '".$tgl_diterima."','".$tgl_pengujian."','".$tgl_selesai."','".$kd_lab."','".$kd_parameter."','".$jns_analisa."','".dbnow()."','1',
                    '".$ket_sampel."','".$umur."','".$dokter."','".$diagnosa."','".$jns_kelamin."','".$telp."','".$tgl_lahir."','".$tgl_spesimen."'
                    ,'".$this->current_user['id_username']."','".$lokasi."','".$volume."','".$jenis_spesimen."','".$keterangan."')";
        $query = $this->db->query($sql);
        if($this->input->post('kode_metode')){
            $items          = $this->input->post('kode_metode');
            foreach ($items as $key => $value1) {
                $m_parameter                = $this->db->query("SELECT kd_kategori_parameter,harga FROM m_parameter WHERE kd_parameter='".$value1."'")->row();
                $kd_kategori_parameter      = $m_parameter->kd_kategori_parameter;
                $harga                      = $m_parameter->harga;
                $nilai      = '';
                $nilai2     = '';
                $ket        = '';
                $this->db->query("INSERT INTO t_pendaftaran_detail (no_pendaftaran,kd_parameter,nilai,nilai2,kd_kategori_parameter,ket,harga)VALUES
                                ('".$no_pendaftaran."','".$value1."','".$nilai."','".$nilai2."','".$kd_kategori_parameter."','".$ket."','".$harga."')");
                // foreach ($this->get_metode_id($kd_kategori_parameter) as $key => $value2) {
                // }
            }
        }
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
    function act_delete(){
        $sql = "UPDATE t_pendaftaran SET `status` = '0' WHERE no_pendaftaran = '".$this->input->post('nomor')."'";
        $query = $this->db->query($sql);
        return $query;
    }
    function act_form_lingkungan(){
        $new_lingkungan   = $this->session->userdata('new_lingkungan');
        // test($new_lingkungan,1);
        // LK/2019/11/00001
        $kd_lab             = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_lab')));
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $alamat             = $this->security->xss_clean($this->db->escape_str($this->input->post('alamat')));
        $telp               = $this->security->xss_clean($this->db->escape_str($this->input->post('telp')));
        $kd_sampel          = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_sampel')));
        $uraian_sampel      = '';
        $ket_sampel         = $this->security->xss_clean($this->db->escape_str($this->input->post('ket_sampel')));
        $kondisi            = $this->security->xss_clean($this->db->escape_str($this->input->post('kondisi')));
        $banyak             = '';
        $jns_analisa        = $this->security->xss_clean($this->db->escape_str($this->input->post('jns_analisa')));
        $lokasi             = $this->security->xss_clean($this->db->escape_str($this->input->post('lokasi')));
        $volume             = $this->security->xss_clean($this->db->escape_str($this->input->post('volume')));
        $umur               = '';
        $dokter             = '';
        $diagnosa           = '';
        $jns_kelamin        = '';
        $no_pendaftaran     = $kd_lab.'/'.date('Y').'/'.date('m').'/'.$this->max_nomor($kd_lab,date('m'),date('Y'))->nomor;
        if($this->input->post('tgl_diterima')!=''){
            $tgl_diterima   = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_diterima')));
        }else{
            $tgl_diterima   = '0000-00-00';
        }
        if($this->input->post('tgl_pengujian')!=''){
            $tgl_pengujian  = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_pengujian')));
        }else{
            $tgl_pengujian  = '0000-00-00';
        }
        // $tgl_selesai        = date('Y-m-d', strtotime('+15 days', strtotime($tgl_diterima)));
        if($this->input->post('tgl_selesai')!=''){
            $tgl_selesai    = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_selesai')));
        }else{
            $tgl_selesai    = '0000-00-00';
        }
        // $tgl_spesimen       = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_spesimen')));
        $tgl_spesimen       = '2000-01-01 00:00:00';
        $tgl_lahir          = '2000-01-01';
        $kd_parameter          = '0';
        $sql    = "INSERT INTO t_pendaftaran
                    (no_pendaftaran,nama,alamat,telp,uraian_sampel,kd_sampel,kondisi,banyak,tgl_diterima,tgl_pengujian,tgl_selesai,kd_lab,kd_parameter,jns_analisa,
                    tgl_input,`status`,ket_sampel,umur,dokter,diagnosa_klinik,jns_kelamin,telepon,tgl_lahir,tgl_spesimen,id_username,lokasi,volume)VALUES
                    ('".$no_pendaftaran."','".$nama."','".$alamat."','".$telp."','".$uraian_sampel."','".$kd_sampel."',
                    '".$kondisi."','".$banyak."','".$tgl_diterima."','".$tgl_pengujian."','".$tgl_selesai."','".$kd_lab."',
                    '".$kd_parameter."','".$jns_analisa."','".dbnow()."','1','".$ket_sampel."','".$umur."','".$dokter."',
                    '".$diagnosa."','".$jns_kelamin."','".$telp."','".$tgl_lahir."','".$tgl_spesimen."','".$this->current_user['id_username']."','".$lokasi."','".$volume."')";
        $query = $this->db->query($sql);
        if($this->input->post('kode_metode')){
            $items          = $this->input->post('kode_metode');
            foreach ($items as $key => $value1) {
                $m_parameter                = $this->db->query("SELECT kd_kategori_parameter,harga FROM m_parameter WHERE kd_parameter='".$value1."'")->row();
                $kd_kategori_parameter      = $m_parameter->kd_kategori_parameter;
                $harga                      = $m_parameter->harga;
                $nilai      = '';
                $nilai2     = '';
                $ket        = '';
                $this->db->query("INSERT INTO t_pendaftaran_detail (no_pendaftaran,kd_parameter,nilai,nilai2,kd_kategori_parameter,ket,harga)VALUES
                                ('".$no_pendaftaran."','".$value1."','".$nilai."','".$nilai2."','".$kd_kategori_parameter."','".$ket."','".$harga."')");
            }
        }
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
    function act_form_maknum(){
        $new_maknum   = $this->session->userdata('new_maknum');
        // test($new_maknum,1);
        // LK/2019/11/00001
        $kd_lab             = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_lab')));
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $alamat             = $this->security->xss_clean($this->db->escape_str($this->input->post('alamat')));
        $kd_sampel          = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_sampel')));
        $uraian_sampel      = $this->security->xss_clean($this->db->escape_str($this->input->post('uraian_sampel')));
        $ket_sampel         = $this->security->xss_clean($this->db->escape_str($this->input->post('ket_sampel')));
        $banyak             = $this->security->xss_clean($this->db->escape_str($this->input->post('banyak')));
        $lokasi             = $this->security->xss_clean($this->db->escape_str($this->input->post('lokasi')));
        $keterangan         = $this->security->xss_clean($this->db->escape_str($this->input->post('keterangan')));
        $telp               = $this->security->xss_clean($this->db->escape_str($this->input->post('telp')));
        $jns_analisa        = '';
        // $telp               = '';
        $kondisi            = '';
        $umur               = '';
        $dokter             = '';
        $diagnosa           = '';
        $jns_kelamin        = '';
        $no_pendaftaran     = $kd_lab.'/'.date('Y').'/'.date('m').'/'.$this->max_nomor($kd_lab,date('m'),date('Y'))->nomor;
        if($this->input->post('tgl_diterima')!=''){
            $tgl_diterima   = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_diterima')));
        }else{
            $tgl_diterima   = '0000-00-00';
        }
        if($this->input->post('tgl_pengujian')!=''){
            $tgl_pengujian  = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_pengujian')));
        }else{
            $tgl_pengujian  = '0000-00-00';
        }
        // $tgl_selesai        = date('Y-m-d', strtotime('+20 days', strtotime($tgl_diterima)));
        if($this->input->post('tgl_selesai')!=''){
            $tgl_selesai    = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_selesai')));
        }else{
            $tgl_selesai    = '0000-00-00';
        }
        // $tgl_spesimen       = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_spesimen')));
        $tgl_spesimen       = '2000-01-01 00:00:00';
        $tgl_lahir          = '1970-01-01';
        $kd_parameter          = '0';
        $sql    = "INSERT INTO t_pendaftaran
                    (no_pendaftaran,nama,alamat,telp,uraian_sampel,kd_sampel,kondisi,banyak,tgl_diterima,tgl_pengujian,tgl_selesai,kd_lab,kd_parameter,jns_analisa,
                    tgl_input,`status`,ket_sampel,umur,dokter,diagnosa_klinik,jns_kelamin,telepon,tgl_lahir,tgl_spesimen,id_username,lokasi,keterangan)VALUES
                    ('".$no_pendaftaran."','".$nama."','".$alamat."','".$telp."','".$uraian_sampel."','".$kd_sampel."','".$kondisi."','".$banyak."',
                    '".$tgl_diterima."','".$tgl_pengujian."','".$tgl_selesai."','".$kd_lab."','".$kd_parameter."','".$jns_analisa."','".dbnow()."','1',
                    '".$ket_sampel."','".$umur."','".$dokter."','".$diagnosa."','".$jns_kelamin."','".$telp."','".$tgl_lahir."','".$tgl_spesimen."'
                    ,'".$this->current_user['id_username']."','".$lokasi."','".$keterangan."')";
        // test($new_maknum['items'],1);
        $query = $this->db->query($sql);
        if($this->input->post('kode_metode')){
            $items          = $this->input->post('kode_metode');
            foreach ($items as $key => $value1) {
                $m_parameter                = $this->db->query("SELECT kd_kategori_parameter,harga FROM m_parameter WHERE kd_parameter='".$value1."'")->row();
                $kd_kategori_parameter      = $m_parameter->kd_kategori_parameter;
                $harga                      = $m_parameter->harga;
                $nilai      = '';
                $nilai2     = '';
                $ket        = '';
                $this->db->query("INSERT INTO t_pendaftaran_detail (no_pendaftaran,kd_parameter,nilai,nilai2,kd_kategori_parameter,ket,harga)VALUES
                                ('".$no_pendaftaran."','".$value1."','".$nilai."','".$nilai2."','".$kd_kategori_parameter."','".$ket."','".$harga."')");
                // foreach ($this->get_metode_id($kd_kategori_parameter) as $key => $value2) {
                // }
            }
        }
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
    function header_pendaftaran($id){
        $query      = $this->db->query("SELECT a.*,b.nm_sampel FROM t_pendaftaran a LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel WHERE a.no_pendaftaran='".$id."'")->row();
        return $query;
    }
    function detail_pendaftaran($id){
        $query      = $this->db->query("SELECT a.*,b.nm_parameter,b.metode_analisa,c.nm_kategori_parameter FROM t_pendaftaran_detail a LEFT JOIN m_parameter b ON a.kd_parameter=b.kd_parameter
                                        LEFT JOIN m_kategori_parameter c ON a.kd_kategori_parameter=c.kd_kategori_parameter WHERE a.no_pendaftaran='".$id."'
										 order by c.zorder,b.zorder")->Result();
        return $query;
    }
    function detail_pendaftaran_par($id){
        $query      = $this->db->query("SELECT a.*,b.nm_parameter,c.nm_kategori_parameter FROM t_pendaftaran_detail a LEFT JOIN m_parameter b ON a.kd_parameter=b.kd_parameter
                                        LEFT JOIN m_kategori_parameter c ON a.kd_kategori_parameter=c.kd_kategori_parameter WHERE a.no_pendaftaran='".$id."' GROUP BY a.kd_kategori_parameter
										order by c.zorder,b.zorder")->Result();
        return $query;
    }
    function detail_metode_pendaftaran($id){
        $query      = $this->db->query("SELECT a.kd_parameter FROM t_pendaftaran_detail a WHERE a.no_pendaftaran='".$id."'");
        return $query;
    }
    function detail_parameter_pendaftaran($id){
        $query      = $this->db->query("SELECT a.*,b.nm_kategori_parameter FROM t_pendaftaran_detail a LEFT JOIN m_kategori_parameter b ON a.kd_kategori_parameter=b.kd_kategori_parameter 
                            WHERE a.no_pendaftaran='".$id."' GROUP BY a.kd_kategori_parameter");
        return $query;
    }
    function get_metode_id($id){
        $query = $this->db->query("SELECT kd_parameter FROM m_parameter WHERE kd_kategori_parameter='".$id."'")->result();
        return $query;
    }
    function act_edit_maknum(){
        $new_maknum   = $this->session->userdata('new_maknum');
        $no_pendaftaran     = $this->security->xss_clean($this->db->escape_str($this->input->post('no_pendaftaran')));
        $kd_lab             = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_lab')));
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $alamat             = $this->security->xss_clean($this->db->escape_str($this->input->post('alamat')));
        $kd_sampel          = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_sampel')));
        $uraian_sampel      = $this->security->xss_clean($this->db->escape_str($this->input->post('uraian_sampel')));
        $ket_sampel         = $this->security->xss_clean($this->db->escape_str($this->input->post('ket_sampel')));
        $banyak             = $this->security->xss_clean($this->db->escape_str($this->input->post('banyak')));
        $lokasi             = $this->security->xss_clean($this->db->escape_str($this->input->post('lokasi')));
        $keterangan         = $this->security->xss_clean($this->db->escape_str($this->input->post('keterangan')));
        $jns_analisa        = '';
        $telp               = '';
        $kondisi            = '';
        $umur               = '';
        $dokter             = '';
        $diagnosa           = '';
        $jns_kelamin        = '';
        if($this->input->post('tgl_diterima')!=''){
            $tgl_diterima   = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_diterima')));
        }else{
            $tgl_diterima   = '0000-00-00';
        }
        if($this->input->post('tgl_pengujian')!=''){
            $tgl_pengujian  = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_pengujian')));
        }else{
            $tgl_pengujian  = '0000-00-00';
        }
        // $tgl_selesai        = date('Y-m-d', strtotime('+20 days', strtotime($tgl_diterima)));
        if($this->input->post('tgl_selesai')!=''){
            $tgl_selesai    = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_selesai')));
        }else{
            $tgl_selesai    = '0000-00-00';
        }
        // $tgl_spesimen       = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_spesimen')));
        $tgl_spesimen       = '2000-01-01 00:00:00';
        $tgl_lahir          = '1970-01-01';
        $kd_parameter          = '0';
        $sql    = "UPDATE t_pendaftaran SET
                    nama = '".$nama."' ,
                    alamat = '".$alamat."' ,
                    telp = '".$telp."' ,
                    uraian_sampel = '".$uraian_sampel."' ,
                    kd_sampel = '".$kd_sampel."' ,
                    kondisi = '".$kondisi."' ,
                    banyak = '".$banyak."' ,
                    tgl_diterima = '".$tgl_diterima."' ,
                    tgl_pengujian = '".$tgl_pengujian."' ,
                    tgl_selesai = '".$tgl_selesai."' ,
                    kd_lab = '".$kd_lab."' ,
                    kd_parameter = '".$kd_parameter."' ,
                    jns_analisa = '".$jns_analisa."' ,
                    keterangan = '".$keterangan."',
                    tgl_input = '".dbnow()."' ,
                    `status` = '1' ,
                    ket_sampel = '".$ket_sampel."' ,
                    lokasi = '".$lokasi."' ,
                    umur = '".$umur."' ,
                    dokter = '".$dokter."' ,
                    diagnosa_klinik = '".$diagnosa."' ,
                    jns_kelamin = '".$jns_kelamin."' ,
                    telepon = '".$telp."' ,
                    tgl_lahir = '".$tgl_lahir."' ,
                    tgl_spesimen = '".$tgl_spesimen."' ,
                    id_username = '".$this->current_user['id_username']."'
                    WHERE no_pendaftaran = '".$no_pendaftaran."'";
        // test($sql,1);
        $query = $this->db->query($sql);
        $this->db->query("DELETE FROM t_pendaftaran_detail WHERE no_pendaftaran = '".$no_pendaftaran."'");
        if($this->input->post('kode_metode')){
            $items          = $this->input->post('kode_metode');
            foreach ($items as $key => $value1) {
                $m_parameter                = $this->db->query("SELECT kd_kategori_parameter,harga FROM m_parameter WHERE kd_parameter='".$value1."'")->row();
                $kd_kategori_parameter      = $m_parameter->kd_kategori_parameter;
                $harga                      = $m_parameter->harga;
                $nilai      = '';
                $nilai2     = '';
                $ket        = '';
                $this->db->query("INSERT INTO t_pendaftaran_detail (no_pendaftaran,kd_parameter,nilai,nilai2,kd_kategori_parameter,ket,harga)VALUES
                                ('".$no_pendaftaran."','".$value1."','".$nilai."','".$nilai2."','".$kd_kategori_parameter."','".$ket."','".$harga."')");
                // foreach ($this->get_metode_id($kd_kategori_parameter) as $key => $value2) {
                // }
            }
        }
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
    function act_edit_lengkungan(){
        $new_lingkungan   = $this->session->userdata('new_lingkungan');
        $no_pendaftaran     = $this->security->xss_clean($this->db->escape_str($this->input->post('no_pendaftaran')));
        $kd_lab             = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_lab')));
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $alamat             = $this->security->xss_clean($this->db->escape_str($this->input->post('alamat')));
        $telp               = $this->security->xss_clean($this->db->escape_str($this->input->post('telp')));
        $kd_sampel          = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_sampel')));
        $uraian_sampel      = '';
        $ket_sampel         = $this->security->xss_clean($this->db->escape_str($this->input->post('ket_sampel')));
        $kondisi            = $this->security->xss_clean($this->db->escape_str($this->input->post('kondisi')));
        $banyak             = '';
        $jns_analisa        = $this->security->xss_clean($this->db->escape_str($this->input->post('jns_analisa')));
        $lokasi             = $this->security->xss_clean($this->db->escape_str($this->input->post('lokasi')));
        $umur               = '';
        $dokter             = '';
        $diagnosa           = '';
        $jns_kelamin        = '';
        // $no_pendaftaran     = $kd_lab.'/'.date('Y').'/'.date('m').'/'.$this->max_nomor($kd_lab,date('m'),date('Y'))->nomor;
        if($this->input->post('tgl_diterima')!=''){
            $tgl_diterima   = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_diterima')));
        }else{
            $tgl_diterima   = '0000-00-00';
        }
        if($this->input->post('tgl_pengujian')!=''){
            $tgl_pengujian  = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_pengujian')));
        }else{
            $tgl_pengujian  = '0000-00-00';
        }
        // $tgl_selesai        = date('Y-m-d', strtotime('+15 days', strtotime($tgl_diterima)));
        if($this->input->post('tgl_selesai')!=''){
            $tgl_selesai    = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_selesai')));
        }else{
            $tgl_selesai    = '0000-00-00';
        }
        // $tgl_spesimen       = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_spesimen')));
        $tgl_spesimen       = '2000-01-01 00:00:00';
        $tgl_lahir          = '1970-01-01';
        $kd_parameter          = '0';
        $sql    = "UPDATE t_pendaftaran SET
                    nama = '".$nama."' ,
                    alamat = '".$alamat."' ,
                    telp = '".$telp."' ,
                    uraian_sampel = '".$uraian_sampel."' ,
                    kd_sampel = '".$kd_sampel."' ,
                    kondisi = '".$kondisi."' ,
                    banyak = '".$banyak."' ,
                    tgl_diterima = '".$tgl_diterima."' ,
                    tgl_pengujian = '".$tgl_pengujian."' ,
                    tgl_selesai = '".$tgl_selesai."' ,
                    kd_lab = '".$kd_lab."' ,
                    kd_parameter = '".$kd_parameter."' ,
                    jns_analisa = '".$jns_analisa."' ,
                    tgl_input = '".dbnow()."' ,
                    `status` = '1' ,
                    lokasi = '".$lokasi."' ,
                    ket_sampel = '".$ket_sampel."' ,
                    umur = '".$umur."' ,
                    dokter = '".$dokter."' ,
                    diagnosa_klinik = '".$diagnosa."' ,
                    jns_kelamin = '".$jns_kelamin."' ,
                    telepon = '".$telp."' ,
                    tgl_lahir = '".$tgl_lahir."' ,
                    tgl_spesimen = '".$tgl_spesimen."' ,
                    id_username = '".$this->current_user['id_username']."'
                    WHERE no_pendaftaran = '".$no_pendaftaran."'";
        // test($sql,1);
        $query = $this->db->query($sql);
        // test("DELETE FROM t_pendaftaran_detail WHERE no_pendaftaran = '".$no_pendaftaran."'",0);
        $delete     = $this->db->query("DELETE FROM t_pendaftaran_detail WHERE no_pendaftaran = '".$no_pendaftaran."'");
        // test($delete,0);
        // test($this->input->post('kode_metode'),1);
        if($this->input->post('kode_metode')){
            $items          = $this->input->post('kode_metode');
            foreach ($items as $key => $value1) {
                $m_parameter                = $this->db->query("SELECT kd_kategori_parameter,harga FROM m_parameter WHERE kd_parameter='".$value1."'")->row();
                $kd_kategori_parameter      = $m_parameter->kd_kategori_parameter;
                $harga                      = $m_parameter->harga;
                $nilai      = '';
                $nilai2     = '';
                $ket        = '';
                // test("INSERT INTO t_pendaftaran_detail (no_pendaftaran,kd_parameter,nilai,nilai2,kd_kategori_parameter,ket,harga)VALUES
                //                 ('".$no_pendaftaran."','".$value1."','".$nilai."','".$nilai2."','".$kd_kategori_parameter."','".$ket."','".$harga."')",0);
                $this->db->query("INSERT INTO t_pendaftaran_detail (no_pendaftaran,kd_parameter,nilai,nilai2,kd_kategori_parameter,ket,harga)VALUES
                                ('".$no_pendaftaran."','".$value1."','".$nilai."','".$nilai2."','".$kd_kategori_parameter."','".$ket."','".$harga."')");
            }
        }
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
    function act_edit_klinik(){
        $new_klinik   = $this->session->userdata('new_klinik');
        $no_pendaftaran     = $this->security->xss_clean($this->db->escape_str($this->input->post('no_pendaftaran')));
        $kd_lab             = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_lab')));
        $nama               = $this->security->xss_clean($this->db->escape_str($this->input->post('nama')));
        $alamat             = $this->security->xss_clean($this->db->escape_str($this->input->post('alamat')));
        $telp               = $this->security->xss_clean($this->db->escape_str($this->input->post('telp')));
        $kd_sampel          = $this->security->xss_clean($this->db->escape_str($this->input->post('kd_sampel')));
        $uraian_sampel      = $this->security->xss_clean($this->db->escape_str($this->input->post('uraian_sampel')));
        $ket_sampel         = $this->security->xss_clean($this->db->escape_str($this->input->post('ket_sampel')));
        $kondisi            = $this->security->xss_clean($this->db->escape_str($this->input->post('kondisi')));
        $banyak             = $this->security->xss_clean($this->db->escape_str($this->input->post('banyak')));
        $jns_analisa        = $this->security->xss_clean($this->db->escape_str($this->input->post('jns_analisa')));
        // $umur               = $this->security->xss_clean($this->db->escape_str($this->input->post('umur')));
        $dokter             = $this->security->xss_clean($this->db->escape_str($this->input->post('dokter')));
        $diagnosa           = $this->security->xss_clean($this->db->escape_str($this->input->post('diagnosa')));
        $jns_kelamin        = $this->security->xss_clean($this->db->escape_str($this->input->post('jns_kelamin')));
        $lokasi             = $this->security->xss_clean($this->db->escape_str($this->input->post('lokasi')));
        // $no_pendaftaran     = $kd_lab.'/'.date('Y').'/'.date('m').'/'.$this->max_nomor($kd_lab,date('m'),date('Y'))->nomor;
        $keterangan         = $this->security->xss_clean($this->db->escape_str($this->input->post('keterangan')));
        if($this->input->post('tgl_diterima')!=''){
            $tgl_diterima   = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_diterima')));
        }else{
            $tgl_diterima   = '0000-00-00';
        }
        if($this->input->post('tgl_pengujian')!=''){
            $tgl_pengujian  = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_pengujian')));
        }else{
            $tgl_pengujian  = '0000-00-00';
        }
        // $tgl_selesai        = date('Y-m-d', strtotime('+1 days', strtotime($tgl_diterima)));
        if($this->input->post('tgl_selesai')!=''){
            $tgl_selesai    = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_selesai')));
        }else{
            $tgl_selesai    = '0000-00-00';
        }
        $tgl_spesimen       = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_spesimen')));
        $tgl_lahir          = $this->security->xss_clean($this->db->escape_str($this->input->post('tgl_lahir')));
        $kd_parameter          = '0';
        $tanggal_lahir  = date('Y-m-d', strtotime($tgl_lahir));
        $birthDate      = new \DateTime($tanggal_lahir);
        $today          = new \DateTime("today");
        $umur           = 0;
        if ($birthDate < $today) {
            $umur       = $today->diff($birthDate)->y;
        }
        $sql    = "UPDATE t_pendaftaran SET
                    nama = '".$nama."' ,
                    alamat = '".$alamat."' ,
                    telp = '".$telp."' ,
                    uraian_sampel = '".$uraian_sampel."' ,
                    kd_sampel = '".$kd_sampel."' ,
                    kondisi = '".$kondisi."' ,
                    banyak = '".$banyak."' ,
                    tgl_diterima = '".$tgl_diterima."' ,
                    tgl_pengujian = '".$tgl_pengujian."' ,
                    tgl_selesai = '".$tgl_selesai."' ,
                    kd_lab = '".$kd_lab."' ,
                    kd_parameter = '".$kd_parameter."' ,
                    jns_analisa = '".$jns_analisa."' ,
                    tgl_input = '".dbnow()."' ,
                    `status` = '1' ,
                    lokasi = '".$lokasi."' ,
                    ket_sampel = '".$ket_sampel."' ,
                    umur = '".$umur."' ,
                    dokter = '".$dokter."' ,
                    diagnosa_klinik = '".$diagnosa."' ,
                    jns_kelamin = '".$jns_kelamin."' ,
                    telepon = '".$telp."' ,
                    tgl_lahir = '".$tgl_lahir."' ,
                    tgl_spesimen = '".$tgl_spesimen."' ,
                    keterangan = '".$keterangan."' ,
                    id_username = '".$this->current_user['id_username']."'
                    WHERE no_pendaftaran = '".$no_pendaftaran."'";
        // test($sql,1);
        $query = $this->db->query($sql);
        $this->db->query("DELETE FROM t_pendaftaran_detail WHERE no_pendaftaran = '".$no_pendaftaran."'");
        if($this->input->post('kode_metode')){
            $items          = $this->input->post('kode_metode');
            foreach ($items as $key => $value1) {
                $m_parameter                = $this->db->query("SELECT kd_kategori_parameter,harga , metode_analisa2 FROM m_parameter WHERE kd_parameter='".$value1."'")->row();
                $kd_kategori_parameter      = $m_parameter->kd_kategori_parameter;
                $harga                      = $m_parameter->harga;
                $metode_analisa             =$m_parameter->metode_analisa2;
                $nilai      = '';
                $nilai2     = '';
                $ket        = '';
                $this->db->query("INSERT INTO t_pendaftaran_detail (no_pendaftaran,kd_parameter,nilai,nilai2,kd_kategori_parameter,ket,harga , metode_analisa  )VALUES
                                ('".$no_pendaftaran."','".$value1."','".$nilai."','".$nilai2."','".$kd_kategori_parameter."','".$ket."','".$harga."' , '".$metode_analisa."' )");
            }
        }
        update_symbol_hasil();
        if ($query === false){
            return "ERROR INSERTT";
        }else{
            return $query; 
        }
    }
    // function max_id(){
    //     $query = $this->db->query("SELECT IFNULL(MAX(id_mutasi),0)+1 id_mutasi FROM t_mutasi")->row();
    //     return $query;
    // }
    // function max_id_detail(){
    //     $query = $this->db->query("SELECT IFNULL(MAX(id_mutasi_detail),0)+1 id_mutasi_detail FROM t_mutasi_detail")->row();
    //     return $query;
    // }
    // function update_status($id,$approve){
    //     return $this->db->query("UPDATE t_mutasi SET approve_mutasi = '".$approve."' WHERE id_mutasi = '".$id."'");
    // }
    // function stok($id){
    //     $data   = $this->db->query("SELECT a.id_mutasi_detail,a.id_barang,a.qty,a.lot_no,a.tgl_kadaluwarsa,b.id_lokasi 
    //                         FROM t_mutasi_detail a LEFT JOIN t_mutasi b on a.id_mutasi=b.id_mutasi WHERE a.id_mutasi='".$id."'")->result();
    //     foreach ($data as $key => $value) {
    //         $this->db->query("INSERT INTO t_stok (id_barang,qty,lot_no,tgl_kadaluwarsa,id_lokasi)VALUE
    //                 ('".$value->id_barang."','".$value->qty."','".$value->lot_no."','".$value->tgl_kadaluwarsa."','".$value->id_lokasi."')");
    //     }
    // }
    // function mutasi_detail($id){
    //     $sql    = "SELECT a.id_mutasi_detail,a.id_mutasi,a.id_barang,b.nama,a.qty,a.lot_no,a.tgl_kadaluwarsa FROM t_mutasi_detail a LEFT JOIN
    //                 m_barang b ON a.id_barang=b.id_barang
    //                 WHERE a.id_mutasi='".$id."'";
    //     $query  = $this->db->query($sql);
    //     return $query;
    // }
    // function mutasi_header($id){
    //     $sql    = "SELECT a.*,b.lokasi FROM t_mutasi a LEFT JOIN m_lokasi b ON a.id_lokasi=b.id_lokasi WHERE a.id_mutasi='".$id."'";
    //     $query  = $this->db->query($sql);
    //     return $query;
    // }
    // function act_edit_masuk(){
    //     $new_klinik   = $this->session->userdata('new_klinik');
    //     $bulan              = substr($this->input->post('tanggal'),0,2);
    //     $hari               = substr($this->input->post('tanggal'),3,2);
    //     $tahun              = substr($this->input->post('tanggal'),6,4);
    //     $tanggal            = $tahun.'-'.$bulan.'-'.$hari;
    //     $keterangan         = $this->security->xss_clean($this->db->escape_str($this->input->post('keterangan')));
    //     $id_lokasi          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_lokasi')));
    //     $id_mutasi          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_mutasi')));
    //     $sql    = "UPDATE t_mutasi SET tgl = '".$tanggal."',keterangan = '".$keterangan."',id_lokasi = '".$id_lokasi."' WHERE id_mutasi = '".$id_mutasi."'";
    //     $query = $this->db->query($sql);
    //     $delete = "DELETE FROM t_mutasi_detail WHERE id_mutasi = '".$id_mutasi."'";
    //     $query = $this->db->query($delete);
    //     if(isset($new_klinik['items'])){
    //         $items          = $new_klinik['items'];
    //         foreach ($items as $key => $value) {
    //             $id_detail      = $this->max_id_detail()->id_mutasi_detail;
    //             $bulan          = substr($value['kadaluarsa'],0,2);
    //             $hari           = substr($value['kadaluarsa'],3,2);
    //             $tahun          = substr($value['kadaluarsa'],6,4);
    //             $tanggal        = $tahun.'-'.$bulan.'-'.$hari;
    //             $sql_detail     = "INSERT INTO t_mutasi_detail (id_mutasi_detail,id_mutasi,id_barang,qty,lot_no,tgl_kadaluwarsa)
    //                             VALUES('".$id_detail."','".$id_mutasi."','".$value['id_barang']."','".$value['quantity']."','".$value['no_lot']."','".$tanggal."')";
    //             $query          = $this->db->query($sql_detail);
    //         }
    //     }
    //     if ($query === false){
    //         return "ERROR INSERTT";
    //     }else{
    //         return $query; 
    //     }
    // }
    // function get_all_keluar(){
    //     $sql ='SELECT a.id_mutasi,a.no_mutasi,a.tgl,a.keterangan,a.id_lokasi,a.approve_mutasi,b.lokasi FROM t_mutasi a LEFT JOIN m_lokasi b
    //             ON a.id_lokasi=b.id_lokasi where a.status_mutasi="2" ORDER BY a.id_mutasi DESC';
    //     $query = $this->db->query($sql);
    //     return $query->result();
    // }
    // function stok_barang($id){
    //     $query = $this->db->query(" SELECT * FROM stok_barang WHERE id_lokasi='".$id."' AND qty>=1 ")->result();                
    //     return $query;
    // }
    // function act_form_keluar(){
    //     $new_mutasi_keluar   = $this->session->userdata('new_mutasi_keluar');
    //     $periode            = date('Y').date('m');
    //     $id_mutasi          = $this->max_id()->id_mutasi;
    //     $no_mutasi          = $periode.'2'.$this->max_nomor('2',$periode)->no_mutasi;
    //     $bulan              = substr($this->input->post('tanggal'),0,2);
    //     $hari               = substr($this->input->post('tanggal'),3,2);
    //     $tahun              = substr($this->input->post('tanggal'),6,4);
    //     $tanggal            = $tahun.'-'.$bulan.'-'.$hari;
    //     $keterangan         = $this->security->xss_clean($this->db->escape_str($this->input->post('keterangan')));
    //     $id_lokasi          = $this->security->xss_clean($this->db->escape_str($this->input->post('id_lokasi')));
    //     $sql    = "INSERT INTO t_mutasi (id_mutasi,no_mutasi,tgl,keterangan,id_lokasi,status_mutasi,id_username,tgl_update,approve_mutasi)VALUES
    //         ('".$id_mutasi."','".$no_mutasi."','".$tanggal."','".$keterangan."','".$id_lokasi."','2','".$this->current_user['id_username']."','".dbnow()."','0')";
    //     $query = $this->db->query($sql);
    //     if(isset($new_mutasi_keluar['items'])){
    //         $items          = $new_mutasi_keluar['items'];
    //         foreach ($items as $key => $value) {
    //             $id_detail      = $this->max_id_detail()->id_mutasi_detail;
    //             $bulan          = substr($value['kadaluarsa'],0,2);
    //             $hari           = substr($value['kadaluarsa'],3,2);
    //             $tahun          = substr($value['kadaluarsa'],6,4);
    //             $tanggal        = $tahun.'-'.$bulan.'-'.$hari;
    //             $sql_detail     = "INSERT INTO t_mutasi_detail (id_mutasi_detail,id_mutasi,id_stok,id_barang,qty,lot_no,tgl_kadaluwarsa)VALUES
    //                     ('".$id_detail."','".$id_mutasi."','".$value['id_stok']."','".$value['id_barang']."','".$value['quantity']."','".$value['no_lot']."','".$value['kadaluarsa']."')";
    //             $query          = $this->db->query($sql_detail);
    //         }
    //     }
    //     if($query === false){
    //         return "ERROR INSERTT";
    //     }else{
    //         return $query;
    //     }
    // }
    // function stok_keluar($id){
    //     $data   = $this->db->query("SELECT a.id_mutasi_detail,a.id_barang,a.qty,a.lot_no,a.tgl_kadaluwarsa,b.id_lokasi,a.id_stok
    //                         FROM t_mutasi_detail a LEFT JOIN t_mutasi b on a.id_mutasi=b.id_mutasi WHERE a.id_mutasi='".$id."'")->result();
    //     foreach ($data as $key => $value) {
    //         $qty_stok   = $this->db->query("SELECT qty FROM t_stok WHERE id_stok='".$value->id_stok."'")->row()->qty;
    //         $stok_akhir = $qty_stok - $value->qty;
    //         $this->db->query("UPDATE t_stok SET qty = '".$stok_akhir."' WHERE id_stok = '".$value->id_stok."'");
    //     }
    // }
    // function get_all_barang($start=0,$length=10,$search='',$id) {
    //     // $sql = "SELECT a.request_id, a.request_no, a.request_date,a.requester,c.name dept,a.project_id,d.project_name,d.project_location FROM trn_request_01 a 
    //     //         LEFT JOIN db_master.mst_user_group c ON c.id_user_group=a.dept
    //     //         LEFT JOIN db_master.mst_project d ON d.project_id=a.project_id
    //     //         WHERE a.status_request='2' AND a.status_approve='1' AND (a.request_no LIKE '%".$search."%')
    //     //         order by a.request_no asc
    //     //         LIMIT ".$start.", ".$length."";
    //     $sql = "SELECT a.*,b.nama FROM t_stok a LEFT JOIN m_barang b ON a.id_barang=b.id_barang WHERE a.id_lokasi='".$id."' AND (b.nama LIKE '%".$search."%') 
    //             ORDER BY b.nama LIMIT ".$start.", ".$length."";
    //     $item = $this->db->query($sql)->result();
    //     return is_for($item) ? $item : false;
    // }
    // function get_count_display($start,$length,$search = false,$id) {
    //     $str = '';
    //     if ($search) {
    //         $str = " AND (b.nama LIKE '%".$search."%') ";
    //     }
    //     $sql = " SELECT COUNT(a.id_stok) total FROM t_stok a LEFT JOIN m_barang b ON a.id_barang=b.id_barang WHERE a.id_lokasi='".$id."' ".$str." ";
    //     $item = $this->db->query($sql)->row();
    //     return isset($item->total) ? $item->total : 0;
    // }
    // function get_count($id){
    //     $sql ="SELECT COUNT(a.id_stok) total FROM t_stok a LEFT JOIN m_barang b ON a.id_barang=b.id_barang WHERE a.id_lokasi='".$id."' ";
    //     $item = $this->db->query($sql)->row();
    //     return isset($item->total) ? $item->total : 0;
    // }
}   