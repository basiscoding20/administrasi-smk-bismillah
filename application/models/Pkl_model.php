<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pkl_model extends CI_Model
{
    private $_table = 'dok_pkl';
    private $_table_id = 'id_pkl';
    private $_join = 'siswa';

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->_join);
        $this->db->join($this->_table, $this->_join . '.id = ' . $this->_table . '.siswa_id');
        return $this->db->get();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, [$this->_table_id => $id])->row_array();
    }

    public function getWhere($param1, $param2)
    {
        return $this->db->get_where($this->_table, [$param1 => $param2])->result_array();
    }

    public function save()
    {
        $post = $this->input->post();

        $this->judul = $post['judul'];
        $this->siswa_id = $post['siswa'];
        $this->pegawai_id = $post['pegawai'];
        $this->upload_at = time();

        // cek apakah file yang akan diupload sudah sesuai dengan ketentuan
        if ($this->_uploadFile()) {
            $this->file = $this->_uploadFile();
            return $this->db->insert($this->_table, $this);
        }
        return false;
    }

    public function update($id)
    {
        $post = $this->input->post();

        $this->judul = $post['judul'];

        if ($this->_uploadFile()) {
            if (!empty($_FILES['file']['name'])) {
                $this->_deleteFile($id);
                $this->file = $this->_uploadFile();
            }
        }
        return $this->db->update(
            $this->_table,
            $this,
            array($this->_table_id => $id)
        );


        // return false;
    }

    public function delete($id)
    {
        $this->_deleteFile($id);
        return $this->db->delete($this->_table, array($this->_table_id => $id));
    }

    private function _uploadFile()
    {
        // ketentuan file
        $config['upload_path']          = './assets/dist/upload/siswa/';
        $config['allowed_types']        = 'jpg|png|pdf|doc|docx';
        $config['file_name']            = md5(time());
        $config['overwrite']            = true;
        $config['max_size']             = 2048; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);


        if ($this->upload->do_upload('file')) {
            return $this->upload->data("file_name");
        }
        return false;
        // return $this->upload->display_errors();
    }

    private function _deleteFile($id)
    {
        $siswa = $this->getById($id);
        if ($siswa['file'] != "test.pdf") {
            $filename = explode(".", $siswa['file'])[0];
            return array_map('unlink', glob(FCPATH . "assets/dist/upload/siswa/$filename.*"));
        }
    }
}
