<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		is_logged_in();
		// memuat model role
		$this->load->model('Role_model');
		$this->load->model('Kelas_model');
		$this->load->model('Menu_model');
		$this->load->model('Siswa_model');
		$this->load->helper('mylib_helper');
		$this->load->model('user_model');
	}

	public function index()
	{

		$prefs = array(
			'start_day'    => 'monday',
			'month_type'   => 'short',
			'day_type'     => 'long'
		);
		$this->load->library('calendar', $prefs);
		$year = date('Y');
		$month = date('m');
		$data = [
			'title' => 'Dashboard',
			'siswa' => $this->Siswa_model->count(),
			'calendar' => $this->calendar->generate(),
			'user' => $this->user_model->get()
		];

		$this->template->load('template', 'admin/view', $data);
	}

	public function profile()
	{
		$data['user'] = $this->user_model->get();
		$this->template->load('template', 'guru/profile');
	}
}
