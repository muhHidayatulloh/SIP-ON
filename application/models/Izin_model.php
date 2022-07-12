<?php 

class Izin_model extends  CI_Model
{
    public function get()
    {
        $this->db->select('a.*, b.nama, b.id_kelas');
        $this->db->join('tbl_siswa as b', 'a.id_siswa = b.id_siswa');
        
        return $this->db->get('tbl_izin as a');
    }

    public function save($data)
    {
       return $this->db->insert('tbl_izin', $data);
    }
}
