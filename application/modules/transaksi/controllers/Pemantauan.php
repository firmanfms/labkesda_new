<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pemantauan extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Pemantauan', 'active_submenu' => '', 'active_submenu2' => ''));
        $this->load->model('transaksi/hasil_model');
    }
    function index(){  
        $data['data_mutu']  = $this->hasil_model->mutu_internal_view();
        $this->template->load('body', 'transaksi/pemantauan/pemantauan_view',$data);
    }
    function form(){
        $search             = $this->input->post('search');
        $tanggal_pilih      = dbnow();
        $kd_lab             = '';
		$nomor				= '';
        if($search!=''){
            // $tanggal                = $this->input->post('tanggal');
            $kd_lab                 = $this->input->post('kd_lab');
			$nomor                 	= $this->input->post('nomor');
            $data['kd_lab']         = $kd_lab;
            // $data['data_lab']       = $this->hasil_model->get_all_lab_new($tanggal,$kd_lab,$nomor);
            $data['data_lab']       = $this->hasil_model->get_all_lab_new_tanpa_tanggal($kd_lab,$nomor);
            $data['tanggal_pilih']  = $tanggal;
        }else{
            $data['kd_lab']         = $kd_lab;
            $data['data_lab']       = array();
            $data['tanggal_pilih']  = $tanggal_pilih;
			$data['nomor']         	= $nomor;
        }
        $this->template->load('body', 'transaksi/pemantauan/pemantauan_input', $data);
    }
    function delete(){
        $delete = $this->hasil_model->act_delete_pemantauan();
        jsout(array('success' => true, 'status' => $delete ));
    }
    function update($id){
        $data['pilih']  = $this->hasil_model->mutu_internal_detail($id);
        $this->template->load('body', 'transaksi/pemantauan/pemantauan_edit',$data);
    }
    function next_act(){
        // $pilih          = array();
        foreach ($this->input->post('kd_parameter') as $key => $value) {
            $pisah              = explode("-",$value);
            $no_pendaftaran     = $pisah['0'];
            $kd_parameter       = $pisah['1'];
            $detail             = $this->db->query("SELECT a.kd_sampel,c.`nm_sampel`,b.`kd_parameter`,d.`nm_parameter`,b.`kd_kategori_parameter`,e.`nm_kategori_parameter`,b.metode_analisa
                                                    FROM t_pendaftaran a 
                                                    LEFT JOIN m_sampel c ON c.`kd_sampel`=a.`kd_sampel` ,t_pendaftaran_detail b 
                                                    LEFT JOIN m_parameter d ON d.`kd_parameter`=b.`kd_parameter`
                                                    LEFT JOIN m_kategori_parameter e ON e.`kd_kategori_parameter`=d.`kd_kategori_parameter`
                                                    WHERE a.`no_pendaftaran`=b.`no_pendaftaran` AND b.`kd_parameter`='".$kd_parameter."' AND a.no_pendaftaran='".$no_pendaftaran."'")->row();
            $pilih[] = array(
                'no_pendaftaran'        => $no_pendaftaran,
                'kd_parameter'          => $kd_parameter,
                'kd_sampel'             => $detail->kd_sampel,
                'nm_sampel'             => $detail->nm_sampel,
                'nm_parameter'          => $detail->nm_parameter,
                'kd_kategori_parameter' => $detail->kd_kategori_parameter,
                'nm_kategori_parameter' => $detail->nm_kategori_parameter,
                'metode_analisa'        => $detail->metode_analisa
            );
        }
        $data['pilih']       = $pilih;
        $this->template->load('body', 'transaksi/pemantauan/pemantauan_next', $data);
    }
    function form_act(){
        $save   = $this->hasil_model->act_pemantauan();
        $this->session->set_flashdata('alert','Data Berhasil Disimpan');
        redirect('transaksi/pemantauan/');
        // $this->session->unset_userdata('new_klinik');
        // jsout(array('success' => true, 'status' => $save ));
    }
    function update_act(){
        $save   = $this->hasil_model->act_pemantauan_update();
        $this->session->set_flashdata('alert','Data Berhasil Di Update');
        redirect('transaksi/pemantauan/');
    }
    function add_item(){
        if(!isset($_POST['kd_kategori_parameter'])) return;
        $new_klinik = $this->session->userdata('new_klinik');
        $items = $new_klinik['items'];
        $exist = false;
        if($items!=''){
        foreach($items as $key=>$val){
                if($val['kd_kategori_parameter'] == $this->input->post('kd_kategori_parameter')){
                    $new_klinik['items'][$key] = array(
                        'kd_kategori_parameter'      => $this->input->post('kd_kategori_parameter'),
                        'nm_kategori_parameter'      => $this->input->post('nm_kategori_parameter')
                    );
                    $exist = true;
                    break;
                }
            }
        }
        if(!$exist){
            $new_klinik['items'][] = array(
                    'kd_kategori_parameter'      => $this->input->post('kd_kategori_parameter'),
                    'nm_kategori_parameter'      => $this->input->post('nm_kategori_parameter')
            );
        }
        // test($new_klinik,0);
        $this->session->set_userdata('new_klinik', $new_klinik);        
    }
    function remove_item(){
        if(!isset($_GET['index_id'])) return;
        $index_id = $this->input->get('index_id');
        $new_klinik = $this->session->userdata('new_klinik');
        $items = $new_klinik['items'];
        foreach($items as $key=>$val){
            if($val['kd_kategori_parameter'] == $index_id){
                unset($new_klinik['items'][$key]);
                $new_klinik['items'] = array_values($new_klinik['items']);
                break;
            }
        }
        $this->session->set_userdata('new_klinik', $new_klinik);
        jsout(array('success'=>1)); 
    }
    function edit($id){
        $nomor = str_replace("-", "/", $id);
        $this->session->unset_userdata('new_klinik');
        $this->load->model('master/sampel_model');
        $this->load->model('master/parameter_model');
        $this->load->model('master/metode_model');
        $new_klinik         = $this->session->userdata('new_klinik');
        $detail             = $this->pendaftaran_model->detail_metode_pendaftaran($nomor)->result();
        $tdetail            = $this->pendaftaran_model->detail_parameter_pendaftaran($nomor)->num_rows();
        $no                 = 0;
        $new_klinik['items'] = array();
        $this->session->set_userdata('new_klinik', $new_klinik);        
        $data['header']             = $this->pendaftaran_model->header_pendaftaran($nomor);
        $data['data_sampel']        = $this->sampel_model->get_all();
        $data['data_metode']        = $this->metode_model->get_all_by_jenis_detail('LK',$nomor);
        // $data['data_parameter']     = $this->parameter_model->get_detail_by_lab('LK');
        $data['data_lab']           = 'LK';
        $data['new_klinik']         = $new_klinik;
        $data['detail']             = $detail;
        // test($detail,1);
        $this->template->load('body', 'transaksi/pendaftaran/pendaftaran_klinik_edit', $data);
    }
    function edit_act(){
        $update     = $this->pendaftaran_model->act_edit_klinik();
        $this->session->unset_userdata('new_klinik');
        jsout(array('success' => true, 'status' => $update ));
    }
    function approve(){
        $nomor          = $this->input->post('nomor');
        $level          = $this->input->post('level');
        $update         = $this->db->query("UPDATE `t_pendaftaran_detail` SET `status_approve` = '".$level."' WHERE `no_pendaftaran` = '".$nomor."'");
    }
    // function approve(){
    //     $id_mutasi          = $this->input->post('id_mutasi');
    //     $approve_mutasi     = $this->input->post('approve_mutasi');
    //     // test($id_mutasi.' '.$approve_mutasi,1);
    //     if($approve_mutasi==1){
    //         $this->mutasi_model->update_status($id_mutasi,$approve_mutasi);
    //         $this->mutasi_model->stok_keluar($id_mutasi);
    //     }elseif($approve_mutasi==2){
    //         $this->mutasi_model->update_status($id_mutasi,$approve_mutasi);
    //     }
    // }
    // function delete(){
    //     $delete = $this->pendaftaran_model->act_delete();
    //     jsout(array('success' => true, 'status' => $delete ));
    // }
    function reset(){
        $this->session->unset_userdata('new_klinik');
        redirect('transaksi/pendaftaran_klinik');
    }
    function detail_items_mutasi(){
        $sup_id     = $this->input->post('id');
        $result     = $this->mutasi_model->detail_items_mutasi($sup_id);
        echo json_encode($result);
    }
    function view_popup($id){
        $id                     = str_replace(str_split('-'), '/', $id);
        $data['header']         = $this->pendaftaran_model->header_pendaftaran($id);
        $data['detail']         = $this->pendaftaran_model->detail_pendaftaran($id);
        $data['detail_kdpar']   = $this->pendaftaran_model->detail_pendaftaran_par($id);
        $this->load->view('transaksi/pendaftaran/pendaftaran_klinik_popup',$data);
    }
    function get_barang(){
        $this->load->model('transaksi/mutasi_model');
        $data   = array(); 
        $start  = $this->input->get('start');
        $length = $this->input->get('length');
        $search = $this->input->get('search');
        $id     = $this->input->get('id');
        //test($start.' '.$length.' '.$search['value'].' '.$id,1);
        $list = $this->mutasi_model->get_all_barang($start,$length,$search['value'],$id);
        if(is_for($list)){
            foreach ($list as $row) {
                $data[] = array(
                    'id_stok'           => $row->id_stok,
                    'id_barang'         => $row->id_barang,
                    'qty'               => $row->qty,
                    'lot_no'            => $row->lot_no,
                    'tgl_kadaluwarsa'   => $row->tgl_kadaluwarsa,
                    'id_lokasi'         => $row->id_lokasi,
                    'nama'              => $row->nama
                );
            }
        }     
        if ($search['value']) {
            $total   = $this->mutasi_model->get_count_display($start,$length,$search['value'],$id);
        }else {
            $total   = $this->mutasi_model->get_count($id);
        }
        // $display = $this->item_model->get_count_display($start,$length,$search['value']);
        // jsout(array('success'=>1, 'aaData'=>$data));
        jsout(array('success'=>1, 'aaData'=>$data,'iTotalRecords'=>$total,'iTotalDisplayRecords'=>$total));
    }
    function cetak($id){
        $id                     = str_replace(str_split('-'), '/', $id);
        $data['header']         = $this->pendaftaran_model->header_pendaftaran($id);
        $data['detail']         = $this->pendaftaran_model->detail_pendaftaran($id);
        $data['detail_kdpar']   = $this->pendaftaran_model->detail_pendaftaran_par($id);
        $this->load->view('transaksi/pendaftaran/pendaftaran_klinik_print',$data);
        // $this->template->load('body','transaksi/pendaftaran/pendaftaran_klinik_print',$data);
    }
}
?>