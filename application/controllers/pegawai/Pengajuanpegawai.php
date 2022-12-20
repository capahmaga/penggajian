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
				'success' => '<div class="alert alert-success">Valid</div>'
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

	public function validate_tanggal()
	{
		$id_pegawai = html_escape($this->input->post('id_pegawai', true));
		$jumlah_tanggal = "";
		$tanggal_mulai = date_create($this->input->post('input_tanggal_mulai'));
		$tanggal_akhir = date_create($this->input->post('input_tanggal_akhir'));
		$jumlah_tanggal = date_diff($tanggal_mulai, $tanggal_akhir);

		$total_hari = $jumlah_tanggal->d + 1;
		$x = 1;
		$tanggal_error = "";
		$array = array(
			'error'   => false,
		);
		while ($x <= $total_hari) {
			if (!(date_format($tanggal_mulai, "l") == "Sunday")) {
				$date = $tanggal_mulai->format('Y-m-d');
				$data['status'] = $this->Absensi_model->cekPresensiStatus($id_pegawai, $date);
				if ((count((array)$data['status']) > 0)) {
					$tanggal_error = 	$tanggal_error . " " . $date;
					$data = [
						'error'   => true,
						'data_error' => $tanggal_error
					];
				};
			}
			$tanggal_mulai->modify('+1 day');
			$x++;
		}
		echo json_encode($data);
	}

	public function savePengajuanIzin()
	{
		$sakit = 0;
		$izin = 0;
		$jenis_izin = $this->input->post('input_jenis_pengajuan');

		if ($jenis_izin == 1) {
			$sakit = 1;
		} else {
			$izin = 1;
		}
		$nik = html_escape($this->input->post('input_nik', true));
		$id_pegawai = html_escape($this->input->post('id_pegawai', true));
		$now = $this->Auth_model->getServerdate();
		$jumlah_tanggal = "";
		$tanggal_mulai = date_create($this->input->post('input_tanggal_mulai'));
		$tanggal_akhir = date_create($this->input->post('input_tanggal_akhir'));
		$jumlah_tanggal = date_diff($tanggal_mulai, $tanggal_akhir);

		$total_hari = $jumlah_tanggal->d + 1;
		$x = 1;
		while ($x <= $total_hari) {
			if (!(date_format($tanggal_mulai, "l") == "Sunday")) {
				$date = $tanggal_mulai->format('Y-m-d');
				$data[] = [
					'tanggal' => $date,
					'nik' => $nik,
					'id_pegawai' => $id_pegawai,
					'hadir' => 0,
					'sakit' => $sakit,
					'izin' => $izin,
					'alpa' => 0,
					'waktu_absen' => $now,
					'waktu_pulang' => $now
				];
			}
			$tanggal_mulai->modify('+1 day');
			$x++;
		}
		$this->Absensi_model->tambah_izin_batch($data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Kehadiran <strong>Berhasil Ditambahkan.</strong></div>');
		redirect('pegawai/pengajuanpegawai');
	}
}
