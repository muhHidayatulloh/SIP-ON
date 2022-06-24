<?php

class OrangTua_model extends CI_Model
{
    public $tabel = "tbl_orang_tua", $id = "id_orang_tua";

    public function get()
    {
        $this->db->select('a.*, b.nama as nama_siswa, b.nis');
        $this->db->join('tbl_siswa as b', 'a.id_orang_tua = b.id_orang_tua');
        return $this->db->get('tbl_orang_tua as a');
    }

    public function get_where($where)
    {
        $this->db->select('a.*, b.nama as nama_siswa, b.nis');
        $this->db->join('tbl_siswa as b', 'a.id_orang_tua = b.id_orang_tua');
        return $this->db->get_where('tbl_orang_tua as a', $where);
    }

    public function max_id()
    {
        $this->db->select_max($this->id);
        $hasil =  $this->db->get($this->tabel)->result();

        return $hasil[0];
    }

    public function save()
    {
        $id_orang_tua = $this->input->post('id_orang_tua', TRUE);

        $ayah = $this->input->post('ayah', TRUE);
        $ibu = $this->input->post('ibu', TRUE);

        $username = 'ortu' . substr($ayah, 0, 3) . substr($ibu, 0, 3) . $id_orang_tua;

        $data = [
            'id_orang_tua' => $id_orang_tua,
            'username' => $username,
            'password' => password_hash('ortusmkn1cibatu', PASSWORD_DEFAULT),
            'nama' => $ayah,
            'nama_ibu' => $ibu,
            'no_tlp_ortu' => $this->input->post('no_tlp_ortu', TRUE),
            'alamat' => $this->input->post('alamat_ortu', TRUE),
            'id_level_user' => $this->input->post('id_level_ortu', TRUE)

        ];

        $result = $this->db->insert($this->tabel, $data);

        $result == true ? $result = $this->session->set_flashdata('pesan', msgSuccess('Data Orang Tua berhasil ditambahkan')) : $result = $this->session->set_flashdata('pesan', msgError('Data Orang Tua gagal ditambahkan'));

        return $result;
    }


    public function update()
    {
        $data = [

            'nama' => $this->input->post('ayah', TRUE),
            'nama_ibu' => $this->input->post('ibu', TRUE),
            'no_tlp_ortu' => $this->input->post('no_tlp_ortu', TRUE),
            'alamat' => $this->input->post('alamat_ortu', TRUE),
            'id_level_user' => $this->input->post('id_level_ortu', TRUE)

        ];

        $id    = $this->input->post('id_orang_tua');
        $this->db->where($this->id, $id);
        $result = $this->db->update($this->tabel, $data);

        $result == true ? $result = $this->session->set_flashdata('pesan', msgSuccess('Data orang tua berhasil diubah')) : $result = $this->session->set_flashdata('pesan', msgError('Data orang tua gagal diubah'));

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
}
