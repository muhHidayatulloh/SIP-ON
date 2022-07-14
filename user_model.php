<?php

class user_model extends CI_Model
{
    public function get()
    {
        $username = $this->session->userdata('username');
        $siswa = $this->db->get_where('tbl_siswa', ['username' => $username])->row_object();
        $guru = $this->db->get_where('tbl_guru', ['username' => $username])->row_object();
        $ortu = $this->db->get_where('tbl_orang_tua', ['username' => $username])->row_object();

        if ($siswa) {
            $this->db->select('a.*, c.alamat as alamat_ortu, c.nama as nama_ayah, a.nama as nama, f.nama_level, d.nama_tingkatan, e.nama_jurusan, b.nomor_kelas');
            $this->db->join('tbl_kelas as b', 'a.id_kelas = b.id');
            $this->db->join('tbl_orang_tua as c', 'a.id_orang_tua = c.id_orang_tua');
            $this->db->join('tbl_tingkatan_kelas as d', 'b.kd_tingkatan = d.kd_tingkatan');
            $this->db->join('tbl_jurusan as e', 'b.kd_jurusan = e.kd_jurusan');
            $this->db->join('tbl_level_user as f', 'a.id_level_user = f.id_level_user');
            $siswa = $this->db->get_where('tbl_siswa as a', ['a.username' => $username])->row_object();
            $user = $siswa;
        } else if ($ortu) {
            $this->db->join('tbl_level_user', 'tbl_orang_tua.id_level_user = tbl_level_user.id_level_user');
            $ortu = $this->db->get_where('tbl_orang_tua', ['username' => $username])->row_object();
            $user = $ortu;
        } else if ($guru) {
            $this->db->select('*, tbl_guru.id as id_guru');
            $this->db->join('tbl_level_user', 'tbl_guru.id_level_user = tbl_level_user.id_level_user');
            $guru = $this->db->get_where('tbl_guru', ['username' => $username])->row_object();
            $user = $guru;
        }

        return $user;
    }

    public function get_where($field)
    {
        $username = $this->session->userdata('username');
        $siswa = $this->db->get_where('tbl_siswa', ['username' => $username])->row_object();
        $guru = $this->db->get_where('tbl_guru', ['username' => $username])->row_object();
        $ortu = $this->db->get_where('tbl_orang_tua', ['username' => $username])->row_object();

        if ($siswa) {
            $this->db->select('*, tbl_orang_tua.alamat as alamat_ortu, tbl_orang_tua.nama as nama_ayah, tbl_siswa.nama as nama');
            $this->db->join('tbl_kelas', 'tbl_siswa.id_kelas = tbl_kelas.id');
            $this->db->join('tbl_orang_tua', 'tbl_siswa.id_orang_tua = tbl_orang_tua.id_orang_tua');
            $this->db->join('tbl_tingkatan_kelas', 'tbl_kelas.kd_tingkatan = tbl_tingkatan_kelas.kd_tingkatan');
            $this->db->join('tbl_jurusan', 'tbl_kelas.kd_jurusan = tbl_jurusan.kd_jurusan');
            $this->db->join('tbl_level_user', 'tbl_siswa.id_level_user = tbl_level_user.id_level_user');
            $siswa = $this->db->get_where('tbl_siswa', ['username' => $username, $field])->row_object();
            $user = $siswa;
        } else if ($ortu) {
            $this->db->join('tbl_level_user', 'tbl_orang_tua.id_level_user = tbl_level_user.id_level_user');
            $ortu = $this->db->get_where('tbl_orang_tua', ['username' => $username, $field])->row_object();
            $user = $ortu;
        } else if ($guru) {
            $this->db->select('*, tbl_guru.id as id_guru');
            $this->db->join('tbl_level_user', 'tbl_guru.id_level_user = tbl_level_user.id_level_user');
            $guru = $this->db->get_where('tbl_guru', ['username' => $username, $field])->row_object();
            $user = $guru;
        }

        return $user;
    }
}
