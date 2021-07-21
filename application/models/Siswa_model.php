<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
    private $_table = 'siswa';
    private $_join = 'user_role';

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->_join);
        $this->db->join($this->_table, $this->_table . '.role_id = ' . $this->_join . '.id');
        return $this->db->get();
    }

    public function getWhere($param1, $param2)
    {
        $this->db->select('*');
        $this->db->from($this->_join);
        $this->db->join($this->_table, $this->_table . '.role_id = ' . $this->_join . '.id');
        $this->db->where($param1, $param2);
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
        $this->id = $post['nis'];
        $this->name = $post['name'];
        $this->tempat_lahir = $post['tempat_lahir'];
        $this->tgl_lahir = $post['tgl_lahir'];
        $this->jenis_kelamin = $post['jk'];
        $this->anak_ke = $post['anak_ke'];
        $this->dari = $post['dari'];
        $this->alamat = $post['alamat'];
        $this->no_hp = $post['no_hp'];
        $this->nama_ayah = $post['nama_ayah'];
        $this->pekerjaan_ayah = $post['pekerjaan_ayah'];
        $this->no_hp_ayah = $post['no_hp_ayah'];
        $this->nama_ibu = $post['nama_ibu'];
        $this->pekerjaan_ibu = $post['pekerjaan_ibu'];
        $this->no_hp_ibu = $post['no_hp_ibu'];
        $this->alamat_orangtua = $post['alamat_orangtua'];
        $this->nama_wali = $post['nama_wali'];
        $this->pekerjaan_wali = $post['pekerjaan_wali'];
        $this->no_hp_wali = $post['no_hp_wali'];
        $this->alamat_wali = $post['alamat_wali'];
        $this->tahun_masuk = $post['tahun_masuk'];
        $this->image = $this->_uploadImage();;
        $this->password = password_hash('user', PASSWORD_DEFAULT);
        $this->role_id = 6;
        $this->is_active = 1;
        $this->date_created = time();

        return $this->db->insert($this->_table, $this);
    }

    public function update($id)
    {
        $post = $this->input->post();
        $this->id = $post['nis'];
        $this->name = $post['name'];
        $this->tempat_lahir = $post['tempat_lahir'];
        $this->tgl_lahir = $post['tgl_lahir'];
        $this->jenis_kelamin = $post['jk'];
        $this->anak_ke = $post['anak_ke'];
        $this->dari = $post['dari'];
        $this->alamat = $post['alamat'];
        $this->no_hp = $post['no_hp'];
        $this->nama_ayah = $post['nama_ayah'];
        $this->pekerjaan_ayah = $post['pekerjaan_ayah'];
        $this->no_hp_ayah = $post['no_hp_ayah'];
        $this->nama_ibu = $post['nama_ibu'];
        $this->pekerjaan_ibu = $post['pekerjaan_ibu'];
        $this->no_hp_ibu = $post['no_hp_ibu'];
        $this->alamat_orangtua = $post['alamat_orangtua'];
        $this->nama_wali = $post['nama_wali'];
        $this->pekerjaan_wali = $post['pekerjaan_wali'];
        $this->no_hp_wali = $post['no_hp_wali'];
        $this->alamat_wali = $post['alamat_wali'];
        $this->tahun_masuk = $post['tahun_masuk'];

        if (!empty($_FILES['image']['name'])) {
            // $this->_deleteImage($id);
            $this->image = $this->_uploadImage();
        } else {
            $this->image = $post['old_image'];
        }

        return $this->db->update($this->_table, $this, array('id' => $id));
    }

    public function delete($id)
    {
        $this->_deleteImage($id);
        return $this->db->delete($this->_table, array('id' => $id));
    }

    private function _uploadImage()
    {
        $config['upload_path']          = './assets/dist/img/profile/';
        $config['allowed_types']        = 'jpg|png';
        $config['file_name']            = $this->id;
        $config['overwrite']            = true;
        $config['max_size']             = 2048; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data('file_name');
        }
        return 'default.jpg';
    }

    private function _deleteImage($id)
    {
        $siswa = $this->getById($id);
        if ($siswa['image'] != "default.jpg") {
            $filename = explode(".", $siswa['image'])[0];
            return array_map('unlink', glob(FCPATH . "assets/dist/img/profile/$filename.*"));
        }
    }
}
