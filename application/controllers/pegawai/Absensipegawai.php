<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensipegawai extends CI_Controller
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
		$data['sakit'] = "0";
		$data['title'] = 'Presensi Pegawai';
		$data['user'] = $this->Absensi_model->getPegawaiByUserID($this->session->userdata('id_user'));
		$data['status'] = $this->Absensi_model->cekPresensiStatus($data['user']->id_pegawai, date("Y-m-d", strtotime($this->Auth_model->getServerdate())));

		if (count((array)$data['status']) > 0) {
			if (($data['status']->sakit) == '1') {
				$data['sakit'] = "1";
			} else {
				$this->session->set_userdata('waktu_absen', $data['status']->waktu_absen);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> <strong>Anda Telah Melakukan Presensi Pada ' . $data['status']->waktu_absen . '</strong></div>');
				if ($data['status']->waktu_pulang) {
					$this->session->set_userdata('waktu_pulang',  $data['status']->waktu_pulang);
					$this->session->set_flashdata('pesan_keluar', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> <strong>Berhasil Melakukan Presensi Keluar Pada ' .  $data['status']->waktu_pulang . '</strong></div>');
				}
			}
		}


		$data['user'] = $this->Auth_model->getAuthUserPegawai($this->session->userdata('username'))->row_array();
		$this->load->view('themeplates/header', $data);
		$this->load->view('themeplates/sidebar', $data);
		$this->load->view('pegawai/absensi/index', $data);
		$this->load->view('themeplates/footer');
	}

	public function presensi_masuk()
	{
		$data['user'] = $this->Absensi_model->getPegawaiByUserID($this->session->userdata('id_user'));
		$id_pegawai = $data['user']->id_pegawai;
		$nik = $data['user']->nik;
		$now = $this->Auth_model->getServerdate();

		$data['kehadiran'] = [
			'tanggal' => date("Y-m-d", strtotime($now)),
			'nik' => $nik,
			'id_pegawai' => $id_pegawai,
			'hadir' => 1,
			'sakit' => 0,
			'alpa' => 0,
			'waktu_absen' => $now,
			'waktu_pulang' => null
		];
		$data['status'] = $this->Absensi_model->cekPresensiStatus($id_pegawai, date("Y-m-d", strtotime($now)));

		if (count((array)$data['status']) > 0) {
			$this->session->set_userdata('waktu_absen', $data['status']->waktu_absen);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> <strong>Anda Telah Melakukan Presensi Pada ' . $data['status']->waktu_absen . '</strong></div>');
			redirect('pegawai/absensipegawai');
		} else {
			$this->Absensi_model->presensi_masuk($data['kehadiran']);
			$this->session->set_userdata('waktu_absen', date("Y-m-d", strtotime($now)));
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Kehadiran <strong>Berhasil Ditambahkan.</strong></div>');
			redirect('pegawai/absensipegawai');
		}
	}

	public function presensi_keluar()
	{
		$data['user'] = $this->Absensi_model->getPegawaiByUserID($this->session->userdata('id_user'));
		$id_pegawai = $data['user']->id_pegawai;
		$now = $this->Auth_model->getServerdate();

		$data['kehadiran'] = [
			'waktu_pulang' => $now
		];
		$data['status'] = $this->Absensi_model->cekPresensiStatus($id_pegawai, date("Y-m-d", strtotime($now)));

		if (count((array)$data['status']) > 0) {
			// sudah melakukan presensi masuk
			$this->Absensi_model->presensi_keluar($data['kehadiran'], $id_pegawai, date("Y-m-d", strtotime($now)));
			$this->session->set_userdata('waktu_pulang', date("Y-m-d", strtotime($now)));
			$this->session->set_flashdata('pesan_keluar', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> <strong>Berhasil Melakukan Presensi Keluar Pada ' . date("Y-m-d", strtotime($now)) . '</strong></div>');
			redirect('pegawai/absensipegawai');
		} else {
			$this->session->set_flashdata('pesan_keluar', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> <strong>Lakukan Proses Presensi Masuk Terlebih Dahulu.</strong></div>');
			redirect('pegawai/absensipegawai');
		}
	}


	public function laporan_absensi()
	{
		$data['title'] = 'Laporan Absensi Pegawai';
		// $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['user'] = $this->Auth_model->getAuthUserPegawai($this->session->userdata('username'))->row_array();
		$this->load->view('themeplates/header', $data);
		$this->load->view('themeplates/sidebar', $data);
		$this->load->view('admin/absensi/laporan_absensi', $data);
		$this->load->view('themeplates/footer');
	}
}
