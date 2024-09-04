<?php
/**
  * Ringkasan dari Controller Barang
  *
  * COntroller barang berfungsi untuk mengelola master barang
  * @author Firmansyah
  * @version 1.0
  * @package Controller Barang
  *
  * @param int $id integer
  *
  * @return void
  */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
  * Ringkasan dari Controller Barang
  *
  * COntroller barang berfungsi untuk mengelola master barang
  * @author Firmansyah
  * @version 1.0
  * @package Controller Barang
  *
  * @param int $id integer
  *
  * @return void
  */
class Harga extends MY_Controller {

	/**
	* fungsi untuk konstruksi
	*/
	function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Master', 'active_submenu' => 'harga', 'active_submenu2' => '')); 
        $this->load->model('master/harga_model');
        $this->load->model('master/barang_model');
    }

	/**
	* fungsi untuk menampilkan data barang di menu master barang
	*/
	function index(){
        $data['data_harga']     = $this->harga_model->get_all();
        $this->template->load('body', 'master/harga/harga_view',$data);
	}

	/**
	* fungsi untuk menampilkan form pengisian master barang
	*/
    function form(){
        $data['data_barang']     = $this->barang_model->get_all_barang();
        $this->template->load('body', 'master/harga/harga_form',$data);
    }
	
	/**
	fungsi untuk menampilkan form pengisian master barang
	*/
    function form_act(){
        $save   = $this->harga_model->act_form();
		/* menampilkan pesan sukses jika terupdate via javascript */
        $this->session->set_flashdata('alert','Data is updated');
        redirect('master/harga');
    }

	/**
	* fungsi untuk menampilkan form edit data barang
	*/
    function edit($id){
		$data['data_barang']     = $this->barang_model->get_all_barang();        
        $data['detail']          = $this->harga_model->get_all_detail($id);
        $data['tahun']           = $id;
        
		/* @param $id integer */		
        $this->template->load('body', 'master/harga/harga_edit', $data);
    }

    function view($id){
        $data['data_barang']     = $this->barang_model->get_all_barang();        
        $data['detail']          = $this->harga_model->get_all_detail($id);
        $data['tahun']           = $id;
        
        /* @param $id integer */        
        $this->template->load('body', 'master/harga/harga_detail', $data);
    }

	/**
	fungsi untuk proses edit data barang
	*/
    function edit_act(){
        // $save   = $this->harga_model->act_form();
        $update   = $this->harga_model->act_edit();
        /* menampilkan pesan sukses jika terupdate via javascript */
        $this->session->set_flashdata('alert','Data is updated');
        redirect('master/harga');
    }

	/**
	fungsi untuk proses menghapus data barang
	*/
    function delete(){
        $delete = $this->harga_model->act_delete();
		/* menampilkan pesan sukses jika berhasil delete via javascript */
        jsout(array('success' => true, 'status' => $delete ));
    }

    /**
	* @deprecated tes
	* abaikan fungsi ini karena sudah tidak digunakan lagi
	*/
    function tes(){
        $this->template->load('body', 'master/harga/harga_tes');
    }

    /**
	* @deprecated tes_act
	* abaikan fungsi ini karena sudah tidak digunakan lagi
	*/
	function tes_act(){
        $no         = $this->input->post('no_telp');
        $text       = $this->input->post('text');
        // test($no,1);
        require_once "vendor/autoload.php";

        $client = new Nexmo\Client(new Nexmo\Client\Credentials\Basic('3ca5b09c', 'NVukoKlBw5YOzAfx')); 

        // $this->load->library('someclass');

        // $basic  = new \Nexmo\clientcore\src\client\Credentials\Basic('3ca5b09c', 'NVukoKlBw5YOzAfx');
        // $client = new \Nexmo\clientcore\src\Clientnew($basic);



        $message = $client->message()->send([
            'to' => $no,
            'from' => 'Nexmo',
            'text' => $text
        ]);
    }

    

}
?>