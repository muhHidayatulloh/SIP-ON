<section class='content'>
    <div class='container-fluid'>
        <div class='row'>

            <div class='col-lg-12'>
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-table"></i> Data Kehadiran <b><?= $nama; ?></b>

                        <span class="float-right">
                            <label class="badge badge-primary">N</label><span> : Netral</span>
                            <label class="badge badge-success"><i class="fas fa-check-circle"></i></label><span> : Hadir</span>
                            <label class="badge badge-info ml-2">I</label><span> : Izin </span>
                            <label class="badge badge-secondary ml-2">S</label><span> : Sakit </span>
                            <label class="badge badge-warning ml-2">A</label><span> : Tidak Hadir</span>
                            <label class="badge badge-warning ml-2">T</label><span> : Terlambat </span>
                            <label class="badge badge-warning ml-2">B</label><span> : Bolos</span>
                            <label class="badge badge-danger ml-2">L</label><span> : Libur</span>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">Hari ini : <span class="badge badge-warning"><?php echo format_indo(date('Y-m-d')); ?></span></div>
                                <div class="col-lg-12 "></div>
                                <div class="col-md-12">Rekap Kehadiran <span class="badge badge-warning"><?= $tanggal; ?></span></div>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <th>Nama</th>
                                    <?php

                                    for ($k = 1; $k <= $end_date; $k++) {
                                        $thisDate = date('Y-m-');
                                        $thisDate .= $k;

                                        $datetime = strtotime($thisDate);
                                        $weekday = date('l', $datetime);

                                        if ($weekday == 'Sunday') {
                                            $weekday = 'Minggu';
                                        }


                                        if (($weekday != "Minggu")) {
                                            echo "<th>" . $k . "</th>";
                                        } else {
                                            echo "<th>" . $weekday . "</th>";
                                        }
                                    }

                                    ?>

                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        if (!empty($kehadiran)) {
                                            for ($i = 1; $i < count($kehadiran); $i++) {
                                                // var_dump($kehadiran);
                                                $hadir = 0;
                                                $alpa = 0;
                                                $terlambat = 0;
                                                $izin = 0;
                                                $sakit = 0;
                                                $bolos = 0;

                                                echo "<td><h6>" . $kehadiran[$i]['nama'] . "</h6></td>";
                                                $nis = $kehadiran[$i]['nis'];
                                                for ($j = 1; $j <= $end_date; $j++) {
                                                    $thisDate = date('Y-m-');
                                                    $thisDate .= $j;

                                                    $datetime = strtotime($thisDate);
                                                    $weekday = date('l', $datetime);

                                                    if ($weekday == 'Sunday') {
                                                        $weekday = 'Minggu';
                                                    }

                                                    if (($weekday != "Minggu")) {
                                                        $sql = "SELECT status FROM record_kehadiran WHERE nis='$nis' AND tanggal='$thisDate'";
                                                        $result = $this->db->query($sql)->result_array();
                                                        // var_dump($sql);

                                                        if (!empty($result)) {
                                                            // var_dump($result);

                                                            if ($result[0]['status'] == 'hadir') {
                                                                $hadir++;
                                                                echo "<td><span class='badge badge-success'><i class='fas fa-check-circle'></i></span></td>";
                                                            } else if ($result[0]['status'] == 'terlambat') {
                                                                $terlambat++;
                                                                echo "<td><span class='badge badge-warning'>T</span></td>";
                                                            } else if ($result[0]['status'] == 'alpa') {
                                                                $alpa++;
                                                                echo "<td><span class='badge badge-warning'>A</span></td>";
                                                            } else if ($result[0]['status'] == 'bolos') {
                                                                $bolos++;
                                                                echo "<td><span class='badge badge-warning'>B</span></td>";
                                                            } else if ($result[0]['status'] == 'sakit') {
                                                                $sakit++;
                                                                echo "<td><span class='badge badge-primary'>S</span></td>";
                                                            } else {
                                                                $izin++;
                                                                echo "<td><span class='badge badge-info'>I</span></td>";
                                                            }
                                                        } else {
                                                            echo "<td><span class='badge badge-primary'>N</span></td>";
                                                        }
                                                    } else {
                                                        echo "<td><span class='badge badge-danger'>L</span></td>";
                                                    }
                                                }
                                            }
                                        } else {
                                            echo '<div class="alert alert-info">Tidak ada rekaman data kehadiran pada siswa ini</div>';
                                        }
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</section>