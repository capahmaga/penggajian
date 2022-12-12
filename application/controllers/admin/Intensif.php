<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Intensif extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cekSession();
		$this->load->model('Intensif_model');
		$this->load->model('Auth_model');
	}

	public function index()
	{
		$data['title'] = 'Setting Intensif Gaji';
		// $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['user'] = $this->Auth_model->getAuthUserPegawai($this->session->userdata('username'))->row_array();
		$data['intensif'] = $this->Intensif_model->gelAllIntensif();

		$this->form_validation->set_rules('intensif', 'Intensif', 'required|trim');
		$this->form_validation->set_rules('jml_intensif', 'Jumlah Intensif', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('themeplates/header', $data);
			$this->load->view('themeplates/sidebar', $data);
			$this->load->view('admin/intensif/index', $data);
			$this->load->view('themeplates/footer');
		} else {
			$this->Intensif_model->tambahDataIntensif();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Intensif <strong>Berhasil Ditambahkan.</strong></div>');
			redirect('admin/intensif');
		}
	}

	public function getintensif()
	{
		echo json_encode($this->Intensif_model->getIntensifById($_POST['id']));
	}

	public function ubahintensif()
	{
		$this->Intensif_model->editIntensif($_POST);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Intensif <strong>Berhasil Diubah.</strong></div>');
		redirect('admin/intensif');
	}

	public function hapus($id)
	{
		$this->db->delete('potongan_gaji', ['id_poga' => $id]);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-trash"></i> Data Intensif <strong>Berhasil Dihapus.</strong></div>');
		redirect('admin/intensif');
	}
}
