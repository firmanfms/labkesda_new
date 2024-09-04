<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('transaksi/mutasi_model');
        $this->load->model('master/lokasi_model');
        $this->load->model('master/barang_model');
        $this->load->model('master/katbarang_model');
    }


    function index(){  
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Report', 'active_submenu' => 'stok', 'active_submenu2' => ''));

        $data['data_lokasi']    = $this->lokasi_model->get_all();
        $id_lokasi              = '';
        $tgl_smp                = '';
        $tgl_smp_asli           = '';
        if($this->input->post('id_lokasi')!=''){
            $id_lokasi          = $this->input->post('id_lokasi');

            $hari                   = substr($this->input->post('tgl_smp'),0,2);
            $bulan                  = substr($this->input->post('tgl_smp'),3,2);
            $tahun                  = substr($this->input->post('tgl_smp'),6,4);
            $tgl_smp                = $tahun.'-'.$bulan.'-'.$hari;
            $tgl_smp_asli           = $this->input->post('tgl_smp');

        }
        $data['id_lokasi']      = $id_lokasi;
        $data['tgl_smp']        = $tgl_smp;
        $data['tgl_smp_asli']   = $tgl_smp_asli;
        $data['data_mutasi']    = $this->mutasi_model->last_stok($id_lokasi,$tgl_smp);

        $this->template->load('body', 'report/stok',$data);
    }

    function stok_cetak($id,$tgl_smp){
        $data['data_mutasi']    = $this->mutasi_model->last_stok($id,$tgl_smp);        
        $data['tgl_smp']        = $tgl_smp;
        $this->load->view('report/stok_cetak',$data);
    }

    function history_stok(){  
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Report', 'active_submenu' => 'history_stok', 'active_submenu2' => ''));
        $data['data_lokasi']    = $this->lokasi_model->get_all();
        $data['data_barang']    = $this->barang_model->get_all();
        $id_lokasi              = '';
        $data['data_mutasi']    = array('');
        $data['year_now']       = date('Y');
        $data['year_old']       = date('Y')-1;
        $data['tgl_dari_asli']  = '';
        $data['tgl_smp_asli']   = '';
        $data['id_barang']      = '';
        $data['data_month']  = array(
                array('id' => '1', 'nama_bulan' => 'January'),
                array('id' => '2', 'nama_bulan' => 'February'),
                array('id' => '3', 'nama_bulan' => 'March'),
                array('id' => '4', 'nama_bulan' => 'April'),
                array('id' => '5', 'nama_bulan' => 'May'),
                array('id' => '6', 'nama_bulan' => 'June'),
                array('id' => '7', 'nama_bulan' => 'July'),
                array('id' => '8', 'nama_bulan' => 'August'),
                array('id' => '9', 'nama_bulan' => 'September'),
                array('id' => '10', 'nama_bulan' => 'October'),
                array('id' => '11', 'nama_bulan' => 'November'),
                array('id' => '12', 'nama_bulan' => 'December'));
        if($this->input->post('id_lokasi')!=''){
            $hari                   = substr($this->input->post('tgl_dari'),0,2);
            $bulan                  = substr($this->input->post('tgl_dari'),3,2);
            $tahun                  = substr($this->input->post('tgl_dari'),6,4);
            $tanggal_dari           = $tahun.'-'.$bulan.'-'.$hari;

            $hari1                  = substr($this->input->post('tgl_smp'),0,2);
            $bulan1                 = substr($this->input->post('tgl_smp'),3,2);
            $tahun1                 = substr($this->input->post('tgl_smp'),6,4);
            $tanggal_smp            = $tahun1.'-'.$bulan1.'-'.$hari1;
            $id_barang              = $this->input->post('id_barang');

            $id_lokasi              = $this->input->post('id_lokasi');
            $data['tgl_dari']       = $tanggal_dari;
            $data['tgl_smp']        = $tanggal_smp;
            $data['tgl_dari_asli']  = $this->input->post('tgl_dari');
            $data['tgl_smp_asli']   = $this->input->post('tgl_smp');
            $data['id_barang']      = $this->input->post('id_barang');
            $data['data_mutasi']    = $this->mutasi_model->history_stok_barang($id_lokasi,$tanggal_dari,$tanggal_smp,$id_barang);
        }
        $data['id_lokasi']      = $id_lokasi;

        $this->template->load('body', 'report/history_stok',$data);
    }

    function history_stok_cetak($id,$tgl_dari,$tgl_smp,$id_barang){  

        $data['data_mutasi']    = $this->mutasi_model->history_stok_barang($id,$tgl_dari,$tgl_smp,$id_barang);
        $data['id_lokasi']      = $id;
        $data['tgl_dari']       = $tgl_dari;
        $data['tgl_smp']        = $tgl_smp;
        // test($data,1);
        $this->load->view('report/history_stok_cetak',$data);
    }

    function kategori_stok(){  
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Report', 'active_submenu' => 'kategori_stok', 'active_submenu2' => ''));
        $data['data_kategori']  = $this->katbarang_model->get_all();
        $id_kat_barang          = '';
        $data['tgl_dari']       = '';
        $data['data_stok']      = array('');
        $data['year_now']       = date('Y');
        $data['year_old']       = date('Y')-1;
        $data['tgl_dari_asli']  = '';
        $data['data_month']  = array(
                array('id' => '01', 'nama_bulan' => 'January'),
                array('id' => '02', 'nama_bulan' => 'February'),
                array('id' => '03', 'nama_bulan' => 'March'),
                array('id' => '04', 'nama_bulan' => 'April'),
                array('id' => '05', 'nama_bulan' => 'May'),
                array('id' => '06', 'nama_bulan' => 'June'),
                array('id' => '07', 'nama_bulan' => 'July'),
                array('id' => '08', 'nama_bulan' => 'August'),
                array('id' => '09', 'nama_bulan' => 'September'),
                array('id' => '10', 'nama_bulan' => 'October'),
                array('id' => '11', 'nama_bulan' => 'November'),
                array('id' => '12', 'nama_bulan' => 'December'));
        if($this->input->post('id_kat_barang')!=''){

            $hari                   = substr($this->input->post('tgl_dari'),0,2);
            $bulan                  = substr($this->input->post('tgl_dari'),3,2);
            $tahun                  = substr($this->input->post('tgl_dari'),6,4);
            $tanggal                = $tahun.'-'.$bulan.'-'.$hari;

            $id_kat_barang          = $this->input->post('id_kat_barang');
            $data['tgl_dari_asli']  = $this->input->post('tgl_dari');
            $data['tgl_dari']       = $tanggal;

            $data['data_stok']      = $this->mutasi_model->kategori_stok($id_kat_barang,$tanggal);
        }
        $data['id_kat_barang']      = $id_kat_barang;
        // test($data,1);

        $this->template->load('body', 'report/kategori_stok',$data);
    }

    function kategori_stok_cetak($id_kat_barang,$tgl_dari){  
            $id_kat_barang          = $id_kat_barang;
            // $data['year1']          = $year;
            $data['tgl_dari']       = $tgl_dari;
            $data['data_stok']      = $this->mutasi_model->kategori_stok($id_kat_barang,$tgl_dari);
        
        $this->load->view('report/kategori_stok_cetak',$data);
    }

    function pemakaian(){  
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Report', 'active_submenu' => 'pemakaian', 'active_submenu2' => ''));
        $data['data_kategori']  = $this->katbarang_model->get_all();
        $data['data_sumber']    = $this->mutasi_model->get_all_sumber(); 
        $id_kat_barang          = '';
        $data['tgl_dari']       = '';
        $data['data_stok']      = array('');
        $data['year_now']       = date('Y');
        $data['year_old']       = date('Y')-1;
        $data['tgl_dari_asli']  = '';
        $data['data_month']  = array(
                array('id' => '01', 'nama_bulan' => 'January'),
                array('id' => '02', 'nama_bulan' => 'February'),
                array('id' => '03', 'nama_bulan' => 'March'),
                array('id' => '04', 'nama_bulan' => 'April'),
                array('id' => '05', 'nama_bulan' => 'May'),
                array('id' => '06', 'nama_bulan' => 'June'),
                array('id' => '07', 'nama_bulan' => 'July'),
                array('id' => '08', 'nama_bulan' => 'August'),
                array('id' => '09', 'nama_bulan' => 'September'),
                array('id' => '10', 'nama_bulan' => 'October'),
                array('id' => '11', 'nama_bulan' => 'November'),
                array('id' => '12', 'nama_bulan' => 'December'));
        if($this->input->post('id_kat_barang')!=''){

            $hari                   = substr($this->input->post('tgl_dari'),0,2);
            $bulan                  = substr($this->input->post('tgl_dari'),3,2);
            $tahun                  = substr($this->input->post('tgl_dari'),6,4);
            $tanggal                = $tahun.'-'.$bulan.'-'.$hari;

            $id_kat_barang          = $this->input->post('id_kat_barang');
            $id_sumber_c              = $this->input->post('id_sumber');
            $data['id_sumber_c']      = $this->input->post('id_sumber');
            $year_c                 = $this->input->post('year');
            $data['year_c']         = $this->input->post('year');
            $month                  = $this->input->post('month');
            $data['month']          = $this->input->post('month');
            $data['tgl_dari_asli']  = $this->input->post('tgl_dari');
            $data['tgl_dari']       = $tanggal;

            $data['data_stok']      = $this->mutasi_model->pemakaian_stok_report($year_c,$month,$id_kat_barang,$id_sumber_c);
        }
        $data['id_kat_barang']      = $id_kat_barang;
        // test($data,1);

        $this->template->load('body', 'report/pemakaian',$data);
    }

    function pemakaian_cetak($year,$month,$id_kat_barang,$id_sumber){  
            $data['id_kat_barang']  = $id_kat_barang;
            $data['year']           = $year;
            $data['month']          = $month;
            $data['id_sumber']      = $id_sumber;
            $data['data_stok']      = $this->mutasi_model->pemakaian_stok_report($year,$month,$id_kat_barang,$id_sumber);
        
        $this->load->view('report/pemakaian_cetak',$data);
    }

























    

    function form(){
        $this->session->unset_userdata('new_mutasi_masuk');

        $this->load->model('master/barang_model');

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
        $this->template->load('body', 'transaksi/mutasi/mutasi_masuk_form', $data);
    }

    function add_item(){
        if(!isset($_POST['id_barang'])) return;
        
        $new_mutasi_masuk = $this->session->userdata('new_mutasi_masuk');

        $items = $new_mutasi_masuk['items'];
        $exist = false;
        if($items!=''){
        foreach($items as $key=>$val){
                if($val['id_barang'] == $this->input->post('id_barang')){
                    $new_mutasi_masuk['items'][$key] = array(
                        'id_barang'      => $this->input->post('id_barang'),
                        'nm_barang'      => $this->input->post('nm_barang'),
                        'quantity'       => $this->input->post('quantity'),
                        'no_lot'         => $this->input->post('no_lot'),
                        'kadaluarsa'     => $this->input->post('kadaluarsa'),
                        'harga_perolehan'=> $this->input->post('harga_perolehan'),
                        'no_hasil'       => $this->input->post('no_hasil')
                    );
                    $exist = true;
                    break;
                }
            }
        }

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

}
?>