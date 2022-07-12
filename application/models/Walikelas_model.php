<?php

class Walikelas_model extends CI_Model
{
    public $id = 'id_wali_kelas', $tabel = 'tbl_walikelas';
    
    public function get()
    {
        $this->db->select('a.*, b.nomor_kelas, c.nama_jurusan, d.nama_tingkatan, e.nama');
        $this->db->join('tbl_kelas as b', 'a.id_kelas = b.id');
        $this->db->join('tbl_tingkatan_kelas as d', 'b.kd_tingkatan = d.kd_tingkatan');
        $this->db->join('tbl_jurusan as c', 'b.kd_jurusan = c.kd_jurusan');
        $this->db->join('tbl_guru as e', 'e.id = a.id_guru');


        return $this->db->get('tbl_walikelas as a');
    }

    public function get_where($where = [])
    {
        $this->db->select('a.*, b.nomor_kelas, c.nama_jurusan, d.nama_tingkatan, e.nama');
        $this->db->join('tbl_kelas as b', 'a.id_kelas = b.id');
        $this->db->join('tbl_tingkatan_kelas as d', 'b.kd_tingkatan = d.kd_tingkatan');
        $this->db->join('tbl_jurusan as c', 'b.kd_jurusan = c.kd_jurusan');
        $this->db->join('tbl_guru as e', 'e.id = a.id_guru');
        return $this->db->get_where('tbl_walikelas as a', $where);
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
