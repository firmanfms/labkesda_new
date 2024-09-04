<?php
/**
  * Ringkasan dari Controller Parameter
  *
  * COntroller untuk mengelola Parameter
  * @author Firmansyah
  * @version 1.0
  * @package Controller Parameter
  *
  * @param int $id integer
  *
  * @return void
  */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
  * Ringkasan dari Controller Parameter
  *
  * COntroller untuk mengelola Parameter
  * @author Firmansyah
  * @version 1.0
  * @package Controller Parameter
  *
  * @param int $id integer
  *
  * @return void
  */
class Parameter extends MY_Controller {
	/**
	fungsi untuk konstruksi
	*/
	function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Master', 'active_submenu' => 'parameter', 'active_submenu2' => '')); 
        $this->load->model('master/parameter_model');
    }

	/**
	fungsi untuk menampilkan data di menu master paramater
	*/
	function index(){
        $data['data_parameter']     = $this->parameter_model->get_all_parameter();
        $this->template->load('body', 'master/parameter/parameter_view',$data);
	}

	/**
	fungsi untuk menampilkan form pengisian master parameter
	*/
    function form(){
        $this->load->model('master/laboratorium_model');
        $this->load->model('master/sampel_model');

        $data['data_sampel']    = $this->sampel_model->get_all();
        $data['data_lab']       = $this->laboratorium_model->get_all(); 
        $this->template->load('body', 'master/parameter/parameter_form',$data);
    }

	/**
	fungsi untuk aksi input parameter
	*/
    function form_act(){
        $save   = $this->parameter_model->act_form();
        jsout(array('success' => true, 'status' => $save ));
    }

	/**
	fungsi untuk menampilkan form edit master parameter
	* @param int $id integer
	*/
    function edit($id){
        $this->load->model('master/laboratorium_model');
        $this->load->model('master/sampel_model');

        $data['data_sampel']  = $this->sampel_model->get_all();
        $data['data_lab']     = $this->laboratorium_model->get_all(); 
        $data['detail']       = $this->parameter_model->get_detail($id);  
        $this->template->load('body', 'master/parameter/parameter_edit',$data);
    }

	/**
	fungsi untuk aksi edit parameter
	*/
    function edit_act(){
        $update   = $this->parameter_model->act_edit();
        jsout(array('success' => true, 'status' => $update ));
    }

	/**
	fungsi untuk aksi delete parameter
	*/
    function delete(){
        $delete = $this->parameter_model->act_delete();
        jsout(array('success' => true, 'status' => $delete ));
    }

    function cek_sampel(){
        $id     = $this->input->post('id');
        $data   = $this->db->query("SELECT b.`nm_kategori_parameter`,b.kd_sampel,b.kd_kategori_parameter FROM m_parameter a 
                            LEFT JOIN m_kategori_parameter b ON a.`kd_kategori_parameter`=b.`kd_kategori_parameter`
                            WHERE a.aktif='Y' AND a.kd_lab='LL'
                            GROUP BY b.`nm_kategori_parameter`
                            ORDER BY b.`nm_kategori_parameter`,a.`nm_parameter`")->result();
        echo json_encode($data);
    }

}
?>