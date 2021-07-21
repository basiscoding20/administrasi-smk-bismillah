<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model("siswa_model", "siswa");
        $this->load->model('user_model', 'user');
        $this->load->model('menu_model', 'menu');
    }

    public function index()
    {
        $data['title'] = 'Administrasi SMK Bismillah';

        $data['user'] = $this->user->login();
        $data['siswa'] = $this->siswa->getAll()->result_array();
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('siswa/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function datasiswa()
    {
        redirect('siswa');
    }

    public function profile()
    {
        $data['title'] = 'Profile';

        $data['user'] = $this->user->login();
        $data['detail'] = $this->siswa->getById($data['user']['id']);
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('siswa/profile', $data);
        $this->load->view('templates/footer', $data);
    }

    public function detsiswa($id)
    {
        $data['title'] = 'Detail Siswa';

        $data['user'] = $this->user->login();
        $data['detail'] = $this->siswa->getById($id);
        $data['role'] = $this->user->getUserRole();
        $data['akses'] = $this->menu->getWhere($data['user']['role_id']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('siswa/detail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editpass($id)
    {
        $data['title'] = 'Ubah Password';

        $data['user'] = $this->user->login();
        $data['detail'] = $this->siswa->getById($id);
        $data['role'] = $this->user->getUserRole();

        if ($id == $data['user']['id']) {
            $this->load->view('templates/header', $data);
            $this->load->view('siswa/sidebar', $data);
            $this->load->view('siswa/update-pass', $data);
            $this->load->view('templates/footer', $data);
        } else {
            // echo $data['role']['menu'];die;
            redirect('auth/blocked');
        }
    }
}
