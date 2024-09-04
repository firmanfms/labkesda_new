<?php
/**
  * Ringkasan dari Controller aset
  *
  * COntroller aset berfungsi untuk mengelola master aset
  * @author Firmansyah
  * @version 1.0
  * @package Controller aset
  *
  * @param int $id integer
  *
  * @return void
  */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
  * Ringkasan dari Controller aset
  *
  * COntroller aset berfungsi untuk mengelola master aset
  * @author Firmansyah
  * @version 1.0
  * @package Controller aset
  *
  * @param int $id integer
  *
  * @return void
  */
class Aset extends MY_Controller {

	/**
	* fungsi untuk konstruksi
	*/
	function __construct(){
        parent::__construct();
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Master', 'active_submenu' => 'aset', 'active_submenu2' => '')); 
        $this->load->model('master/aset_model');
    }

	/**
	* fungsi untuk menampilkan data aset di menu master aset
	*/
	function index(){
        

        $data['data_aset']     = $this->aset_model->get_all();
        $this->template->load('body', 'master/aset/aset_view',$data);
	}

	/**
	* fungsi untuk menampilkan form pengisian master aset
	*/
    function form(){
        $this->load->model('master/aset_model');
        $this->load->model('master/satuan_model');
        $this->load->model('master/lokasi_assets_model');
        $this->load->model('master/kataset_model');
        $this->load->model('master/satuan_model');
		/* menampilkan kategori aset */
        // $data['data_kataset']     = $this->kataset_model->get_all();
		/* menampilkan satuan */

        $get_all_json     = $this->aset_model->get_all();
        $data_array = array();
        foreach ($get_all_json as $key => $value) {
          array_push($data_array, $value->nama);
        }
        $data['data_array']         = $data_array;

        $data['data_satuan']     = $this->satuan_model->get_all(); 
        $data['data_kondisi']    = $this->aset_model->get_all_kondisi(); 
        $data['data_sumber']     = $this->aset_model->get_all_sumber(); 
        $data['data_assets']     = $this->lokasi_assets_model->get_all(); 
        $data['data_kategory']   = $this->kataset_model->get_all(); 
        $this->template->load('body', 'master/aset/aset_form',$data);
    }
	
	/**
	fungsi untuk menampilkan form pengisian master aset
	*/
    function form_act(){
        $save   = $this->aset_model->act_form();
		/* menampilkan pesan sukses jika terupdate via javascript */
        jsout(array('success' => true, 'status' => $save ));
    }

	/**
	* fungsi untuk menampilkan form edit data aset
	*/
    function edit($id){
		$this->load->model('master/aset_model');
        $this->load->model('master/satuan_model');
        $this->load->model('master/lokasi_assets_model');
        $this->load->model('master/kataset_model');
        $this->load->model('master/satuan_model');
        /* menampilkan kategori aset */
        // $data['data_kataset']     = $this->kataset_model->get_all();
        /* menampilkan satuan */

        $get_all_json     = $this->aset_model->get_all();
        $data_array = array();
        foreach ($get_all_json as $key => $value) {
          array_push($data_array, $value->nama);
        }
        $data['data_array']         = $data_array;

        $data['data_aset']       = $this->aset_model->get_all_detail($id);
        $data['data_satuan']     = $this->satuan_model->get_all(); 
        $data['data_kondisi']    = $this->aset_model->get_all_kondisi(); 
        $data['data_sumber']     = $this->aset_model->get_all_sumber(); 
        $data['data_assets']     = $this->lokasi_assets_model->get_all(); 
        $data['data_kategory']   = $this->kataset_model->get_all(); 
        $this->template->load('body', 'master/aset/aset_edit',$data);
    }

	/**
	fungsi untuk proses edit data aset
	*/
    function edit_act(){
        $update   = $this->aset_model->act_edit();
        jsout(array('success' => true, 'status' => $update ));
    }

	/**
	fungsi untuk proses menghapus data aset
	*/
    function delete(){
        $delete = $this->aset_model->act_delete();
		/* menampilkan pesan sukses jika berhasil delete via javascript */
        jsout(array('success' => true, 'status' => $delete ));
    }

    /**
	* @deprecated tes
	* abaikan fungsi ini karena sudah tidak digunakan lagi
	*/
    function tes(){
        $this->template->load('body', 'master/aset/aset_tes');
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

    function report(){
        $this->session->set_userdata('ses_menu', array('active_menu' => 'Report', 'active_submenu' => 'aset_report', 'active_submenu2' => '')); 

        $data['data_aset']     = $this->aset_model->get_all();
        $this->template->load('body', 'master/aset/aset_report',$data);
    }

    function excell(){
        $data['data_aset']     = $this->aset_model->report();
        $this->load->view('master/aset/aset_cetak',$data);

    }

    function rekap(){
        $data['data_aset']     = $this->aset_model->report();
        $this->load->view('master/aset/aset_rekap',$data);

    }

    

}
?>