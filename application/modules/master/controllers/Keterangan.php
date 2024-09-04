<?php
/**
  * Ringkasan dari Controller keterangan
  *
  * COntroller untuk mengelola master keterangan
  * @author Firmansyah
  * @version 1.0
  * @package Controller keterangan
  *
  * @param int $id integer
  *
  * @return void
  */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
  * Ringkasan dari Controller keterangan
  *
  * COntroller untuk mengelola master keterangan
  * @author Firmansyah
  * @version 1.0
  * @package Controller keterangan
  *
  * @param int $id integer
  *
  * @return void
  */
class Keterangan extends MY_Controller {
	/**
	fungsi untuk konstruksi
	*/
	function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Master', 'active_submenu' => 'keterangan', 'active_submenu2' => '')); 
        $this->load->model('master/keterangan_model');
        $this->load->model('master/laboratorium_model');
    }
	/**
	fungsi untuk menampilkan data di menu master keterangan
	*/
	function index(){
        $data['data_keterangan']     = $this->keterangan_model->get_all();
        $this->template->load('body', 'master/keterangan/keterangan_view',$data);
	}
	/**
	fungsi untuk menampilkan form pengisian master keterangan
	*/
    function form(){
        $data['data_lab']     = $this->laboratorium_model->get_all(); 
        $this->template->load('body', 'master/keterangan/keterangan_form',$data);
    }
	/**
	fungsi untuk aksi input keterangan
	*/
    function form_act(){
        // exit();
        $save   = $this->keterangan_model->act_form();
        jsout(array('success' => true, 'status' => $save ));
    }
	/**
	fungsi untuk menampilkan form edit master keterangan
	* @param int $id integer
	*/
    function edit($id){
        $this->load->model('master/keterangan_model');
        $data['detail']       = $this->keterangan_model->get_all_detail($id);  
        $data['data_lab']     = $this->laboratorium_model->get_all(); 
        $this->template->load('body', 'master/keterangan/keterangan_edit',$data);
    }
	/**
	fungsi untuk aksi edit keterangan
	*/
    function edit_act(){
        $update   = $this->keterangan_model->act_edit();
        jsout(array('success' => true, 'status' => $update ));
    }
	/**
	fungsi untuk aksi delete keterangan
	*/
    function delete(){
        $delete = $this->keterangan_model->act_delete();
        jsout(array('success' => true, 'status' => $delete ));
    }
}
?>