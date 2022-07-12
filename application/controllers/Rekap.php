<?php


class Rekap extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->model('kelas_model');
        $this->load->model('kehadiran_model');
        $this->load->model('siswa_model');
        $this->load->model('tingkatan_model');
        $this->load->model('user_model');
        $this->load->library('Pdf');
    }

    public function index()
    {

        $datestring = '%m / %Y';
        if (isset($_GET['bulan'])) {
            $bulan = $this->input->get('bulan');
        } else {
            $bulan = date('m');
        }

        $start_date = date("1-" . $bulan . "-Y");
        $end_date = date('t', strtotime($start_date));
        $data = [
            'tanggal' => mdate($datestring),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'kelas' => $this->kelas_model->get(),
            'tingkatan' => $this->tingkatan_model->get(),
            'user' => $this->user_model->get()
        ];

        $bulan = date('m');
        $tahun = date('Y');

        // enkripsi aes
        $this->load->library('EasyAESCrypt');

        $z = 'abcdefghijuklmno0123456789012345';
        $encrypt = '';
        $aes = new EasyAESCrypt($z);


        if (isset($_POST['filter'])) {
            // var_dump($_POST);

            // mengambil data dari form filter
            $id_kelas = $this->input->post('id_kelas', TRUE);
            $bulan = $this->input->post('bulan', TRUE);
            $tahun = $this->input->post('tahun', TRUE);

            // menambahkan 0 pada bulan dibawah angka 10
            if ($bulan < '10') {
                $bulan = '0' . $bulan;
            }

            // mengirim data filter bulan dan tahun untuk ditampilkan di view pada keterangan rekap 
            $data['filter'] = $bulan . ' / ' . $tahun;
            // var_dump($data['filter']);

            $date = strtotime(date("1-" . $bulan . "-Y"));
            $end_date = date('t', $date);


            $siswa = $this->siswa_model->get_siswa_select_where('tbl_siswa.nama, tbl_siswa.nis, tbl_siswa.id_kelas', ['id_kelas' => $id_kelas])->result_array();

            // var_dump($siswa); die;
        }




        $return = '';
        // var_dump($end_date);

        // merangakt view table

        // tag table
        $return .= '<table class="table table-bordered text-sm table-sm">';
        $return .= '<thead class="thead-light">';
        $return .= '<tr>';
        $return .= '<th>Nama</th>';

        // untuk memunculkan urutan tanggal di tabel head sesuai bulan yang sudah dipilih saat filter data
        for ($k = 1; $k <= $end_date; $k++) {

            $thisDate = $tahun . '-' . $bulan . '-' . $k;

            $datetime = strtotime($thisDate);
            $weekday = date('l', $datetime);

            if ($weekday == 'Sunday') {
                $weekday = 'M';
            } else if ($weekday == 'Saturday') {
                $weekday = 'S';
            }

            // var_dump($weekday);
            if (($weekday != "M" && $weekday != "S")) {
                $return .= "<th>" . $k . "</th>";
            } else {
                $return .= "<th class='bg-danger'>" . $weekday . "</th>";
            }
        }
        // akhir tabel head
        $return .= '<th>Hadir/total</th>';
        $return .= '<th>A</th>';
        $return .= '<th>I</th>';
        $return .= '<th>S</th>';
        $return .= '<th>T</th>';
        $return .= '<th>B</th>';
        $return .= '<th>Persentase</th>';
        $return .= '</tr>';
        $return .= '</thead>';

        $return .= '<tbody>';


        if (!empty($siswa)) {
            for ($i = 0; $i < count($siswa); $i++) {
                // var_dump($kehadiran);
                $hadir = 0;
                $alpa = 0;
                $terlambat = 0;
                $izin = 0;
                $sakit = 0;
                $bolos = 0;
                $total = 0;
                $return .= '<tr>';
                $return .= "<td>" . $siswa[$i]['nama'] . "</td>";
                // var_dump($kehadiran[$i]['nama']);
                $nis = $siswa[$i]['nis'];

                $nis = $aes->encrypt($nis);
                // var_dump($nis);
                for ($j = 1; $j <= $end_date; $j++) {

                    $thisDate = $tahun . '-' . $bulan . '-' . $j;

                    $datetime = strtotime($thisDate);
                    $weekday = date('l', $datetime);

                    if ($weekday == 'Sunday') {
                        $weekday = 'Minggu';
                    } else if ($weekday == 'Saturday') {
                        $weekday = 'Sabtu';
                    }

                    if (($weekday != "Minggu" && $weekday != "Sabtu")) {
                        $total++;
                        $sql = "SELECT status, jam_masuk, jam_pulang FROM record_kehadiran WHERE nis='$nis' AND tanggal='$thisDate'";
                        $result = $this->db->query($sql)->result_array();
                        // var_dump($sql);

                        if (!empty($result)) {
                            // var_dump($result);

                            if ($result[0]['status'] == 'hadir') {
                                $hadir++;
                                $return .= "<td><span class='text-success'><i class='fas fa-check'></i></span></td>";
                            } else if ($result[0]['status'] == 'terlambat') {
                                $hadir++;
                                $terlambat++;
                                $return .= "<td><span class='badge bg-teal'><span title='" . $result[0]['jam_masuk'] . "'>T</span></span></td>";
                            } else if ($result[0]['status'] == 'alpa') {
                                $alpa++;
                                $return .= "<td><span class='badge badge-warning'>A</span></td>";
                            } else if ($result[0]['status'] == 'bolos') {
                                $bolos++;
                                $alpa++;
                                $return .= "<td><span class='badge bg-fuchsia'><span title='" . $result[0]['jam_pulang'] . "'>B</span></span></td>";
                            } else if ($result[0]['status'] == 'sakit') {
                                $sakit++;
                                $return .= "<td><span class='badge badge-secondary'>S</span></td>";
                            } else {
                                $izin++;
                                $return .= "<td><span class='badge badge-info'>I</span></td>";
                            }
                        } else {
                            $today = date('d');
                            $thisMonth = date('m');
                            $thisYear = date('Y');

                            // cek filter ada dibulan sekarang atau kurang dari bulan sekarang
                            if ($bulan . $tahun < $thisMonth . $thisYear) {
                                $alpa++;
                                $return .= "<td><span class='badge badge-warning'>A</span></td>";
                            } else if ($bulan . $tahun > $thisMonth . $thisYear) {
                                // jika lebih dari bulan sekarang
                                $return .= "<td><span class='badge badge-primary'>N</span></td>";
                            } else {
                                // jika bulan sesuai dengan bulan sekarang
                                if ($j < $today) {
                                    $alpa++;
                                    $return .= "<td><span class='badge badge-warning'>A</span></td>";
                                } else {
                                    $return .= "<td><span class='badge badge-primary'>N</span></td>";
                                }
                            }
                        }
                    } else {
                        $return .= "<td><span class='badge badge-danger'>L</span></td>";
                    }
                }

                if ($total != 0)
                    $perc = round((($hadir * 100) / $total), 2);
                else
                    $perc = 0;
                $return .= "<td><strong>" . $hadir . "</strong>/" . $total . "</td>";
                $return .= "<td>" . $alpa . "</td>";
                $return .= "<td>" . $izin . "</td>";
                $return .= "<td>" . $sakit . "</td>";
                $return .= "<td>" . $terlambat . "</td>";
                $return .= "<td>" . $bolos . "</td>";
                $return .= "<td>" . $perc . "&nbsp;%</td>";
                $return .=  "</tr>";
            }

            // tutup table row body dan tag body

            $return .= '</tbody>';
            $return .= '</table>';
            $data['table'] = $return;
        } else {
            $data['table'] = null;
        }

        $data['tingkatan'] = $this->tingkatan_model->get();

        $this->template->load('template', 'rekap/view', $data);
    }

    public function export_rakap()
    {
        // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        error_reporting(0);
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetTitle('Data Siswa SMKN 1 Cibatu');

        $GetX = $pdf->GetX();
        $x = $GetX;
        $width = $pdf->GetPageWidth();

        $file = base_url('assets/logo/logo.png');
        $pdf->Image($file, $GetX, 10, 25, 25);
        $ml = 22;
        $pdf->Cell($ml);
        $pdf->SetFont('Times', "B", 12);
        $pdf->Cell(0, 5, "PEMERINTAH DAERAH PROVINSI JAWA BARAT", 0, 1, 'C');
        $pdf->Cell($ml);
        $pdf->Cell(0, 5, "DINAS PENDIDIKAN", 0, 1, 'C');
        $pdf->Cell($ml);
        $pdf->SetFont('Times', "B", 15);
        $pdf->Cell(0, 5, "SEKOLAH MENENGAH KEJURUAN NEGERI 1 CIBATU", 0, 1, 'C');
        $pdf->Cell($ml);
        $pdf->SetFont('Times', 'I', 8);
        $pdf->Cell(0, 5, 'Jl. Raya Sadang-Subang Desa Cipinang Kecamatan Cibatu Purwakarta Jawa Barat 41182', 0, 1, 'C');
        $pdf->Cell($ml);
        $pdf->Cell(0, 3, 'Telp (0264) 8396042 Website: smkn1cibatu.sch.id Email: smkn1cibatu@yahoo.co.id', 0, 1, 'C');
        $pdf->Cell($ml);
        $pdf->SetFont('Times', 'B', 8);
        $pdf->Cell(0, 3.1, 'Teknik Permesinan - Teknik Kendaraan Ringan Otomotif - Teknik Komputer dan Jaringan', 0, 1, 'C');
        $pdf->Cell($ml);
        $pdf->Cell(0, 3, 'Otomatisasi dan Tata Kelola Perkantoran - Akutansi dan Keuangan Lembaga', 0, 1, 'C');
        $xline = 43;
        $pdf->SetLineWidth(1);
        $pdf->Line(10, $xline, $width - 10, $xline);
        $pdf->SetLineWidth(0);
        $pdf->Line(10, $xline + 1, $width - 10, $xline + 1);
    }

    public function bulanan()
    {

        $datestring = '%m / %Y';
        if (isset($_GET['bulan'])) {
            $bulan = $this->input->get('bulan');
        } else {
            $bulan = date('m');
        }

        $start_date = date("1-" . $bulan . "-Y");
        $end_date = date('t', strtotime($start_date));
        $data = [
            'tanggal' => mdate($datestring),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'kelas' => $this->kelas_model->get(),
            'tingkatan' => $this->tingkatan_model->get()
        ];

        $bulan = date('m');
        $tahun = date('Y');

        // enkripsi aes
        $this->load->library('EasyAESCrypt');

        $z = 'abcdefghijuklmno0123456789012345';
        $encrypt = '';
        $aes = new EasyAESCrypt($z);


        if (isset($_POST['print'])) {
            // var_dump($_POST);

            // mengambil data dari form filter
            $id_kelas = $this->input->post('id_kelas', TRUE);
            $bulan = $this->input->post('bulan', TRUE);
            $tahun = $this->input->post('tahun', TRUE);

            // menambahkan 0 pada bulan dibawah angka 10
            if ($bulan < '10') {
                $bulan = '0' . $bulan;
            }
            $kelas_where = $this->kelas_model->get('id', $id_kelas)[0];
            $data['kelas_where'] = $kelas_where->nama_tingkatan . ' ' . $kelas_where->nama_jurusan . ' ' . $kelas_where->nomor_kelas;
            $data['jurusan'] = $kelas_where->deskripsi;
            // mengirim data filter bulan dan tahun untuk ditampilkan di view pada keterangan rekap 
            $data['filter'] = $bulan . ' / ' . $tahun;
            // var_dump($data['filter']);

            $date = strtotime(date("1-" . $bulan . "-Y"));
            $end_date = date('t', $date);


            $siswa = $this->siswa_model->get_siswa_select_where('tbl_siswa.nama, tbl_siswa.nis, tbl_siswa.id_kelas', ['id_kelas' => $id_kelas])->result_array();

            // var_dump($siswa); die;
        }




        $return = '';
        // var_dump($end_date);

        // merangakt view table

        // tag table
        $return .= '<table class="table table-bordered text-sm table-sm">';
        $return .= '<thead class="thead-light">';
        $return .= '<tr>';
        $return .= '<th>Nama</th>';

        // untuk memunculkan urutan tanggal di tabel head sesuai bulan yang sudah dipilih saat filter data
        for ($k = 1; $k <= $end_date; $k++) {

            $thisDate = $tahun . '-' . $bulan . '-' . $k;

            $datetime = strtotime($thisDate);
            $weekday = date('l', $datetime);

            if ($weekday == 'Sunday') {
                $weekday = 'M';
            } else if ($weekday == 'Saturday') {
                $weekday = 'S';
            }

            // var_dump($weekday);
            if (($weekday != "M" && $weekday != "S")) {
                $return .= "<th>" . $k . "</th>";
            } else {
                $return .= "<th style='background-color:red;'>" . $weekday . "</th>";
            }
        }
        // akhir tabel head
        $return .= '<th>Hadir/total</th>';
        $return .= '<th>A</th>';
        $return .= '<th>I</th>';
        $return .= '<th>S</th>';
        $return .= '<th>T</th>';
        $return .= '<th>B</th>';
        $return .= '<th>Persentase</th>';
        $return .= '</tr>';
        $return .= '</thead>';

        $return .= '<tbody>';


        if (!empty($siswa)) {
            for ($i = 0; $i < count($siswa); $i++) {
                // var_dump($kehadiran);
                $hadir = 0;
                $alpa = 0;
                $terlambat = 0;
                $izin = 0;
                $sakit = 0;
                $bolos = 0;
                $total = 0;
                $return .= '<tr>';
                $return .= "<td>" . $siswa[$i]['nama'] . "</td>";
                // var_dump($kehadiran[$i]['nama']);
                $nis = $siswa[$i]['nis'];

                $nis = $aes->encrypt($nis);
                // var_dump($nis);
                for ($j = 1; $j <= $end_date; $j++) {

                    $thisDate = $tahun . '-' . $bulan . '-' . $j;

                    $datetime = strtotime($thisDate);
                    $weekday = date('l', $datetime);

                    if ($weekday == 'Sunday') {
                        $weekday = 'M';
                    } else if ($weekday == 'Saturday') {
                        $weekday = 'S';
                    }

                    if (($weekday != "M" && $weekday != "S")) {
                        $total++;
                        $sql = "SELECT status, jam_masuk, jam_pulang FROM record_kehadiran WHERE nis='$nis' AND tanggal='$thisDate'";
                        $result = $this->db->query($sql)->result_array();
                        // var_dump($sql);

                        if (!empty($result)) {
                            // var_dump($result);

                            if ($result[0]['status'] == 'hadir') {
                                $hadir++;
                                $return .= "<td style='backgrounf-color:green'><span class='text-success'><i class='fas fa-check'></i>H</span></td>";
                            } else if ($result[0]['status'] == 'terlambat') {
                                $hadir++;
                                $terlambat++;
                                $return .= "<td><span class='badge bg-teal'><span title='" . $result[0]['jam_masuk'] . "'>T</span></span></td>";
                            } else if ($result[0]['status'] == 'alpa') {
                                $alpa++;
                                $return .= "<td><span class='badge badge-warning'>A</span></td>";
                            } else if ($result[0]['status'] == 'bolos') {
                                $bolos++;
                                $alpa++;
                                $return .= "<td><span class='badge bg-fuchsia'><span title='" . $result[0]['jam_pulang'] . "'>B</span></span></td>";
                            } else if ($result[0]['status'] == 'sakit') {
                                $sakit++;
                                $return .= "<td><span class='badge badge-primary'>S</span></td>";
                            } else {
                                $izin++;
                                $return .= "<td><span class='badge badge-info'>I</span></td>";
                            }
                        } else {
                            $today = date('d');
                            $thisMonth = date('m');
                            $thisYear = date('Y');

                            // cek filter ada dibulan sekarang atau kurang dari bulan sekarang
                            if ($bulan . $tahun < $thisMonth . $thisYear) {
                                $alpa++;
                                $return .= "<td><span class='badge badge-warning'>A</span></td>";
                            } else if ($bulan . $tahun > $thisMonth . $thisYear) {
                                // jika lebih dari bulan sekarang
                                $return .= "<td><span class='badge badge-primary'>N</span></td>";
                            } else {
                                // jika bulan sesuai dengan bulan sekarang
                                if ($j < $today) {
                                    $alpa++;
                                    $return .= "<td><span class='badge badge-warning'>A</span></td>";
                                } else {
                                    $return .= "<td><span class='badge badge-primary'>N</span></td>";
                                }
                            }
                        }
                    } else {
                        $return .= "<td><span class='badge badge-danger'></span></td>";
                    }
                }

                if ($total != 0)
                    $perc = round((($hadir * 100) / $total), 2);
                else
                    $perc = 0;
                $return .= "<td><strong>" . $hadir . "</strong>/" . $total . "</td>";
                $return .= "<td>" . $alpa . "</td>";
                $return .= "<td>" . $izin . "</td>";
                $return .= "<td>" . $sakit . "</td>";
                $return .= "<td>" . $terlambat . "</td>";
                $return .= "<td>" . $bolos . "</td>";
                $return .= "<td>" . $perc . "&nbsp;%</td>";
                $return .=  "</tr>";
            }

            // tutup table row body dan tag body

            $return .= '</tbody>';
            $return .= '</table>';
            $data['table'] = $return;
        } else {
            $data['table'] = null;
        }


        $this->load->library('dompdf');
        $html = $this->load->view('rekap/bulanan', $data, true);
        $this->dompdf->createPDF($html, 'Laporan', true, 'B4', 'potrait');
    }

    public function generate_pdf_range()
    {
        if (isset($_POST['generate'])) {
            $kd_tingkatan = $this->input->post('tingkatan_kelas', TRUE);
            $date_periode = $this->input->post('date', TRUE);

            // pecah date range
            $explode = explode(' - ', $date_periode);

            // var_dump($explode);
            // mengambil tanggal awal dan akhir yang ditentukan
            $start_date = $explode[0];
            $end_date = $explode[1];

            $tglmulai = date_create($start_date);
            $tglselesai = date_create($end_date);
            $interval = date_diff($tglmulai, $tglselesai)->format('%a') + 1;
            $add = date_interval_create_from_date_string('1 day');
            date_sub($tglmulai, $add);

            // for ($i = 0; $i < $interval; $i++) {
            //     date_add($tglmulai, $add);
            //     echo date_format($tglmulai, 'j');
            // }

            // mengambil semua kelas berdasarkan tingkatan
            $kelas = $this->kelas_model->get('tbl_kelas.kd_tingkatan', $kd_tingkatan);

            $nama_tingkatan = $kelas[0]->nama_tingkatan;

            // var_dump($kelas);
            // die;

            $data = [
                'kd_tingkatan'      => $kd_tingkatan,
                'date_periode'      => $date_periode,
                'kelas'             => $kelas,
                'tglmulai'          => $tglmulai,
                'start_date'        => $start_date,
                'end_date'          => $end_date,
                'nama_tingkatan'    => $nama_tingkatan,
                'interval'          => $interval,
                'add'               => $add
            ];

            // var_dump($data);
            $this->load->view('rekap/rekapitulasi', $data);
        }
    }

    public function rekap_view()
    {

        // $this->load->view('rekap/rekapitulasi', []);
        $this->load->library('dompdf');
        $html = $this->load->view('rekap/rekapitulasi', [], true);
        $this->dompdf->createPDF($html, 'Laporan', false, 'B4', 'landscape');
    }
}
