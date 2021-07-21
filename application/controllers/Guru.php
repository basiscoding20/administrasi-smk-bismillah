<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model("siswa_model", "siswa");
        $this->load->model("pegawai_model", "pegawai");
        $this->load->model('user_model', 'user');
        $this->load->model('menu_model', 'menu');
        $this->load->model('pegawai_model', 'pegawai');

        $this->load->model('pelajaran_model', 'pel');
        $this->load->model('silabus_model', 'silab');
        $this->load->model('absensi_model', 'absen');
        $this->load->model('nilai_model', 'nilai');
        $this->load->model('tk_model', 'tk');
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

        $data['silabus'] = $this->silab->get()->num_rows();
        $data['absensi'] = $this->absen->get()->num_rows();
        $data['nilai'] = $this->nilai->get()->num_rows();
        $data['siswa'] = $this->siswa->get()->num_rows();
        $data['pkl'] = $this->db->get('dok_pkl')->num_rows();

        $data['pelajaran'] = $this->db->get('dok_pelajaran')->num_rows();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('guru/index', $data);
        $this->load->view('templates/footer', $data);
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

    // data siswa
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

    // pelajaran
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

    // Olah dokumen silabus
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

    public function addsilab()
    {
        $data['title'] = 'Tambah Dokumen Silabus';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $data['kelas'] = $this->kelas->get()->result_array();
        $data['jurusan'] = $this->jurusan->get()->result_array();
        $data['mapel'] = $this->mapel->get()->result_array();

        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('ta1', 'Tahun Ajaran', 'trim|required');
        $this->form_validation->set_rules('ta2', 'Tahun Ajaran', 'trim|required');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required');
        // $this->form_validation->set_rules('file', 'File', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dok-silab/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // $this->silab->save();
            if ($this->silab->save()) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Dokumen Silabus berhasil ditambahkan.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
                );
                redirect('guru/silabus');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('guru/addsilab');
            }
        }
    }

    public function editsilab($id)
    {
        $data['title'] = 'Dokumen Silabus';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);
        $data['detail'] = $this->silab->getById($id);

        $data['kelas'] = $this->kelas->get()->result_array();
        $data['jurusan'] = $this->jurusan->get()->result_array();
        $data['mapel'] = $this->mapel->get()->result_array();

        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('ta1', 'Tahun Ajaran', 'trim|required');
        $this->form_validation->set_rules('ta2', 'Tahun Ajaran', 'trim|required');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dok-silab/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            if ($this->silab->update($id)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Dokumen Silabus berhasil diubah.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
                );
                redirect('guru/silabus');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('guru/editsilab/' . $id);
            }
        }
    }

    public function delsilab($id)
    {
        $this->silab->delete($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Dokumen Silabus berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>'
        );
        redirect('guru/silabus');
    }

    // Olah dokumen absensi
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

    public function addabsen()
    {
        $data['title'] = 'Tambah Dokumen Absensi';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $data['kelas'] = $this->kelas->get()->result_array();
        $data['jurusan'] = $this->jurusan->get()->result_array();
        $data['mapel'] = $this->mapel->get()->result_array();

        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('ta1', 'Tahun Ajaran', 'trim|required');
        $this->form_validation->set_rules('ta2', 'Tahun Ajaran', 'trim|required');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required');
        // $this->form_validation->set_rules('file', 'File', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dok-absen/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // $this->absen->save();
            if ($this->absen->save()) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Dokumen Absensi berhasil ditambahkan.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
                );
                redirect('guru/absensi');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('guru/addabsen');
            }
        }
    }

    public function editabsen($id)
    {
        $data['title'] = 'Dokumen Absensi';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);
        $data['detail'] = $this->absen->getById($id);

        $data['kelas'] = $this->kelas->get()->result_array();
        $data['jurusan'] = $this->jurusan->get()->result_array();
        $data['mapel'] = $this->mapel->get()->result_array();

        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('ta1', 'Tahun Ajaran', 'trim|required');
        $this->form_validation->set_rules('ta2', 'Tahun Ajaran', 'trim|required');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dok-absen/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            if ($this->absen->update($id)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Dokumen Absensi berhasil diubah.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
                );
                redirect('guru/absensi');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('guru/editabsen/' . $id);
            }
        }
    }

    public function delabsen($id)
    {
        $this->absen->delete($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Dokumen Absensi berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>'
        );
        redirect('guru/absensi');
    }

    // Olah Nilai siswa
    public function nsiswa()
    {
        $data['title'] = 'Penilaian Siswa';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $data['data'] = $this->nilai->getAll()->result_array();
        // var_dump($data['data']);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('nilai-siswa/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function addnsiswa()
    {
        $data['title'] = 'Tambah Nilai Siswa';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $data['kelas'] = $this->kelas->get()->result_array();
        $data['jurusan'] = $this->jurusan->get()->result_array();
        $data['mapel'] = $this->mapel->get()->result_array();
        $data['siswa'] = $this->siswa->get()->result_array();

        $this->form_validation->set_rules('siswa', 'Siswa', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('ta1', 'Tahun Ajaran', 'trim|required');
        $this->form_validation->set_rules('ta2', 'Tahun Ajaran', 'trim|required');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required');
        $this->form_validation->set_rules('latihan', 'Latihan', 'integer|required');
        $this->form_validation->set_rules('tugas', 'Tugas', 'integer|required');
        $this->form_validation->set_rules('pts', 'Nilai PTS', 'integer|required');
        $this->form_validation->set_rules('pas', 'Nilai PAS', 'integer|required');
        // $this->form_validation->set_rules('file', 'File', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('nilai-siswa/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // var_dump($this->nilai->save());
            // die;
            $this->nilai->save();
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Nilai Siswa berhasil ditambahkan.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
            );
            redirect('guru/nsiswa');
        }
    }

    public function editnsiswa($id)
    {
        $data['title'] = 'Ubah Nilai Siswa';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);
        $data['detail'] = $this->nilai->getById($id);

        $data['kelas'] = $this->kelas->get()->result_array();
        $data['jurusan'] = $this->jurusan->get()->result_array();
        $data['mapel'] = $this->mapel->get()->result_array();
        $data['siswa'] = $this->siswa->get()->result_array();

        $this->form_validation->set_rules('siswa', 'Siswa', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('ta1', 'Tahun Ajaran', 'trim|required');
        $this->form_validation->set_rules('ta2', 'Tahun Ajaran', 'trim|required');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required');
        $this->form_validation->set_rules('latihan', 'Latihan', 'integer|required');
        $this->form_validation->set_rules('tugas', 'Tugas', 'integer|required');
        $this->form_validation->set_rules('pts', 'Nilai PTS', 'integer|required');
        $this->form_validation->set_rules('pas', 'Nilai PAS', 'integer|required');
        // $this->form_validation->set_rules('file', 'File', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('nilai-siswa/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // var_dump($this->nilai->save());
            // die;
            $this->nilai->update($id);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Nilai Siswa berhasil diubah.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
            );
            redirect('guru/nsiswa');
        }
    }

    public function delnsiswa($id)
    {
        $this->nilai->delete($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Nilai Siswa berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>'
        );
        redirect('guru/nsiswa');
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
