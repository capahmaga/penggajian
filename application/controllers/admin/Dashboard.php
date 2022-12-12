<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cekSession();
		cekMenu();
		$this->load->model('Auth_model');
	}

	public function index()
	{
		$pegawai = $this->db->get_where('pegawai', ['id_jabatan' => '1'])->num_rows();
		$admin = $this->db->get_where('pegawai', ['id_jabatan' => '2'])->num_rows();
		$data = [
			'pegawai' => $pegawai,
			'admin' => $admin
		];
		$data['title'] = 'Dashboard';
		// $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['user'] = $this->Auth_model->getAuthUserPegawai($this->session->userdata('username'))->row_array();
		$this->load->view('themeplates/header', $data);
		$this->load->view('themeplates/sidebar', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('themeplates/footer');
	}
}
