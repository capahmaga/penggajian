<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuanpegawai extends CI_Controller
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
		$data['title'] = 'Pengajuan Izin dan Cuti';
		if ((isset($_POST['bulan']) && $_POST['bulan'] != null) && (isset($_POST['tahun']) && $_POST['tahun'] != null)) {
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');
		} else {
			$bulan = date('m');
			$tahun = date('Y');
		}
		$data['pegawai'] = $this->Absensi_model->getPegawaiByUserID($this->session->userdata('id_user'));
		$id_pegawai = $data['pegawai']->id_pegawai;

		$data['absensi'] = $this->Absensi_model->getPengajuanAbsensi($id_pegawai, $bulan, $tahun);
		$data['user'] = $this->Auth_model->getAuthUserPegawai($this->session->userdata('username'))->row_array();

		$this->load->view('themeplates/header', $data);
		$this->load->view('themeplates/sidebar', $data);
		$this->load->view('pegawai/absensi/pengajuanpegawai', $data);
		$this->load->view('themeplates/footer');
	}

	public function validation_form()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nik', 'NIK', 'required|trim');
		$this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required|trim');
		$this->form_validation->set_rules('jenis_pengajuan', 'Jenis Pengajuan', 'required|trim');
		if ($this->form_validation->run()) {
			$array = array(
				'success' => '<div class="alert alert-success">Thank you for Contact Us</div>'
			);
		} else {
			$array = array(
				'error'   => true,
				'nik_error' => form_error('nik'),
				'nama_pegawai_error' => form_error('nama_pegawai'),
				'jenis_pengajuan_error' => form_error('jenis_pengajuan')
			);
		}

		echo json_encode($array);
	}

	public function savePengajuanIzin()
	{
		$data = [
			'nama_jabatan' => html_escape($this->input->post('jabatan', true)),
			'gaji_pokok' => html_escape($this->input->post('gapok', true)),
			'tj_transport' => html_escape($this->input->post('tj_transport', true)),
			'uang_makan' => html_escape($this->input->post('uang_makan', true))
		];

		$data['kehadiran'] = [
			'tanggal' => html_escape($this->input->post('jabatan', true)),
			'nik' =>  html_escape($this->input->post('jabatan', true)),
			'id_pegawai' =>  html_escape($this->input->post('jabatan', true)),
			'hadir' => 1,
			'sakit' => 0,
			'alpa' => 0,
			'waktu_absen' => html_escape($this->input->post('jabatan', true)),
			'waktu_pulang' => null
		];
	}
}
