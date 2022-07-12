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
		$this->load->model('kehadiran_model');
	}

	public function index()
	{

		
		$m = date('m');

		for($i = 1; $i < $m; $i++) {
			
			$bulan[] = bulan_format_indo($i);
			if($i < 10) {
				$count[] = $this->kehadiran_model->get_month($i)->num_rows();
			} else {
				$count[] = $this->kehadiran_model->get_month($i)->num_rows();
			}
		}

// var_dump(bulan_format_indo(2));

		$data = [
			'title' => 'Dashboard',
			'siswa' => $this->Siswa_model->count(),
			'countkehadiran' => $this->kehadiran_model->count_today(),
			'user' => $this->user_model->get(),
			'bulan' => $bulan,
			'countMonthly' => $count
		];
		
		// var_dump($data['countMonthly']);

		$this->template->load('template', 'admin/view', $data);
	}

	public function profile()
	{
		$data['user'] = $this->user_model->get();
		$this->template->load('template', 'guru/profile');
	}
}
