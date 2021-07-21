<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai_model extends CI_Model
{
    private $_table = 'nilai_siswa';
    // private $_join = 'pegawai';
    private $_join1 = 'kelas';
    private $_join2 = 'mapel';
    private $_join3 = 'jurusan';
    private $_join4 = 'siswa';

    private $_table_id = 'id_nilai';

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        // $this->db->join($this->_join,  $this->_join . '.id = ' . $this->_table . '.pegawai_id');
        $this->db->join($this->_join1, $this->_join1 . '.id_' . $this->_join1  . ' = ' . $this->_table . '.kelas_id');
        $this->db->join($this->_join2, $this->_join2 . '.id_' . $this->_join2  . ' = ' . $this->_table . '.mapel_id');
        $this->db->join($this->_join3,  $this->_join3 . '.id_' . $this->_join3  . ' = ' . $this->_table . '.jurusan_id');
        $this->db->join($this->_join4,  $this->_join4 . '.id = ' . $this->_table . '.siswa_id');
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

    public function save()
    {
        $post = $this->input->post();

        $this->siswa_id = $post['siswa'];
        $this->kelas_id = $post['kelas'];
        $this->jurusan_id = $post['jurusan'];
        $this->mapel_id = $post['mapel'];
        $this->pegawai_id = $post['pegawai'];
        $this->ta1 = $post['ta1'];
        $this->ta2 = $post['ta2'];
        $this->semester = $post['semester'];
        $this->latihan = $post['latihan'];
        $this->tugas = $post['tugas'];
        $this->pts = $post['pts'];
        $this->pas = $post['pas'];
        $this->date_created = time();
        // return $this;
        return $this->db->insert($this->_table, $this);
    }

    public function update($id)
    {
        $post = $this->input->post();

        $this->siswa_id = $post['siswa'];
        $this->kelas_id = $post['kelas'];
        $this->jurusan_id = $post['jurusan'];
        $this->mapel_id = $post['mapel'];
        $this->pegawai_id = $post['pegawai'];
        $this->ta1 = $post['ta1'];
        $this->ta2 = $post['ta2'];
        $this->semester = $post['semester'];
        $this->latihan = $post['latihan'];
        $this->tugas = $post['tugas'];
        $this->pts = $post['pts'];
        $this->pas = $post['pas'];
        $this->date_created = time();
        // return $this;
        return $this->db->update(
            $this->_table,
            $this,
            array($this->_table_id => $id)
        );
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array($this->_table_id => $id));
    }
}
