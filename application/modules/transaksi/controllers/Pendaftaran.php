<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pendaftaran extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Transaksi', 'active_submenu' => 'pendaftaran'));
        $this->load->model('transaksi/pendaftaran_model');
    }
    function index(){  
        $data['data_pendaftaran']  = $this->pendaftaran_model->get_all();
        $this->template->load('body', 'transaksi/pendaftaran/pendaftaran_view',$data);
    }
    function form(){
        $this->session->unset_userdata('new_mutasi_keluar');
        $this->load->model('master/laboratorium_model');
        $this->load->model('master/sampel_model');
        $this->load->model('master/lokasi_model');
        $new_mutasi_keluar = $this->session->userdata('new_mutasi_keluar');
        // test($new_mutasi_keluar,1);
        if(!$new_mutasi_keluar){
            $new_mutasi_keluar = array(
                'items' => array()
            );
        }
        $data['data_lab']           = $this->laboratorium_model->get_all();
        $data['data_sampel']        = $this->sampel_model->get_all();
        $data['data_lokasi']        = $this->lokasi_model->get_all();
        $data['new_mutasi_keluar']   = $new_mutasi_keluar;
        $this->template->load('body', 'transaksi/pendaftaran/pendaftaran_form', $data);
    }
    function add_item(){
        if(!isset($_POST['id_barang'])) return;
        $new_mutasi_keluar = $this->session->userdata('new_mutasi_keluar');
        $items = $new_mutasi_keluar['items'];
        $exist = false;
        if($items!=''){
        foreach($items as $key=>$val){
                if($val['id_barang'] == $this->input->post('id_barang')){
                    $new_mutasi_keluar['items'][$key] = array(
                        'id_barang'      => $this->input->post('id_barang'),
                        'nm_barang'      => $this->input->post('nm_barang'),
                        'quantity'       => $this->input->post('quantity'),
                        'no_lot'         => $this->input->post('no_lot'),
                        'kadaluarsa'     => $this->input->post('kadaluarsa'),
                        'id_stok'        => $this->input->post('id_stok')
                    );
                    $exist = true;
                    break;
                }
            }
        }
        if(!$exist){
            $new_mutasi_keluar['items'][] = array(
                    'id_barang'      => $this->input->post('id_barang'),
                    'nm_barang'      => $this->input->post('nm_barang'),
                    'quantity'       => $this->input->post('quantity'),
                    'no_lot'         => $this->input->post('no_lot'),
                    'kadaluarsa'     => $this->input->post('kadaluarsa'),
                    'id_stok'        => $this->input->post('id_stok')
            );
        }
        // test($new_mutasi_keluar,0);
        $this->session->set_userdata('new_mutasi_keluar', $new_mutasi_keluar);        
    }
    function remove_item(){
        if(!isset($_GET['index_id'])) return;
        $index_id = $this->input->get('index_id');
        $new_mutasi_keluar = $this->session->userdata('new_mutasi_keluar');
        $items = $new_mutasi_keluar['items'];
        foreach($items as $key=>$val){
            if($val['no_hasil'] == $index_id){
                unset($new_mutasi_keluar['items'][$key]);
                $new_mutasi_keluar['items'] = array_values($new_mutasi_keluar['items']);
                break;
            }
        }
        $this->session->set_userdata('new_mutasi_keluar', $new_mutasi_keluar);
        jsout(array('success'=>1)); 
    }
    function form_act(){
        $save   = $this->mutasi_model->act_form_keluar();
        $this->session->unset_userdata('new_mutasi_keluar');
        jsout(array('success' => true, 'status' => $save ));
    }
    function approve(){
        $id_mutasi          = $this->input->post('id_mutasi');
        $approve_mutasi     = $this->input->post('approve_mutasi');
        // test($id_mutasi.' '.$approve_mutasi,1);
        if($approve_mutasi==1){
            $this->mutasi_model->update_status($id_mutasi,$approve_mutasi);
            $this->mutasi_model->stok_keluar($id_mutasi);
        }elseif($approve_mutasi==2){
            $this->mutasi_model->update_status($id_mutasi,$approve_mutasi);
        }
    }
    function delete(){
        $delete = $this->mutasi_model->act_delete();
        jsout(array('success' => true, 'status' => $delete ));
    }
    function edit($id){
        $this->session->unset_userdata('new_mutasi_keluar');
        $this->load->model('master/barang_model');
        $this->load->model('master/lokasi_model');
        $new_mutasi_keluar = $this->session->userdata('new_mutasi_keluar');
        $detail     = $this->mutasi_model->mutasi_detail($id)->result();
        $tdetail    = $this->mutasi_model->mutasi_detail($id)->num_rows();
        $no         = 0;
        if($tdetail!=0){
            foreach($detail as $key=>$val){
                $bulan          = substr($val->tgl_kadaluwarsa,5,2);
                $hari           = substr($val->tgl_kadaluwarsa,8,2);
                $tahun          = substr($val->tgl_kadaluwarsa,0,4);
                $tanggal        = $bulan.'/'.$hari.'/'.$tahun;
                $new_mutasi_keluar['items'][$key] = array(
                    'no_hasil'      => $val->id_mutasi_detail,
                    'id_mutasi'     => $val->id_mutasi,
                    'id_barang'     => $val->id_barang,
                    'nm_barang'     => $val->nama,
                    'quantity'      => $val->qty,
                    'no_lot'        => $val->lot_no,
                    'kadaluarsa'    => $tanggal
                );
            }
            $no     = $val->id_mutasi_detail;
        }else{
            $new_mutasi_keluar['items'] = array();
        }
        $this->session->set_userdata('new_mutasi_keluar', $new_mutasi_keluar);
        $data['data_barang']        = $this->barang_model->get_all();
        $data['data_lokasi']        = $this->lokasi_model->get_all();
        $data['new_mutasi_keluar']   = $new_mutasi_keluar;
        $data['no_urut']            = $no;
        $data['header']             = $this->mutasi_model->mutasi_header($id)->row();
        $this->template->load('body', 'transaksi/mutasi/mutasi_keluar_edit', $data);
    }
    function edit_act(){
        $update   = $this->mutasi_model->act_edit_keluar();
        $this->session->unset_userdata('new_mutasi_keluar');
        jsout(array('success' => true, 'status' => $update ));
    }
    function reset(){
        $this->session->unset_userdata('new_mutasi_keluar');
        redirect('transaksi/mutasi_keluar');
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
//UPDATE t_pendaftaran SET status_bayar='yes' WHERE no_pendaftaran='$no_pendaftaran'
    function update_status_bayar(){
        $no_pendaftaran = str_replace('-','/',$this->input->post('no_pendaftaran'));
        $status_bayar   = $this->input->post('status_bayar');
        $this->db->set('status_bayar',$status_bayar);
        $this->db->where('no_pendaftaran',$no_pendaftaran);
        $this->db->update('t_pendaftaran');
        jsout(array('success'=>1, 'message'=>'Status bayar berhasil diubah' , 
        'Query'=>$this->db->last_query(), 'row_afected'=>$this->db->affected_rows()
    ));
    }
}
?>