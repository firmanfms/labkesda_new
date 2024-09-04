<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Invoices extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('transaksi/mutasi_model');
        $this->load->model('master/lokasi_model');
        $this->load->model('master/barang_model');
        $this->load->model('master/katbarang_model');
        $this->load->model('master/metode_model');
        $this->load->model('master/laboratorium_model');
    }
    function index(){  
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Report', 'active_submenu' => 'report/analis', 'active_submenu2' => ''));
        $data['tgl_dari_asli']  = '';
        $data['tgl_smp_asli']   = '';
        $data['tgl_dari']  = '';
        $data['tgl_smp']   = '';
        $data['kd_lab']   = '';
        $data['status_bayar']   = '';
        $data['data_lab']       = $this->laboratorium_model->get_all();
        $data['pendaftaran']    = array();
        if($this->input->post('tgl_dari')!=''){
            $hari                   = substr($this->input->post('tgl_dari'),0,2);
            $bulan                  = substr($this->input->post('tgl_dari'),3,2);
            $tahun                  = substr($this->input->post('tgl_dari'),6,4);
            $tanggal_dari           = $tahun.'-'.$bulan.'-'.$hari;
            $hari1                  = substr($this->input->post('tgl_smp'),0,2);
            $bulan1                 = substr($this->input->post('tgl_smp'),3,2);
            $tahun1                 = substr($this->input->post('tgl_smp'),6,4);
            $status_bayar           = $this->input->post('status_bayar');
            $tanggal_smp            = $tahun1.'-'.$bulan1.'-'.$hari1;
            // test($tanggal_dari.' '.$tanggal_smp,1);
            $data['tgl_dari']       = $tanggal_dari;
            $data['tgl_smp']        = $tanggal_smp;
            $data['tgl_dari_asli']  = $this->input->post('tgl_dari');
            $data['tgl_smp_asli']   = $this->input->post('tgl_smp'); 
            $data['kd_lab']         = $this->input->post('kd_lab');
            $data['status_bayar']   = $status_bayar;
            $data['pendaftaran'] = $this->db->query("SELECT a.tgl_pengujian , b.no_pendaftaran , a.kd_lab , b.kd_parameter , b.nama_analis
                                                  , c.nm_parameter , a.status_bayar , a.tgl_input , a.nama , a.no_pendaftaran , sum(b.harga) as total_harga
                                                FROM t_pendaftaran a
                                                LEFT JOIN t_pendaftaran_detail b ON a.`no_pendaftaran`=b.`no_pendaftaran`
                                                LEFT JOIN m_parameter c ON b.`kd_parameter`=c.`kd_parameter`
                                                LEFT JOIN m_lab d ON a.kd_lab=d.kd_lab
                                                LEFT JOIN m_kategori_parameter e ON e.kd_kategori_parameter=b.kd_kategori_parameter
                                                WHERE a.`kd_lab`='".$this->input->post('kd_lab')."' 
                                                AND a.`tgl_input` BETWEEN '".$tanggal_dari." 00:00:00' AND '".$tanggal_smp." 23:00:00'
                                                AND a.`status_bayar` like '%".$status_bayar."%'
                                                GROUP BY a.no_pendaftaran ORDER BY b.no_pendaftaran ")->result();
            // test($data['pendaftaran'],1);
            // $data['data_mutasi']    = $this->mutasi_model->history_stok_barang($id_lokasi,$tanggal_dari,$tanggal_smp,$id_barang);
        }
        // $this->load->view('report/lab_lingkungan',$data);
        $this->template->load('body', 'report/invoices',$data);
    }
    function excell($tgl_dari,$tgl_smp,$kd_lab , $status_bayar ){
        // echo $tgl_dari." ".$tgl_smp." ".$kd_lab;exit();
        $data['kd_lab']         = $kd_lab;
		$data['tgl_dari']		= $tgl_dari;
		$data['tgl_smp']		= $tgl_smp;
        $data['pendaftaran']    =$this->db->query("SELECT a.tgl_pengujian , b.no_pendaftaran , a.kd_lab , b.kd_parameter , b.nama_analis
                                                    , c.nm_parameter , a.status_bayar , a.tgl_input , a.nama , a.no_pendaftaran , sum(b.harga) as total_harga
                                                FROM t_pendaftaran a
                                                LEFT JOIN t_pendaftaran_detail b ON a.`no_pendaftaran`=b.`no_pendaftaran`
                                                LEFT JOIN m_parameter c ON b.`kd_parameter`=c.`kd_parameter`
                                                LEFT JOIN m_lab d ON a.kd_lab=d.kd_lab
                                                LEFT JOIN m_kategori_parameter e ON e.kd_kategori_parameter=b.kd_kategori_parameter
                                                WHERE a.`kd_lab`='".$kd_lab."' 
                                                AND a.`tgl_input` BETWEEN '".$tgl_dari." 00:00:00' AND '".$tgl_smp." 23:00:00'
                                                AND a.`status_bayar` like '%".$status_bayar."%'
                                                GROUP BY a.no_pendaftaran ORDER BY b.no_pendaftaran ")->result();
        // echo $this->db->last_query();exit();
        $this->load->view('report/invoices_excell',$data);
    }
}