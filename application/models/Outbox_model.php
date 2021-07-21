<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Outbox_model extends CI_Model
{
    private $_table = 'surat_keluar';
    private $_join = 'pegawai';

    private $_table_id = 'id_surat';

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join($this->_join,  $this->_join . '.id' . ' = ' . $this->_table . '.pegawai_id');
        return $this->db->get();
    }

    public function get()
    {
        return $this->db->get($this->_table);
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, [$this->_table_id => $id])->row_array();
    }

    public function getWhere($param1, $param2)
    {
        return $this->db->get_where($this->_table, [$param1 => $param2]);
    }

    public function save()
    {
        $post = $this->input->post();

        $this->no_surat = $post['no_surat'];
        $this->perihal = $post['perihal'];
        $this->pegawai_id = $post['pegawai'];
        $this->upload_at = time();

        // cek apakah file yang akan diupload sudah sesuai dengan ketentuan
        if ($this->_uploadFile()) {
            $this->file = $this->_uploadFile();
            return $this->db->insert($this->_table, $this);
        }
        return false;
    }

    public function is_approved($id)
    {
        $post = $this->input->post();

        if ($this->_uploadFile()) {
            if (!empty($_FILES['file']['name'])) {
                // $this->_deleteFile($id);
                $this->is_approved = $this->_uploadFile();
                return $this->db->update(
                    $this->_table,
                    $this,
                    array($this->_table_id => $id)
                );
            }
        }
        return false;
    }

    public function update($id)
    {
        $post = $this->input->post();

        $this->no_surat = $post['no_surat'];
        $this->perihal = $post['perihal'];

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
        $this->_deleteFileApproved($id);
        return $this->db->delete($this->_table, array($this->_table_id => $id));
    }

    private function _uploadFile()
    {
        // ketentuan file
        $config['upload_path']          = './assets/dist/upload/outbox/';
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
        $outbox = $this->getById($id);
        if ($outbox['file'] != "test.pdf") {
            $filename = explode(".", $outbox['file'])[0];
            return array_map('unlink', glob(FCPATH . "assets/dist/upload/outbox/$filename.*"));
        }
    }
    private function _deleteFileApproved($id)
    {
        $outbox = $this->getById($id);
        if ($outbox['is_approved'] != "test.pdf") {
            $filename = explode(".", $outbox['is_approved'])[0];
            return array_map('unlink', glob(FCPATH . "assets/dist/upload/outbox/$filename.*"));
        }
    }
}
