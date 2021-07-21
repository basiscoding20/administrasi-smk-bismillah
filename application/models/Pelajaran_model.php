<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelajaran_model extends CI_Model
{
    private $_table = 'dok_pelajaran';
    private $_join = 'pegawai';
    private $_join1 = 'kelas';
    private $_join2 = 'mapel';
    private $_join3 = 'jurusan';

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join($this->_join,  $this->_join . '.id' . ' = ' . $this->_table . '.pegawai_id');
        $this->db->join($this->_join1, $this->_join1 . '.id_' . $this->_join1  . ' = ' . $this->_table . '.kelas_id');
        $this->db->join($this->_join2, $this->_join2 . '.id_' . $this->_join2  . ' = ' . $this->_table . '.mapel_id');
        $this->db->join($this->_join3,  $this->_join3 . '.id_' . $this->_join3  . ' = ' . $this->_table . '.jurusan_id');
        return $this->db->get();
    }

    public function get()
    {
        return $this->db->get($this->_table);
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ['id_pel' => $id])->row_array();
    }

    public function save()
    {
        $post = $this->input->post();

        $this->kelas_id = $post['kelas'];
        $this->jurusan_id = $post['jurusan'];
        $this->mapel_id = $post['mapel'];
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

        $this->id_pel = $id;
        $this->kelas_id = $post['kelas'];
        $this->jurusan_id = $post['jurusan'];
        $this->mapel_id = $post['mapel'];
        $this->pegawai_id = $post['pegawai'];
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
            array('id_pel' => $id)
        );

        return false;
    }

    public function delete($id)
    {
        $this->_deleteFile($id);
        return $this->db->delete($this->_table, array('id_pel' => $id));
    }

    private function _uploadFile()
    {
        // ketentuan file
        $config['upload_path']          = './assets/dist/upload/pelajaran/';
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
        // return $this->upload->display_errors();
    }

    private function _deleteFile($id)
    {
        $pelajaran = $this->getById($id);
        if ($pelajaran['file'] != "test.pdf") {
            $filename = explode(".", $pelajaran['file'])[0];
            return array_map('unlink', glob(FCPATH . "assets/dist/upload/pelajaran/$filename.*"));
        }
    }
}
