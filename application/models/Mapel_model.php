<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapel_model extends CI_Model
{
    private $_table = 'mapel';

    public function get()
    {
        return $this->db->get($this->_table);
    }
}
