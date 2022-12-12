<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Intensif_model extends CI_Model
{
    public function gelAllIntensif()
    {
        return $this->db->get('intensif')->result_array();
    }

    public function tambahDataIntensif()
    {
        $data = [
            'intensif' => html_escape($this->input->post('intensif', true)),
            'jml_intensif' => html_escape($this->input->post('jml_intensif', true)),
        ];

        $this->db->insert('intensif', $data);
    }

    public function getIntensifById($id)
    {
        return $this->db->get_where('intensif', ['id_intensif' => $id])->row_array();
    }

    public function editIntensif($data)
    {
        $id_intensif = $data['id_intensif'];
        $arr = [
            'intensif' => html_escape($data['intensif']),
            'jml_intensif' => html_escape($data['jml_intensif']),
        ];

        $this->db->where('id_intensif', $id_intensif);
        $this->db->update('jabatan', $arr);
    }
}
