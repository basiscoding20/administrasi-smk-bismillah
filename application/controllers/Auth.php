<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model', 'user');
		$this->load->model('pegawai_model', 'pegawai');
		$this->load->model('siswa_model', 'siswa');
	}

	public function index()
	{
		$this->form_validation->set_rules('id', 'NIP/NIS', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/auth_header');
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			$this->_login();
		}


		if ($this->session->userdata('id')) {
			$login = $this->user->getUserRole();
			redirect($login['menu']);
		}
	}

	private function _login()
	{
		$id = $this->input->post('id');
		$password = $this->input->post('password');

		$user_role = $this->user->get();

		$query = $this->pegawai->getById($id);

		if ($query) {
			$user = $query;
		} else {
			$query = $this->siswa->getById($id);
			$user = $query;
		}


		// var_dump($user_role->result());

		if ($user) {
			// user ada
			if ($user['is_active'] == 1) {
				// cek password
				if (password_verify($password, $user['password'])) {
					$data = [
						'id' => $user['id'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);

					foreach ($user_role as $row) {
						if ($row['id'] == $data['role_id']) {
							$row['menu'];
							redirect($row['menu']);
						}
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIP/NIS sudah tidak aktif!</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIP/NIS belum terdaftar!</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil keluar!</div>');
		redirect('auth');
	}

	public function blocked()
	{
		$data['user'] = $this->user->getUserRole();
		$this->load->view('auth/blocked', $data);
	}
}
