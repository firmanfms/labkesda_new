<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adjustment extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Transaksi', 'active_submenu' => 'mutasi', 'active_submenu2' => 'adjustment'));
        $this->load->model('transaksi/mutasi_model');
    }


    function index(){  
        $data['data_mutasi']  = $this->mutasi_model->get_all_adjustment();
        $this->template->load('body', 'transaksi/mutasi/adjustment_view',$data);
    }

    function form_positif(){
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
        $data['new_mutasi_masuk']   = $new_mutasi_masuk;
        $this->template->load('body', 'transaksi/mutasi/adjustment_form_positif', $data);
    }

    function form_negatif(){
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
        $data['new_mutasi_masuk']   = $new_mutasi_masuk;
        // test($data,1);
        $this->template->load('body', 'transaksi/mutasi/adjustment_form_negatif', $data);
    }

    function get_barang(){
        $this->load->model('transaksi/mutasi_model');

        $data   = array(); 
        $start  = $this->input->get('start');
        $length = $this->input->get('length');
        $search = $this->input->get('search');
        $id     = $this->input->get('id');
        //test($start.' '.$length.' '.$search['value'].' '.$id,1);

        $list = $this->mutasi_model->get_all_barang_adj($start,$length,$search['value'],$id);
        if(is_for($list)){
            foreach ($list as $row) {

                $tgl_kadaluwarsa    = tgl_singkat($row->tgl_kadaluwarsa);

                // $hari           = substr($row->tgl_kadaluwarsa,0,2);
                // $bulan          = substr($row->tgl_kadaluwarsa,3,2);
                // $tahun          = substr($row->tgl_kadaluwarsa,6,4);
                // $tanggal        = $tahun.'-'.$bulan.'-'.$hari;

                // if($tanggal=='--'){
                //     $tanggal    = '1700-01-01';
                // }


                if($tgl_kadaluwarsa=='01/01/1700'){
                    $tgl_kadaluwarsa        = '';
                }

                $data[] = array(
                    'id_stok'           => $row->id_stok,
                    'id_barang'         => $row->id_barang,
                    'harga_perolehan'   => $row->harga_perolehan,
                    'qty'               => $row->qty,
                    'lot_no'            => $row->lot_no,
                    'tgl_kadaluwarsa'   => $tgl_kadaluwarsa,
                    'id_lokasi'         => $row->id_lokasi,
                    'nama'              => $row->nama.' ('.$row->satuan.')'
                );
            }
        }     

        if ($search['value']) {
            $total   = $this->mutasi_model->get_count_display_adj($start,$length,$search['value'],$id);
        }else {
            $total   = $this->mutasi_model->get_count_adj($id);
        }
        // $display = $this->item_model->get_count_display($start,$length,$search['value']);
        // jsout(array('success'=>1, 'aaData'=>$data));
        jsout(array('success'=>1, 'aaData'=>$data,'iTotalRecords'=>$total,'iTotalDisplayRecords'=>$total));

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
        //                 'type_adjustment'=> $this->input->post('type_adjustment'),
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
                    'type_adjustment'=> $this->input->post('type_adjustment'),
                    'no_hasil'       => $this->input->post('no_hasil')
            );
        }
        // test($new_mutasi_masuk,0);
        // test($exist,0);
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
        $save   = $this->mutasi_model->act_form_adjustment();

        $this->session->unset_userdata('new_mutasi_masuk');
        jsout(array('success' => true, 'status' => $save ));
    }

    function approve(){
        $id_mutasi          = $this->input->post('id_mutasi');
        $approve_mutasi     = $this->input->post('approve_mutasi');

        if($approve_mutasi==1){
            $this->mutasi_model->update_status($id_mutasi,$approve_mutasi);
            $this->mutasi_model->stok_adjustment($id_mutasi);

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

                $new_mutasi_masuk['items'][$key] = array(
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
            $new_mutasi_masuk['items'] = array();
        }

        $this->session->set_userdata('new_mutasi_masuk', $new_mutasi_masuk);
        $data['data_barang']        = $this->barang_model->get_all();
        $data['data_lokasi']        = $this->lokasi_model->get_all();
        $data['new_mutasi_masuk']   = $new_mutasi_masuk;
        $data['no_urut']            = $no;
        $data['header']             = $this->mutasi_model->mutasi_header($id)->row();
        $this->template->load('body', 'transaksi/mutasi/adjustment_edit', $data);
    }

    function edit_act(){
        $update   = $this->mutasi_model->act_edit_masuk();
        $this->session->unset_userdata('new_mutasi_masuk');
        jsout(array('success' => true, 'status' => $update ));
    }

    function reset(){
        $this->session->unset_userdata('new_mutasi_masuk');
        redirect('transaksi/adjustment');
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

    function show_lot(){
        $id_barang          = $this->input->post('id_barang');
        $id_lokasi          = $this->input->post('id_lokasi');

        $result     = $this->mutasi_model->sub_lokasi($id_lokasi,$id_barang);
        $data_array = array();
        foreach ($result as $key => $value) {
          array_push($data_array, $value->lot_no);
        }

        echo json_encode($data_array);
    }

    function batal($id){
        $this->session->unset_userdata('new_mutasi_keluar');

        $this->load->model('master/barang_model');
        $this->load->model('master/lokasi_model');

        $new_mutasi_keluar = $this->session->userdata('new_mutasi_keluar');
        $detail     = $this->mutasi_model->mutasi_detail_keluar_batal($id)->result();
        $tdetail    = $this->mutasi_model->mutasi_detail_keluar_batal($id)->num_rows();
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
        $data['detail']             = $detail;
        $this->template->load('body', 'transaksi/mutasi/adjustment_batal', $data);
    
    }

    function batal_detail(){
        $id_mutasi_detail   = $this->input->post('id_mutasi_detail');
        $det                = $this->mutasi_model->detail_mutasi($id_mutasi_detail);
        // test($det,1);
        $lot                = $det->lot_no;
        $id_barang          = $det->id_barang;
        $type_adjustment    = $det->type_adjustment;

        if($type_adjustment=='Negatif Adjustment'){
            $qty                = "+".$det->qty;
        }else{
            $qty                = "-".$det->qty;
        }

        // $cek_stok           = $this->mutasi_model->cek_stok_mutasi($id_barang,$lot);
        // if($cek_stok->qty>=$qty){

        if($det->harga_perolehan!=''){
            $harga_perolehan        = $det->harga_perolehan;
        }else{
            $harga_perolehan        = 0;
        }

            $this->db->query("UPDATE `t_mutasi_detail` SET type_adjustment='Delete' WHERE id_mutasi_detail='".$id_mutasi_detail."'");
        
            $this->db->query("INSERT INTO t_stok 
                (id_barang,tgl_transaksi,no_mutasi,tipe_mutasi,lot_no,tgl_kadaluwarsa,id_lokasi,id_sub_lokasi,qty,harga_perolehan)VALUES
                ('".$det->id_barang."','".$det->tgl."','".$det->no_mutasi."','Pembatalan','".strtoupper($det->lot_no)."','".$det->tgl_kadaluwarsa."','".$det->id_lokasi."','".$det->id_sub_lokasi."','".$qty."','".$harga_perolehan."')");

            jsout(array('keterangan' => true, 'status' => "Yes" ));
        
        // }else{

        //     jsout(array('keterangan' => false, 'status' => "No" ));
        // }
    }

}
?>