<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporanabsensi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cekSession();
		$this->load->model('Absensi_model');
		$this->load->model('Auth_model');
	}

	public function index()
	{
		$data['title'] = 'Laporan Absensi';
		if ((isset($_POST['bulan']) && $_POST['bulan'] != null) && (isset($_POST['tahun']) && $_POST['tahun'] != null)) {
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');
		} else {
			$bulan = date('m');
			$tahun = date('Y');
		}

		$data['pegawai'] = $this->Absensi_model->getPegawaiByUserID($this->session->userdata('id_user'));
		$id_pegawai = $data['pegawai']->id_pegawai;

		$data['absensi'] = $this->Absensi_model->getPegawaiAbsensi($id_pegawai, $bulan, $tahun);
		$data['user'] = $this->Auth_model->getAuthUserPegawai($this->session->userdata('username'))->row_array();
		$this->load->view('themeplates/header', $data);
		$this->load->view('themeplates/sidebar', $data);
		$this->load->view('pegawai/absensi/laporanabsensi', $data);
		$this->load->view('themeplates/footer');
	}
}
