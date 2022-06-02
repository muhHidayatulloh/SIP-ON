<?php

class Guru_model extends CI_Model
{
    public $tabel = "tbl_siswa", $id = "id_siswa";

    function get($field = null, $where = null, $sql = null, $querySql = null)
    {
        if ($where != null) {
            $this->db->where($field, $where);
            $query = $this->db->get($this->tabel);
        } else if ($sql != null) {
            $this->db->where($sql);
            $query = $this->db->get($this->tabel);
        } else if ($querySql != null) {
            $query = $this->db->query($querySql);
        } else {
            $query = $this->db->get($this->tabel);
        }

        return $query->result();
    }
}
