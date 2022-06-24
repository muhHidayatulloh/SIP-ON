<!-- <script>
    $(document).ready(function() {
        var dataTable = $('#table_attendance').dataTable({
            'processing': true,
            'serverSide': true,
            "order": [],
            "ajax": {
                url: "<?= base_url('siswa/kehadiran_action') ?>",
                method: "POST",
                data: {
                    action: "fetch"
                }
            }
        });    
    })
</script> -->


<!-- public function kehadiran_action()
    {
        $id = $this->uri->segment(3);
        $nis = $this->Siswa_model->get('id_siswa', $id)[0]->nis;
        if (isset($_POST['action'])) {
            if ($_POST['action'] == "fetch") {
                $statement = $this->Kehadiran_model->get_where($nis);
                $result = $statement->result_array();
                $data = array();
                $filtered_rows = $statement->num_rows();

                foreach ($result as $row) {
                    $sub_array = array();
                    $status = '';
                    if ($row['status'] == "hadir") {
                        $status = '<label class="badge badge-success"><i class="fas fa-check-circle></i></label>';
                    }
                    if ($row['status'] == "alpa") {
                        $status = '<label class="badge badge-danger">A</label>';
                    }
                    if ($row['status'] == "izin") {
                        $status = '<label class="badge badge-info">I</label>';
                    }
                    if ($row['status'] == "sakit") {
                        $status = '<label class="badge badge-secondary">S</label>';
                    }
                    if ($row['status'] == "bolos") {
                        $status = '<label class="badge badge-warning">B</label>';
                    }
                    if ($row['status'] == "terlambat") {
                        $status = '<label class="badge badge-warning">T</label>';
                    }

                    $sub_array[] = $row['student_name'];
                    $sub_array[] = $row['nis'];
                    $sub_array[] = $status;
                    $sub_array[] = $row['tanggal'];

                    $data[] = $sub_array;
                }

                $output = array(
                    'draw'              => intval($_POST['draw']),
                    'recordsTotal'      => $filtered_rows,
                    'recordFiltered'    => $this->kehadiran_model->get()->num_rows(),
                    'data'              => $data
                );

                echo json_encode($output);
            }
        }
    } -->


<?php 



     // public function backupd()
    // {
    //     $nis = $this->Siswa_model->get('id_siswa', $id)[0]->nis;
    //     $nama = $this->Siswa_model->get('id_siswa', $id)[0]->nama;
    //     $datestring = 'Bulan : %m, Tahun: %Y';

    //     $hari_ini = date("Y-m-d");
    //     $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));;
    //     $end_date = explode('-', $tgl_terakhir)[2];
    //     $y = date('Y');
    //     $s = date('m');
    //     $ret = "";
    //     $kehadiran = $this->kehadiran_model->get_where($nis);
    //     // print_r($kehadiran);

    //     $nis = array_column($kehadiran, 'nis');
    //     $name = array_column($kehadiran, 'nama');

    //     $nis = array_unique($nis);
    //     $name = array_unique($name);



    //     for ($i = 0; $i < sizeof($nis); $i++) {
    //         $ret .= '<tr>
    //                 <td>' . $name[$i] . '</td>';

    //         for ($j = 0; $j <= $end_date; $j++) {
    //             $cd = date('Y-m-d', strtotime($y . '-' . $s . '-' . ($j + 1)));
    //             // var_dump($cd);
    //             $d = date('l', strtotime($y . '-' . $s . '-' . ($j + 1)));
    //             // var_dump($d);
    //             // $ret .= "<td>$j</td>";
    //             if ($d != 'Sunday' && $d != 'Saturday') {

    //                 for ($k = 0; $k < sizeof($kehadiran); $k++) {

    //                     if ($nis[$i] == $kehadiran[$k]['nis']) {

    //                         if ($cd == $kehadiran[$k]['tanggal']) {
    //                             $ret .= '<td><span class="badge badge-info">' . ($kehadiran[$k]['status']) . ' ' . $kehadiran[$k]['tanggal'] .  '</span></td>';
    //                         } else {
    //                             $ret .= '<td><i class="fas fa-times-circle text-danger"></i></td>';
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //         $ret .= '</tr>';
    //     }

    //     // var_dump($ret);

    //     // var_dump($nis);


    //     $data = [
    //         'title'     => 'Kehadiran Siswa',
    //         'kehadiran' => $ret,
    //         'nama'      => $nama,
    //         'tanggal'   => mdate($datestring),
    //         'end_date' => $end_date
    //     ];




    //     $this->template->load('template', 'siswa/kehadiran/view', $data);
    // }