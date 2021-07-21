<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kepalasekolah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model("siswa_model", "siswa");
        $this->load->model("pegawai_model", "pegawai");
        $this->load->model('user_model', 'user');
        $this->load->model('menu_model', 'menu');

        $this->load->model('lpj_model', 'lpj');
        $this->load->model('pelajaran_model', 'pel');
        $this->load->model('silabus_model', 'silab');
        $this->load->model('absensi_model', 'absen');
        $this->load->model('nilai_model', 'nilai');
        $this->load->model('inbox_model', 'inbox');
        $this->load->model('outbox_model', 'outbox');
        $this->load->model('tk_model', 'tk');
        $this->load->model('arsip_model', 'arsip');
        $this->load->model('pkl_model', 'pkl');

        $this->load->model('kelas_model', 'kelas');
        $this->load->model('jurusan_model', 'jurusan');
        $this->load->model('mapel_model', 'mapel');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $data['siswa'] = $this->db->get('siswa')->num_rows();
        $data['guru'] = $this->pegawai->getWhere('role_id', '5')->num_rows();
        $data['newinbox'] = $this->inbox->getWhere('disposisi', 0)->num_rows();
        $data['newoutbox'] = $this->outbox->getWhere('is_approved', '')->num_rows();
        $data['lpj'] = $this->db->get('dok_lpj')->num_rows();
        $data['pelajaran'] = $this->db->get('dok_pelajaran')->num_rows();
        $data['silabus'] = $this->db->get('dok_silabus')->num_rows();
        $data['absensi'] = $this->db->get('dok_absensi')->num_rows();
        $data['nilai'] = $this->db->get('nilai_siswa')->num_rows();
        $data['inbox'] = $this->db->get('surat_masuk')->num_rows();
        $data['outbox'] = $this->db->get('surat_keluar')->num_rows();
        $data['arsip'] = $this->db->get('dok_arsip')->num_rows();
        $data['pkl'] = $this->db->get('dok_pkl')->num_rows();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('kepsek/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function profile()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();

        $data['loc'] = '';
        $data['detail'] = $this->pegawai->getWhere('pegawai.id', $data['user']['id'])->row_array();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);
        $data['dok'] = $this->tk->getWhere('pegawai_id', $data['user']['id']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pegawai/detail', $data);
        $this->load->view('templates/footer', $data);
    }

    // Olah data pegawai
    public function guru()
    {
        // ambil segmen url ke-3
        $seg = $this->uri->segment(2);

        // jika ada akan menampilkan data sesuai request
        if ($seg) {
            $data['pegawai'] = $this->pegawai->getWhere('menu', $seg)->result_array();
            $data['loc'] = $data['pegawai'][0]['menu'];
            $data['menu'] = $data['pegawai'][0]['role'];
        } else {
            // jika tidak ada segmen 3 maka akan menampilkan seluruh data pegawai
            $data['pegawai'] = $this->pegawai->getAll()->result_array();
            $data['loc'] = '';
            $data['menu'] = 'Pegawai';
        }

        // var_dump($data['pegawai']);
        // die;

        $data['title'] = 'Data Staff Guru';
        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);
        $data['pegawai'] = $this->pegawai->getWhere('role_id', '5')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pegawai/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function detp($id)
    {

        $seg = $this->uri->segment(4);
        if ($seg) {
            $query = $this->user->getWhere('menu', $seg)->row_array();
            $data['loc_id'] = $query['id'];
            $data['loc'] = $query['menu'];
            $data['menu'] = $query['role'];
        } else {
            $data['loc'] = '';
            $data['menu'] = 'Pegawai';
        }

        $data['detail'] = $this->pegawai->getWhere('pegawai.id', $id)->row_array();

        $data['title'] = 'Detail ' . $data['detail']['role'];
        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);
        $data['dok'] = $this->tk->getWhere('pegawai_id', $id);

        // var_dump($data['detail']);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pegawai/detail', $data);
        $this->load->view('templates/footer', $data);
    }

    // Olah data siswa
    public function datasiswa()
    {
        $data['title'] = 'Data Siswa';

        $data['user'] = $this->user->login();
        $data['siswa'] = $this->siswa->getAll()->result_array();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('siswa/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function detsiswa($id)
    {
        $data['title'] = 'Detail Siswa';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);
        $data['detail'] = $this->siswa->getById($id);
        $data['dok'] = $this->pkl->getWhere('siswa_id', $id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('siswa/detail', $data);
        $this->load->view('templates/footer', $data);
    }

    // Olah data surat masuk
    public function inbox()
    {
        $data['title'] = 'Surat Masuk';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $data['data'] = $this->inbox->get()->result_array();
        // var_dump($data['data']);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('inbox/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function disposisi($id)
    {
        $this->inbox->disposisi($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Surat Masuk telah disposisi.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>'
        );
        redirect('kepalasekolah/inbox');
    }

    // Olah data surat keluar
    public function outbox()
    {
        $data['title'] = 'Surat Keluar';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $data['data'] = $this->outbox->get()->result_array();
        // var_dump($data['data']);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('outbox/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function is_approved($id)
    {
        if ($this->outbox->is_approved($id)) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Surat Keluar telah disetujui, silahkan dicek kembali.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
            );
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            File gagal diupload, coba lagi!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
            );
        }
        redirect('kepalasekolah/outbox');
    }

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

    public function silabus()
    {
        $data['title'] = 'Dokumen Silabus';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $data['data'] = $this->silab->getAll()->result_array();
        // var_dump($data['data']);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dok-silab/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function absensi()
    {
        $data['title'] = 'Dokumen Absensi';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $data['data'] = $this->absen->getAll()->result_array();
        // var_dump($data['data']);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dok-absen/index', $data);
        $this->load->view('templates/footer', $data);
    }

    // olah dokumen Arsip
    public function arsip()
    {
        $data['title'] = 'Dokumen Arsip';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $data['data'] = $this->arsip->getAll()->result_array();
        // var_dump($data['data']);die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dok-arsip/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function doksiswa()
    {
        $data['title'] = 'Dokumen Siswa';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $data['data'] = $this->pkl->getAll()->result_array();
        // var_dump($data['data']);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dok-siswa/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
