<?php

class Tingkatan_model extends  CI_Model
{
    public $tabel = "tbl_tingkatan_kelas", $id = 'kd_tingkatan';

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
            'nama_tingkatan'      => $this->input->post('nama_tingkatan', TRUE),
            'deskripsi'         => $this->input->post('deskripsi', TRUE),
        ];

        return $this->db->insert($this->tabel, $data);
    }

    public function update()
    {
        $data = [
            //tabel di database => name di form
            'nama_tingkatan'          => $this->input->post('nama_tingkatan', TRUE),
            'deskripsi'             => $this->input->post('deskripsi', TRUE),
        ];
        $id_tingkatan    = $this->input->post('id');
        $this->db->where($this->id, $id_tingkatan);
        return $this->db->update($this->tabel, $data);
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
}
