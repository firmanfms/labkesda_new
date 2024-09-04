<?php
/**
  * Ringkasan dari Controller Manajemen
  *
  * COntroller untuk mengelola master Manajemen
  * @author Firmansyah
  * @version 1.0
  * @package Controller Manajemen
  *
  * @param int $id integer
  *
  * @return void
  */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
  * Ringkasan dari Controller Manajemen
  *
  * COntroller untuk mengelola master Manajemen
  * @author Firmansyah
  * @version 1.0
  * @package Controller Manajemen
  *
  * @param int $id integer
  *
  * @return void
  */
class Manajemen extends MY_Controller {

	/**
	fungsi untuk konstruksi
	*/
	function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Master', 'active_submenu' => 'manajemen', 'active_submenu2' => '')); 
        $this->load->model('master/manajemen_model');
    }

	/**
	fungsi untuk menampilkan data di menu master manajemen
	*/
	function index(){
        $data['data_manajemen']     = $this->manajemen_model->get_all();
        $this->template->load('body', 'master/manajemen/manajemen_view',$data);
	}

	/**
	fungsi untuk menampilkan form pengisian master manajemen
	*/
    function form(){
        $this->template->load('body', 'master/manajemen/manajemen_form');
    }

	/**
	fungsi untuk aksi input manajemen
	*/
    function form_act(){
        $save   = $this->manajemen_model->act_form();
        jsout(array('success' => true, 'status' => $save ));
    }

	/**
	fungsi untuk menampilkan form edit master manajemen
	* @param int $id integer
	*/
    function edit($id){
        $this->load->model('master/manajemen_model');
        $data['detail']       = $this->manajemen_model->get_all_detail($id);  
        $this->template->load('body', 'master/manajemen/manajemen_edit',$data);
    }

	/**
	fungsi untuk aksi edit manajemen
	*/
    function edit_act(){
        $update   = $this->manajemen_model->act_edit();
        jsout(array('success' => true, 'status' => $update ));
    }

	/**
	fungsi untuk aksi delete manajemen
	*/
    function delete(){
        $delete = $this->manajemen_model->act_delete();
        jsout(array('success' => true, 'status' => $delete ));
    }

    

}
?>