<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getWhere($id)
    {
        return $this->db->get_where('role_menu', ['role_id' => $id])->row_array();
    }
}
