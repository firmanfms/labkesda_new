<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi_masuk extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Transaksi', 'active_submenu' => 'mutasi', 'active_submenu2' => 'mutasi_masuk'));
        $this->load->model('transaksi/mutasi_model');
    }


    function index(){  
        $data['data_mutasi']  = $this->mutasi_model->get_all_masuk();
        $this->template->load('body', 'transaksi/mutasi/mutasi_masuk_view',$data);
    }

    function form(){
        $this->session->unset_userdata('new_mutasi_masuk');

        $this->load->model('master/barang_model');
        $this->load->model('master/lokasi_model');

        $new_mutasi_masuk = $this->session->userdata('new_mutasi_masuk');
        // test($new_mutasi_masuk,1);
        if(!$new_mutasi_masuk){
            $new_mutasi_masuk = array(
                'items' => array()
            );
        }

        $data['data_barang']        = $this->barang_model->get_all();
        $data['data_lokasi']        = $this->lokasi_model->get_all();
        $data['data_sumber']        = $this->mutasi_model->get_all_sumber(); 
        $data['new_mutasi_masuk']   = $new_mutasi_masuk;
        $this->template->load('body', 'transaksi/mutasi/mutasi_masuk_form', $data);
    }

    function add_item(){
        if(!isset($_POST['id_barang'])) return;
        
        $new_mutasi_masuk = $this->session->userdata('new_mutasi_masuk');

        $items = $new_mutasi_masuk['items'];
        $exist = false;
        // if($items!=''){
        //     foreach($items as $key=>$val){
        //         if($val['id_barang'] == $this->input->post('id_barang')){
        //             $new_mutasi_masuk['items'][$key] = array(
        //                 'id_barang'      => $this->input->post('id_barang'),
        //                 'nm_barang'      => $this->input->post('nm_barang'),
        //                 'quantity'       => $this->input->post('quantity'),
        //                 'no_lot'         => $this->input->post('no_lot'),
        //                 'kadaluarsa'     => $this->input->post('kadaluarsa'),
        //                 'harga_perolehan'=> $this->input->post('harga_perolehan'),
        //                 'no_hasil'       => $this->input->post('no_hasil')
        //             );
        //             $exist = true;
        //             break;
        //         }
        //     }
        // }

        if(!$exist){
            $new_mutasi_masuk['items'][] = array(
                    'id_barang'      => $this->input->post('id_barang'),
                    'nm_barang'      => $this->input->post('nm_barang'),
                    'quantity'       => $this->input->post('quantity'),
                    'no_lot'         => $this->input->post('no_lot'),
                    'kadaluarsa'     => $this->input->post('kadaluarsa'),
                    'harga_perolehan'=> $this->input->post('harga_perolehan'),
                    'no_hasil'       => $this->input->post('no_hasil')
            );
        }
        
        $this->session->set_userdata('new_mutasi_masuk', $new_mutasi_masuk);        
    }

    function remove_item(){
        if(!isset($_GET['index_id'])) return;
        $index_id = $this->input->get('index_id');
        $new_mutasi_masuk = $this->session->userdata('new_mutasi_masuk');

        $items = $new_mutasi_masuk['items'];
        foreach($items as $key=>$val){
            if($val['no_hasil'] == $index_id){
                unset($new_mutasi_masuk['items'][$key]);
                $new_mutasi_masuk['items'] = array_values($new_mutasi_masuk['items']);
                break;
            }
        }

        $this->session->set_userdata('new_mutasi_masuk', $new_mutasi_masuk);
        jsout(array('success'=>1)); 
    }

    function form_act(){
        $save   = $this->mutasi_model->act_form_masuk();

        $this->session->unset_userdata('new_mutasi_masuk');
        jsout(array('success' => true, 'status' => $save ));
    }

    function approve(){
        $id_mutasi          = $this->input->post('id_mutasi');
        $approve_mutasi     = $this->input->post('approve_mutasi');

        if($approve_mutasi==1){
            $this->mutasi_model->update_status($id_mutasi,$approve_mutasi);
            $this->mutasi_model->stok($id_mutasi);

        }elseif($approve_mutasi==2){
            $this->mutasi_model->update_status($id_mutasi,$approve_mutasi);
        }
    }

    function delete(){
        $delete = $this->mutasi_model->act_delete();
        jsout(array('success' => true, 'status' => $delete ));
    }

    function edit($id){
        $this->session->unset_userdata('new_mutasi_masuk');

        $this->load->model('master/barang_model');
        $this->load->model('master/lokasi_model');

        $new_mutasi_masuk = $this->session->userdata('new_mutasi_masuk');
        $detail     = $this->mutasi_model->mutasi_detail($id)->result();
        $tdetail    = $this->mutasi_model->mutasi_detail($id)->num_rows();
        $no         = 0;
        if($tdetail!=0){
            foreach($detail as $key=>$val){
                $bulan          = substr($val->tgl_kadaluwarsa,5,2);
                $hari           = substr($val->tgl_kadaluwarsa,8,2);
                $tahun          = substr($val->tgl_kadaluwarsa,0,4);
                $tanggal        = $bulan.'/'.$hari.'/'.$tahun;

                if($tanggal=='01/01/1700'){
                    $tanggal        = '';
                }

                $new_mutasi_masuk['items'][$key] = array(
                    'no_hasil'      => $val->id_mutasi_detail,
                    'id_mutasi'     => $val->id_mutasi,
                    'id_barang'     => $val->id_barang,
                    'nm_barang'     => $val->nama,
                    'harga_perolehan'=> number_format($val->harga_perolehan,2),
                    'quantity'      => $val->qty,
                    'no_lot'        => $val->lot_no,
                    'kadaluarsa'    => $tanggal
                );
            }
            $no     = $val->id_mutasi_detail;
        }else{
            $new_mutasi_masuk['items'] = array();
        }

        $this->session->set_userdata('new_mutasi_masuk', $new_mutasi_masuk);
        $data['data_barang']        = $this->barang_model->get_all();
        $data['data_lokasi']        = $this->lokasi_model->get_all();
        $data['new_mutasi_masuk']   = $new_mutasi_masuk;
        $data['no_urut']            = $no;
        $data['header']             = $this->mutasi_model->mutasi_header($id)->row();
		$data['data_sumber']     	= $this->mutasi_model->get_all_sumber(); 
        $this->template->load('body', 'transaksi/mutasi/mutasi_masuk_edit', $data);
    }

    function edit_act(){
        $update   = $this->mutasi_model->act_edit_masuk();
        $this->session->unset_userdata('new_mutasi_masuk');
        jsout(array('success' => true, 'status' => $update ));
    }

    function reset(){
        $this->session->unset_userdata('new_mutasi_masuk');
        redirect('transaksi/mutasi_masuk');
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

    function stok_barang(){
        $id         = $this->input->post('id');
        $result     = $this->mutasi_model->stok_barang($id);
        echo json_encode($result);
    }

    function cetak($id){
        $data['header']     = $this->mutasi_model->mutasi_header($id)->row();
        $data['detail']     = $this->mutasi_model->mutasi_detail($id)->result();

        $this->load->view('transaksi/mutasi/mutasi_print',$data);
    }

    function batal($id){
        $this->session->unset_userdata('new_mutasi_masuk');

        $this->load->model('master/barang_model');
        $this->load->model('master/lokasi_model');

        $new_mutasi_masuk = $this->session->userdata('new_mutasi_masuk');
        $detail     = $this->mutasi_model->mutasi_detail($id)->result();
        $tdetail    = $this->mutasi_model->mutasi_detail($id)->num_rows();
        $no         = 0;
        if($tdetail!=0){
            foreach($detail as $key=>$val){
                $bulan          = substr($val->tgl_kadaluwarsa,5,2);
                $hari           = substr($val->tgl_kadaluwarsa,8,2);
                $tahun          = substr($val->tgl_kadaluwarsa,0,4);
                $tanggal        = $bulan.'/'.$hari.'/'.$tahun;

                if($tanggal=='01/01/1700'){
                    $tanggal        = '';
                }

                $new_mutasi_masuk['items'][$key] = array(
                    'no_hasil'      => $val->id_mutasi_detail,
                    'id_mutasi'     => $val->id_mutasi,
                    'id_barang'     => $val->id_barang,
                    'nm_barang'     => $val->nama,
                    'harga_perolehan'=> number_format($val->harga_perolehan,2),
                    'quantity'      => $val->qty,
                    'no_lot'        => $val->lot_no,
                    'kadaluarsa'    => $tanggal
                );
            }
            $no     = $val->id_mutasi_detail;
        }else{
            $new_mutasi_masuk['items'] = array();
        }

        $this->session->set_userdata('new_mutasi_masuk', $new_mutasi_masuk);
        $data['data_barang']        = $this->barang_model->get_all();
        $data['data_lokasi']        = $this->lokasi_model->get_all();
        $data['new_mutasi_masuk']   = $new_mutasi_masuk;
        $data['no_urut']            = $no;
        $data['header']             = $this->mutasi_model->mutasi_header($id)->row();
        $data['detail']             = $detail;
        $this->template->load('body', 'transaksi/mutasi/mutasi_masuk_batal', $data);
    }

    function batal_detail(){
        $id_mutasi_detail   = $this->input->post('id_mutasi_detail');
        $det                = $this->mutasi_model->detail_mutasi($id_mutasi_detail);
        // test($det,1);
        $lot                = $det->lot_no;
        $qty                = $det->qty;
        $id_barang          = $det->id_barang;

        $cek_stok           = $this->mutasi_model->cek_stok_mutasi($id_barang,$lot);
        if($cek_stok->qty>=$qty){

            $this->db->query("UPDATE `t_mutasi_detail` SET type_adjustment='Delete' WHERE id_mutasi_detail='".$id_mutasi_detail."'");
        
            $this->db->query("INSERT INTO t_stok 
                (id_barang,tgl_transaksi,no_mutasi,tipe_mutasi,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi,qty,harga_perolehan)VALUES
                ('".$det->id_barang."','".$det->tgl."','".$det->no_mutasi."','Pembatalan','".strtoupper($det->lot_no)."','".$det->tgl_kadaluwarsa."','".$det->id_lokasi."','".$det->id_sub_lokasi."','-".$det->qty."','".$det->harga_perolehan."')");

            jsout(array('keterangan' => true, 'status' => "Yes" ));
        
        }else{

            jsout(array('keterangan' => false, 'status' => "No" ));
        }
    }

}
?>