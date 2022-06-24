<?php

class Guru_model extends CI_Model
{
    public $tabel = "tbl_guru", $id = "id";

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
            $this->db->select('*, tbl_guru.id as id_guru');
            $query = $this->db->get($this->tabel);
        }

        return $query->result();
    }

    public function save()
    {
        $nip  = $this->input->post('nip', TRUE);
        $nama = $this->input->post('nama', TRUE);
        $username = 'G' . substr($nama, 0, 3) . substr($nip, 8, 4);
        $data = [
            'nip'           => $nip,
            'username'      => $username,
            'password'      => password_hash('gurusmkn1cibatu', PASSWORD_DEFAULT),
            'nama'          => $nama,
            'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
            'tgl_lahir'     => $this->input->post('tanggal_lahir', TRUE),
            'gender'        => $this->input->post('gender', TRUE),
            'id_level_user' => $this->input->post('id_level_user', TRUE)
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
            'nip'           => $this->input->post('nip', TRUE),
            'nama'          => $this->input->post('nama', TRUE),
            'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
            'tgl_lahir'     => $this->input->post('tanggal_lahir', TRUE),
            'gender'        => $this->input->post('gender', TRUE),
            'id_level_user' => $this->input->post('id_level_user', TRUE),
        );
        $id    = $this->input->post('id');
        $this->db->where($this->id, $id);
        return $this->db->update($this->tabel, $data);
    }

    public function get_join($id)
    {
        $this->db->select('*, tbl_guru.id as id_guru');
        $this->db->from($this->tabel);
        $this->db->join('tbl_level_user', 'tbl_level_user.id_level_user = ' . $this->tabel . '.id_level_user');
        $this->db->where($this->tabel . '.id', $id);
        $query = $this->db->get();

        return $query->result();
    }
}
