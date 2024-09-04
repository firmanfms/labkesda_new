<?php
/**
  * Ringkasan dari Controller vendor
  *
  * COntroller untuk mengelola master vendor
  * @author Firmansyah
  * @version 1.0
  * @package Controller vendor
  *
  * @param int $id integer
  *
  * @return void
  */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
  * Ringkasan dari Controller vendor
  *
  * COntroller untuk mengelola master vendor
  * @author Firmansyah
  * @version 1.0
  * @package Controller vendor
  *
  * @param int $id integer
  *
  * @return void
  */
class Vendor extends MY_Controller {

	/**
	fungsi untuk konstruksi
	*/
	function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Master', 'active_submenu' => 'vendor', 'active_submenu2' => '')); 
        $this->load->model('master/vendor_model');
    }

	/**
	fungsi untuk menampilkan data di menu master vendor
	*/
	function index(){
        $data['data_vendor']     = $this->vendor_model->get_all();
        $this->template->load('body', 'master/vendor/vendor_view',$data);
	}

	/**
	fungsi untuk menampilkan form pengisian master vendor
	*/
    function form(){
        $get_all_json     = $this->vendor_model->get_all();
        $data_array = array();
        foreach ($get_all_json as $key => $value) {
          array_push($data_array, $value->nm_vendor);
        }
        $data['data_array']         = $data_array;

        $this->template->load('body', 'master/vendor/vendor_form',$data);
    }

	/**
	fungsi untuk aksi input vendor
	*/
    function form_act(){
        $save   = $this->vendor_model->act_form();
        jsout(array('success' => true, 'status' => $save ));
    }

	/**
	fungsi untuk menampilkan form edit master vendor
	@param int $id integer
	*/
    function edit($id){
        $this->load->model('master/vendor_model');
        $data['detail']       = $this->vendor_model->get_all_detail($id);  

        $get_all_json     = $this->vendor_model->get_all();
        $data_array = array();
        foreach ($get_all_json as $key => $value) {
          array_push($data_array, $value->nm_vendor);
        }
        $data['data_array']         = $data_array;

        $this->template->load('body', 'master/vendor/vendor_edit',$data);
    }

	/**
	fungsi untuk aksi edit vendor
	*/
    function edit_act(){
        $update   = $this->vendor_model->act_edit();
        jsout(array('success' => true, 'status' => $update ));
    }

	/**
	fungsi untuk aksi delete vendor
	*/
    function delete(){
        $delete = $this->vendor_model->act_delete();
        jsout(array('success' => true, 'status' => $delete ));
    }    

}
?>