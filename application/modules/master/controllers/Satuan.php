<?php
/**
  * Ringkasan dari Controller satuan
  *
  * COntroller untuk mengelola master satuan
  * @author Firmansyah
  * @version 1.0
  * @package Controller satuan
  *
  * @param int $id integer
  *
  * @return void
  */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
  * Ringkasan dari Controller satuan
  *
  * COntroller untuk mengelola master satuan
  * @author Firmansyah
  * @version 1.0
  * @package Controller satuan
  *
  * @param int $id integer
  *
  * @return void
  */
class Satuan extends MY_Controller {

	/**
	fungsi untuk konstruksi
	*/
	function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Master', 'active_submenu' => 'satuan', 'active_submenu2' => '')); 
        $this->load->model('master/satuan_model');
    }

	/**
	fungsi untuk menampilkan data di menu master satuan
	*/
	function index(){
        $data['data_satuan']     = $this->satuan_model->get_all();
        $this->template->load('body', 'master/satuan/satuan_view',$data);
	}

	/**
	fungsi untuk menampilkan form pengisian master satuan
	*/
    function form(){
        $get_all_json     = $this->satuan_model->get_all();
        $data_array = array();
        foreach ($get_all_json as $key => $value) {
          array_push($data_array, $value->satuan);
        }
        $data['data_array']         = $data_array;

        $this->template->load('body', 'master/satuan/satuan_form',$data);
    }

	/**
	fungsi untuk aksi input satuan
	*/
    function form_act(){
        $save   = $this->satuan_model->act_form();
        jsout(array('success' => true, 'status' => $save ));
    }

	/**
	fungsi untuk menampilkan form edit master satuan
	@param int $id integer
	*/
    function edit($id){
        $this->load->model('master/satuan_model');
        $data['detail']       = $this->satuan_model->detail_satuan($id);  

        $get_all_json     = $this->satuan_model->get_all();
        $data_array = array();
        foreach ($get_all_json as $key => $value) {
          array_push($data_array, $value->satuan);
        }
        $data['data_array']         = $data_array;

        $this->template->load('body', 'master/satuan/satuan_edit',$data);
    }

	/**
	fungsi untuk aksi edit satuan
	*/
    function edit_act(){
        $update   = $this->satuan_model->act_edit();
        jsout(array('success' => true, 'status' => $update ));
    }

	/**
	fungsi untuk aksi delete satuan
	*/
    function delete(){
        $delete = $this->satuan_model->act_delete();
        jsout(array('success' => true, 'status' => $delete ));
    }    

}
?>