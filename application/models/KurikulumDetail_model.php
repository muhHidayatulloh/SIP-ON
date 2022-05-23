<?php

class KurikulumDetail_model extends CI_Model
{
    public $tabel = 'tbl_kurikulum_detail', $id = 'id_kurikulum_detail';
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
            'id_kurikulum'        => $this->input->post('id_kurikulum', TRUE),
            'kd_mapel'              => $this->input->post('kd_mapel', TRUE),
            'kd_jurusan'              => $this->input->post('kd_jurusan', TRUE),
            'kd_tingkatan'              => $this->input->post('kd_tingkatan', TRUE),
        ];


        return $this->db->insert($this->tabel, $data);
    }
}
