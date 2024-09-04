<?php
/**
  * Ringkasan dari Controller User
  *
  * COntroller untuk mengelola User
  * @author Firmansyah
  * @version 1.0
  * @package Controller User
  *
  * @param int $id integer
  *
  * @return void
  */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
  * Ringkasan dari Controller User
  *
  * COntroller untuk mengelola User
  * @author Firmansyah
  * @version 1.0
  * @package Controller User
  *
  * @param int $id integer
  *
  * @return void
  */
class Users extends MY_Controller {
	/**
	fungsi untuk konstruksi
	*/
	function __construct(){
        parent::__construct();
        $this->load->model('master/users_model');
        $this->load->model("menu_model");
        $this->load->library('form_validation');
    }

	/**
	fungsi untuk menampilkan data di menu master User
	*/
    function index(){
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Master', 'active_submenu' => 'master/users/'));  
        $this->isMenu(); 
        $data['data_user']  = $this->users_model->user_all();
        $this->template->load('body', 'master/users/users_view', $data);
    }

	/**
	fungsi untuk aksi delete User
	*/
    function delete(){
        $delete = $this->users_model->act_delete_js();
        jsout(array('success' => true, 'status' => $delete ));
    }

	/**
	fungsi untuk menampilkan form penambahan master User
	*/
    function form(){
        $this->load->model('master/users_group_model');
        $this->load->model('master/master_model');
        $this->load->model('company_model');
        $data['user_level']     = $this->master_model->get_user_level();
        $data['approve_level']  = $this->master_model->get_user_level_approve();
        $data['user_group']     = $this->users_group_model->get_user_group();
        $this->template->load('body', 'master/users/users_form', $data);
    }

	/**
	fungsi untuk aksi input User
	*/
    function form_act(){
        $save = $this->users_model->act_form();
        jsout(array('success' => true, 'status' => $save ));
    }

	/**
	fungsi untuk menampilkan form edit master User
	* @param int $id integer
	*/
    function edit($id){
        $this->load->model('master/users_group_model');
        $this->load->model('master/master_model');
        $data['data_user']  = $this->users_model->data_user($id);
        $data['approve_level']  = $this->master_model->get_user_level_approve();
        $data['user_level'] = $this->master_model->get_user_level();
        $data['user_group'] = $this->users_group_model->get_user_group();
        $data['permission'] = $this->users_model->permission_user_group($id);
        $this->template->load('body', 'master/users/users_edit', $data);
    }

	/**
	fungsi untuk aksi edit User
	*/
    function edit_act(){
        $update   = $this->users_model->act_edit();
        jsout(array('success' => true, 'status' => $update ));
    }

	/**
	fungsi untuk menampilkan hak akses/permission User
	* @param int $id integer
	*/
    function permission($id){
        $this->load->model('master/users_group_model');
        $this->load->model('company_model');
        $data['data_user'] = $this->users_model->data_user($id);
        $data['submenu'] = $this->menu_model->get_akses_submenu($id);
        $data['data_menu'] = $this->menu_model->get_menu();
        $data['data_company']   = $this->company_model->get_company();
        $data['user_company']   = $this->company_model->hak_akses_company($id);
        $this->template->load('body', 'master/users/users_permission', $data);
    }

	/**
	fungsi untuk aksi update permission User
	*/
    function permission_act(){
        $update = $this->users_model->act_permission();
        $this->session->set_flashdata('alert','Data is updated');
        redirect('master/users/');
    }

	/**
	fungsi untuk menampilkan password dari User
	*/
    function password(){
        $id = $this->current_user['user_id'];
        $this->load->model('master/users_group_model');
        $data['data_user'] = $this->users_model->data_user($id);
        $this->template->load('body', 'master/users/users_password', $data);
    }

	/**
	fungsi untuk mengupdate password dari User
	*/
    function password_act(){
        $update   = $this->users_model->act_password();
        jsout(array('success' => true, 'status' => $update ));
    }
}
