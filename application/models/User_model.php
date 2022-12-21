<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getAllUser()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('pegawai', 'user.id_user = pegawai.id_user');
        $this->db->join('roles', 'user.id_roles = roles.id_roles');
        return $this->db->get()->result_array();
    }

    public function tambahUsername($data)
    {
        $jumlahData = count($data);
        // var_dump($jumlahData); die;
        if ($jumlahData > 0) {
            $this->db->insert('user', $data);
            $insert_id = $this->db->insert_id();

            $id_pegawai = $data['id_pegawai'];
            $arr = [
                'id_user' =>  $insert_id,
            ];

            $this->db->where('id_pegawai', $id_pegawai);
            $this->db->update('pegawai', $arr);
        }
    }

    public function getUserByID($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('pegawai', 'user.id_user = pegawai.id_user');
        $this->db->join('roles', 'user.id_roles = roles.id_roles');
        $this->db->where('user.id_user', $id);
        return $this->db->get()->row();
    }

    public function editUser($data)
    {
        $id_user = $data['id_user'];
        $password = $data['password'];
        if ($password == "") {
            $arr = [
                'username' => html_escape($data['username']),
                'id_roles' => html_escape($data['roles'])
            ];
        } else {
            // reset password
            $passwordHash = sha1(html_escape($data['password']));
            $arr = [
                'username' => html_escape($data['username']),
                'password' => html_escape($passwordHash),
                'id_roles' => html_escape($data['roles'])
            ];
        }

        $this->db->where('id_user', $id_user);
        $this->db->update('user', $arr);
    }

    public function resetPassword($data)
    {
        $id_user = $data['id_user'];
        $passwordHash = sha1(html_escape($data['password']));

        $arr = [
            'password' => $passwordHash
        ];

        $this->db->where('id_user', $id_user);
        $this->db->update('user', $arr);
    }
}
