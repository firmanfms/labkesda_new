<?php
/**
  * Ringkasan dari Controller Dokter
  *
  * COntroller untuk mengelola master Dokter
  * @author Firmansyah
  * @version 1.0
  * @package Controller Dokter
  *
  * @param int $id integer
  *
  * @return void
  */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
  * Ringkasan dari Controller Dokter
  *
  * COntroller untuk mengelola master Dokter
  * @author Firmansyah
  * @version 1.0
  * @package Controller Dokter
  *
  * @param int $id integer
  *
  * @return void
  */
class Dokter extends MY_Controller {
	
	/**
	* fungsi untuk konstruksi
	*/	
	function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Master', 'active_submenu' => 'dokter', 'active_submenu2' => '')); 
        $this->load->model('master/dokter_model');
    }

	/**
	fungsi untuk menampilkan data dokter di menu master dokter
	*/
	function index(){
        $data['data_dokter']     = $this->dokter_model->get_all();
        $this->template->load('body', 'master/dokter/dokter_view',$data);
	}

	/**
	fungsi untuk menampilkan form pengisian master dokter
	*/
    function form(){
        $this->template->load('body', 'master/dokter/dokter_form');
    }

	/**
	fungsi untuk aksi input dokter
	*/
    function form_act(){
        $save   = $this->dokter_model->act_form();
        jsout(array('success' => true, 'status' => $save ));
    }

	/**
	fungsi untuk menampilkan form edit dokter
	@param int @id integer
	*/
    function edit($id){
        $this->load->model('master/dokter_model');
        $data['detail']       = $this->dokter_model->get_all_detail($id);  
        $this->template->load('body', 'master/dokter/dokter_edit',$data);
    }

	/**
	fungsi untuk proses edit data dokter
	*/
    function edit_act(){
        $update   = $this->dokter_model->act_edit();
        jsout(array('success' => true, 'status' => $update ));
    }

	/**
	fungsi untuk proses hapus data dokter
	*/
    function delete(){
        $delete = $this->dokter_model->act_delete();
        jsout(array('success' => true, 'status' => $delete ));
    }

    

}
?>