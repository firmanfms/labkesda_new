<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratorium extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('report/LaboratoriumReport_model','report_lab');
        $this->load->model('master/laboratorium_model');
    }

    function outstanding(){  
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Report', 'active_submenu' => 'report/laboratorium/outstanding', 'active_submenu2' => ''));
        
        $data['kd_lab']         = '';
        $data['status']         = '';
        $data['data_lab']       = $this->laboratorium_model->get_all();
        $data['pendaftaran']    = array();
        $tgl_out                = date('Y-m-d', strtotime('+2 days', strtotime(dbnow(false))));
        // test($tgl_out,1);

        if($this->input->post('kd_lab')!=''){
            $data['kd_lab']         = $this->input->post('kd_lab');
            $data['status']         = $this->input->post('status');
            $data['pendaftaran']    = $this->db->query('SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,
                a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,
                b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,REPLACE(a.no_pendaftaran,"/","-") nopendaftar,e.status_approve
                FROM t_pendaftaran a 
                LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
                LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
                LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
                LEFT JOIN t_pendaftaran_detail e ON a.no_pendaftaran = e.no_pendaftaran
                WHERE a.status="1" AND a.kd_lab="'.$this->input->post('kd_lab').'"  AND e.status_approve="'.$this->input->post('status').'" AND a.tgl_selesai<"'.$tgl_out.'"
                GROUP BY a.no_pendaftaran
                ORDER BY a.tgl_input DESC')->result();
            // test($data['pendaftaran'],1);
            // $data['data_mutasi']    = $this->mutasi_model->history_stok_barang($id_lokasi,$tanggal_dari,$tanggal_smp,$id_barang);
        }

        // $this->load->view('report/lab_lingkungan',$data);
        $this->template->load('body', 'report/outstanding_report',$data);
    }

    function outstanding_excell($kd_lab,$status){  
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Report', 'active_submenu' => 'report/laboratorium/outstanding', 'active_submenu2' => ''));
        
        $data['kd_lab']         = '';
        $data['status']         = '';
        $data['data_lab']       = $this->laboratorium_model->get_all();
        $data['pendaftaran']    = array();
        $tgl_out                = date('Y-m-d', strtotime('+2 days', strtotime(dbnow(false))));
        

            $data['kd_lab']         = $kd_lab;
            $data['status']         = $this->input->post('status');
            $data['pendaftaran']    = $this->db->query('SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,
                a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,
                b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,REPLACE(a.no_pendaftaran,"/","-") nopendaftar,e.status_approve
                FROM t_pendaftaran a 
                LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
                LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
                LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
                LEFT JOIN t_pendaftaran_detail e ON a.no_pendaftaran = e.no_pendaftaran
                WHERE a.status="1" AND a.kd_lab="'.$kd_lab.'"  AND e.status_approve="'.$status.'" AND a.tgl_selesai<"'.$tgl_out.'"
                GROUP BY a.no_pendaftaran
                ORDER BY a.tgl_input DESC')->result();
            // test($data['pendaftaran'],1);
            // $data['data_mutasi']    = $this->mutasi_model->history_stok_barang($id_lokasi,$tanggal_dari,$tanggal_smp,$id_barang);
        
        // test($data,1);

        // $this->load->view('report/lab_lingkungan',$data);
        $this->load->view('report/outstanding_excell',$data);
    }

    function tindakan_sample(){  
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Report', 'active_submenu' => 'report/laboratorium/tindakan_sample', 'active_submenu2' => ''));
        
        $data['kd_lab']         = '';
        $data['data_lab']       = $this->laboratorium_model->get_all();
        $data['pendaftaran']    = array();
        $tgl_out                = date('Y-m-d', strtotime('+2 days', strtotime(dbnow(false))));
        // test($tgl_out,1);

        if($this->input->post('kd_lab')!=''){
            $data['kd_lab']         = $this->input->post('kd_lab');

            $data['pendaftaran']    = $this->db->query('SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,
                a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,
                b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,REPLACE(a.no_pendaftaran,"/","-") nopendaftar,e.status_approve
                FROM t_pendaftaran a 
                LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
                LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
                LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
                LEFT JOIN t_pendaftaran_detail e ON a.no_pendaftaran = e.no_pendaftaran
                WHERE a.status="1" AND a.kd_lab="'.$this->input->post('kd_lab').'"  AND e.status_approve IN (1,2)
                GROUP BY a.no_pendaftaran
                ORDER BY a.tgl_input DESC')->result();
            // test($data['pendaftaran'],1);
            // $data['data_mutasi']    = $this->mutasi_model->history_stok_barang($id_lokasi,$tanggal_dari,$tanggal_smp,$id_barang);
        }

        // $this->load->view('report/lab_lingkungan',$data);
        $this->template->load('body', 'report/tindakan',$data);
    }

    function tindakan_sample_excell($kd_lab){  
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Report', 'active_submenu' => 'report/laboratorium/tindakan_sample', 'active_submenu2' => ''));
        
        $data['kd_lab']         = '';
        $data['data_lab']       = $this->laboratorium_model->get_all();
        $data['pendaftaran']    = array();
        $tgl_out                = date('Y-m-d', strtotime('+2 days', strtotime(dbnow(false))));
        // test($tgl_out,1);

            $data['kd_lab']         = $kd_lab;

            $data['pendaftaran']    = $this->db->query('SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,
                a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,
                b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,REPLACE(a.no_pendaftaran,"/","-") nopendaftar,e.status_approve
                FROM t_pendaftaran a 
                LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
                LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
                LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
                LEFT JOIN t_pendaftaran_detail e ON a.no_pendaftaran = e.no_pendaftaran
                WHERE a.status="1" AND a.kd_lab="'.$kd_lab.'"  AND e.status_approve IN (1,2)
                GROUP BY a.no_pendaftaran
                ORDER BY a.tgl_input DESC')->result();
            // test($data['pendaftaran'],1);
            // $data['data_mutasi']    = $this->mutasi_model->history_stok_barang($id_lokasi,$tanggal_dari,$tanggal_smp,$id_barang);

        // $this->load->view('report/lab_lingkungan',$data);
        $this->load->view('report/tindakan_excell',$data);
    }

    function grafik_kunjungan(){  
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Report', 'active_submenu' => 'report/laboratorium/grafik_kunjungan', 'active_submenu2' => ''));
        
        $data['kd_lab']         = '';
        $data['data_lab']       = $this->laboratorium_model->get_all();
        $data['pendaftaran']    = array();
        $tgl_out                = date('Y-m-d', strtotime('+2 days', strtotime(dbnow(false))));
        // test($tgl_out,1);

        if($this->input->post('kd_lab')!=''){
            $data['kd_lab']         = $this->input->post('kd_lab');

            $data['pendaftaran']    = $this->db->query('SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,
                a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,
                b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,REPLACE(a.no_pendaftaran,"/","-") nopendaftar,e.status_approve
                FROM t_pendaftaran a 
                LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
                LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
                LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
                LEFT JOIN t_pendaftaran_detail e ON a.no_pendaftaran = e.no_pendaftaran
                WHERE a.status="1" AND a.kd_lab="'.$this->input->post('kd_lab').'"  AND e.status_approve IN (1,2)
                GROUP BY a.no_pendaftaran
                ORDER BY a.tgl_input DESC')->result();
            // test($data['pendaftaran'],1);
            // $data['data_mutasi']    = $this->mutasi_model->history_stok_barang($id_lokasi,$tanggal_dari,$tanggal_smp,$id_barang);
        }

        // $this->load->view('report/lab_lingkungan',$data);
        $this->template->load('body', 'report/grafik_kunjungan',$data);
    }

    function grafik_kunjungan_print(){
        $tgl_dari       = $this->input->post('tgl_dari');
        $tgl_smp        = $this->input->post('tgl_smp');

        // $bulan      = "07";
        // $tahun      = "2023";

        $data_kunjungan                         = $this->report_lab->data_kunjungan_tanggal($tgl_dari,$tgl_smp);

        $data['tgl_dari']                   = $tgl_dari;
        $data['tgl_smp']                    = $tgl_smp;
        $data['data_kunjungan']                 = $data_kunjungan;
        // test($data['data_kunjungan_klinik'],1);
        $this->load->view('report/report_kunjungan',$data);
        // test($data,1);

    }



    function table_kunjungan(){  
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Report', 'active_submenu' => 'report/laboratorium/table_kunjungan', 'active_submenu2' => ''));
        
        $data['kd_lab']         = '';
        $data['data_lab']       = $this->laboratorium_model->get_all();
        $data['pendaftaran']    = array();
        $tgl_out                = date('Y-m-d', strtotime('+2 days', strtotime(dbnow(false))));
        // test($tgl_out,1);

        if($this->input->post('kd_lab')!=''){
            $data['kd_lab']         = $this->input->post('kd_lab');

            $data['pendaftaran']    = $this->db->query('SELECT a.no_pendaftaran,a.nama,a.uraian_sampel,a.kd_sampel,a.tgl_diterima,
                a.tgl_pengujian,a.tgl_selesai,a.kd_lab,a.kd_parameter,a.jns_analisa,a.status,a.ket_sampel,a.umur,a.dokter,a.jns_kelamin,
                b.nm_sampel,c.lab,d.nm_parameter,a.tgl_input,REPLACE(a.no_pendaftaran,"/","-") nopendaftar,e.status_approve
                FROM t_pendaftaran a 
                LEFT JOIN m_sampel b ON a.kd_sampel=b.kd_sampel
                LEFT JOIN m_lab c ON a.kd_lab=c.kd_lab
                LEFT JOIN m_parameter d ON a.kd_parameter=d.kd_parameter
                LEFT JOIN t_pendaftaran_detail e ON a.no_pendaftaran = e.no_pendaftaran
                WHERE a.status="1" AND a.kd_lab="'.$this->input->post('kd_lab').'"  AND e.status_approve IN (1,2)
                GROUP BY a.no_pendaftaran
                ORDER BY a.tgl_input DESC')->result();
            // test($data['pendaftaran'],1);
            // $data['data_mutasi']    = $this->mutasi_model->history_stok_barang($id_lokasi,$tanggal_dari,$tanggal_smp,$id_barang);
        }

        // $this->load->view('report/lab_lingkungan',$data);
        $this->template->load('body', 'report/table_kunjungan',$data);
    }

    function table_kunjungan_print(){
        $bulan      = "07";
        $tahun      = "2023";
        $kd_lab     = 'LK';

        $tgl_dari       = $this->input->post('tgl_dari');
        $tgl_smp        = $this->input->post('tgl_smp');
        $kd_lab         = $this->input->post('kd_lab');

        // $data_kunjungan             = $this->report_lab->data_kunjungan($tahun,$bulan);
        $data_kunjungan             = $this->report_lab->data_kunjungan_perlab_tgl($kd_lab,$tgl_dari,$tgl_smp);

        $data['data_kunjungan']     = $data_kunjungan;
        $data['kd_lab']             = $kd_lab;
        $data['tgl_dari']                   = $tgl_dari;
        $data['tgl_smp']                    = $tgl_smp;

        $this->load->view('report/table_kunjungan_print',$data);
        // test($data,1);

    }

    function rekap(){
        $bulan      = "07";
        $tahun      = "2023";

        $data_kunjungan             = $this->report_lab->data_kunjungan($tahun,$bulan);

        $data_kunjungan_lingkungan  = $this->report_lab->data_kunjungan_perlab('LL',$tahun,$bulan);
        $data_kunjungan_klinik      = $this->report_lab->data_kunjungan_perlab('LK',$tahun,$bulan);
        $data_kunjungan_maknum      = $this->report_lab->data_kunjungan_perlab('LM',$tahun,$bulan);

        $data['data_kunjungan']                 = $data_kunjungan;
        $data['data_kunjungan_lingkungan']      = $data_kunjungan_lingkungan;
        $data['data_kunjungan_klinik']          = $data_kunjungan_klinik;
        $data['data_kunjungan_maknum']          = $data_kunjungan_maknum;
        // test($data['data_kunjungan_klinik'],1);
        $this->load->view('report/report_kunjungan',$data);
        // test($data,1);

    }







































































    function excell($tgl_dari,$tgl_smp,$kd_lab){
        $data['kd_lab']         = $kd_lab;
        $data['pendaftaran']    = $this->db->query("SELECT a.tgl_input,b.kd_parameter,c.nm_parameter,COUNT(b.kd_parameter) jumlah,d.lab,
                                            e.nm_kategori_parameter
                                            FROM t_pendaftaran a
                                            LEFT JOIN t_pendaftaran_detail b ON a.no_pendaftaran=b.no_pendaftaran
                                            LEFT JOIN m_parameter c ON b.kd_parameter=c.kd_parameter 
                                            LEFT JOIN m_lab d ON a.kd_lab=d.kd_lab
                                            LEFT JOIN m_kategori_parameter e ON e.kd_kategori_parameter=b.kd_kategori_parameter
                                            WHERE a.kd_lab='".$kd_lab."' 
                                            AND a.tgl_input BETWEEN '".$tgl_dari." 00:00:00' AND '".$tgl_smp." 23:00:00'
                                            GROUP BY b.kd_parameter")->result();

        $this->load->view('report/parameter_excell',$data);
    }

    function print(){  
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Report', 'active_submenu' => 'lab_lingkungan', 'active_submenu2' => ''));
        
        $data['tgl_dari_asli']  = '';
        $data['tgl_smp_asli']   = '';
        $data['tgl_dari']  = '';
        $data['tgl_smp']   = '';
        $data['data_metode']        = $this->metode_model->get_all_by_jenis('LL');

        if($this->input->post('tgl_dari')!=''){
            $hari                   = substr($this->input->post('tgl_dari'),0,2);
            $bulan                  = substr($this->input->post('tgl_dari'),3,2);
            $tahun                  = substr($this->input->post('tgl_dari'),6,4);
            $tanggal_dari           = $tahun.'-'.$bulan.'-'.$hari;

            $hari1                  = substr($this->input->post('tgl_smp'),0,2);
            $bulan1                 = substr($this->input->post('tgl_smp'),3,2);
            $tahun1                 = substr($this->input->post('tgl_smp'),6,4);
            $tanggal_smp            = $tahun1.'-'.$bulan1.'-'.$hari1;

            $data['tgl_dari']       = $tanggal_dari;
            $data['tgl_smp']        = $tanggal_smp;
            $data['tgl_dari_asli']  = $this->input->post('tgl_dari');
            $data['tgl_smp_asli']   = $this->input->post('tgl_smp'); 
            $data['kd_lab']         = $this->input->post('kd_lab');
            $data['pendaftaran']    = $this->db->query("SELECT a.nama,a.alamat,a.no_pendaftaran,b.kd_parameter,c.nm_parameter,b.nilai,
                                                b.kd_kategori_parameter,d.nm_kategori_parameter
                                                FROM t_pendaftaran a 
                                                LEFT JOIN t_pendaftaran_detail b ON a.no_pendaftaran=b.no_pendaftaran
                                                LEFT JOIN m_parameter c ON b.kd_parameter=c.kd_parameter
                                                LEFT JOIN m_kategori_parameter d ON b.kd_kategori_parameter=d.kd_kategori_parameter
                                                WHERE a.status='1' AND tgl_input BETWEEN '".$tanggal_dari." 00:00:00' AND '".$tanggal_smp." 23:00:00'")->result();
            // test($data['pendaftaran'],1);
            // $data['data_mutasi']    = $this->mutasi_model->history_stok_barang($id_lokasi,$tanggal_dari,$tanggal_smp,$id_barang);
        }

        $this->load->view('report/lab_lingkungan_excell',$data);
    }

}