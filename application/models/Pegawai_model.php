<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{
    private $_table = 'pegawai';
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

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row_array();
    }

    public function get()
    {
        return $this->db->get('pegawai');
    }

    public function save()
    {
        $post = $this->input->post();

        $this->id = $post['nip'];
        $this->name = $post['name'];
        $this->tempat_lahir = $post['tempat_lahir'];
        $this->tgl_lahir = $post['tgl_lahir'];
        $this->jenis_kelamin = $post['jk'];
        $this->pendidikan_terakhir = $post['pendidikan_terakhir'];
        $this->no_hp = $post['no_hp'];
        $this->email = $post['email'];
        $this->tahun_masuk = $post['tahun_masuk'];
        $this->status = $post['status'];
        $this->jalan = $post['jalan'];
        $this->desa_kelurahan = $post['desa_kelurahan'];
        $this->kecamatan = $post['kecamatan'];
        $this->kab_kota = $post['kab_kota'];
        $this->provinsi = $post['provinsi'];
        $this->kode_pos = $post['kode_pos'];
        $this->image = $this->_uploadImage();
        $this->password = password_hash('user', PASSWORD_DEFAULT);
        $this->role_id = $post['jabatan'];
        $this->is_active = 1;
        $this->date_created = time();

        return $this->db->insert($this->_table, $this);
    }

    public function update($id)
    {
        $post = $this->input->post();
        $this->id = $post['nip'];
        $this->name = $post['name'];
        $this->tempat_lahir = $post['tempat_lahir'];
        $this->tgl_lahir = $post['tgl_lahir'];
        $this->jenis_kelamin = $post['jk'];
        $this->pendidikan_terakhir = $post['pendidikan_terakhir'];
        $this->no_hp = $post['no_hp'];
        $this->email = $post['email'];
        $this->tahun_masuk = $post['tahun_masuk'];
        $this->status = $post['status'];
        $this->jalan = $post['jalan'];
        $this->desa_kelurahan = $post['desa_kelurahan'];
        $this->kecamatan = $post['kecamatan'];
        $this->kab_kota = $post['kab_kota'];
        $this->provinsi = $post['provinsi'];
        $this->kode_pos = $post['kode_pos'];
        $this->role_id = $post['jabatan'];

        if (!empty($_FILES['image']['name'])) {
            $this->_deleteImage($id);
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
            return $this->upload->data("file_name");
        }
        return "default.jpg";
    }

    private function _deleteImage($id)
    {
        $pegawai = $this->getById($id);
        if ($pegawai['image'] != "default.jpg") {
            $filename = explode(".", $pegawai['image'])[0];
            return array_map('unlink', glob(FCPATH . "assets/dist/img/profile/$filename.*"));
        }
    }
}
