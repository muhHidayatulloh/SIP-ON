<?php

class Kelas_model extends CI_Model
{
    public $tabel  = "tbl_kelas", $id = "id";

    function get($field = null, $where = null)
    {

        $this->db->from($this->tabel);
        $this->db->join('tbl_tingkatan_kelas', $this->tabel . '.kd_tingkatan = tbl_tingkatan_kelas.kd_tingkatan');
        $this->db->join('tbl_jurusan', $this->tabel . '.kd_jurusan = tbl_jurusan.kd_jurusan');
        if ($where != null) {
            $this->db->where($field, $where);
            $query = $this->db->get();
        } else {
            $query = $this->db->get();
        }

        return $query->result();
    }

    function count($field = null, $where = null)
    {

        $this->db->from($this->tabel);
        $this->db->join('tbl_tingkatan_kelas', $this->tabel . '.kd_tingkatan = tbl_tingkatan_kelas.kd_tingkatan');
        $this->db->join('tbl_jurusan', $this->tabel . '.kd_jurusan = tbl_jurusan.kd_jurusan');
        if ($where != null) {
            $this->db->where($field, $where);
            $query = $this->db->count_all_results();
        } else {
            $query = $this->db->count_all_results();
        }

        return $query;
    }

    function save()
    {
        $kodeKelas = $this->input->post('tingkatan_kelas', TRUE) . $this->input->post('jurusan', TRUE) . $this->input->post('nomor_kelas');

        $data = [
            'kd_kelas'          => $kodeKelas,
            'kd_tingkatan'      => $this->input->post('tingkatan_kelas', TRUE),
            'kd_jurusan'        => $this->input->post('jurusan', TRUE),
            'nomor_kelas'       => $this->input->post('nomor_kelas', TRUE)
        ];

        $row = $this->get('kd_kelas', $kodeKelas);


        if (sizeof($row) < 1) {
            $this->db->insert($this->tabel, $data);
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        $id_kelas    = $this->input->post('id');
        $kodeKelas = $this->input->post('tingkatan_kelas', TRUE) . $this->input->post('jurusan', TRUE) . $this->input->post('nomor_kelas');
        $data = [
            //tabel di database => name di form

            'kd_kelas'          => $kodeKelas,
            'kd_tingkatan'      => $this->input->post('tingkatan_kelas', TRUE),
            'kd_jurusan'        => $this->input->post('jurusan', TRUE),
            'nomor_kelas'       => $this->input->post('nomor_kelas', TRUE)
        ];

        $row = $this->get('kd_kelas', $kodeKelas);


        if (sizeof($row) < 1) {
            $this->db->where($this->id, $id_kelas);
            $this->db->update($this->tabel, $data);
            return true;
        } else {
            return false;
        }
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
