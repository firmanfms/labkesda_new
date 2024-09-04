<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'vendor/phpoffice/phpword/src/PhpWord/PhpWord.php';
use PhpOffice\PhpWord\PhpWord;
class Hasil_klinik extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Transaksi', 'active_submenu' => 'hasil', 'active_submenu2' => 'hasil_klinik'));
        $this->load->model('transaksi/hasil_model');
        $this->load->model('master/manajemen_model');
        $this->load->model('master/keterangan_model');
    }
    // ALTER TABLE `db_labkesda_lab`.`t_pendaftaran_detail` ADD COLUMN `detail_id` INT(11) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`detail_id`); 
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
        // pre($_GET);
        $data['data_pendaftaran']  = $this->hasil_model->get_all_klinik_tahun_status($tahun,$status_cetak);
        if($this->input->get('status_cetak') != '' ){
            $status_cetak = $this->input->get('status_cetak');
        }
        // count($data['data_pendaftaran']);
        // array_to_table( $data['data_pendaftaran']);exit();
        $data['data_tahun']  = execute_query_result_array(" SELECT distinct YEAR(tgl_diterima) tahun
        from t_pendaftaran where YEAR(tgl_diterima) > 2022 ");
        $data['tahun'] = $tahun;
        $data['status_cetak'] = $status_cetak;
        $data['catatankaki1']="data yang ditampilkan adalah yang belum done";
        $data['catatankaki2']="jika ingin melihat data yang sudah done, silakan cek di menu  <a href='".base_url('transaksi/hasil_klinik/done')."'> hasil pemeriksaan klinik done</a>";
        $this->template->load('body', 'transaksi/hasil/hasil_klinik_view',$data);
        c:
    }
    function done(){  
        $tahun=date('Y');
        $status_cetak = '1';
        if($this->input->get('tahun') != ''){
            $tahun = $this->input->get('tahun');
        }
        $data['data_pendaftaran']  = $this->hasil_model->get_all_klinik_tahun_status($tahun,$status_cetak);
        if($this->input->get('status_cetak') != '' ){
            $status_cetak = $this->input->get('status_cetak');
        }
        // count($data['data_pendaftaran']);
        // array_to_table( $data['data_pendaftaran']);exit();
        $data['data_tahun']  = execute_query_result_array(" SELECT distinct YEAR(tgl_diterima) tahun
        from t_pendaftaran where YEAR(tgl_diterima) > 2022 ");
        $data['tahun'] = $tahun;
        $data['status_cetak'] = $status_cetak;
        $data['catatankaki1']="data yang ditampilkan adalah yang sudah done";
        $data['catatankaki2']="jika ingin melihat data yang belum done, silakan cek di menu  <a href='".base_url('transaksi/hasil_klinik/')."'> hasil pemeriksaan klinik</a>";
        $this->template->load('body', 'transaksi/hasil/hasil_klinik_view',$data);
    }
    function get_tahun(){
        $tahun = $this->input->post('tahun');
        $data = $this->hasil_model->get_all_klinik_tahun($tahun);
        echo json_encode($data);
    }
    function update_sudah_cetak(){
        $nomor = $this->input->post('nomor');
        // $urut = $this->input->post('urut');
        $update = $this->hasil_model->update_sudah_cetak($nomor);
        echo json_encode($update);
    }
    function update($id,$urut){
        $id                     = str_replace(str_split('-'), '/', $id);
        $data['header']         = $this->hasil_model->header_hasil($id);
        // $data['detail']         = $this->hasil_model->detail_hasil_new($id,$urut);
        $data['detail']         = $this->hasil_model->detail_hasil_klinik($id,$urut);
        // detail_hasil_klinik
        $data['detail_kdpar']   = $this->hasil_model->detail_hasil_par($id);
        $this->load->model('master/sampel_model');
        $this->load->model('master/parameter_model');
        $data['data_sampel']        = $this->sampel_model->get_all();
        $data['data_parameter']     = $this->parameter_model->get_detail_by_lab('LK');
        $data['data_lab']           = 'LK';
        $data['urut']               = $urut;
        $data['data_analis']        = $this->db->query("SELECT id_username,nama FROM m_user WHERE app_level IN (1,6,7,8)")->result();
        $this->template->load('body', 'transaksi/hasil/hasil_klinik_form', $data);
    }
    function insert($id,$urut){
        $id                     = str_replace(str_split('-'), '/', $id);
        $data['header']         = $this->hasil_model->header_hasil($id);
        // $data['detail']         = $this->hasil_model->detail_hasil_new($id,$urut);
        $data['detail']         = $this->hasil_model->detail_hasil_klinik($id,$urut);
        if($urut>1)
        {
            $urut = $urut-1;
        $data['detail']         = $this->hasil_model->detail_hasil_klinik_urutsebelumnya($id,$urut);
          exit();
        }
        $data['detail_kdpar']   = $this->hasil_model->detail_hasil_par($id);
        $data['urut']           = $urut;
        $this->load->model('master/sampel_model');
        $this->load->model('master/parameter_model');
        $data['data_sampel']        = $this->sampel_model->get_all();
        $data['data_parameter']     = $this->parameter_model->get_detail_by_lab('LK');
        $data['data_lab']           = 'LK';
        $data['data_analis']        = $this->db->query("SELECT id_username,nama FROM m_user WHERE app_level IN (1,6,7,8)")->result();
        // $this->template->load('body', 'transaksi/hasil/hasil_klinik_insert', $data);
        $this->load->view('transaksi/hasil/hasil_klinik_insert',$data);
    }
    function detail($id,$urut){
        $id                     = str_replace(str_split('-'), '/', $id);
        $data['header']         = $this->hasil_model->header_hasil($id);
        // $data['detail']         = $this->hasil_model->detail_hasil_klinik($id,$urut);
        $data['detail']         = $this->hasil_model->detail_hasil_klinik($id,$urut);
        $data['detail_kdpar']   = $this->hasil_model->detail_hasil_par($id);
        $data['urut']           = $urut;
        $this->load->model('master/sampel_model');
        $this->load->model('master/parameter_model');
        $data['data_sampel']        = $this->sampel_model->get_all();
        $data['data_parameter']     = $this->parameter_model->get_detail_by_lab('LK');
        $data['data_lab']           = 'LK';
        $this->template->load('body', 'transaksi/hasil/hasil_klinik_detail', $data);
    }
    function update_act(){
        $update = $this->hasil_model->update_klinik_act();
        $this->session->set_flashdata('alert','Data Berhasil Disimpan');
        redirect('transaksi/hasil_klinik/');
    }   
    function insert_act(){
        // print_r();
        $json_data = json_encode($this->input->post(), JSON_PRETTY_PRINT);
// Menampilkan data JSON yang lebih mudah dibaca
        // echo '<pre>' . htmlspecialchars($json_data) . '</pre>';
        // exit();
        $update = $this->hasil_model->insert_klinik_act();
        // exit();
        $this->session->set_flashdata('alert','Data Berhasil Disimpan');
        redirect('transaksi/hasil_klinik/');
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
        $this->template->load('body','transaksi/hasil/hasil_klinik_print',$data);
    }
    function print(){
        // update_symbol_hasil();
        $nomor      = $this->input->post('nomor');
        $urut       = $this->input->post('urut');
        $agreditasi = $this->input->post('agreditasi');
        $print      = $this->input->post('print');
        $ttn        = $this->input->post('ttn');
        $ttl        = $this->input->post('ttl');
        $header_cetak=$this->input->post('header_cetak');
        $versi      = $this->input->post('versi');
        $type_surat = $this->input->post('type_surat');
        $type_laporan=$this->input->post('type_laporan');
        $napsa      = $this->input->post('napsa');
        $data['header']         = $this->hasil_model->header_hasil($nomor);
        $data['detail']         = $this->hasil_model->detail_hasil_klinik($nomor,$urut);
        $data['detail_kdpar']   = $this->hasil_model->detail_hasil_par($nomor);      
        $data['agreditasi']     = $agreditasi;
        $data['type_surat']     = $type_surat;
        $data['type_laporan']   = $type_laporan;
        $data['napsa']          = $napsa;
        // test($data,1);
        $data['ttn']            = $ttn;
        $data['ttl']            = $ttl;
        $data['header_cetak']   = $header_cetak;
        $data['ttd_kepala']     = $this->manajemen_model->get_all_detail(1);
        $data['ttd_tu']         = $this->manajemen_model->get_all_detail(3);
        $data['ttd_teknis']     = $this->manajemen_model->get_all_detail(2);
        $data['ttd_koor']       = $this->manajemen_model->get_all_detail(6);
        $data['note']           = $this->keterangan_model->get_detail_keterangan($versi,"LK");
        // print_r($data);
        // pre($_POST);
        // pre($data);
        // exit();
        if($print=='word'){
		//line di bawah untuk cetak word versi lama
        $this->load->view("transaksi/hasil/hasil_klinik_word",$data);
		//======line di bawah untuk cetak word versi baru============
        //$this->load->view("transaksi/hasil/hasil_klinik_phpword",$data);
        /* =================================== */
		// $this->load->view("transaksi/hasil/hasil_klinik_phpword",$data);
        }elseif ($print=='wordversi2') {
            # code...
        generateWordDocumentKlinik2($data['header'], $data['detail'], $data['detail_kdpar'], $data['ttd_kepala'], $data['ttd_tu'], $data['ttd_teknis'], $data['ttd_koor'], $data['type_surat'], $data['type_laporan'], $data['header_cetak'], $data['agreditasi'], $data['napsa'], $data['note'], $data['ttl'], $data['ttn']);
        }
        else{
            $this->load->view("transaksi/hasil/hasil_klinik_print",$data);
        }
    }
    function word(){
        // test($this->input->post('nomor'),1);
        $nomor      = $this->input->post('nomor');
        $urut       = $this->input->post('urut');
        $agreditasi = $this->input->post('agreditasi');
        $print      = $this->input->post('print');
        $data['header']         = $this->hasil_model->header_hasil($nomor);
        $data['detail']         = $this->hasil_model->detail_hasil_new($nomor,$urut);
        $data['detail_kdpar']   = $this->hasil_model->detail_hasil_par($nomor);      
        $data['agreditasi']     = $agreditasi;
        $data['print']          = $print;
        $data['ttd_kepala']     = $this->manajemen_model->get_all_detail(1);
        $data['ttd_tu']         = $this->manajemen_model->get_all_detail(3);
        $data['ttd_teknis']     = $this->manajemen_model->get_all_detail(2);
        $data['ttd_koor']       = $this->manajemen_model->get_all_detail(4);
        // $this->load->view("transaksi/hasil/hasil_klinik_word",$data);
        $this->load->view("transaksi/hasil/hasil_klinik_phpword",$data);
    }
    function download_word_document() {
        $nomor = "Nomor";
        $nama = "Nama";
        $hasil = "Hasil";
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $section->addText("Data Hasil Klinik");
        $section->addText("Nomor: " . $nomor);
        $section->addText("Nama: " . $nama);
        $section->addText("Hasil: " . $hasil);
        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="hasil_klinik_'.$nomor.'.docx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
    function download_excel_document() {
        $nomor = $this->input->post('nomor');
        $data = $this->hasil_model->get_data_for_document($nomor);
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Data Hasil Klinik');
        $sheet->setCellValue('A2', 'Nomor');
        $sheet->setCellValue('B2', $data['nomor']);
        $sheet->setCellValue('A3', 'Nama');
        $sheet->setCellValue('B3', $data['nama']);
        $sheet->setCellValue('A4', 'Hasil');
        $sheet->setCellValue('B4', $data['hasil']);
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="hasil_klinik_'.$nomor.'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
}
?>