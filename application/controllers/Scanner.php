<?php

class Scanner extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('user_model');
        $this->load->model('kehadiran_model');
    }
    public function index()
    {

        // $this->load->view('qr/scanner/view');
        $data['user'] = $this->user_model->get();

        $this->template->load('template', 'qr/scanner/view', $data);
    }

    public function validation_qr()
    {
        $this->load->library('EasyAESCrypt');

        $z = 'abcdefghijuklmno0123456789012345';
        $encrypt = '';
        $aes = new EasyAESCrypt($z);

        $token = $this->input->post('token', TRUE);

        $this->db->where('token', $token);
        $hasil = $this->db->get('tbl_qr')->num_rows();

        // validasi qr yang di scan dengan token yang tersimpan
        if ($hasil > 0) {
            // jika hasil scan valid
            $result = $this->user_model->get();
            $nis = $result->nis;
            $nis = $aes->encrypt($nis);
            // $nisEncrypt = $aes->encrypt($nis);
            $record_today = $this->kehadiran_model->get_today($nis);
            $jadwal_masuk = '07:00:00';
            $jadwal_pulang = '12:00:00';
            $jam_record = date('H:i:s');
            $tanggal = date('Y-m-d');
            $hasil = ['pesan' => 'Default'];
            $record_pulang = $this->kehadiran_model->get_pulang($nis)->num_rows();
            $record_masuk = $this->kehadiran_model->get_masuk($nis)->num_rows();
            $chatID = '948313695'; //chat id muhamad hidayatulloh
            // $chatID = '1910851864';
            $token2 = "5525121168:AAG5bL1PyyxUSuCL-grYd0T62S2xy73RyC8"; // token bot


            // cek sudah rekam kehadiran tanggal sekarang
            if ($record_today->num_rows() > 0) {
                // jika sudah ada rekaman data hari ini

                // cek user ingin absen pulang atau masuk
                if ($jam_record > $jadwal_pulang) {
                    // user mencoba untuk melakukan absensi pulang

                    // $hasil = ['pesan' => 'Mencoba Untuk melakukan absensi pulang'];

                    $result = $this->user_model->get();
                    $nis = $result->nis;
                    $nis = $aes->encrypt($nis);
                    // cek dulu user sudah melakukan absensi pulang pada hari ini atau belum

                    if ($record_pulang > 0) {
                        // jika ada jam pulang 
                        $hasil = ['info' => 'Anda sudah melakukan absensi pulang'];
                    } else {
                        // jika tidak ada jam pulang maka insert data jam pulang pada hari ini
                        // $hasil = ['pesan' => 'Tidak ada jam pulang masukan codingan insert jam pulang'];

                        // cek sudah ada jam masuk atau belum, jika sudah ada jam masuk berarti status hadir
                        if ($record_masuk > 0) {
                            // jika record masuk ada
                            $status = 'hadir';
                            $ket = '<b class="text-success">Tepat Waktu</b>';
                        } else {
                            // jika tidak ada jam masuk berarti statusnya terlambat atau tidak melakukan absensi masuk
                            $status = 'terlambat';
                            $ket = 'Anda Tidak Melakukan <b class="text-danger">ABSENSI MASUK</b>, Jadi status kehadiran anda <span class="text-warning"><b>Terlambat</b></span>';
                        }


                        // update data jam_pulang dan update status menjadi sesuai kondisi
                        $data = [
                            'jam_pulang' => $jam_record,
                            'status' => $status
                        ];

                        $this->db->where(['nis' => $nis, 'tanggal' => $tanggal]);
                        $this->db->update('record_kehadiran', $data);

                        // kirim notif ke orang tua
                        $object = [
                            'text' => 'Nama : ' . $result->nama . '.  Tanggal Kehadiran : ' . $tanggal . '.  Jam_melakukan Kehadrian : ' . $jam_record . '.   Keterangan : ' . $ket,
                            'chat_id' => $chatID
                        ];

                        // memberikan data untuk pesan alert
                        $hasil = ['warning' => 'Nama : <b>' . $result->nama . '</b><br> Tanggal Melakukan Kehadiran : <b>' . $tanggal . '</b><br> Jam Melakukan Kehadiran : <b>' . $jam_record . '</b><br><i class="fas text-danger">*</i>Keterangan : ' . $ket, 'icon' => 'success'];
                        file_get_contents("https://api.telegram.org/bot$token2/sendMessage?" . http_build_query($object));
                    }
                } else {
                    // user mencoba melakukan absensi masuk

                    // $hasil = ['pesan' => 'Mencoba Untuk Melakukan absensi masuk'];

                    // cek user sudah melakukan absensi masuk atau belum

                    if ($record_masuk > 0) {
                        // jika ada jam masuk
                        $hasil = ['info' => 'Anda sudah melakukan absensi masuk'];
                    } else {
                        // jika tidak ada jam masuk 

                        // cek tepat waktu atau terlambat
                        if ($jam_record > $jadwal_masuk) {
                            // insert data jam masuk status 
                            $status = 'terlambat';
                            $ket = 'Terlambat';
                            // $hasil = ['pesan' => 'insert data jam masuk status terlambat'];
                        } else {
                            // insert data jam masuk status hadir
                            $status = 'hadir';
                            $ket = 'Tepat waktu';
                            // $hasil = ['pesan' => 'insert data jam masuk status hadir'];
                        }

                        // update data jam_masuk dan status sesuai kondisi
                        $data = [
                            'jam_masuk' => $jam_record,
                            'status' => $status
                        ];

                        $this->db->where(['nis' => $nis, 'tanggal' => $tanggal]);
                        $this->db->update('record_kehadiran', $data);

                        // kirim notifikasi ke orang tua
                        $object = [
                            'text' => 'Nama : ' . $result->nama . '.  Tanggal Kehadiran : ' . $tanggal . '.  Jam_melakukan Kehadrian : ' . $jam_record . '.   Keterangan : ' . $ket,
                            'chat_id' => $chatID
                        ];

                        // kirim data untuk ditampilkan pada pesan alert
                        $hasil = [
                            'username'  => $result->username,
                            'nama'      => $result->nama,
                            'tanggal'   => date('d-m-Y'),
                            'jam'       => date('H:i:s'),
                            'status'    => $ket
                        ];
                        file_get_contents("https://api.telegram.org/bot$token2/sendMessage?" . http_build_query($object));
                    }
                }
            } else {
                // jika belum ada rekaman data kehadiran tanggal sekarang

                // input data ['nis', 'jam_masuk', 'status'] ke tabel record_kehadiran
                $result = $this->user_model->get();
                $nis = $result->nis;

                $nis = $aes->encrypt($nis);



                if ($jam_record > $jadwal_pulang) {
                    // jika record_today() belum ditemkan record dari pengekecak tanggal sekarang, tapi user melakukan scan pulang
                    // maka insert data jam_pulang status terlambat

                    $data = [
                        'nis' => $nis,
                        'tanggal' => $tanggal,
                        'jam_pulang' => $jam_record,
                        'status' => 'terlambat'
                    ];

                    $this->db->insert('record_kehadiran', $data);


                    $hasil = ['warning' => 'Nama : <b>' . $result->nama . '</b><br> Tanggal Melakukan Kehadiran : <b>' . $tanggal . '</b><br> Jam Melakukan Kehadiran : <b>' . $jam_record . '</b><br> <u><i class="fas fa-quote-left"></i>Keterangan<u> : Anda Tidak Melakukan <b class="text-danger">ABSENSI MASUK</b>, Jadi status kehadiran anda <span class="text-warning"><b>Terlambat</b></span>', 'icon' => 'warning'];

                    // kirim noifikasi ke orang tua
                    $object = [
                        'text' => 'Nama : ' . $result->nama . '.  Tanggal Kehadiran : ' . $tanggal . '.  Jam_melakukan Kehadrian : ' . $jam_record . '.   Keterangan : Terlambat',
                        'chat_id' => $chatID
                    ];

                    file_get_contents("https://api.telegram.org/bot$token2/sendMessage?" . http_build_query($object));
                } else {

                    if ($jam_record > $jadwal_masuk) {
                        $status = 'terlambat';
                        $ket = 'Terlambat';
                    } else {
                        $status = 'hadir';
                        $ket = 'Tepat Waktu';
                    }

                    $data = [
                        'nis' => $nis,
                        'tanggal' => $tanggal,
                        'jam_masuk' => $jam_record,
                        'status' => $status
                    ];

                    $this->db->insert('record_kehadiran', $data);

                    $hasil = [
                        'username'  => $result->username,
                        'nama'      => $result->nama,
                        'tanggal'   => date('d-m-Y'),
                        'jam'       => date('H:i:s'),
                        'status'    => $ket
                    ];

                    // kirim notifikasi telegram 
                    $object = [
                        'text' => 'Nama : ' . $result->nama . '.  Tanggal Kehadiran : ' . $tanggal . '.  Jam_melakukan Kehadrian : ' . $jam_record . '.   Keterangan : ' . $ket,
                        'chat_id' => $chatID
                    ];

                    file_get_contents("https://api.telegram.org/bot$token2/sendMessage?" . http_build_query($object));
                }
            }
        } else {
            // jika hasil scan tidak valid
            $hasil = ['pesan' => 'QR Tidak valid gagal merekan data absensi'];
        }

        // $hasil > 0 ? $hasil = 'valid' : $hasil = 'tidak valid Gagal Simpan Data Kehadiran';

        // $data['result'] = $hasil;

        echo json_encode($hasil);
    }
}
