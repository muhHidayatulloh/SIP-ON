<?php 

class Walikelas_model extends CI_Model
{
    public function get()
    {
        $this->db->select('a.*, b.nomor_kelas, c.nama_jurusan, d.nama_tingkatan, e.nama');
        $this->db->join('tbl_kelas as b', 'a.id_kelas = b.id');
        $this->db->join('tbl_tingkatan_kelas as d','b.kd_tingkatan = d.kd_tingkatan');
        $this->db->join('tbl_jurusan as c', 'b.kd_jurusan = c.kd_jurusan');
        $this->db->join('tbl_guru as e', 'e.id = a.id_guru');
        
        
        return $this->db->get('tbl_walikelas as a');
    }

    public function get_where($where = [])
    {
        return $this->db->get_where('tbl_walikelas', $where);
    }
}