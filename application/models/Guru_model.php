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
            $this->db->join('tbl_guru_keterangan', 'tbl_guru_keterangan.id = tbl_guru.id_guru_keterangan');
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
            'karpeg'        => $this->input->post('karpeg', TRUE),
            'username'      => $username,
            'password'      => password_hash('gurusmkn1cibatu', PASSWORD_DEFAULT),
            'nama'          => $nama,
            'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
            'tgl_lahir'     => $this->input->post('tanggal_lahir', TRUE),
            'gender'        => $this->input->post('gender', TRUE),
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
            'id_guru_keterangan'                                   => $this->input->post('ket', TRUE),
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
            'karpeg'        => $this->input->post('karpeg', TRUE),
            'nama'          => $this->input->post('nama', TRUE),
            'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
            'tgl_lahir'     => $this->input->post('tanggal_lahir', TRUE),
            'gender'        => $this->input->post('gender', TRUE),
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
            'id_guru_keterangan'                                   => $this->input->post('ket', TRUE),
        );
        $id    = $this->input->post('id');
        $this->db->where($this->id, $id);
        return $this->db->update($this->tabel, $data);
    }

    public function get_join($id)
    {
        $this->db->select('*, tbl_guru.id as id_guru');
        $this->db->from($this->tabel);
        $this->db->join('tbl_guru_keterangan', 'tbl_guru_keterangan.id = ' . $this->tabel . '.id_guru_keterangan');
        $this->db->join('tbl_level_user', 'tbl_level_user.id_level_user = ' . $this->tabel . '.jabatan');
        $this->db->where($this->tabel . '.id', $id);
        $query = $this->db->get();

        return $query->result();
    }
}
