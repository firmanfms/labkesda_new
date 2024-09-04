<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hasil_lingkungan extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Transaksi', 'active_submenu' => 'hasil', 'active_submenu2' => 'hasil_lingkungan'));
        $this->load->model('transaksi/hasil_model');
        $this->load->model('master/manajemen_model');
        $this->load->model('master/keterangan_model');
    }
    function index(){
        $tahun=date('Y');
        $status_cetak = '0';
        if($this->input->get('tahun') != ''){
            $tahun = $this->input->get('tahun');
        }  
         if($this->input->get('status_cetak') != ''){
            $status_cetak = $this->input->get('status_cetak');
        }
        if($status_cetak=="1")
        {
            $this->done();
            // exit();
            goto c;
        }
        $data['data_pendaftaran']  = $this->hasil_model->get_all_lingkungan_tahun_status($tahun,$status_cetak);
        $data['data_tahun']  = execute_query_result_array(" SELECT distinct YEAR(tgl_diterima) tahun
        from t_pendaftaran where YEAR(tgl_diterima) > 2022 ");
        $data['tahun'] = $tahun;
          $data['status_cetak'] = $status_cetak;
        $data['catatankaki1']="data yang ditampilkan adalah yang belum done";
        $data['catatankaki2']="jika ingin melihat data yang sudah done, silakan cek di menu  <a href='".base_url('transaksi/hasil_lingkungan/done')."'> hasil pemeriksaan klinik done</a>";
        $this->template->load('body', 'transaksi/hasil/hasil_lingkungan_view',$data);
        c:
    }
    function done(){
        $tahun=date('Y');
        $status_cetak = '1';
        if($this->input->get('tahun') != ''){
            $tahun = $this->input->get('tahun');
        }  
        $data['data_pendaftaran']  = $this->hasil_model->get_all_lingkungan_tahun_status($tahun,$status_cetak);
        $data['data_tahun']  = execute_query_result_array(" SELECT distinct YEAR(tgl_diterima) tahun
        from t_pendaftaran where YEAR(tgl_diterima) > 2022 ");
        $data['tahun'] = $tahun;
        $data['status_cetak'] = $status_cetak;
        $data['catatankaki1']="data yang ditampilkan adalah yang sudah done";
        $data['catatankaki2']="jika ingin melihat data yang belum done, silakan cek di menu  <a href='".base_url('transaksi/hasil_lingkungan/')."'> hasil pemeriksaan Lingkungan</a>";
        $this->template->load('body', 'transaksi/hasil/hasil_lingkungan_view',$data);
    }
    function update($id,$urut){
        // detail_kdpar
        $id                     = str_replace(str_split('-'), '/', $id);
        $data['header']         = $this->hasil_model->header_hasil($id);
        $data['detail']         = $this->hasil_model->detail_hasil_new($id,$urut);
        $data['detail_kdpar']   = $this->hasil_model->detail_hasil_par($id);
        $this->load->model('master/sampel_model');
        $this->load->model('master/parameter_model');
        $data['data_sampel']        = $this->sampel_model->get_all();
        $data['data_parameter']     = $this->parameter_model->get_detail_by_lab('LL');
        $data['data_lab']           = 'LL';
        $data['data_analis']        = $this->db->query("SELECT id_username,nama FROM m_user WHERE app_level IN (1,6,7,8)")->result();
        $data['urut']               = $urut;
        $this->template->load('body', 'transaksi/hasil/hasil_lingkungan_form', $data);
    }
    function insert($id,$urut){
        $id                     = str_replace(str_split('-'), '/', $id);
        $data['header']         = $this->hasil_model->header_hasil($id);
        $data['detail']         = $this->hasil_model->detail_hasil_new($id,$urut);
        $data['detail_kdpar']   = $this->hasil_model->detail_hasil_par($id);
        $data['urut']           = $urut;
        $this->load->model('master/sampel_model');
        $this->load->model('master/parameter_model');
        $data['data_sampel']        = $this->sampel_model->get_all();
        $data['data_parameter']     = $this->parameter_model->get_detail_by_lab('LK');
        $data['data_lab']           = 'LK';
        $data['data_analis']        = $this->db->query("SELECT id_username,nama FROM m_user WHERE app_level IN (1,6,7,8)")->result();
        $this->template->load('body', 'transaksi/hasil/hasil_lingkungan_insert', $data);
    }
    function detail($id,$urut){
        $id                     = str_replace(str_split('-'), '/', $id);
        $data['header']         = $this->hasil_model->header_hasil($id);
        $data['detail']         = $this->hasil_model->detail_hasil_new($id,$urut);
        $data['detail_kdpar']   = $this->hasil_model->detail_hasil_par($id);
        $data['urut']           = $urut;
        $this->load->model('master/sampel_model');
        $this->load->model('master/parameter_model');
        $data['data_sampel']        = $this->sampel_model->get_all();
        $data['data_parameter']     = $this->parameter_model->get_detail_by_lab('LK');
        $data['data_lab']           = 'LK';
        $this->template->load('body', 'transaksi/hasil/hasil_lingkungan_detail', $data);
    }
    function update_act(){
        $update = $this->hasil_model->update_lingkungan_act();
        $this->session->set_flashdata('alert','Data Berhasil Disimpan');
        redirect('transaksi/hasil_lingkungan/');
    }    
    function insert_act(){
        $update = $this->hasil_model->insert_klinik_act();
        $this->session->set_flashdata('alert','Data Berhasil Disimpan');
        redirect('transaksi/hasil_lingkungan/');
    }   
    function view_popup($id){
        $data['detail']             = $this->mutasi_model->mutasi_detail($id)->result();
        $data['tdetail']            = $this->mutasi_model->mutasi_detail($id)->num_rows();
        $data['header']             = $this->mutasi_model->mutasi_header($id)->row();
        $this->load->view('transaksi/mutasi/mutasi_detail_popup',$data);
    }
    function cetak($id,$urut){
        $id                     = str_replace(str_split('-'), '/', $id);
        $data['header']         = $this->hasil_model->header_hasil($id);
        $data['detail']         = $this->hasil_model->detail_hasil_new($id,$urut);
        $data['detail_kdpar']   = $this->hasil_model->detail_hasil_par($id);
        $this->template->load('body','transaksi/hasil/hasil_lingkungan_print',$data);
    }
    function print(){
        update_symbol_hasil();
        // test($this->input->post('nomor'),1);
        $nomor      = $this->input->post('nomor');
        $urut       = $this->input->post('urut');
        $agreditasi = $this->input->post('agreditasi');
        $print      = $this->input->post('print');
        $header_cetak=$this->input->post('header_cetak');
        $versi      = $this->input->post('versi');
        $type_surat = $this->input->post('type_surat');
        $type_laporan=$this->input->post('type_laporan');
        $napsa      = $this->input->post('napsa');
        $data['header']         = $this->hasil_model->header_hasil($nomor);
        $data['detail']         = $this->hasil_model->detail_hasil_new($nomor,$urut);
        $data['detail_kdpar']   = $this->hasil_model->detail_hasil_par($nomor);      
        $data['agreditasi']     = $agreditasi;
        $data['type_surat']     = $type_surat;
        $data['type_laporan']   = $type_laporan;
        $data['napsa']          = $napsa;
        // test($data,1);
        $data['ttn']            = $this->input->post('ttn');
        $data['ttl']            = $this->input->post('ttl');
        $data['header_cetak']   = $header_cetak;
        $data['print']          = $print;
        $data['ttd_kepala']     = $this->manajemen_model->get_all_detail(1);
        $data['ttd_tu']         = $this->manajemen_model->get_all_detail(3);
        $data['ttd_teknis']     = $this->manajemen_model->get_all_detail(2);
        $data['ttd_koor']       = $this->manajemen_model->get_all_detail(5);
        $data['note']           = $this->keterangan_model->get_detail_keterangan($versi,"LL");
        if($print=='word'){
			//=========== fungsi untuk cetak word versi lama ====================
            $this->load->view("transaksi/hasil/hasil_lingkungan_word",$data);
			//================================================================
            //=========== fungsi untuk cetak word versi baru ====================
		}elseif ($print=='wordversi2') {
			generateWordDocumentLingkungan2($data['header'], $data['detail'], $data['detail_kdpar'], $data['ttd_kepala'], $data['ttd_tu'], $data['ttd_teknis'], $data['ttd_koor'], $data['type_surat'], $data['type_laporan'], $data['header_cetak'], $data['agreditasi'], $data['napsa'], $data['note'], $data['ttl'], $data['ttn']);
        }else{
            $this->load->view("transaksi/hasil/hasil_lingkungan_print",$data);        
        }
    }
}
?>