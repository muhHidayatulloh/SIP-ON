<?php

class Jurusan_model extends CI_Model
{
    public $tabel = "tbl_jurusan", $id = "kd_jurusan";

    function get($field = null, $where = null, $sql = null)
    {
        if ($where != null) {
            $this->db->where($field, $where);
            $query = $this->db->get($this->tabel);
        } else if ($sql != null) {
            $this->db->where($sql);
            $query = $this->db->get($this->tabel);
        } else {
            $query = $this->db->get($this->tabel);
        }

        return $query->result();
    }

    public function save()
    {
        $data = [
            'nama_jurusan'      => $this->input->post('nama_jurusan', TRUE),
            'deskripsi'         => $this->input->post('deskripsi', TRUE),
        ];

        return $this->db->insert($this->tabel, $data);
    }

    public function delete($id)
    {
        if (empty($id)) {
            return false;
        } else {
            $this->db->where($this->id, $id);
            return $this->db->delete($this->tabel);
        }
    }

    public function update()
    {
        $data = array(
            //tabel di database => name di form
            'nama_jurusan'          => $this->input->post('nama_jurusan', TRUE),
            'deskripsi'             => $this->input->post('deskripsi', TRUE),
        );
        $id_jurusan    = $this->input->post('id');
        $this->db->where($this->id, $id_jurusan);
        return $this->db->update($this->tabel, $data);
    }
}
