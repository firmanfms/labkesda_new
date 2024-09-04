<?php
/**
  * Ringkasan dari Controller Metode
  *
  * COntroller untuk mengelola master Metode
  * @author Firmansyah
  * @version 1.0
  * @package Controller Metode
  *
  * @param int $id integer
  *
  * @return void
  */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
  * Ringkasan dari Controller Metode
  *
  * COntroller untuk mengelola master Metode
  * @author Firmansyah
  * @version 1.0
  * @package Controller Metode
  *
  * @param int $id integer
  *
  * @return void
  */
class Metode extends MY_Controller {
	/**
	fungsi untuk konstruksi
	*/
    function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Master', 'active_submenu' => 'metode', 'active_submenu2' => ''));
        $this->load->model('master/metode_model');
    }
	/**
	fungsi untuk menampilkan data di menu master metode
	*/
    function index(){  
        $data['data_metode']  = $this->metode_model->get_all();
        $this->template->load('body', 'master/metode/metode_view',$data);
    }
	/**
	fungsi untuk menampilkan form pengisian master metode
	*/
    function form(){
        $this->session->unset_userdata('new_metode');
        $this->load->model('master/laboratorium_model');
        $this->load->model('master/parameter_model');
        $new_metode = $this->session->userdata('new_metode');
        // test($new_metode,1);
        if(!$new_metode){
            $new_metode = array(
                'items' => array()
            );
        }
        $data['data_lab']       = $this->laboratorium_model->get_all();
        $data['data_parameter'] = $this->parameter_model->get_all();
        $data['new_metode']     = $new_metode;
        $this->template->load('body', 'master/metode/metode_form', $data);
    }
	/**
	*fungsi untuk menambahkan hasil metode di bagian detail
	*/
    function add_item(){
        if(!isset($_POST['deskripsi_kadar'])) return;
        $new_metode = $this->session->userdata('new_metode');
        $items = $new_metode['items'];
        $exist = false;
        if($items!=''){
        foreach($items as $key=>$val){
                if($val['no_hasil'] == $this->input->post('no_hasil')){
                    $new_metode['items'][$key] = array(
                        'no_hasil'      => $this->input->post('no_hasil'),
                        'deskripsi_kadar'     => $this->input->post('deskripsi_kadar'),
                        'min_kadar'     => $this->input->post('min_kadar'),
                        'max_kadar'     => $this->input->post('max_kadar'),
                        'aktif'         => $this->input->post('aktif')
                    );
                    $exist = true;
                    break;
                }
            }
        }
        if(!$exist){
            $new_metode['items'][] = array(
                    'no_hasil'      => $this->input->post('no_hasil'),
                    'deskripsi_kadar'     => $this->input->post('deskripsi_kadar'),
                    'min_kadar'     => $this->input->post('min_kadar'),
                    'max_kadar'     => $this->input->post('max_kadar'),
                    'aktif'         => $this->input->post('aktif')
            );
        }
        test($new_metode,0);
        $this->session->set_userdata('new_metode', $new_metode);        
    }
	/**
	*fungsi untuk menghapus hasil metode di bagian detail
	*/
    function remove_item(){
        if(!isset($_GET['index_id'])) return;
        $index_id = $this->input->get('index_id');
        $new_metode = $this->session->userdata('new_metode');
        $items = $new_metode['items'];
        foreach($items as $key=>$val){
            if($val['no_hasil'] == $index_id){
                $new_metode['items'][] = array(
                    'no_hasil'      => $new_metode['items'][$key]['no_hasil'],
                    'deskripsi_kadar'=>$new_metode['items'][$key]['deskripsi_kadar'],
                    'min_kadar'     => $new_metode['items'][$key]['min_kadar'],
                    'max_kadar'     => $new_metode['items'][$key]['max_kadar'],
                    'aktif'         => 'N'
                );
                unset($new_metode['items'][$key]);
                $new_metode['items'] = array_values($new_metode['items']);
                break;
            }
        }
        test($new_metode,0);
        $this->session->set_userdata('new_metode', $new_metode);
        jsout(array('success'=>1)); 
    }
	/**
	*fungsi untuk aksi input metode
	*/
    function form_act(){
        $save   = $this->metode_model->act_form();
        // $this->session->unset_userdata('new_metode');
        jsout(array('success' => true, 'status' => $save ));
    }
	/**
	*fungsi untuk aksi delete metode
	*/
    function delete(){
        $delete = $this->metode_model->act_delete();
        jsout(array('success' => true, 'status' => $delete ));
    }
	/**
	*fungsi untuk menampilkan form edit metode
	* @param int $id integer
	*/
    function edit($id){
        $this->session->unset_userdata('new_metode');
        $this->load->model('master/laboratorium_model');
        $this->load->model('master/parameter_model');
        $new_metode = $this->session->userdata('new_metode');
        $detail     = $this->metode_model->metode_detail($id)->result();
        $tdetail    = $this->metode_model->metode_detail($id)->num_rows();
        $no         = 0;
        if($tdetail!=0){
            foreach($detail as $key=>$val){
                $new_metode['items'][$key] = array(
                    'no_hasil'      => $val->id_kadar,
                    'deskripsi_kadar'=> $val->deskripsi_kadar,
                    'min_kadar'     => $val->nilai_minimum,
                    'max_kadar'     => $val->nilai_maksimum,
                    'aktif'         => $val->aktif
                );
            }
            $no     = $val->id_kadar;
        }else{
            $new_metode['items'] = array();
        }
        $this->session->set_userdata('new_metode', $new_metode);
        $data['data_lab']       = $this->laboratorium_model->get_all();
        $data['data_parameter'] = $this->parameter_model->get_all();
        $data['new_metode']     = $new_metode;
        $data['no_urut']        = $no;
        $data['header']         = $this->metode_model->metode_header($id)->row();
        $this->template->load('body', 'master/metode/metode_edit', $data);
    }
	/**
	*fungsi untuk aksi edit metode
	*/
    function edit_act(){
        $update   = $this->metode_model->act_edit();
        // $this->session->unset_userdata('new_metode');
        jsout(array('success' => true, 'status' => $update ));
    }
    function reset(){
        $this->session->unset_userdata('new_metode');
        redirect('master/metode');
    }
	/**
	*fungsi untuk aksi update detail hasil
	*/
    function detail_items_metode(){
        $sup_id     = $this->input->post('id');
        $result     = $this->metode_model->detail_items_metode($sup_id);
        echo json_encode($result);
    }
	/**
	*fungsi untuk menampilkan pop up detail
	* @param int $id integer
	*/
    function view_popup($id){
        $data['id']     = $id;
        $data['detail'] = $this->metode_model->detail_items_metode($id);
        $this->load->view('master/metode/metode_detail_popup',$data);
    }
}
?>