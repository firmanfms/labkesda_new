<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_klinik extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Transaksi', 'active_submenu' => 'pendaftaran', 'active_submenu2' => 'pendaftaran_klinik'));
        $this->load->model('transaksi/pendaftaran_model');
    }


    function index(){  
        $data['data_pendaftaran']  = $this->pendaftaran_model->get_all_klinik();
        $this->template->load('body', 'transaksi/pendaftaran/pendaftaran_klinik_view',$data);
    }

    function form(){
        $this->session->unset_userdata('new_klinik');

        // $this->load->model('master/laboratorium_model');
        // $this->load->model('master/lokasi_model');
        $this->load->model('master/sampel_model');
        $this->load->model('master/metode_model');

        $new_klinik = $this->session->userdata('new_klinik');
        // test($new_klinik,1);
        if(!$new_klinik){
            $new_klinik = array(
                'items' => array()
            );
        }

        $get_all_json               = $this->db->query("SELECT nama,alamat,telp,DATE(tgl_lahir)tgl_lahir FROM t_pendaftaran WHERE `status` = '1' AND nama IS NOT NULL GROUP BY nama")->result_array();
        $data['data_nama']          = $get_all_json;


        // $data['data_lab']           = $this->laboratorium_model->get_all();
        // $data['data_lokasi']        = $this->lokasi_model->get_all();
        $data['data_sampel']        = $this->sampel_model->get_all();
        $data['data_metode']        = $this->metode_model->get_all_by_jenis('LK');
        $data['data_lab']           = 'LK';
        $data['new_klinik']         = $new_klinik;
        $this->template->load('body', 'transaksi/pendaftaran/pendaftaran_klinik_form', $data);
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

    function form_act(){
        $save   = $this->pendaftaran_model->act_form_klinik();

        $this->session->unset_userdata('new_klinik');
        jsout(array('success' => true, 'status' => $save ));
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

        $get_all_json               = $this->db->query("SELECT nama,alamat,telp,DATE(tgl_lahir)tgl_lahir FROM t_pendaftaran WHERE `status` = '1' AND nama IS NOT NULL GROUP BY nama")->result_array();
        $data['data_nama']          = $get_all_json;
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

    function delete(){
        $delete = $this->pendaftaran_model->act_delete();
        jsout(array('success' => true, 'status' => $delete ));
    }

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

    function cetak_permintaan($id){
        $id                     = str_replace(str_split('-'), '/', $id);
        $data['header']         = $this->pendaftaran_model->header_pendaftaran($id);
        $data['detail']         = $this->pendaftaran_model->detail_pendaftaran($id);
        $data['detail_kdpar']   = $this->pendaftaran_model->detail_pendaftaran_par($id);
        $this->load->view('transaksi/pendaftaran/pendaftaran_klinik_print_permintaan',$data);
        // $this->template->load('body','transaksi/pendaftaran/pendaftaran_klinik_print',$data);
    }

}
?>