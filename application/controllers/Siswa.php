<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Siswa extends  CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Siswa_model');
        $this->load->model('Kelas_model');
        $this->load->model('OrangTua_model');
        $this->load->library('Pdf');
        $this->load->model('kehadiran_model');
        $this->load->model('user_model');
        $this->load->helper('date');
    }

    // menampilkan tabel data siswa
    public function index()
    {
        $data['user'] = $this->user_model->get();
        $data['siswa'] = $this->Siswa_model->get();
        $data['title'] = "Data Siswa";

        $this->template->load('template', 'siswa/view', $data);
    }


    public function dashboard()
    {
        $nis = $this->user_model->get()->nis;
        $tanggal = date('Y-m-d');
        // var_dump($nis);


        $kehadiran = $this->kehadiran_model->get_where_today($nis, $tanggal)->result_array();
        // var_dump($kehadiran);

        $return = '';
        
        $return .= '<table class="table table-bordered text-sm">';
        $return .= '<thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>';
        if (!empty($kehadiran)) {

            $return .= '<td>' . $kehadiran[0]['nama'] . '</td>';
            $return .= '<td>' . $kehadiran[0]['tanggal'] . '</td>';
            $return .= '<td>' . $kehadiran[0]['jam_masuk'] . '</td>';
            $return .= '<td>' . $kehadiran[0]['jam_pulang']. '</td>';
            if ($kehadiran[0]['status'] == 'hadir') {
                $return .= "<td><span class='badge badge-success'>Hadir</span></td>";
            } else if ($kehadiran[0]['status'] == 'terlambat') {
                $return .= "<td><span class='badge badge-warning'><span>Terlambat</span></span></td>";
            } else if ($kehadiran[0]['status'] == 'alpa') {
                $return .= "<td><span class='badge badge-warning'>Alpa</span></td>";
            } else if ($kehadiran[0]['status'] == 'bolos') {        
                $return .= "<td><span class='badge badge-warning'>Bolos</span></span></td>";
            } else if ($kehadiran[0]['status'] == 'sakit') {            
                $return .= "<td><span class='badge badge-primary'>Sakit</span></td>";
            } else {             
                $return .= "<td><span class='badge badge-info'>Izin</span></td>";
            }
            $return .= '</tbody></table>';
        } else {
            $return = null;
        }

        $data['return'] = $return;
        $data['user'] = $this->user_model->get();

        $this->template->load('template', 'siswa/dashboard', $data);
    }


    // menampilkan form add data siswa
    public function add()
    {
        $data['user'] = $this->user_model->get();
        $data['kelas'] = $this->Kelas_model->get();
        $data['nis'] = $this->Siswa_model->nis_auto();
        $data['id_orang_tua'] = $this->OrangTua_model->max_id();
        $data['orang_tua'] = $this->OrangTua_model->get();
        $data['kelas'] = $this->Kelas_model->get();
        $data['id_level_siswa'] = $this->db->get_where('tbl_level_user', ['nama_level' => 'siswa'])->result();
        $data['id_level_orang_tua'] = $this->db->get_where('tbl_level_user', ['nama_level' => 'orang tua'])->result();
        if (isset($_POST['submit'])) {
            // message untuk validasi error
            $errorMessage = array(
                'required' => "{field} Tidak boleh kosong !!!",
                'numeric' => "{field} Hanya boleh berisi angka !!!",
                'alpha_spaces' => "{field} Tidak boleh berisi angka dan karakter lain !!!",
                'is_unique' => "Sudah ada data dengan {field} yang sama"
            );

            $this->form_validation->set_rules('nisn', 'NISN', 'required|numeric|is_unique[tbl_siswa.nisn]', $errorMessage);
            $this->form_validation->set_rules('nama', 'Nama Siswa', 'required', $errorMessage);
            $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|alpha_spaces', $errorMessage);
            $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required', $errorMessage);
            $this->form_validation->set_rules('no_tlp_siswa', 'No Tlp', 'numeric', $errorMessage);
            $this->form_validation->set_rules('asal_sekolah', 'Asal Sekolah', 'required', $errorMessage);
            $this->form_validation->set_rules('no_tlp_ortu', 'No Tlp', 'numeric', $errorMessage);
            $this->form_validation->set_rules('ayah', 'Nama Ayah', 'required', $errorMessage);
            $this->form_validation->set_rules('ibu', 'Nama Ibu', 'required', $errorMessage);


            $this->form_validation->set_rules('gender', 'Gender', 'required', array('required' => '<small class="text-red text-sm">Gender/Jenis kelamin Wajib dipilih !!!</small>'));


            if ($this->form_validation->run() == false) {
                $this->template->load('template', 'siswa/add', $data);
            } else {
                $this->OrangTua_model->save();
                $this->Siswa_model->save();

                redirect('siswa');
            }
        } else {
            $this->template->load('template', 'siswa/add', $data);
        }
    }

    public function edit()
    {
        $data['user'] = $this->user_model->get();
        $id_siswa = $this->uri->segment(3);

        $data['siswa'] = $this->Siswa_model->get('id_siswa', $id_siswa);
        $data['kelas'] = $this->Kelas_model->get();

        if (isset($_POST['submit'])) {
            $errorMessage = array(
                'required' => "{field} Tidak boleh kosong !!!",
                'numeric' => "{field} Hanya boleh berisi angka !!!",
                'alpha_spaces' => "{field} Tidak boleh berisi angka dan karakter lain !!!",
                'is_unique' => "Sudah ada data dengan {field} yang sama"
            );

            $this->form_validation->set_rules('nisn', 'NISN', 'required|numeric', $errorMessage);
            $this->form_validation->set_rules('nama', 'Nama Siswa', 'required', $errorMessage);
            $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|alpha_spaces', $errorMessage);
            $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required', $errorMessage);
            $this->form_validation->set_rules('no_tlp_siswa', 'No Tlp', 'numeric', $errorMessage);
            $this->form_validation->set_rules('asal_sekolah', 'Asal Sekolah', 'required', $errorMessage);
            $this->form_validation->set_rules('no_tlp_ortu', 'No Tlp', 'numeric', $errorMessage);
            $this->form_validation->set_rules('ayah', 'Nama Ayah', 'required', $errorMessage);
            $this->form_validation->set_rules('ibu', 'Nama Ibu', 'required', $errorMessage);


            $this->form_validation->set_rules('gender', 'Gender', 'required', array('required' => '<small class="text-red text-sm">Gender/Jenis kelamin Wajib dipilih !!!</small>'));
            if ($this->form_validation->run() == false) {
                $this->template->load('template', 'siswa/edit', $data);
            } else {
                $this->OrangTua_model->update();
                $this->Siswa_model->update();
                redirect('siswa');
            }
        } else {
            $this->template->load('template', 'siswa/edit', $data);
        }

        // var_dump($data);
    }

    public function delete($id)
    {
        $id_ortu = $this->uri->segment(4);
        if (!empty($id)) {
            $this->Siswa_model->delete($id);
            $this->OrangTua_model->delete($id_ortu);
        }
        $this->session->set_flashdata('pesan', msgSuccess('Data Siswa berhasil dihapus'));
        redirect('siswa');
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
                    $this->upload->display_errors();
                }
            }

            $this->session->set_userdata(['username' => $username, 'foto' => $newImage]);

            $this->db->set('nama', $nama);
            $this->db->set('username', $username);
            $this->db->set('tempat_lahir', $tempat_lahir);
            $this->db->set('tgl_lahir', $tgl_lahir);
            $this->db->where('id_siswa', $id);
            $this->db->update('tbl_siswa');
            $this->session->set_flashdata('pesan', toastSuccess('Profile berhasil diubah'));
            redirect('siswa/profile');
        } else if (isset($_POST['password_edit'])) {
            $id = $this->input->post('id', TRUE);

            $passwordLama = $this->input->post('password', TRUE);
            $passwordInput = $this->input->post('password2', TRUE);
            $passwordBaru = password_hash($passwordInput, PASSWORD_DEFAULT);

            $userPassword = $this->user_model->get()->password;

            if (password_verify($passwordLama, $userPassword)) {
                $this->db->set('password', $passwordBaru);
                $this->db->where('id_siswa', $id);
                $this->db->update('tbl_siswa');
                $this->session->set_flashdata('pesan', msgSuccess('Berhasil Merubah Password'));
                redirect('siswa/profile');
            } else {
                $this->session->set_flashdata('pesan', msgError('Password lama salah, Silahkan coba lagi!!'));
                redirect('siswa/profile');
            }
        } else {
            $this->template->load('template', 'siswa/profile', $data);
        }
    }

    // untuk tombol kehadiarn yang ada view data siswa
    public function kehadiran($id)
    {

        $nis = $this->Siswa_model->get('id_siswa', $id)[0]->nis;
        $nama = $this->Siswa_model->get('id_siswa', $id)[0]->nama;
        $datestring = '%m / %Y';

        $start_date = date("1-m-Y");
        $end_date = date('t', strtotime($start_date));
        // $end_date = explode('-', $tgl_terakhir)[2];
        $kehadiran = $this->kehadiran_model->get_where($nis)->result_array();


        $data = [
            'title'     => 'Kehadiran Siswa',
            'kehadiran' => $kehadiran,
            'nama'      => $nama,
            'tanggal'   => mdate($datestring),
            'start_date' => $start_date,
            'end_date'  => $end_date,
            'user'      => $this->user_model->get()
        ];

        $this->template->load('template', 'siswa/kehadiran/view', $data);
    }


    // tampilan kehadiran pada siswa
    public function absensi()
    {
        $id = $this->user_model->get()->id_siswa;

        // var_dump($id) ;

        $nis = $this->Siswa_model->get('id_siswa', $id)[0]->nis;
        $nama = $this->Siswa_model->get('id_siswa', $id)[0]->nama;
        $datestring = '%m / %Y';

        $start_date = date("1-m-Y");
        $end_date = date('t', strtotime($start_date));
        // $end_date = explode('-', $tgl_terakhir)[2];
        $kehadiran = $this->kehadiran_model->get_where($nis)->result_array();


        $data = [
            'title'     => 'Kehadiran Siswa',
            'kehadiran' => $kehadiran,
            'nama'      => $nama,
            'tanggal'   => mdate($datestring),
            'start_date' => $start_date,
            'end_date'  => $end_date,
            'user'      => $this->user_model->get()
        ];

        $this->template->load('template', 'siswa/absensi/view', $data);
    }



    // export to pdf
    public function export_pdf()
    {

        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetTitle('Data Siswa SMKN 1 Cibatu');

        $GetX = $pdf->GetX();
        $x = $GetX;
        $width = $pdf->GetPageWidth();
        $height = $pdf->GetPageHeight();



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



        $pdf->SetY(60);
        $pdf->SetFont('Times', 'B', 15);
        $pdf->Cell(0, 0, "BIODATA SISWA", 0, 1, 'C');

        // Colors, line width and bold font

        $header = array('No', 'Nis', 'Nisn', 'Nama', 'Kelas', 'Asal Sekolah');
        $pdf->SetFillColor(219, 219, 219);
        $pdf->SetTextColor(0);

        $pdf->SetFont('Times', 'B', 10);
        // Header
        $pdf->SetY($xline + 30);
        $pdf->SetX($x);
        $w = array(10, 25, 25, 45, 35, 47);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();
        // Color and font restoration
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = false;
        $no = 0;
        $siswa = $this->Siswa_model->get();
        // $siswa = $this->db->get('tbl_siswa')->result();
        foreach ($siswa as $row) {
            $pdf->SetX($x);
            $no++;
            $pdf->Cell($w[0], 7, $no, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[1], 7, $row->nis, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[2], 7, $row->nisn, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[3], 7, $row->nama, 'LR', 0, 'L', $fill);
            $pdf->Cell($w[4], 7, $row->nama_tingkatan . ' ' . $row->nama_jurusan . ' ' . $row->nomor_kelas, 'LR', 0, 'L', $fill);
            $pdf->Cell($w[5], 7, $row->asal_sekolah, 'LR', 0, 'L', $fill);
            $pdf->Ln();
            $pdf->SetX($x);
            $fill = !$fill;
        }
        // Closing line
        $pdf->Cell(array_sum($w), 0, '', 'T');
        $pdf->Output();
    }

    public function export_excel()
    {

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->mergeCells('A1:F1');

        $sheet->setCellValue('A1', 'Data Siswa');
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Nis');
        $sheet->setCellValue('C2', 'Nisn');
        $sheet->setCellValue('D2', 'Nama');
        $sheet->setCellValue('E2', 'Kelas');
        $sheet->setCellValue('F2', 'Asal Sekolah');

        $siswa = $this->Siswa_model->get();
        $no = 1;
        $x = 3;
        foreach ($siswa as $row) {
            $sheet->setCellValue('A' . $x, $no++);
            $sheet->setCellValue('B' . $x, $row->nis);
            $sheet->setCellValue('C' . $x, $row->nisn);
            $sheet->setCellValue('D' . $x, $row->nama);
            $sheet->setCellValue('E' . $x, $row->nama_tingkatan . $row->nama_jurusan . $row->nomor_kelas);
            $sheet->setCellValue('F' . $x, $row->asal_sekolah);
            $x++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'datas-siswa';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
