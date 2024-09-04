<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lab_lingkungan extends MY_Controller {
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
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Report', 'active_submenu' => 'lab_lingkungan', 'active_submenu2' => ''));
        $data['tgl_dari_asli']  = '';
        $data['tgl_smp_asli']   = '';
        $data['tgl_dari']  = '';
        $data['tgl_smp']   = '';
        $data['data_metode']        = $this->metode_model->get_all_by_jenis('LL');
        $data['kd_lab']   = '';
        $data['data_lab']       = $this->laboratorium_model->get_all();
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
            $data['pendaftaran']    = $this->db->query("SELECT a.nama,a.alamat,a.`no_pendaftaran`,b.kd_parameter,c.`nm_parameter`,b.`nilai`,
                                                b.`kd_kategori_parameter`,d.`nm_kategori_parameter`,a.tgl_diterima
                                                FROM t_pendaftaran a 
                                                LEFT JOIN t_pendaftaran_detail b ON a.`no_pendaftaran`=b.`no_pendaftaran`
                                                LEFT JOIN m_parameter c ON b.`kd_parameter`=c.`kd_parameter`
                                                LEFT JOIN m_kategori_parameter d ON b.`kd_kategori_parameter`=d.`kd_kategori_parameter`
                                                WHERE a.`kd_lab`='".$this->input->post('kd_lab')."' AND a.status='1' AND tgl_input BETWEEN '".$tanggal_dari." 00:00:00' AND '".$tanggal_smp." 23:00:00'")->result();
            // test($data['pendaftaran'],1);
            // $data['data_mutasi']    = $this->mutasi_model->history_stok_barang($id_lokasi,$tanggal_dari,$tanggal_smp,$id_barang);
        }
        // $this->load->view('report/lab_lingkungan',$data);
        $this->template->load('body', 'report/lab_lingkungan',$data);
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
            /*$data['pendaftaran']    = $this->db->query("SELECT a.nama,a.alamat,a.`no_pendaftaran`,b.kd_parameter,c.`nm_parameter`,b.`nilai`,
                                                b.`kd_kategori_parameter`,d.`nm_kategori_parameter`,a.`tgl_diterima`,e.`nm_sampel`,a.`kd_sampel`
                                                FROM t_pendaftaran a 
                                                LEFT JOIN t_pendaftaran_detail b ON a.`no_pendaftaran`=b.`no_pendaftaran`
                                                LEFT JOIN m_parameter c ON b.`kd_parameter`=c.`kd_parameter`
                                                LEFT JOIN m_kategori_parameter d ON b.`kd_kategori_parameter`=d.`kd_kategori_parameter`
                                                LEFT JOIN m_sampel e ON a.`kd_sampel`=e.`kd_sampel`
                                                WHERE a.`kd_lab`='".$this->input->post('kd_lab')."' AND a.status='1' AND tgl_input BETWEEN '".$tanggal_dari." 00:00:00' AND '".$tanggal_smp." 23:00:00'")->result();
												*/
			$data['pendaftaran']    = $this->db->query("SELECT a.nama,a.alamat,a.`no_pendaftaran`,a.`tgl_diterima`,b.nm_sampel,a.kd_lab
                                                FROM t_pendaftaran a 
												LEFT JOIN m_sampel b ON a.`kd_sampel`=b.`kd_sampel`
                                                WHERE a.`kd_lab`='".$this->input->post('kd_lab')."' AND a.status='1' 
                                                AND a.tgl_input BETWEEN '".$tanggal_dari." 00:00:00' 
                                                AND '".$tanggal_smp." 23:00:00'")->result();
                                            //    PRE($data);
                                            //    pre( ($data['pendaftaran']));
                                            //  echo $this->db->last_query();
            // test($data['pendaftaran'],1);
            // $data['data_mutasi']    = $this->mutasi_model->history_stok_barang($id_lokasi,$tanggal_dari,$tanggal_smp,$id_barang);
        }
        $this->load->view('report/lab_lingkungan_excell',$data);
    }
}