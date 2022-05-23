<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// memuat model menu
		$this->load->model('Menu_model');
	}

	public function index()
	{
		$data = [
			'menu' => $this->Menu_model->get()
		];

		$this->template->load('template', 'menu/view', $data);
	}

	public function add()
	{
		$data = [
			'menu' => $this->Menu_model->get()
		];
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required');
			$this->form_validation->set_rules('link', 'Link', 'required');
			$this->form_validation->set_rules('icon', 'Icon', 'required');
			if ($this->form_validation->run() == false) {
				$this->template->load('template', 'menu/add', $data);
			} else {
				$this->Menu_model->save();
				$this->session->set_flashdata('pesan', msgSuccess('Menu berhasil ditambahkan'));
				redirect('menu');
			}
		} else {
			$this->template->load('template', 'menu/add', $data);
		}
	}

	public function edit($id)
	{
		if (isset($_POST['submit'])) {
			$this->Menu_model->update();
			$this->session->set_flashdata('pesan', msgSuccess('Menu berhasil diubah'));
			redirect('menu');
		} else {
			$id_menu 	  = $id;
			$data = [
				'menu' => $this->db->get_where('tabel_menu', array('id' => $id_menu))->row_array(),
				'tabelMenu' => $this->Menu_model->get()
			];
			$this->template->load('template', 'menu/edit', $data);
		}
	}

	public function delete($id)
	{

		if (!empty($id)) {
			$this->Menu_model->delete($id);
		}
		$this->session->set_flashdata('pesan', msgSuccess('Menu berhasil dihapus'));
		redirect('menu');
	}
}
