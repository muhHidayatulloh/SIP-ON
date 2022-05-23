<?php

class Menu_model extends CI_Model
{

	public $tabel = "tabel_menu", $id = "id";

	function get()
	{
		$query = $this->db->get($this->tabel);

		return $query->result();
	}

	function save()
	{
		$data = array(
			//tabel di database => name di form
			'nama_menu'          => $this->input->post('nama_menu', TRUE),
			'link'         		 => $this->input->post('link', TRUE),
			'icon'            	 => $this->input->post('icon', TRUE),
			'is_main_menu'       => $this->input->post('is_main_menu', TRUE)
		);
		$this->db->insert($this->tabel, $data);
	}

	function update()
	{
		$data = array(
			//tabel di database => name di form
			'nama_menu'          => $this->input->post('nama_menu', TRUE),
			'link'         		 => $this->input->post('link', TRUE),
			'icon'            	 => $this->input->post('icon', TRUE),
			'is_main_menu'       => $this->input->post('is_main_menu', TRUE)
		);
		$id_menu 	= $this->input->post('id');
		$this->db->where($this->id, $id_menu);
		$this->db->update($this->tabel, $data);
	}

	function delete($id)
	{
		$this->db->where($this->id, $id);
		$this->db->delete($this->tabel);
	}
}
