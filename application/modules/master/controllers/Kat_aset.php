<?php
/**
  * Ringkasan dari Controller Kategori Barang
  *
  * COntroller untuk mengelola master Kategori Barang
  * @author Firmansyah
  * @version 1.0
  * @package Controller Kategori Barang
  *
  * @param int $id integer
  *
  * @return void
  */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
  * Ringkasan dari Controller Kategori Barang
  *
  * COntroller untuk mengelola master Kategori Barang
  * @author Firmansyah
  * @version 1.0
  * @package Controller Kategori Barang
  *
  * @param int $id integer
  *
  * @return void
  */
class Kat_aset extends MY_Controller {

	/**
	* fungsi untuk konstruksi
	*/
	function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Master', 'active_submenu' => 'kat_aset', 'active_submenu2' => '')); 
        $this->load->model('master/kataset_model');
    }

	/**
	fungsi untuk menampilkan data kategori barang di menu master kategori barang
	*/
	function index(){
        $data['data_kat_barang']     = $this->kataset_model->get_all();
        $this->template->load('body', 'master/kat_aset/kat_aset_view',$data);
	}

	/**
	fungsi untuk menampilkan form pengisian master kategori barang
	*/
    function form(){
        $get_all_json     = $this->kataset_model->get_all();
        $data_array = array();
        foreach ($get_all_json as $key => $value) {
          array_push($data_array, $value->kategori);
        }
        $data['data_array']         = $data_array;

        $this->template->load('body', 'master/kat_aset/kat_aset_form',$data);
    }


	/**
	fungsi untuk aksi input kategori barang
	*/
    function form_act(){
        $save   = $this->kataset_model->act_form();
        jsout(array('success' => true, 'status' => $save ));
    }

	/**
	fungsi untuk menampilkan form edit kategori barang
	* @param int @id integer
	*/
    function edit($id){
        $get_all_json     = $this->kataset_model->get_all();
        $data_array = array();
        foreach ($get_all_json as $key => $value) {
          array_push($data_array, $value->kategori);
        }
        $data['data_array']         = $data_array;
        $data['detail']       = $this->kataset_model->detail_katkategori($id);  
        $this->template->load('body', 'master/kat_aset/kat_aset_edit',$data);
    }

	/**
	fungsi untuk proses edit kategori
	*/
    function edit_act(){
        $update   = $this->kataset_model->act_edit();
        jsout(array('success' => true, 'status' => $update ));
    }

	/**
	fungsi untuk proses delete kategori
	*/
    function delete(){
        $delete = $this->kataset_model->act_delete();
        jsout(array('success' => true, 'status' => $delete ));
    }

    

}
?>