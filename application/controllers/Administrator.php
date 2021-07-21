<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
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
        $this->load->model('arsip_model', 'arsip');
        $this->load->model('pelajaran_model', 'pel');
        $this->load->model('silabus_model', 'silab');
        $this->load->model('absensi_model', 'absen');
        $this->load->model('nilai_model', 'nilai');
        $this->load->model('inbox_model', 'inbox');
        $this->load->model('outbox_model', 'outbox');
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

        $data['siswa'] = $this->db->get('siswa')->num_rows();
        $data['pegawai'] = $this->db->get('pegawai')->num_rows();
        $data['lpj'] = $this->db->get('dok_lpj')->num_rows();
        $data['pelajaran'] = $this->db->get('dok_pelajaran')->num_rows();
        $data['silabus'] = $this->db->get('dok_silabus')->num_rows();
        $data['absensi'] = $this->db->get('dok_absensi')->num_rows();
        $data['nsiswa'] = $this->db->get('nilai_siswa')->num_rows();
        $data['inbox'] = $this->db->get('surat_masuk')->num_rows();
        $data['outbox'] = $this->db->get('surat_keluar')->num_rows();
        $data['pkl'] = $this->db->get('dok_pkl')->num_rows();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function akun()
    {
        $data['title'] = 'Daftar Akun';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $data['siswa'] = $this->siswa->getAll()->num_rows();
        $data['pegawai'] = $this->pegawai->getAll()->num_rows();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('templates/footer', $data);
    }

    public function profile()
    {
        $data['user'] = $this->user->login();
        redirect('administrator/detp/' . $data['user']['id']);
    }

    // Olah data pegawai
    public function pegawai()
    {
        // ambil segmen url ke-3
        $seg = $this->uri->segment(3);

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

        $data['title'] = 'Data ' . $data['menu'];
        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

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

    public function addp()
    {
        $seg = $this->uri->segment(3);
        if ($seg) {
            $query = $this->user->getWhere('menu', $seg)->row_array();
            $data['loc_id'] = $query['id'];
            $data['loc'] = $query['menu'];
            $data['menu'] = $query['role'];
        } else {
            $data['loc'] = '';
            $data['menu'] = 'Guru';
        }


        $data['title'] = 'Tambah Data ' . $data['menu'];

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);
        $data['jabatan'] = $this->user->get();

        $this->form_validation->set_rules('nip', 'NIP', 'trim|required|is_unique[pegawai.id]');
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan Terakhir', 'trim|required');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('tahun_masuk', 'Tahun Masuk', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_rules('jalan', 'Jalan', 'trim|required');
        $this->form_validation->set_rules('desa_kelurahan', 'Desa/Kelurahan', 'trim|required');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required');
        $this->form_validation->set_rules('kab_kota', 'Kabupaten/Kota', 'trim|required');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
        $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'trim|required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('pegawai/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->pegawai->save();
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data ' . $query['role'] . ' berhasil ditambahkan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            redirect('administrator/pegawai/' . $data['loc']);
        }
    }

    public function editp($id)
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

        $data['title'] = 'Ubah Data ' . $data['menu'];

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);
        $data['jabatan'] = $this->user->get();
        $data['detail'] = $this->pegawai->getById($id);

        $this->form_validation->set_rules('nip', 'NIP', 'trim|required');
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan Terakhir', 'trim|required');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('tahun_masuk', 'Tahun Masuk', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_rules('jalan', 'Jalan', 'trim|required');
        $this->form_validation->set_rules('desa_kelurahan', 'Desa/Kelurahan', 'trim|required');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required');
        $this->form_validation->set_rules('kab_kota', 'Kabupaten/Kota', 'trim|required');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
        $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'trim|required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('pegawai/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->pegawai->update($id);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data ' . $query['role'] . ' berhasil diubah.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            redirect('administrator/pegawai/' . $data['loc']);
        }
    }

    public function delp($id)
    {
        $seg = $this->uri->segment(4);
        if ($seg) {
            $query = $this->user->getWhere('menu', $seg)->row_array();
            $data['loc'] = $query['menu'];
        } else {
            $data['loc'] = '';
        }

        $this->pegawai->delete($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data ' . $query['role'] . ' berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>'
        );
        redirect('administrator/pegawai/' . $data['loc']);
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
        // var_dump($data['dok']);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('siswa/detail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function addsiswa()
    {
        $data['title'] = 'Tambah Siswa';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $this->form_validation->set_rules('nis', 'Nis', 'trim|required|is_unique[siswa.id]');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('anak_ke', 'Anak ke-', 'trim|required');
        $this->form_validation->set_rules('dari', 'Dari', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'numeric');
        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'trim|required');
        $this->form_validation->set_rules('no_hp_ayah', 'No. HP Ayah', 'numeric');
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'trim|required');
        $this->form_validation->set_rules('no_hp_ibu', 'No. HP Ibu', 'numeric');
        $this->form_validation->set_rules('alamat_orangtua', 'Alamat Orang Tua', 'required');
        $this->form_validation->set_rules('no_hp_wali', 'No. HP Wali', 'numeric');
        $this->form_validation->set_rules('tahun_masuk', 'Tahun Masuk', 'trim|required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('siswa/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->siswa->save();
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data Siswa berhasil ditambahkan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            redirect('administrator/datasiswa');
        }
    }

    public function editsiswa($id)
    {
        $data['title'] = 'Ubah Data Siswa';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);
        $data['detail'] = $this->siswa->getById($id);

        $this->form_validation->set_rules('nis', 'Nis', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('anak_ke', 'Anak ke-', 'trim|required');
        $this->form_validation->set_rules('dari', 'Dari', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'numeric');
        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'trim|required');
        $this->form_validation->set_rules('no_hp_ayah', 'No. HP Ayah', 'numeric');
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'trim|required');
        $this->form_validation->set_rules('no_hp_ibu', 'No. HP Ibu', 'numeric');
        $this->form_validation->set_rules('alamat_orangtua', 'Alamat Orang Tua', 'required');
        $this->form_validation->set_rules('no_hp_wali', 'No. HP Wali', 'numeric');
        $this->form_validation->set_rules('tahun_masuk', 'Tahun Masuk', 'trim|required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('siswa/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->siswa->update($id);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data Siswa berhasil diubah.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            redirect('administrator/datasiswa');
        }
    }

    public function delsiswa($id)
    {
        $this->siswa->delete($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Siswa berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>'
        );
        redirect('administrator/datasiswa');
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
                redirect('administrator/lpj');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('administrator/addlpj');
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
                redirect('administrator/lpj');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('administrator/editlpj/' . $id);
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
        redirect('administrator/lpj');
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
                redirect('administrator/pelajaran');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('administrator/addpel');
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
                redirect('administrator/pelajaran');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('administrator/editpel/' . $id);
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
        redirect('administrator/pelajaran');
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
                redirect('administrator/silabus');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('administrator/addsilab');
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
                redirect('administrator/silabus');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('administrator/editsilab/' . $id);
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
        redirect('administrator/silabus');
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
                redirect('administrator/absensi');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('administrator/addabsen');
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
                redirect('administrator/absensi');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('administrator/editabsen/' . $id);
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
        redirect('administrator/absensi');
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
            redirect('administrator/nsiswa');
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
            redirect('administrator/nsiswa');
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
        redirect('administrator/nsiswa');
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

    public function addinbox()
    {
        $data['title'] = 'Tambah Surat Masuk';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $this->form_validation->set_rules('no_surat', 'No. Surat', 'trim|required|is_unique[surat_masuk.no_surat]');
        $this->form_validation->set_rules('dari', 'Dari', 'required');
        $this->form_validation->set_rules('tgl_terima', 'Tanggal Diterima', 'required');
        $this->form_validation->set_rules('perihal', 'Perihal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('inbox/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            if ($this->inbox->save()) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Surat Masuk berhasil ditambahkan.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
                );
                redirect('administrator/inbox');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('administrator/addinbox');
            }
        }
    }

    public function editinbox($id)
    {
        $data['title'] = 'Tambah Surat Masuk';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);
        $data['detail'] = $this->inbox->getById($id);

        $this->form_validation->set_rules('no_surat', 'No. Surat', 'trim|required');
        $this->form_validation->set_rules('dari', 'Dari', 'required');
        $this->form_validation->set_rules('tgl_terima', 'Tanggal Diterima', 'required');
        $this->form_validation->set_rules('perihal', 'Perihal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('inbox/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            if ($this->inbox->update($id)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Surat Masuk berhasil diubah.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
                );
                redirect('administrator/inbox');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('administrator/editinbox' . $id);
            }
        }
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
        redirect('administrator/inbox');
    }

    public function delinbox($id)
    {
        $this->inbox->delete($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Surat Masuk berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>'
        );
        redirect('administrator/inbox');
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

    public function addoutbox()
    {
        $data['title'] = 'Tambah Surat Keluar';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $this->form_validation->set_rules('no_surat', 'No. Surat', 'trim|required|is_unique[surat_masuk.no_surat]');
        $this->form_validation->set_rules('perihal', 'Perihal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('outbox/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            if ($this->outbox->save()) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Surat Keluar berhasil ditambahkan.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
                );
                redirect('administrator/outbox');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('administrator/addoutbox');
            }
        }
    }

    public function editoutbox($id)
    {
        $data['title'] = 'Tambah Surat Keluar';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);
        $data['detail'] = $this->outbox->getById($id);

        $this->form_validation->set_rules('no_surat', 'No. Surat', 'trim|required');
        $this->form_validation->set_rules('perihal', 'Perihal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('outbox/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            if ($this->outbox->update($id)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Surat Keluar berhasil diubah.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
                );
                redirect('administrator/outbox');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('administrator/editoutbox' . $id);
            }
        }
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
        redirect('administrator/outbox');
    }

    public function deloutbox($id)
    {
        $this->outbox->delete($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Surat Keluar berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>'
        );
        redirect('administrator/outbox');
    }

    public function adddoktk($id)
    {
        if ($this->tk->save()) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Berhasil ditambahkan.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
            );
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Gagal, coba lagi!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
            );
        }
        redirect('administrator/detp/' . $id);
    }

    public function editdoktk($id)
    {
        $seg = $this->uri->segment(4);
        if ($this->tk->update($id)) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Berhasil diubah.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
            );
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Gagal, coba lagi!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
            );
        }
        redirect('administrator/detp/' . $seg);
    }

    public function deldoktk($id)
    {
        $seg = $this->uri->segment(4);
        $this->tk->delete($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>'
        );
        redirect('administrator/detp/' . $seg);
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

    public function addarsip()
    {
        $data['title'] = 'Tambah Dokumen arsip';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $this->form_validation->set_rules('ket1', 'Keterangan 1', 'required');
        $this->form_validation->set_rules('ket2', 'Keterangan 2', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dok-arsip/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // $this->arsip->save();
            if ($this->arsip->save()) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Dokumen Arsip berhasil ditambahkan.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
                );
                redirect('administrator/arsip');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('administrator/addarsip');
            }
        }
    }

    public function editarsip($id)
    {
        $data['title'] = 'Edit Dokumen arsip';

        $data['user'] = $this->user->login();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);
        $data['detail'] = $this->arsip->getById($id);

        $this->form_validation->set_rules('ket1', 'Keterangan 1', 'required');
        $this->form_validation->set_rules('ket2', 'Keterangan 2', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dok-arsip/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // $this->arsip->update($id);
            if ($this->arsip->update($id)) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Dokumen Arsip berhasil diubah.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
                );
                redirect('administrator/arsip');
            } else {
                $this->session->set_flashdata('file', 'Silahkan pilih file dengan benar!');
                redirect('administrator/editarsip/' . $id);
            }
        }
    }

    public function delarsip($id)
    {
        $this->arsip->delete($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Dokumen Arsip berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>'
        );
        redirect('administrator/arsip');
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
    public function adddoksiswa($id)
    {
        if ($this->pkl->save()) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Berhasil ditambahkan.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
            );
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Gagal, coba lagi!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
            );
        }
        redirect('administrator/detsiswa/' . $id);
    }

    public function editdoksiswa($id)
    {
        $seg = $this->uri->segment(4);
        if ($this->pkl->update($id)) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Berhasil diubah.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
            );
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Gagal, coba lagi!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'
            );
        }
        redirect('administrator/detsiswa/' . $seg);
    }

    public function deldoksiswa($id)
    {
        $seg = $this->uri->segment(4);
        $this->pkl->delete($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Berhasil dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>'
        );
        redirect('administrator/detsiswa/' . $seg);
    }
}
