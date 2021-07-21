<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kurikulum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model("siswa_model", "siswa");
        $this->load->model("pegawai_model", "pegawai");
        $this->load->model('user_model', 'user');
        $this->load->model('menu_model', 'menu');

        $this->load->model('tk_model', 'tk');
        $this->load->model('lpj_model', 'lpj');
        $this->load->model('pelajaran_model', 'pel');
        $this->load->model('nilai_model', 'nilai');
        $this->load->model('inbox_model', 'inbox');

        $this->load->model('kelas_model', 'kelas');
        $this->load->model('jurusan_model', 'jurusan');
        $this->load->model('mapel_model', 'mapel');
    }

    public function profile()
    {
        $data['title'] = 'Profile';

        $data['user'] = $this->user->login();
        $id = $data['user']['id'];

        $data['detail'] = $this->pegawai->getWhere('pegawai.id', $id)->row_array();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);
        $data['dok'] = $this->tk->getWhere('pegawai_id', $id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pegawai/detail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $data['lpj'] = $this->db->get('dok_lpj')->num_rows();
        $data['pelajaran'] = $this->db->get('dok_pelajaran')->num_rows();
        $data['inbox'] = $this->db->get_where('surat_masuk', ['disposisi' => 1])->num_rows();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('kurikulum/index', $data);
        $this->load->view('templates/footer', $data);
    }

    // olah dokumen Pelajaran
    public function pelajaran()
    {
        $data['title'] = 'Dokumen Pelajaran';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $data['data'] = $this->pel->getAll()->result_array();
        // var_dump($data['data']);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dok-pel/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function addpel()
    {
        $data['title'] = 'Tambah Dokumen Pelajaran';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $data['kelas'] = $this->kelas->get()->result_array();
        $data['jurusan'] = $this->jurusan->get()->result_array();
        $data['mapel'] = $this->mapel->get()->result_array();

        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dok-pel/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // $this->pel->save();
            if ($this->pel->save()) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Dokumen Pelajaran berhasil ditambahkan.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
                );
                redirect('kurikulum/pelajaran');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('kurikulum/addpel');
            }
        }
    }

    public function editpel($id)
    {
        $data['title'] = 'Dokumen Pelajaran';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);
        $data['detail'] = $this->pel->getById($id);

        $data['kelas'] = $this->kelas->get()->result_array();
        $data['jurusan'] = $this->jurusan->get()->result_array();
        $data['mapel'] = $this->mapel->get()->result_array();

        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dok-pel/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // $this->pel->update($id);
            // echo $this->pel->update($id);
            // die;
            if ($this->pel->update($id)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Dokumen Pelajaran berhasil diubah.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
                );
                redirect('kurikulum/pelajaran');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('kurikulum/editpel/' . $id);
            }
        }
    }

    public function delpel($id)
    {
        $this->pel->delete($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Dokumen Pelajaran berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>'
        );
        redirect('kurikulum/pelajaran');
    }

    // olah dokumen LPJ
    public function lpj()
    {
        $data['title'] = 'Dokumen LPJ';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $data['data'] = $this->lpj->getAll()->result_array();
        // var_dump($data['data']);die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dok-lpj/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function addlpj()
    {
        $data['title'] = 'Tambah Dokumen LPJ';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $this->form_validation->set_rules('kegiatan', 'Nama Kegiatan', 'required');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required');
        // $this->form_validation->set_rules('file', 'File', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dok-lpj/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // $this->lpj->save();
            if ($this->lpj->save()) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Dokumen LPJ berhasil ditambahkan.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
                );
                redirect('kurikulum/lpj');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('kurikulum/addlpj');
            }
        }
    }

    public function editlpj($id)
    {
        $data['title'] = 'Edit Dokumen LPJ';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);
        $data['detail'] = $this->lpj->getById($id);

        $this->form_validation->set_rules('kegiatan', 'Nama Kegiatan', 'required');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required');
        // $this->form_validation->set_rules('file', 'File', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dok-lpj/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // $this->lpj->update($id);
            if ($this->lpj->update($id)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Dokumen LPJ berhasil diubah.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
                );
                redirect('kurikulum/lpj');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('kurikulum/editlpj/' . $id);
            }
        }
    }

    public function dellpj($id)
    {
        $this->lpj->delete($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Dokumen LPJ berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>'
        );
        redirect('kurikulum/lpj');
    }

    // Olah data surat masuk
    public function inbox()
    {
        $data['title'] = 'Surat Masuk';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        // $data['data'] = $this->inbox->get()->result_array();
        $data['data'] = $this->inbox->getWhere('disposisi', 1)->result_array();

        // var_dump($data['data']);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('inbox/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
