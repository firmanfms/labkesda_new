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
class Lokasi extends MY_Controller {

	/**
	fungsi untuk konstruksi
	*/
	function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Master', 'active_submenu' => 'lokasi', 'active_submenu2' => '')); 
        $this->load->model('master/lokasi_model');
    }

	/**
	fungsi untuk menampilkan data di menu master lokasi
	*/
	function index(){
        $data['data_lokasi']     = $this->lokasi_model->get_all();
        $this->template->load('body', 'master/lokasi/lokasi_view',$data);
	}

	/**
	fungsi untuk menampilkan form pengisian master lokasi
	*/
    function form(){
        $get_all_json     = $this->lokasi_model->get_all();
        $data_array = array();
        foreach ($get_all_json as $key => $value) {
          array_push($data_array, $value->lokasi);
        }
        $data['data_array']         = $data_array;

        $this->template->load('body', 'master/lokasi/lokasi_form',$data);
    }

	/**
	fungsi untuk aksi input lokasi
	*/
    function form_act(){
        $save   = $this->lokasi_model->act_form();
        jsout(array('success' => true, 'status' => $save ));
    }

	/**
	fungsi untuk menampilkan form edit master lokasi
	@param int $id integer
	*/
    function edit($id){
        $this->load->model('master/lokasi_model');
        $data['detail']       = $this->lokasi_model->get_all_detail($id);  

        $get_all_json     = $this->lokasi_model->get_all();
        $data_array = array();
        foreach ($get_all_json as $key => $value) {
          array_push($data_array, $value->lokasi);
        }
        $data['data_array']         = $data_array;

        $this->template->load('body', 'master/lokasi/lokasi_edit',$data);
    }

	/**
	fungsi untuk aksi edit lokasi
	*/
    function edit_act(){
        $update   = $this->lokasi_model->act_edit();
        jsout(array('success' => true, 'status' => $update ));
    }

	/**
	fungsi untuk aksi delete lokasi
	*/
    function delete(){
        $delete = $this->lokasi_model->act_delete();
        jsout(array('success' => true, 'status' => $delete ));
    }    

}
?>