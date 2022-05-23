<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		// memuat model role
		$this->load->model('Role_model');
		$this->load->model('Kelas_model');
		$this->load->model('Menu_model');
		$this->load->helper('mylib_helper');
	}

	public function index()
	{
		$data = [];

		$this->template->load('template', 'admin/view', $data);
	}


	// ############# kelola role #################
	public function role()
	{
		$data = [
			'role' => $this->Role_model->get()
		];
		$this->template->load('template', 'admin/role/view', $data);
	}

	public function add_role()
	{

		if (isset($_POST['submit'])) {
			$this->Role_model->save();
			$this->session->set_flashdata('pesan', msgSuccess('Role berhasil ditambahkan'));
			redirect('admin/role');
		} else {
			$this->template->load('template', 'admin/role/add');
		}
	}

	public function edit_role($id)
	{
		if (isset($_POST['submit'])) {
			$this->Role_model->update();
			$this->session->set_flashdata('pesan', msgSuccess('Role berhasil diubah!'));
			redirect('admin/role');
		} else {

			$data = [
				'role' => $this->db->get_where('tbl_level_user', array('id_level_user' => $id))->row_array(),
			];
			$this->template->load('template', 'admin/role/edit', $data);
		}
	}

	public function delete_role($id)
	{

		if (!empty($id)) {
			$this->db->where('id_level_user', $id);
			$this->db->delete('tbl_level_user');
		}
		$this->session->set_flashdata('pesan', msgSuccess('Role Berhasil Dihapus!'));
		redirect('admin/role');
	}

	public function access_role($id_role)
	{
		$data = [
			'menu'	=> $this->Menu_model->get(),
			'role'	=> $this->Role_model->get_where($id_role),
			'title'	=> 'role'
		];
		$this->template->load('template', 'admin/role/access', $data);
	}

	public function change_access()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'id_menu' => $menu_id,
			'id_level_user' => $role_id
		];

		$result = $this->db->get_where('tbl_user_rule', $data);

		if ($result->num_rows() < 1) {
			$this->db->insert('tbl_user_rule', $data);
		} else {
			$this->db->delete('tbl_user_rule', $data);
		}

		$this->session->set_flashdata('pesan', msgSuccess('Hak akses berhasil diubah'));
	}
}
