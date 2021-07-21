<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lpj_model extends CI_Model
{
    private $_table = 'dok_lpj';
    private $_join = 'pegawai';

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->_join);
        $this->db->join($this->_table, $this->_join . '.id = ' . $this->_table . '.pegawai_id');
        return $this->db->get();
    }

    public function get()
    {
        return $this->db->get($this->_table);
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row_array();
    }

    public function save()
    {
        $post = $this->input->post();

        $this->nama_kegiatan = $post['kegiatan'];
        $this->tahun = $post['tahun'];
        $this->pegawai_id = $post['pegawai_id'];
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

        $this->id = $id;
        $this->nama_kegiatan = $post['kegiatan'];
        $this->tahun = $post['tahun'];
        $this->pegawai_id = $post['pegawai_id'];
        $this->upload_at = time();

        if ($this->_uploadFile()) {
            if (!empty($_FILES['file']['name'])) {
                $this->_deleteFile($id);
                $this->file = $this->_uploadFile();
            } else {
                $this->file = $post['old_file'];
            }
        } else {
            $this->file = $post['old_file'];
        }
        return $this->db->update(
            $this->_table,
            $this,
            array('id' => $id)
        );

        return false;
    }

    public function delete($id)
    {
        $this->_deleteFile($id);
        return $this->db->delete($this->_table, array('id' => $id));
    }

    private function _uploadFile()
    {
        // $fileName = str_replace(' ', '-', $this->nama_kegiatan);

        // ketentuan file
        $config['upload_path']          = './assets/dist/upload/lpj/';
        $config['allowed_types']        = 'pdf|doc|docx';
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
    }

    private function _deleteFile($id)
    {
        $lpj = $this->getById($id);
        if ($lpj['file'] != "test.pdf") {
            $filename = explode(".", $lpj['file'])[0];
            return array_map('unlink', glob(FCPATH . "assets/dist/upload/lpj/$filename.*"));
        }
    }
}
