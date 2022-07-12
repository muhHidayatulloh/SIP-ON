<?php

class kehadiran_model extends CI_Model
{

    public function save($nis, $tanggal, $jam_masuk = '0', $jam_pulang = null, $status = '0')
    {
        $data = [
            'nis' => $nis,
            'tanggal' => $tanggal,
            'jam_masuk' => $jam_masuk,
            'jam_pulang' => $jam_pulang,
            'status' => $status
        ];

        return $this->db->insert('record_kehadiran', $data);
    }

    public function count_today()
    {
        $today = date('Y-m-d');
        
        $result = $this->db->get_where('record_kehadiran', ['tanggal'=> $today, 'status !=' => 'bolos' ]);
        return $result->num_rows();
    }

    public function update($jam_pulang)
    {
        $data = [
            'jam_pulang' => $jam_pulang
        ];

        return $this->db->update('record_kehadiran', $data);
    }

    public function get()
    {
        $tanggal = date('Y-m-d');
        $explode = explode('-', $tanggal);
        // var_dump($explode);
        $mY = $explode[0] . '-' . $explode[1];

        $this->db->select('a.*, b.nama, c.id as id_kelas');
        $this->db->like('tanggal', $mY, 'after');
        $this->db->order_by('tanggal', 'asc');
        $this->db->join('tbl_siswa as b', 'a.nis = b.nis');
        $this->db->join('tbl_kelas c', 'b.id_kelas = c.id');

        return $this->db->get_where('record_kehadiran as a');
    }

    public function get_month($m)
    {  
        $mY = date('Y-');
        
        if ($m < 10) {
            $m = '0'.$m;
        }

        $mY .= $m;

        $this->db->like('tanggal', $mY, 'after');
        return $this->db->get_where('record_kehadiran');
    }

    public function get_today($nis)
    {
        $tanggal = date('Y-m-d');
        $this->db->select('*');
        return $this->db->get_where('record_kehadiran', ['nis' => $nis, 'tanggal' => $tanggal]);
    }

    public function get_masuk($nis)
    {
        $tanggal = date('Y-m-d');
        $this->db->select('*');
        return $this->db->get_where('record_kehadiran', ['nis' => $nis, 'tanggal' => $tanggal, 'jam_masuk !=' => '00:00:00']);
    }
    public function get_pulang($nis)
    {
        $tanggal = date('Y-m-d');
        $this->db->select('*');
        return $this->db->get_where('record_kehadiran', ['nis' => $nis, 'tanggal' => $tanggal, 'jam_pulang !=' => '00:00:00']);
    }

    // return $this->db->get_where('record_kehadiran', ['nis' => $nis, 'tanggal' => $tanggal, 'jam_masuk !=' => '00:00:00', 'jam_pulang !=' => '00:00:00']);

    public function get_where($nis = null, $id_kelas = null)
    {

        // var_dump($nis);
        $tanggal = date('Y-m-d');
        $explode = explode('-', $tanggal);
        // var_dump($explode);
        $mY = $explode[0] . '-' . $explode[1];

        // var_dump($mY);
        $this->db->select('a.*, b.nama, c.id as id_kelas');
        $this->db->like('tanggal', $mY, 'after');
        $this->db->order_by('tanggal', 'asc');
        $this->db->join('tbl_siswa as b', 'a.nis = b.nis');
        $this->db->join('tbl_kelas c', 'b.id_kelas = c.id');
        if ($id_kelas == null) {
            return $this->db->get_where('record_kehadiran as a', ['a.nis' => $nis]);
        } else {
            return $this->db->get_where('record_kehadiran as a', ['id_kelas' => $id_kelas]);
        }
        // return $this->db->query('SELECT * FROM record_kehadiran WHERE nis = "$nis" AND MONTH(tanggal) = MONTH(CURRENT_DATE()) AND YEAR(tanggal) = YEAR(CURRENT_DATE())')->result();
        // var_dump($hasil);
    }

    public function get_where_today($nis, $tanggal)
    {
        $this->db->select('a.*, b.nama, c.id as id_kelas');
        $this->db->join('tbl_siswa as b', 'a.nis = b.nis');
        $this->db->join('tbl_kelas c', 'b.id_kelas = c.id');
        return $this->db->get_where('record_kehadiran as a', ['a.nis' => $nis, 'tanggal' => $tanggal]);
    }

    public function get_where_today_encrypt($nis, $tanggal)
    {
        return $this->db->get_where('record_kehadiran as a', ['a.nis' => $nis, 'tanggal' => $tanggal]);
    }

    public function get_encrypt($nis)
    {
        $tanggal = date('Y-m');
       
        $this->db->like('tanggal', $tanggal, 'after');
        $this->db->order_by('tanggal', 'asc');
        return $this->db->get_where('record_kehadiran ', ['nis' => $nis]);
    }

    public function get_record_month_by_nis($nis, $where_tambahan = '')
    {
        
        // nis sudah di encript dengan aes
        $sql = "SELECT * FROM record_kehadiran WHERE `tanggal` BETWEEN DATE_FORMAT(CURDATE() ,'%Y-%m-01') AND CURDATE() AND `nis` = '$nis' $where_tambahan";
        $record = $this->db->query($sql);
        return $record;
    }
}
