<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		if ($this->session->userdata('id_level_user')) {
			redirect('welcome');
		}

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login Page';
			$this->load->view('auth/login');
		} else {
			//jika validasinya sukses
			$this->_login();
		}
	}

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$siswa = $this->db->get_where('tbl_siswa', ['username' => $username])->row_array();
		$ortu = $this->db->get_where('tbl_guru', ['username' => $username])->row_array();
		$guru = $this->db->get_where('tbl_orang_tua', ['username' => $username])->row_array();
		$user = false;
		if ($siswa) {
			$level = $siswa['id_level_user'];
			$level = $this->db->get_where('tbl_level_user', ['id_level_user' => $level])->row_array()['nama_level'];
			$user = $siswa;
		} else if ($ortu) {
			$level = $ortu['id_level_user'];
			$level = $this->db->get_where('tbl_level_user', ['id_level_user' => $level])->row_array()['nama_level'];
			$user = $ortu;
		} else if ($guru) {
			$level = $guru['id_level_user'];
			$level = $this->db->get_where('tbl_level_user', ['id_level_user' => $level])->row_array()['nama_level'];
			$user = $guru;
		} else {
			$this->session->set_flashdata('pesan', msgError('User Akses Tidak Ditemukan'));
		}

		// cek user
		if ($user) {
			// jika usernya ada
			//cek password
			if (password_verify($password, $user['password'])) {
				$level = strtolower($level);
				//jika password terkonfirmasi benar
				$data = [
					'username' => $user['username'],
					'id_level_user' => $user['id_level_user'],
					'nama' => $user['nama'],
					'foto' => $user['pas_foto']
				];
				//menyimpan data di session
				$this->session->set_userdata($data);

				if ($level === 'admin') {
					redirect('admin');
				} else if ($level === 'siswa') {
					redirect('siswa/dashboard');
				} else if ($level === 'orang tua') {
					redirect('orangtua/');
				} else if ($level === 'guru') {
					redirect('welcome');
				} else {
					redirect('welcome');
				}
			} else {
				$this->session->set_flashdata('pesan', msgError('Password Salah'));
				redirect('auth');
			}
		} else {
			//user gak ada
			$this->session->set_flashdata('pesan', msgError('Username Tidak terdaftar'));
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('id_level_user');
		$this->session->set_flashdata('pesan', toastSuccess('Berhasil Logout, Berhasil meninggalkan sesi'));
		redirect('auth');
	}

	public function blocked()
	{
		$this->load->model('user_model');
		$data['title'] = 'blocked';
		$data['user'] = $this->user_model->get();
		$this->template->load('template', 'auth/blocked', $data);
	}
}
