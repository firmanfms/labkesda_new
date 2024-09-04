<?php
/**
  * Ringkasan dari Controller Sampel
  *
  * COntroller untuk mengelola Sampel
  * @author Firmansyah
  * @version 1.0
  * @package Controller Sampel
  *
  * @param int $id integer
  *
  * @return void
  */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
  * Ringkasan dari Controller Sampel
  *
  * COntroller untuk mengelola Sampel
  * @author Firmansyah
  * @version 1.0
  * @package Controller Sampel
  *
  * @param int $id integer
  *
  * @return void
  */
class Sampel extends MY_Controller {
	/**
	fungsi untuk konstruksi
	*/
	function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Master', 'active_submenu' => 'sampel', 'active_submenu2' => '')); 
        $this->load->model('master/sampel_model');
    }

	/**
	fungsi untuk menampilkan data di menu master sampel
	*/
	function index(){
        $data['data_sampel']     = $this->sampel_model->get_all_sampel();
        $this->template->load('body', 'master/sampel/sampel_view',$data);
	}

	/**
	fungsi untuk menampilkan form pengisian master sampel
	*/
    function form(){
        $this->load->model('master/laboratorium_model');
        $data['data_lab']     = $this->laboratorium_model->get_all(); 
        $this->template->load('body', 'master/sampel/sampel_form',$data);
    }

	/**
	fungsi untuk aksi input sampel
	*/
    function form_act(){
        $save   = $this->sampel_model->act_form();
        jsout(array('success' => true, 'status' => $save ));
    }

	/**
	fungsi untuk menampilkan form edit master lokasi
	* @param int $id integer
	*/
    function edit($id){
        $this->load->model('master/laboratorium_model');
        $data['data_lab']     = $this->laboratorium_model->get_all(); 
        $data['detail']       = $this->sampel_model->get_detail($id);  
        $this->template->load('body', 'master/sampel/sampel_edit',$data);
    }

	/**
	fungsi untuk aksi edit lokasi
	*/
    function edit_act(){
        $update   = $this->sampel_model->act_edit();
        jsout(array('success' => true, 'status' => $update ));
    }

	/**
	fungsi untuk aksi delete lokasi
	*/
    function delete(){
        $delete = $this->sampel_model->act_delete();
        jsout(array('success' => true, 'status' => $delete ));
    }

    

}
?>