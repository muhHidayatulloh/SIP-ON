<?php

class WaliKelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('user_model');
        $this->load->model('walikelas_model');
        $this->load->model('kelas_model');
        $this->load->model('guru_model');
        $this->load->model('siswa_model');
        $this->load->model('izin_model');
        $this->load->helper('date');
        $this->load->helper('download');
    }

    public function index()
    {
        $walikelas = $this->walikelas_model->get()->result();
        $id_level_user = $this->db->get_where('tbl_level_user', ['nama_level' => 'wali kelas'])->row_object()->id_level_user;

        $guru = $this->guru_model->get();

        $data = [
            'walikelas' => $walikelas,
            'user' => $this->user_model->get(),
            'kelas' => $this->kelas_model->get(),
            'guru' => $guru
        ];

        if (isset($_POST['save_walikelas'])) {
            $id_kelas = $this->input->post('id_kelas', TRUE);
            $id_guru = $this->input->post('id_guru', TRUE);
            $id_tahun_akademik = get_tahun_akademik('id_tahun_akademik');

            $insert = [
                'id_guru' => $id_guru,
                'id_kelas' => $id_kelas,
                'id_tahun_akademik' => $id_tahun_akademik
            ];

            $this->db->insert('tbl_walikelas', $insert);
            $this->db->update('tbl_guru', ['id_level_user' => $id_level_user], ['id' => $id_guru]);

            $this->session->set_flashdata('pesan', msgSuccess('Data Wali Kelas berhasil ditambahkan'));
            redirect('walikelas');
        } else if (isset($_POST['update'])) {
            $id_guru = $this->input->post('id_guru', TRUE);
            $id_kelas = $this->input->post('id_kelas', TRUE);
            $id_wali_kelas = $this->input->post('id_wali_kelas', TRUE);

            // cek apakah kelas dan guru sudah ada
            $res = $this->db->get_where('tbl_walikelas', ['id_guru' => $id_guru, 'id_kelas' => $id_kelas])->num_rows();

            if ($res > 0) {
                $this->session->set_flashdata('pesan', msgError('Data Wali kelas dengan kelas dan guru tersebut sudah ada'));
                redirect('walikelas');
            }

            $this->db->where('id_wali_kelas', $id_wali_kelas);
            $this->db->update('tbl_walikelas', ['id_kelas' => $id_kelas, 'id_guru' => $id_guru]);
            $this->session->set_flashdata('pesan', msgSuccess("Berhasil merubah data walikelas"));
            redirect('walikelas');
        } else {
            $this->template->load('template', 'walikelas/view', $data);
        }
    }

    function delete($id)
    {
        $res = $this->walikelas_model->delete($id);

        if (!$res) {
            $this->session->set_flashdata('pesan', msgError('Gagal menghapus data Walikelas'));
            redirect('walikelas');
        }

        $this->session->set_flashdata('pesan', msgSuccess('Berhasil menghapus data walikelas'));
        redirect('walikelas');
    }

    public function profile()
    {
        $data['user'] = $this->user_model->get();
        if (isset($_POST['profile_edit'])) {

            $nama = $this->input->post('nama', TRUE);
            $id = $this->input->post('id', TRUE);
            $username = $this->input->post('username', TRUE);
            $tempat_lahir = $this->input->post('tempat_lahir', TRUE);
            $tgl_lahir = $this->input->post('tgl_lahir', TRUE);
            $data['user'] = $this->user_model->get();
            //cek jika ada gambar yang diuload
            $uploadImage = $_FILES['image']['name'];

            if ($uploadImage) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/dist/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $oldImage = $data['user']->pas_foto;

                    if ($oldImage != 'default.png') {
                        unlink(FCPATH . 'assets/dist/img/profile/' . $oldImage);
                    }
                    $newImage = $this->upload->data('file_name');
                    $this->db->set('pas_foto', $newImage);
                } else {
                    $error =  $this->upload->display_errors();
                    $this->session->set_flashdata('pesan', msgError($error));
                    redirect('walikelas/profile');
                }
            }

            $this->session->set_userdata(['username' => $username, 'foto' => $newImage]);

            $this->db->set('nama', $nama);
            $this->db->set('username', $username);
            $this->db->set('tempat_lahir', $tempat_lahir);
            $this->db->set('tgl_lahir', $tgl_lahir);
            $this->db->where('id', $id);
            $this->db->update('tbl_guru');
            $this->session->set_flashdata('pesan', msgSuccess('Profile berhasil diubah'));

            redirect('walikelas/profile');
        } else if (isset($_POST['password_edit'])) {
            $id = $this->input->post('id', TRUE);

            $passwordLama = $this->input->post('password', TRUE);
            $passwordInput = $this->input->post('password2', TRUE);
            $passwordBaru = password_hash($passwordInput, PASSWORD_DEFAULT);

            $userPassword = $this->user_model->get()->password;


            if (password_verify($passwordLama, $userPassword)) {
                $this->db->set('password', $passwordBaru);
                $this->db->where('id', $id);
                $this->db->update('tbl_guru');
                $this->session->set_flashdata('pesan', msgSuccess('Berhasil Merubah Password'));
                redirect('auth/logout');
            } else {
                $this->session->set_flashdata('pesan', msgError('Password lama salah, Silahkan coba lagi!!'));
                redirect('walikelas/profile');
            }
        } else {
            $this->template->load('template', 'walikelas/profile', $data);
        }
    }

    public function rekap()
    {

        // enkripsi aes
        $this->load->library('EasyAESCrypt');

        $z = 'abcdefghijuklmno0123456789012345';
        $encrypt = '';
        $aes = new EasyAESCrypt($z);

        $datestring = '%m / %Y';
        $user = $this->user_model->get();
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
            'user' => $user

        ];

        $id_guru = $user->id;

        $bulan = date('m');
        $tahun = date('Y');

        $id_kelas = $this->walikelas_model->get_where(['id_guru' => $id_guru])->row_object()->id_kelas;

        // var_dump($id_kelas);die;

        if (isset($_POST['filter'])) {
            // var_dump($_POST);

            // mengambil data bulan dan tahun dari form filter
            $bulan = $this->input->post('bulan', TRUE);
            $tahun = $this->input->post('tahun', TRUE);

            // menambahkan 0 pada bulan dibawah angka 10
            if ($bulan < '10') {
                $bulan = '0' . $bulan;
            }

            // mengirim data filter bulan dan tahun untuk ditampilkan di view pada keterangan rekap 
            $data['filter'] = $bulan . ' / ' . $tahun;
        }

        // mengambil tanggal terakhir pada bulan sesuai dengan yang di filter
        $date = strtotime(date("1-" . $bulan . "-" . $tahun));
        $end_date = date('t', $date);

        $siswa = $this->siswa_model->get_siswa_select_where('tbl_siswa.nama, tbl_siswa.nis, tbl_siswa.id_kelas', ['id_kelas' => $id_kelas])->result_array();


        $return = '';
        // var_dump($end_date);

        // merangakt view table

        // tag table
        $return .= '<table class="table table-bordered text-sm table-sm table-hover">';
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

                $nis = $aes->encrypt($nis);
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
        $this->template->load('template', 'walikelas/rekap', $data);
    }

    public function approval()
    {
        $this->load->library('EasyAESCrypt');
        $z = 'abcdefghijuklmno0123456789012345';
        $aes = new EasyAESCrypt($z);

        if (isset($_POST['approval'])) {
            $id_izin = $this->input->post('id_izin', TRUE);

            $this->db->select('tbl_izin.*, tbl_siswa.nis');
            $this->db->join('tbl_siswa', 'tbl_izin.id_siswa = tbl_siswa.id_siswa');
            $res = $this->db->get_where('tbl_izin', ['id_izin' => $id_izin])->row();

            $message = 'Sudah di approve';

            if ($res->is_approve != 1) {
                $status = $res->subject;
                $tanggal_izin = $res->to_date;
                // $nis = $res->nis;

                $nis = $aes->encrypt($res->nis);

                // cek kehadiran sudah ada atau belum
                $cek = $this->db->get_where('record_kehadiran', ['nis' => $nis, 'tanggal' => $tanggal_izin]);

                if ($cek->num_rows() < 1) {

                    $data = [
                        'nis' => $nis,
                        'tanggal' => $tanggal_izin,
                        'status' => $status
                    ];

                    // record ke tabel record absensi
                    $this->db->insert('record_kehadiran', $data);

                    // update is_approve pada tbl_izin
                    $this->db->where('id_izin', $id_izin);
                    $this->db->update('tbl_izin', ['is_approve' => 1]);
                    $message = 'berhasil di approve, record kehadiran berhasil ditambahkan';
                } else {
                    $this->db->where('id_izin', $id_izin);
                    $this->db->update('tbl_izin', ['is_approve' => 1]);
                    $message = 'Approve tidak valid, siswa sudah melakukan kehadiran';
                }
            }

            echo json_encode($message);
            die;
        }

        $data = [
            'izin' => $this->izin_model->get()->result()
        ];

        if (isset($_GET['file_name'])) {
            $file_name = $_GET['file_name'];

            force_download('assets/bukti/' . $file_name, NULL);
        }

        $this->template->load('template', 'walikelas/approval', $data);
    }
}
