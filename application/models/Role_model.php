<?php

/**
 * 
 */
class Role_model extends CI_Model
{
	public $table = "tbl_level_user";

	function get()
	{
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function get_desc()
	{
		$this->db->order_by('id_level_user', 'desc');
		$query = $this->db->get($this->table);
		return $query->result();
	}

	function get_where($id)
	{
		$query = $this->db->get_where($this->table, ['id_level_user' => $id]);

		return $query->result()[0];
	}

	function save()
	{
		$data['nama_level'] = $this->input->post('nama_level', TRUE);
		$this->db->insert($this->table, $data);
	}

	function update()
	{
		$data['nama_level'] = $this->input->post('nama_level', TRUE);
		$id 	= $this->input->post('id');
		$this->db->where('id_level_user', $id);
		$this->db->update($this->table, $data);
	}
}
