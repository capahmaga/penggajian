<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekSession();
        $this->load->model('User_model');
        $this->load->model('Auth_model');
        $this->load->model('Pegawai_model');
    }

    public function index()
    {
        $data['title'] = 'Daftar Pengguna';
        $data['pegawai'] = $this->Pegawai_model->getAllPegawai();
        $data['roles'] = $this->db->get('roles')->result_array();
        $data['user'] = $this->Auth_model->getAuthUserPegawai($this->session->userdata('username'))->row_array();
        $data['users'] = $this->User_model->getAllUser();
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required|trim');
        $this->form_validation->set_rules('roles', 'Nama Roles', 'required|trim');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('themeplates/header', $data);
            $this->load->view('themeplates/sidebar', $data);
            $this->load->view('admin/users/index', $data);
            $this->load->view('themeplates/footer');
        } else {
            $passwordHash = sha1(html_escape($this->input->post('password', true)));
            $data['save'] = [
                'username' => html_escape($this->input->post('username', true)),
                'password' => $passwordHash,
                'id_roles' => html_escape($this->input->post('roles', true)),
                'id_pegawai' => html_escape($this->input->post('nama_pegawai', true)),
                'status' => 1
            ];
            $this->User_model->tambahUsername($data['save']);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data User <strong>Berhasil Ditambahkan.</strong></div>');
            redirect('admin/user');
        }
    }

    public function getUserByID()
    {
        echo json_encode($this->User_model->getUserByID($_POST['id']));
    }

    public function ubahUser()
    {
        $this->User_model->editUser($_POST);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data User <strong>Berhasil Diubah.</strong></div>');
        redirect('admin/user');
    }

    public function resetPassword()
    {
        $data[] = [
            'id_user' => html_escape($this->input->post('id_user', true)),
            'password' => html_escape($this->input->post('password', true))
        ];
        $this->User_model->editUser($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data User <strong>Berhasil Diubah.</strong></div>');
        redirect('admin/user');
    }

    public function hapus($id)
    {
        $this->db->delete('user', ['id_user' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data User <strong>Berhasil Dihapus.</strong></div>');
        redirect('admin/user');
    }
}
