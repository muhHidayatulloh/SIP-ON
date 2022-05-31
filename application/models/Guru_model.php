<?php

class Guru_model extends CI_Model
{
    public $tabel = "tbl_guru", $id = "id";

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
            'nip'           => $this->input->post('nip', TRUE),
            'karpeg'        => $this->input->post('karpeg', TRUE),
            'nama'          => $this->input->post('nama', TRUE),
            'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
            'tgl_lahir'     => $this->input->post('tanggal_lahir', TRUE),
            'pangkat'       => $this->input->post('pangkat', TRUE),
            'golongan'      => $this->input->post('golongan', TRUE),
            'jabatan'       => $this->input->post('jabatan', TRUE),
            'pendidikan'    => $this->input->post('pendidikan', TRUE),
            'pendidikan_th' => $this->input->post('pendidikan_th', TRUE),
            'jurusan'       => $this->input->post('jurusan', TRUE),
            'usia_th'       => $this->input->post('usia_th', TRUE),
            'usia_bl'       => $this->input->post('usia_bl', TRUE),
            'mk_th'         => $this->input->post('mk_th', TRUE),
            'mk_bl'         => $this->input->post('mk_bl', TRUE),
            'tambahan_mk_th' => $this->input->post('tambahan_mk_th', TRUE),
            'tambahan_mk_bl' => $this->input->post('tambahan_mk_bl', TRUE),
            'mk_potongan'   => $this->input->post('mk_potongan', TRUE),
            'lat_jab_nama'  => $this->input->post('lat_jab_nama', TRUE),
            'lat_jab_th'    => $this->input->post('lat_jab_th', TRUE),
            'lat_jab_bl'    => $this->input->post('lat_jab_bl', TRUE),
            'mutasi_kepeg'  => $this->input->post('mutasi_kepeg', TRUE),
            'pertgl_dso'    => $this->input->post('pertgl_dso', TRUE),
            'no_tgl_surat_pengangkatan_pertama'     => $this->input->post('no_tgl_surat_pengangkatan_pertama', TRUE),
            'no_tgl_surat_pengangkatan_terakhir'    => $this->input->post('no_tgl_surat_pengangkatan_terakhir', TRUE),
            'pejabat_yang_mengangkat'               => $this->input->post('pejabat_yang_mengangkat', TRUE),
            'ket'                                   => $this->input->post('ket', TRUE),
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
            'nama_jurusan'          => $this->input->post('nama_jurusan', TRUE),
            'deskripsi'             => $this->input->post('deskripsi', TRUE),
        );
        $id_jurusan    = $this->input->post('id');
        $this->db->where($this->id, $id_jurusan);
        return $this->db->update($this->tabel, $data);
    }

    public function get_join($id)
    {

        $this->db->from($this->tabel);
        $this->db->join('tbl_level_user', 'tbl_level_user.id_level_user = ' . $this->tabel . '.jabatan');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->result();
    }
}
