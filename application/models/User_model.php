<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function get()
    {
        return $this->db->get('user_role')->result_array();
    }

    public function getWhere($param1, $param2)
    {
        return $this->db->get_where('user_role', [$param1 => $param2]);
    }

    // ambil
    public function login()
    {
        $id = $this->session->userdata('id');
        $data = $this->db->get_where('pegawai', ['id' => $id])->row_array();
        if ($data) {
            return $data;
        } else {
            $data = $this->db->get_where('siswa', ['id' => $id])->row_array();
            return $data;
        }
    }

    public function getUserRole()
    {
        $id = $this->session->userdata('role_id');
        $data = $this->db->get_where('user_role', ['id' => $id])->row_array();
        return $data;
    }
}
