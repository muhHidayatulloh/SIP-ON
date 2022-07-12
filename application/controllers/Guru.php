<?php

class Guru extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Guru_model');
        $this->load->model('Role_model');
        $this->load->model('user_model');
    }

    public function index()
    {
        $data['guru'] = $this->Guru_model->get();
        $data['user'] = $this->user_model->get();
        $this->template->load('template', 'guru/view', $data);
    }

    public function profile()
    {
        $data['user'] = $this->user_model->get();
        $this->template->load('template', 'guru/profile', $data);
    }

    public function add()
    {
        $data['role'] = $this->Role_model->get();
        $data['user'] = $this->user_model->get();
        if (isset($_POST['submit'])) {
            // message untuk validasi error
            $errorMessage = array(
                'required' => "{field} Tidak boleh kosong !!!",
                'numeric' => "{field} Hanya boleh berisi angka !!!",
                'alpha_spaces' => "{field} Tidak boleh berisi angka dan karakter lain !!!",
                'is_unique' => "Sudah ada data dengan {field} / NIK yang sama"
            );
            $this->form_validation->set_rules('nip', 'NIP', 'required|numeric|is_unique[tbl_guru.nip]', $errorMessage);
            $this->form_validation->set_rules('nama', 'Nama', 'required', $errorMessage);
            $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|alpha_spaces', $errorMessage);
            $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required', $errorMessage);
            $this->form_validation->set_rules('gender', 'Gender', 'required', array('required' => '<small class="text-red text-sm">Gender/Jenis kelamin Wajib dipilih !!!</small>'));


            if ($this->form_validation->run() == false) {
                $this->template->load('template', 'guru/add', $data);
            } else {
                ($this->Guru_model->save()) ?
                    $this->session->set_flashdata('pesan', msgSuccess('Data Guru berhasil ditambahkan'))
                    : $this->session->set_flashdata('pesan', msgError('Gagal Menambahkan data Guru'));
                redirect('guru');
            }
        } else {
            $this->template->load('template', 'guru/add', $data);
        }
    }

    // function untuk select validasi
    
    // function ket_validate($ket)
    // {
    //     if ($ket == 'null') {
    //         $this->form_validation->set_message('ket_validate', '<small class="text-red text-sm">Keterangan Wajib Dipilih !!!</small>');
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }
    // ./ select validasi

    public function delete($id)
    {

        if (!empty($id)) {
            $this->Guru_model->delete($id);
        }
        $this->session->set_flashdata('pesan', msgSuccess('Data Guru berhasil dihapus'));
        redirect('guru');
    }

    public function detail()
    {
        $id = $this->uri->segment(3);
        $data['guru'] = $this->Guru_model->get_join($id)[0];
        $data['user'] = $this->user_model->get();

        $this->template->load('template', 'guru/detail', $data);
    }

    public function edit($id)
    {
        $data['user'] = $this->user_model->get();
        $data =
            [
                'guru' => $this->Guru_model->get('id', $id)[0],
                'role' => $this->Role_model->get(),
            ];
        if (isset($_POST['submit'])) {
            // message untuk validasi error
            $errorMessage = array(
                'required' => "{field} Tidak boleh kosong !!!",
                'numeric' => "{field} Hanya boleh berisi angka !!!",
                'alpha_spaces' => "{field} Tidak boleh berisi angka dan karakter lain !!!",
                'is_unique' => "Sudah ada data dengan {field} / NIK yang sama"
            );
            $this->form_validation->set_rules('nip', 'NIP', 'required|trim|numeric', $errorMessage);
            $this->form_validation->set_rules('nama', 'Nama', 'required', $errorMessage);
            $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|alpha_spaces', $errorMessage);
            $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required', $errorMessage);
            $this->form_validation->set_rules('gender', 'Gender', 'required', array('required' => '<small class="text-red text-sm">Gender/Jenis kelamin Wajib dipilih !!!</small>'));


            if ($this->form_validation->run() == false) {
                $this->template->load('template', 'guru/edit', $data);
            } else {
                ($this->Guru_model->update()) ?
                    $this->session->set_flashdata('pesan', msgSuccess('Data Guru berhasil diubah'))
                    : $this->session->set_flashdata('pesan', msgError('Gagal Mengubah data Guru'));
                redirect('guru');
            }
        } else if (isset($_POST['profile_edit'])) {

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
            $this->db->where('id', $id);
            $this->db->update('tbl_guru');
            $this->session->set_flashdata('pesan', msgSuccess('Profile berhasil diubah'));

            redirect('guru/profile');
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
                redirect('guru/profile');
            } else {
                $this->session->set_flashdata('pesan', msgError('Password lama salah, Silahkan coba lagi!!'));
                redirect('guru/profile');
            }
        } else {
            $data['user'] = $this->user_model->get();
            $this->template->load('template', 'guru/edit', $data);
        }
    }

}
