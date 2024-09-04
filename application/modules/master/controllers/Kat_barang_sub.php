<?php
/**
  * Ringkasan dari Controller Lokasi
  *
  * COntroller untuk mengelola master lokasi
  * @author Firmansyah
  * @version 1.0
  * @package Controller Lokasi
  *
  * @param int $id integer
  *
  * @return void
  */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
  * Ringkasan dari Controller Lokasi
  *
  * COntroller untuk mengelola master lokasi
  * @author Firmansyah
  * @version 1.0
  * @package Controller Lokasi
  *
  * @param int $id integer
  *
  * @return void
  */
class Kat_barang_sub extends MY_Controller {

	/**
	fungsi untuk konstruksi
	*/
	function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Master', 'active_submenu' => 'kat_barang_sub', 'active_submenu2' => '')); 
        $this->load->model('master/katbarangsub_model');
    }

	/**
	fungsi untuk menampilkan data di menu master lokasi
	*/
	function index(){
        $data['data']     = $this->katbarangsub_model->get_all();
        $this->template->load('body', 'master/kat_barang_sub/sub_view',$data);
	}

	/**
	fungsi untuk menampilkan form pengisian master lokasi
	*/
    function form(){
        $this->load->model('master/katbarang_model');

        $get_all_json     = $this->katbarangsub_model->get_all();
        $data_array = array();
        foreach ($get_all_json as $key => $value) {
          array_push($data_array, $value->kategori_sub);
        }
        $data['data_array']         = $data_array;

        $data['data_kat']        = $this->katbarang_model->get_all();
        $this->template->load('body', 'master/kat_barang_sub/sub_form',$data);
    }

	/**
	fungsi untuk aksi input lokasi
	*/
    function form_act(){
        $save   = $this->katbarangsub_model->act_form();
        jsout(array('success' => true, 'status' => $save ));
    }

	/**
	fungsi untuk menampilkan form edit master lokasi
	@param int $id integer
	*/
    function edit($id){
        $this->load->model('master/katbarang_model');

        $get_all_json     = $this->katbarangsub_model->get_all();
        $data_array = array();
        foreach ($get_all_json as $key => $value) {
          array_push($data_array, $value->kategori_sub);
        }
        $data['data_array']         = $data_array;

        $data['data_kat']           = $this->katbarang_model->get_all();
        $data['data_detail']        = $this->katbarangsub_model->get_all_detail($id);
        $this->template->load('body', 'master/kat_barang_sub/sub_edit',$data);
    }

	/**
	fungsi untuk aksi edit lokasi
	*/
    function edit_act(){
        $update   = $this->katbarangsub_model->act_edit();
        jsout(array('success' => true, 'status' => $update ));
    }

	/**
	fungsi untuk aksi delete lokasi
	*/
    function delete(){
        $delete = $this->katbarangsub_model->act_delete();
        jsout(array('success' => true, 'status' => $delete ));
    }    

    function sub_kategori(){
        $id         = $this->input->post('id');
        $result     = $this->katbarangsub_model->sub_kategori($id);
        echo json_encode($result);
    }

}
?>