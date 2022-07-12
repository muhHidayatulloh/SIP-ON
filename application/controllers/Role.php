<?php 

class Role extends CI_Controller {

	public $user;

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

		$this->user = $this->user_model->get();
	}


    // ############# kelola role #################
	public function index()
	{
		$data = [
			'title'=> 'manage role',
			'role' => $this->Role_model->get(),
			'user' => $this->user
		];
		$this->template->load('template', 'admin/role/view', $data);
	}

	public function add_role()
	{
		$data['user'] = $this->user;
		if (isset($_POST['submit'])) {
			$this->Role_model->save();
			$this->session->set_flashdata('pesan', msgSuccess('Role berhasil ditambahkan'));
			redirect('role');
		} else {
			$this->template->load('template', 'admin/role/add', $data);
		}
	}

	public function edit_role($id)
	{
		if (isset($_POST['submit'])) {
			$this->Role_model->update();
			$this->session->set_flashdata('pesan', msgSuccess('Role berhasil diubah!'));
			redirect('role');
		} else {

			$data = [
				'role' => $this->db->get_where('tbl_level_user', array('id_level_user' => $id))->row_array(),
				'user' => $this->user_model->get()
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
		redirect('role');
	}

	public function access_role($id_role)
	{
		$data = [
			'menu'	=> $this->Menu_model->get(),
			'role'	=> $this->Role_model->get_where($id_role),
			'title'	=> 'role',
			'user'  => $this->user
		];
		$this->template->load('template', 'admin/role/access', $data);
	}

	public function change_access()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'id_menu' => $menu_id,
			'id_level_user' => $role_id,
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