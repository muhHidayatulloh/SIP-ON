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
            'kelas' => $this->kelas_model->get()
        ];

        $bulan = date('m');
        $tahun = date('Y');


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

            // $kehadiran = $this->kehadiran_model->get_where(null, $id_kelas)->result_array();
            // var_dump($kehadiran->result_array());

            // $kehadiran = [];

            // foreach ($query->result_array() as $row) {
            //     $kehadiran['id_record'] = $row['id_record'];
            //     $kehadiran['nama'] = $row['nama'];
            // }

            $siswa = $this->siswa_model->get_siswa_select_where('tbl_siswa.nama, tbl_siswa.nis, tbl_siswa.id_kelas', ['id_kelas' => $id_kelas])->result_array();

            // var_dump($siswa);
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
                $weekday = 'Minggu';
            }

            // var_dump($weekday);
            if (($weekday != "Minggu")) {
                $return .= "<th>" . $k . "</th>";
            } else {
                $return .= "<th>" . $weekday . "</th>";
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
                for ($j = 1; $j <= $end_date; $j++) {
                    
                    $thisDate = $tahun . '-' . $bulan . '-' . $j;

                    $datetime = strtotime($thisDate);
                    $weekday = date('l', $datetime);

                    if ($weekday == 'Sunday') {
                        $weekday = 'Minggu';
                    }

                    if (($weekday != "Minggu")) {
                        $total++;
                        $sql = "SELECT status, jam_masuk, jam_pulang FROM record_kehadiran WHERE nis='$nis' AND tanggal='$thisDate'";
                        $result = $this->db->query($sql)->result_array();
                        // var_dump($sql);

                        if (!empty($result)) {
                            // var_dump($result);
                            
                            if ($result[0]['status'] == 'hadir') {
                                $hadir++;
                                $return .= "<td><span class='badge badge-success'><i class='fas fa-check-circle'></i></span></td>";
                            } else if ($result[0]['status'] == 'terlambat') {
                                $hadir++;
                                $terlambat++;
                                $return .= "<td><span class='badge badge-warning'><span title='".$result[0]['jam_masuk']."'>T</span></span></td>";
                            } else if ($result[0]['status'] == 'alpa') {
                                $alpa++;
                                $return .= "<td><span class='badge badge-warning'>A</span></td>";
                            } else if ($result[0]['status'] == 'bolos') {
                                $bolos++;
                                $return .= "<td><span class='badge badge-warning'><span title='".$result[0]['jam_pulang']."'>B</span></span></td>";
                            } else if ($result[0]['status'] == 'sakit') {
                                $sakit++;
                                $return .= "<td><span class='badge badge-primary'>S</span></td>";
                            } else {
                                $izin++;
                                $return .= "<td><span class='badge badge-info'>I</span></td>";
                            }
                        } else {
                            $return .= "<td><span class='badge badge-primary'>N</span></td>";
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
                $return .= "<td>".$alpa."</td>";
                $return .= "<td>".$izin."</td>";
                $return .= "<td>".$sakit."</td>";
                $return .= "<td>".$terlambat."</td>";
                $return .= "<td>".$bolos."</td>";
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

        $this->template->load('template', 'rekap/view', $data);
    }
}
