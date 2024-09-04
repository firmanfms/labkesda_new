<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model('report_model');
		$this->session->set_userdata('ses_menu', array('active_menu' => 'Dashboard', 'active_submenu' => '', 'active_submenu2' => ''));
		$tahun 							= substr(dbnow(),0,4);
		$range_tahun 					= $tahun-2;

		$data['lk']						= $this->report_model->jml_pendaftaran($tahun,"LK");
		$data['ll']						= $this->report_model->jml_pendaftaran($tahun,"LL");
		$data['lm']						= $this->report_model->jml_pendaftaran($tahun,"LM");

		$data['gr_lk']					= $this->report_model->pendaftaran_pertahun($range_tahun,$tahun,"LK");
		$data['gr_ll']					= $this->report_model->pendaftaran_pertahun($range_tahun,$tahun,"LL");
		$data['gr_lm']					= $this->report_model->pendaftaran_pertahun($range_tahun,$tahun,"LM");

		// test($data,1);

		$data['top_mutasi'] 			= $this->report_model->top_10_mutasi_keluar(); 
		$data['last_stok'] 				= $this->report_model->last_stok(); 
		$data['stok_expired_bmhp']	 	= $this->report_model->last_stok_expired('2')->row();
		$data['jml_expired_bmhp']		= $this->report_model->last_stok_expired('2')->num_rows();
		$data['stok_expired_bk']		= $this->report_model->last_stok_expired('1')->row();
		$data['jml_expired_bk'] 		= $this->report_model->last_stok_expired('1')->num_rows();
		$this->template->load('body','welcome_message',$data);
	}

	function error(){
		$this->template->load('body','errors/html/error_404');
	}
}
