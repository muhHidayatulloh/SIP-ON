<?php

class TahunAkademik_model extends CI_Model
{
    public $tabel = 'tbl_tahun_akademik', $id = 'id_tahun_akademik';
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
            'tahun_akademik'        => $this->input->post('tahun_akademik', TRUE),
            'is_aktif'              => $this->input->post('is_aktif', TRUE),
            'semester'              => 'Ganjil'
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
            'tahun_akademik'          => $this->input->post('tahun_akademik', TRUE),
            'semester'             => $this->input->post('semester', TRUE),
        );
        $tahunAkademik    = $this->input->post('id');
        $this->db->where($this->id, $tahunAkademik);
        return $this->db->update($this->tabel, $data);
    }

    public function aktifkan($id)
    {
        // menonaktifkan yang statusnya aktif
        $this->db->where('is_aktif', 'Y');
        $this->db->update($this->tabel, ['is_aktif' => 'N']);

        // mengaktifkan yang statusnya ingin diaktifkan berdasarkan id
        $this->db->where('id_tahun_akademik', $id);
        $this->db->update($this->tabel, ['is_aktif' => 'Y']);
    }
}
