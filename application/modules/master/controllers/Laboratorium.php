<?php
/**
  * Ringkasan dari Controller Laboratorium
  *
  * COntroller untuk mengelola master Laboratorium
  * @author Firmansyah
  * @version 1.0
  * @package Controller Laboratorium
  *
  * @param int $id integer
  *
  * @return void
  */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
  * Ringkasan dari Controller Laboratorium
  *
  * COntroller untuk mengelola master Laboratorium
  * @author Firmansyah
  * @version 1.0
  * @package Controller Laboratorium
  *
  * @param int $id integer
  *
  * @return void
  */
class Laboratorium extends MY_Controller {

	/**
	* Kontroller untuk konstruksi
	*/
	function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Master', 'active_submenu' => 'laboratorium', 'active_submenu2' => '')); 
        $this->load->model('master/laboratorium_model');
    }

	/**
	fungsi untuk menampilkan data di menu master laboratorium
	*/
	function index(){
        $data['data_laboratorium']     = $this->laboratorium_model->get_all();
        $this->template->load('body', 'master/laboratorium/laboratorium_view',$data);
	}

	/**
	fungsi untuk menampilkan form pengisian master laboratorium
	*/
    function form(){
        // $this->load->model('master/laboratorium_model');
        // $data['data_lab']     = $this->laboratorium_model->get_all(); 
        $this->template->load('body', 'master/laboratorium/laboratorium_form'/*,$data*/);
    }

	/**
	fungsi untuk aksi input laboratorium
	*/
    function form_act(){
        $save   = $this->laboratorium_model->act_form();
        jsout(array('success' => true, 'status' => $save ));
    }


	/**
	* fungsi untuk menampilkan form edit master laboratorium
	* @param int @id integer
	*/
    function edit($id){
        $this->load->model('master/laboratorium_model');
        $data['data_lab']     = $this->laboratorium_model->get_all(); 
        $data['detail']       = $this->laboratorium_model->get_all_detail($id);  
        $this->template->load('body', 'master/laboratorium/laboratorium_edit',$data);
    }

	/**
	fungsi untuk aksi edit laboratorium
	*/
    function edit_act(){
        $update   = $this->laboratorium_model->act_edit();
        jsout(array('success' => true, 'status' => $update ));
    }

	/**
	fungsi untuk aksi delete laboratorium
	*/
    function delete(){
        $delete = $this->laboratorium_model->act_delete();
        jsout(array('success' => true, 'status' => $delete ));
    }

    

}
?>