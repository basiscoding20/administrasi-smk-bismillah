<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inbox_model extends CI_Model
{
    private $_table = 'surat_masuk';
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
        $this->dari = $post['dari'];
        $this->tgl_terima = $post['tgl_terima'];
        $this->perihal = $post['perihal'];
        $this->disposisi = 0;
        $this->pegawai_id = $post['pegawai'];
        $this->upload_at = time();

        // cek apakah file yang akan diupload sudah sesuai dengan ketentuan
        if ($this->_uploadFile()) {
            $this->file = $this->_uploadFile();
            return $this->db->insert($this->_table, $this);
        }
        return false;
    }

    public function disposisi($id)
    {
        $this->disposisi = 1;

        return $this->db->update(
            $this->_table,
            $this,
            array($this->_table_id => $id)
        );
    }

    public function update($id)
    {
        $post = $this->input->post();

        $this->no_surat = $post['no_surat'];
        $this->dari = $post['dari'];
        $this->tgl_terima = $post['tgl_terima'];
        $this->perihal = $post['perihal'];
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
        $config['upload_path']          = './assets/dist/upload/inbox/';
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
        $inbox = $this->getById($id);
        if ($inbox['file'] != "test.pdf") {
            $filename = explode(".", $inbox['file'])[0];
            return array_map('unlink', glob(FCPATH . "assets/dist/upload/inbox/$filename.*"));
        }
    }
}
