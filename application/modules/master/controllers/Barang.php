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
class Barang extends MY_Controller {

	/**
	* fungsi untuk konstruksi
	*/
	function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Master', 'active_submenu' => 'barang', 'active_submenu2' => '')); 
        $this->load->model('master/barang_model');
    }

	/**
	* fungsi untuk menampilkan data barang di menu master barang
	*/
	function index(){
        $data['data_barang']     = $this->barang_model->get_all_barang();
        $this->template->load('body', 'master/barang/barang_view',$data);
	}

	/**
	* fungsi untuk menampilkan form pengisian master barang
	*/
    function form(){
        $this->load->model('master/katbarang_model');
        $this->load->model('master/satuan_model');
        $this->load->model('master/vendor_model');
		/* menampilkan kategori barang */
        $data['data_katbarang']     = $this->katbarang_model->get_all();
		/* menampilkan satuan */
        $data['data_satuan']     = $this->satuan_model->get_all(); 
        $data['data_vendor']     = $this->vendor_model->get_all(); 

        $get_all_json     = $this->barang_model->get_all_barang();
        $data_array = array();
        foreach ($get_all_json as $key => $value) {
          array_push($data_array, $value->nama);
        }
        $data['data_array']         = $data_array;

        $this->template->load('body', 'master/barang/barang_form',$data);
    }
	
	/**
	fungsi untuk menampilkan form pengisian master barang
	*/
    function form_act(){
        $save   = $this->barang_model->act_form();
		/* menampilkan pesan sukses jika terupdate via javascript */
        jsout(array('success' => true, 'status' => $save ));
    }

	/**
	* fungsi untuk menampilkan form edit data barang
	*/
    function edit($id){
		/* @param $id integer */
        $this->load->model('master/katbarang_model');
        $this->load->model('master/satuan_model');
        $this->load->model('master/katbarangsub_model');
        $this->load->model('master/vendor_model');
        
        $data['data_katbarang']     = $this->katbarang_model->get_all();
        $data['data_satuan']     = $this->satuan_model->get_all(); 
        $data['detail']          = $this->barang_model->get_all_detail($id);
        $data['data_vendor']     = $this->vendor_model->get_all();  

        $get_all_json     = $this->barang_model->get_all_barang();
        $data_array = array();
        foreach ($get_all_json as $key => $value) {
          array_push($data_array, $value->nama);
        }
        $data['data_array']         = $data_array;
        $data['data_sub']           = $this->katbarangsub_model->sub_kategori($data['detail']->id_kat_barang);
        
		/* @param $id integer */		
        $this->template->load('body', 'master/barang/barang_edit', $data);
    }

	/**
	fungsi untuk proses edit data barang
	*/
    function edit_act(){
        $update   = $this->barang_model->act_edit();
        jsout(array('success' => true, 'status' => $update ));
    }

	/**
	fungsi untuk proses menghapus data barang
	*/
    function delete(){
        $delete = $this->barang_model->act_delete();
		/* menampilkan pesan sukses jika berhasil delete via javascript */
        jsout(array('success' => true, 'status' => $delete ));
    }

    /**
	* @deprecated tes
	* abaikan fungsi ini karena sudah tidak digunakan lagi
	*/
    function tes(){
        $this->template->load('body', 'master/barang/barang_tes');
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