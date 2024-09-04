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
class User extends MY_Controller {
	/**
	fungsi untuk konstruksi
	*/
	function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Master', 'active_submenu' => 'user', 'active_submenu2' => '')); 
        $this->load->model('master/user_model');
    }
	/**
	fungsi untuk menampilkan data di menu master lokasi
	*/
	function index(){
        $data['data_user']     = $this->user_model->get_all();
        $this->template->load('body', 'master/user/user_view',$data);
	}
	/**
	fungsi untuk menampilkan form pengisian master lokasi
	*/
    function form(){
        $this->load->model('master/user_model');
        $get_all_json     = $this->user_model->get_all();
        $data_array = array();
        foreach ($get_all_json as $key => $value) {
          array_push($data_array, $value->username);
        }
        $data['data_array']         = $data_array;
        $data['data_lokasi']        = $this->user_model->get_all();
        $data['data_level']         = $this->user_model->get_level();
        $this->template->load('body', 'master/user/user_form',$data);
    }
	/**
	fungsi untuk aksi input lokasi
	*/
    function form_act(){
        $save   = $this->user_model->act_form();
        jsout(array('success' => true, 'status' => $save ));
    }
	/**
	fungsi untuk menampilkan form edit master lokasi
	@param int $id integer
	*/
    function edit($id){
        $this->load->model('master/user_model');
        $get_all_json     = $this->user_model->get_all();
        $data_array = array();
        foreach ($get_all_json as $key => $value) {
          array_push($data_array, $value->username);
        }
        $data['data_array']         = $data_array;
        $data['data_lokasi']        = $this->user_model->get_all();
        $data['data_level']         = $this->user_model->get_level();
        $data['data_detail']         = $this->user_model->get_detail($id);
        $this->template->load('body', 'master/user/user_edit',$data);
    }
	/**
	fungsi untuk aksi edit lokasi
	*/
    function edit_act(){
        $update   = $this->user_model->act_edit();
        jsout(array('success' => true, 'status' => $update ));
    }
	/**
	fungsi untuk aksi delete lokasi
	*/
    function delete(){
        $delete = $this->user_model->act_delete();
        jsout(array('success' => true, 'status' => $delete ));
    }    
    function sub_lokasi(){
        $id         = $this->input->post('id');
        $result     = $this->user_model->sub_lokasi($id);
        echo json_encode($result);
    }
      public function kirimemail() {
        // $this->load->views('Email/email_form');
        $data=array();
        $this->template->load('body', 'Email/email_form',$data);
    }
    public function send_email() {
         $this->load->library('form_validation');
         $this->load->library('email');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('email_form');
        } else {
            $to_email = $this->input->post('email');
            // Konfigurasi email
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.gmail.com', // Ganti dengan HOST
                'smtp_port' => 465,
                'smtp_user' => '', // Ganti dengan email Anda
                'smtp_pass' => '', // Ganti dengan password email Anda
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'wordwrap' => TRUE
            );
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            // Mengatur email
            $this->email->from('', 'LABKESDA NOTIF'); // Ganti dengan email dan nama Anda
            $this->email->to($to_email);
            $this->email->subject('Test Email');
            $this->email->message('This is a test email sent from CodeIgniter.');
            // Mengirim email
            if($this->email->send()) {
                // $this->load->view('Email/email_success');
                  $this->template->load('body', 'Email/email_success',$data);
            } else {
                show_error($this->email->print_debugger());
            }
        }
    }
}
?>