<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_lingkungan extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Transaksi', 'active_submenu' => 'pendaftaran', 'active_submenu2' => 'pendaftaran_lingkungan'));
        $this->load->model('transaksi/pendaftaran_model');
    }

    function index(){  
        $this->load->model('master/sampel_model');

        $data['data_sampel']        = $this->sampel_model->get_all();
        $data['data_pendaftaran']   = $this->pendaftaran_model->get_all_lingkungan();
        $this->template->load('body', 'transaksi/pendaftaran/pendaftaran_lingkungan_view',$data);
    }

    function form(){
        $this->session->unset_userdata('new_lingkungan');

        // $this->load->model('master/laboratorium_model');
        // $this->load->model('master/lokasi_model');
        $this->load->model('master/sampel_model');
        $this->load->model('master/parameter_model');
        $this->load->model('master/metode_model');

        $new_lingkungan = $this->session->userdata('new_lingkungan');
        // test($new_lingkungan,1);
        if(!$new_lingkungan){
            $new_lingkungan = array(
                'items' => array()
            );
        }

        $get_all_json               = $this->db->query("SELECT nama,alamat,telp FROM t_pendaftaran WHERE `status` = '1' AND nama IS NOT NULL GROUP BY nama")->result_array();
        $data_array = array();
        $sug        = array();
        // foreach ($get_all_json as $key => $value) {
        //     $sug       = array(
        //         "nama"  => $value->nama,
        //         "alamat"=> $value->alamat
        //     );
        //   array_push($data_array, $sug);
        // }
        $data['data_nama']         = $get_all_json;
        // test($data,1);

        // $data['data_lab']           = $this->laboratorium_model->get_all();
        // $data['data_lokasi']        = $this->lokasi_model->get_all();
        $data['data_sampel']        = $this->sampel_model->get_all();
        $data['data_parameter']     = $this->parameter_model->get_detail_by_lab('LL');
        $data['data_metode']        = $this->metode_model->get_all_by_sampel($this->input->post('kd_sampel'));
        $data['data_lab']           = 'LL';
        $data['kode_sample']        = $this->input->post('kd_sampel');
        $data['new_lingkungan']         = $new_lingkungan;
        $this->template->load('body', 'transaksi/pendaftaran/pendaftaran_lingkungan_form', $data);
    }

    function add_item(){
        if(!isset($_POST['kd_kategori_parameter'])) return;
        
        $new_lingkungan = $this->session->userdata('new_lingkungan');

        $items = $new_lingkungan['items'];
        $exist = false;
        if($items!=''){
        foreach($items as $key=>$val){
                if($val['kd_kategori_parameter'] == $this->input->post('kd_kategori_parameter')){
                    $new_lingkungan['items'][$key] = array(
                        'kd_kategori_parameter'      => $this->input->post('kd_kategori_parameter'),
                        'nm_kategori_parameter'      => $this->input->post('nm_kategori_parameter')
                    );
                    $exist = true;
                    break;
                }
            }
        }

        if(!$exist){
            $new_lingkungan['items'][] = array(
                    'kd_kategori_parameter'      => $this->input->post('kd_kategori_parameter'),
                    'nm_kategori_parameter'      => $this->input->post('nm_kategori_parameter')
            );
        }
        // test($new_lingkungan,0);
        $this->session->set_userdata('new_lingkungan', $new_lingkungan);        
    }

    function remove_item(){
        if(!isset($_GET['index_id'])) return;
        $index_id = $this->input->get('index_id');
        $new_lingkungan = $this->session->userdata('new_lingkungan');

        $items = $new_lingkungan['items'];
        foreach($items as $key=>$val){
            if($val['kd_kategori_parameter'] == $index_id){
                unset($new_lingkungan['items'][$key]);
                $new_lingkungan['items'] = array_values($new_lingkungan['items']);
                break;
            }
        }

        $this->session->set_userdata('new_lingkungan', $new_lingkungan);
        jsout(array('success'=>1)); 
    }

    function form_act(){
        $save   = $this->pendaftaran_model->act_form_lingkungan();

        $this->session->unset_userdata('new_lingkungan');
        jsout(array('success' => true, 'status' => $save ));
    }

    function edit($id){
        $nomor = str_replace("-", "/", $id);
        // test($nomor,1);
        $this->session->unset_userdata('new_lingkungan');

        $this->load->model('master/sampel_model');
        $this->load->model('master/parameter_model');
        $this->load->model('master/metode_model');

        $new_lingkungan     = $this->session->userdata('new_lingkungan');
        $detail             = $this->pendaftaran_model->detail_metode_pendaftaran($nomor)->result();
        $tdetail            = $this->pendaftaran_model->detail_parameter_pendaftaran($nomor)->num_rows();
        $no                 = 0;

        $new_lingkungan['items'] = array();

        $this->session->set_userdata('new_lingkungan', $new_lingkungan);        

        $data['header']             = $this->pendaftaran_model->header_pendaftaran($nomor);
        $data['data_sampel']        = $this->sampel_model->get_all();
        $data['data_parameter']     = $this->parameter_model->get_detail_by_lab('LL');
        $data['data_metode']        = $this->metode_model->get_all_by_jenis_detail('LL',$nomor);
        $data['data_lab']           = 'LL';
        $data['new_lingkungan']     = $new_lingkungan;
        $data['detail']             = $detail;

        $get_all_json               = $this->db->query("SELECT nama,alamat,telp FROM t_pendaftaran WHERE `status` = '1' AND nama IS NOT NULL GROUP BY nama")->result_array();
        $data['data_nama']          = $get_all_json;

        $this->template->load('body', 'transaksi/pendaftaran/pendaftaran_lingkungan_edit', $data);
    }

    function edit_new(){
        $this->session->unset_userdata('new_lingkungan');

        $this->load->model('master/sampel_model');
        $this->load->model('master/parameter_model');
        $this->load->model('master/metode_model');

        $new_lingkungan = $this->session->userdata('new_lingkungan');
        // test($new_lingkungan,1);
        if(!$new_lingkungan){
            $new_lingkungan = array(
                'items' => array()
            );
        }

        $get_all_json     = $this->db->query("SELECT nama,alamat FROM t_pendaftaran WHERE `status` = '1' AND nama IS NOT NULL")->result_array();
        $data['data_nama']         = $get_all_json;

        $tdetail            = $this->pendaftaran_model->detail_parameter_pendaftaran($this->input->post('no_pendaftaran'))->num_rows();
        // test($detail,1);

        $data['header']             = $this->pendaftaran_model->header_pendaftaran($this->input->post('no_pendaftaran'));
        $data['data_sampel']        = $this->sampel_model->get_all();
        $data['data_parameter']     = $this->parameter_model->get_detail_by_lab('LL');

        if($this->input->post('kd_sampel_old')!=$this->input->post('kd_sampel_edit')){
            $data['data_metode']    = $this->metode_model->get_all_by_sampel_old($this->input->post('kd_sampel_edit'));
            $detail                 = array();
            // test("disini1",1);
        }else{
            $data['data_metode']    = $this->metode_model->get_all_by_sampel_ll($this->input->post('kd_sampel_edit'),$this->input->post('no_pendaftaran'));
            $detail                 = $this->pendaftaran_model->detail_metode_pendaftaran($this->input->post('no_pendaftaran'))->result();
            // test("disini2",1);
        }
        // test($data['data_metode'],1);
        $data['data_lab']           = 'LL';
        $data['sampel_new']         = $this->input->post('kd_sampel_edit');
        $data['sampel_old']         = $this->input->post('kd_sampel_old');
        $data['kode_sample']        = $this->input->post('kd_sampel_edit');
        $data['no_pendaftaran']     = $this->input->post('no_pendaftaran');
        $data['new_lingkungan']     = $new_lingkungan;
        $data['detail']             = $detail;

        $this->template->load('body', 'transaksi/pendaftaran/pendaftaran_lingkungan_edit', $data);
    }

    function edit_act(){
        $update     = $this->pendaftaran_model->act_edit_lengkungan();
        $this->session->unset_userdata('new_lingkungan');
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

    function delete(){
        $delete = $this->pendaftaran_model->act_delete();
        jsout(array('success' => true, 'status' => $delete ));
    }

    function reset(){
        $this->session->unset_userdata('new_lingkungan');
        redirect('transaksi/pendaftaran_lingkungan');
    }

    function detail_items_mutasi(){
        $sup_id     = $this->input->post('id');
        $result     = $this->mutasi_model->detail_items_mutasi($sup_id);
        echo json_encode($result);
    }

    function view_popup($id){
        $data['detail']             = $this->mutasi_model->mutasi_detail($id)->result();
        $data['tdetail']            = $this->mutasi_model->mutasi_detail($id)->num_rows();
        $data['header']             = $this->mutasi_model->mutasi_header($id)->row();
        
        $this->load->view('transaksi/mutasi/mutasi_detail_popup',$data);
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
        $this->load->view('transaksi/pendaftaran/pendaftaran_lingkungan_print',$data);
    }

    function cetak_permintaan($id){
        $id                     = str_replace(str_split('-'), '/', $id);
        $data['header']         = $this->pendaftaran_model->header_pendaftaran($id);
        $data['detail']         = $this->pendaftaran_model->detail_pendaftaran($id);
        $data['detail_kdpar']   = $this->pendaftaran_model->detail_pendaftaran_par($id);
        $this->load->view('transaksi/pendaftaran/pendaftaran_lingkungan_print_permintaan',$data);
        // $this->template->load('body','transaksi/pendaftaran/pendaftaran_klinik_print',$data);
    }

}
?>