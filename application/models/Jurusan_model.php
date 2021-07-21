<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan_model extends CI_Model
{
    private $_table = 'jurusan';

    public function get()
    {
        return $this->db->get($this->_table);
    }
}
