<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('master/users_model');
        // $this->load->model("menu_model");
        // $this->load->model("company_model");
        $this->load->library('form_validation');
    }


	function index(){
        // $data['company']    = $this->company_model->get_company();
		if (!isset($this->current_user['loginuser'])){
            // test('1111',0);
			$username 		= $this->security->xss_clean($this->db->escape_str($this->input->post('username')));
			$password		= $this->security->xss_clean($this->db->escape_str($this->input->post('password')));
            // test($username,1);
			$this->form_validation->set_rules('username','Username');
            $this->form_validation->set_rules('password','Password');

			if ($username == '' ){
                $this->load->view('login');
            }else{
                // test($username,1);
            	$usr_result = $this->users_model->get_user($username,$password);
                $row = $this->users_model->detail_user($username,$password);
                // test($row,1);
                if ($usr_result > 0){

                    // if(!empty($cp)){
                  	$session_data = array('id_username'      => $row->id_username,
                                            'nama'           => $row->nama,
                                            'user_group'     => $row->level,
                                            'user_level'     => $row->lab,
                                            'loginuser'      => 1,
                                            'app_level'      => $row->app_level
                                        );
                  	//$this->session->sess_expiration = '60'; // 1 menit
                    $this->session->sess_expiration_on_close = 'true';
                    $this->session->set_userdata('session', $session_data);

                    redirect('welcome');
                }else{
                	$this->session->set_flashdata('msg','<div class="alert alert-danger text-center"><font size="2">Username Atau Password Anda salah</font></div>');
                    redirect($_SERVER['HTTP_REFERER']);
                    redirect('login');
                }
            } 
		}else{
            redirect('welcome');
		}
	}

	function logout() {
        // $data['company']    = $this->company_model->get_company();
         //remove all session data
        if ($this->current_user['loginuser'] == 1){
            // $this->users_model->aktifitas_user('logged out');
        }
        $this->session->unset_userdata('session');
        $this->session->unset_userdata('ses_menu');

        $this->load->view('login');
    }
}
