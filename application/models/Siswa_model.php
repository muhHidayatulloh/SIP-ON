<?php

class Siswa_model extends CI_Model
{
    public $tabel = "tbl_siswa", $id = "id_siswa";


    function get_siswa_select_where($select = '*', $where = []) {
        $this->db->select($select);
        $this->db->join('tbl_kelas', $this->tabel . '.id_kelas = tbl_kelas.id');
        $this->db->join('tbl_orang_tua', $this->tabel . '.id_orang_tua = tbl_orang_tua.id_orang_tua');
        $this->db->join('tbl_tingkatan_kelas', 'tbl_kelas.kd_tingkatan = tbl_tingkatan_kelas.kd_tingkatan');
        $this->db->join('tbl_jurusan', 'tbl_kelas.kd_jurusan = tbl_jurusan.kd_jurusan');

        return $this->db->get_where($this->tabel, $where);
    }

    function get($field = null, $where = null, $sql = null, $querySql = null)
    {
        $this->db->select('*, tbl_orang_tua.alamat as alamat_ortu, tbl_orang_tua.nama as nama_ayah, tbl_siswa.nama as nama');

        $this->db->join('tbl_kelas', $this->tabel . '.id_kelas = tbl_kelas.id');
        $this->db->join('tbl_orang_tua', $this->tabel . '.id_orang_tua = tbl_orang_tua.id_orang_tua');
        $this->db->join('tbl_tingkatan_kelas', 'tbl_kelas.kd_tingkatan = tbl_tingkatan_kelas.kd_tingkatan');
        $this->db->join('tbl_jurusan', 'tbl_kelas.kd_jurusan = tbl_jurusan.kd_jurusan');
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

    public function nis_auto()
    {

        $tahun = substr(date('Y'), 2);
        $angkatan = $tahun + 1;
        $nis = $tahun . $angkatan;
        $this->db->select_max('nis');
        $this->db->like('nis', $nis);
        $hasil =  $this->db->get_where($this->tabel)->result();

        if ($hasil[0]->nis == null) {
            $data = $nis . '0001';
        } else {
            $data = $hasil[0]->nis + 1;
        }

        return $data;
    }

    public function save()
    {
        $nis = $this->input->post('nis', TRUE);

        $data = [
            'nis'   => $nis,
            'nisn'  => $this->input->post('nisn', TRUE),
            'username' => $nis,
            'password' => password_hash('siswasmkn1cibatu', PASSWORD_DEFAULT),
            'nama'  => $this->input->post('nama', TRUE),
            'gender' => $this->input->post('gender', TRUE),
            'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
            'tgl_lahir' => $this->input->post('tgl_lahir', TRUE),
            'alamat' => $this->input->post('alamat', TRUE),
            'no_tlp_siswa' => $this->input->post('no_tlp_siswa', TRUE),
            'asal_sekolah' => $this->input->post('asal_sekolah', TRUE),
            'id_orang_tua' => $this->input->post('id_orang_tua', TRUE),
            'id_kelas' => $this->input->post('kelas', TRUE),
            'id_level_user' => $this->input->post('id_level_siswa', TRUE),
        ];

        $result = $this->db->insert($this->tabel, $data);

        $result == true ? $result = $this->session->set_flashdata('pesan', msgSuccess('Data Siswa berhasil ditambahkan')) : $result = $this->session->set_flashdata('pesan', msgError('Data Siswa gagal ditambahkan'));

        return $result;
    }

    public function update()
    {
        $data = [
            'nisn'  => $this->input->post('nisn', TRUE),
            'nama'  => $this->input->post('nama', TRUE),
            'gender' => $this->input->post('gender', TRUE),
            'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
            'tgl_lahir' => $this->input->post('tgl_lahir', TRUE),
            'alamat' => $this->input->post('alamat', TRUE),
            'no_tlp_siswa' => $this->input->post('no_tlp_siswa', TRUE),
            'asal_sekolah' => $this->input->post('asal_sekolah', TRUE),
            'id_kelas' => $this->input->post('kelas', TRUE),
            'id_level_user' => $this->input->post('id_level_siswa', TRUE)
        ];

        $id    = $this->input->post('id_siswa');
        $this->db->where($this->id, $id);
        $result = $this->db->update($this->tabel, $data);

        $result == true ? $result = $this->session->set_flashdata('pesan', msgSuccess('Data Siswa berhasil diubah')) : $result = $this->session->set_flashdata('pesan', msgError('Data Siswa gagal diubah'));

        return $result;
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

    public function count()
    {

        $Var = $this->db->get('tbl_siswa');
        $Var->num_rows();

        return $Var;
    }
}
