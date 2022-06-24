<?php

class OrangTua extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('orangTua_model');
        $this->load->model('user_model');
        $this->load->model('kehadiran_model');
    }

    public function index()
    {
        $user =  $this->user_model->get();
        $id_orang_tua = $user->id_orang_tua;

        $orangTua = $this->orangTua_model->get_where(['a.id_orang_tua' => $id_orang_tua])->row_object();

        // var_dump($orangTua);
        $nis = $orangTua->nis;

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
            $return .= '<td>' . $kehadiran[0]['jam_pulang'] . '</td>';
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
        $data['user'] = $user;
        $this->template->load('template', 'orang_tua/dashboard', $data);
    }

    public function profile()
    {
        $username = $this->input->post('username', TRUE);
        $data['user'] = $this->user_model->get();
        if (isset($_POST['profile_edit'])) {
            $id = $this->input->post('id', TRUE);
            $update = [
                'username'      => $username,
                'nama'          => $this->input->post('nama', TRUE),
                'nama_ibu'      => $this->input->post('nama_ibu', TRUE),
                'no_tlp_ortu'   => $this->input->post('no_tlp_ortu', TRUE),
                'alamat'        => $this->input->post('alamat', TRUE)
            ];
            $this->session->set_userdata(['username' => $username]);
            $this->db->where('id_orang_tua', $id);
            $this->db->update('tbl_orang_tua', $update);
            $this->session->set_flashdata('pesan', msgSuccess('Berhasil Update Profile'));
            redirect('orangtua/profile');
        } else if (isset($_POST['password_edit'])) {
            $id = $this->input->post('id', TRUE);

            $passwordLama = $this->input->post('password', TRUE);
            $passwordInput = $this->input->post('password2', TRUE);
            $passwordBaru = password_hash($passwordInput, PASSWORD_DEFAULT);

            $userPassword = $this->user_model->get()->password;

            if (password_verify($passwordLama, $userPassword)) {
                $this->db->set('password', $passwordBaru);
                $this->db->where('id_orang_tua', $id);
                $this->db->update('tbl_orang_tua');
                $this->session->set_flashdata('pesan', msgSuccess('Berhasil Merubah Password'));
                redirect('orangtua/profile');
            } else {
                $this->session->set_flashdata('pesan', msgError('Password lama salah, Silahkan coba lagi!!'));
                redirect('orangtua/profile');
            }
        } else {
            $this->template->load('template', 'orang_tua/profile', $data);
        }
    }

    public function rekap()
    {

        $user =  $this->user_model->get();
        $id_orang_tua = $user->id_orang_tua;

        $orangTua = $this->orangTua_model->get_where(['a.id_orang_tua' => $id_orang_tua])->row_object();

        $nis = $orangTua->nis;


        $start_date = date("1-m-Y");
        $end_date = date('t', strtotime($start_date));
        // $end_date = explode('-', $tgl_terakhir)[2];
        $kehadiran = $this->kehadiran_model->get_where($nis)->result_array();

        $data = [
            'user'      => $user,
            'tanggal'   => date('m / Y'),
            'end_date'  => $end_date,
            'kehadiran' => $kehadiran
        ];

        $this->template->load('template', 'orang_tua/rekap', $data);
    }
}
