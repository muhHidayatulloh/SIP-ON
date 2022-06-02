<?php

class Guru extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Guru_model');
        $this->load->model('Role_model');
    }

    public function index()
    {
        $data['guru'] = $this->Guru_model->get();


        $this->template->load('template', 'guru/view', $data);
    }

    public function add()
    {
        $data['role'] = $this->Role_model->get();
        $data['keterangan'] = $this->Guru_model->get(null, null, null, 'Select * from tbl_guru_keterangan');
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
            $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required', $errorMessage);
            $this->form_validation->set_rules('jurusan', 'Jurusan', 'required', $errorMessage);
            $this->form_validation->set_rules('pendidikan_th', 'Tahun Lulus', 'required', $errorMessage);
            $this->form_validation->set_rules('jabatan', 'Jabatan', 'callback_jabatan_validate');
            $this->form_validation->set_rules('ket', 'Keterangan', 'callback_ket_validate');
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
    function jabatan_validate($jabatan)
    {
        if ($jabatan == 'null') {
            $this->form_validation->set_message('jabatan_validate', '<small class="text-red text-sm">Jabatan Wajib Dipilih !!!</small>');
            return false;
        } else {
            return true;
        }
    }
    function ket_validate($ket)
    {
        if ($ket == 'null') {
            $this->form_validation->set_message('ket_validate', '<small class="text-red text-sm">Keterangan Wajib Dipilih !!!</small>');
            return false;
        } else {
            return true;
        }
    }
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

        $this->template->load('template', 'guru/detail', $data);
    }

    public function edit($id)
    {
        $data =
            [
                'guru' => $this->Guru_model->get('id', $id)[0],
                'role' => $this->Role_model->get(),
                'keterangan' => $this->Guru_model->get(null, null, null, 'Select * from tbl_guru_keterangan')
            ];
        if (isset($_POST['submit'])) {
            // message untuk validasi error
            $errorMessage = array(
                'required' => "{field} Tidak boleh kosong !!!",
                'numeric' => "{field} Hanya boleh berisi angka !!!",
                'alpha_spaces' => "{field} Tidak boleh berisi angka dan karakter lain !!!",
                'is_unique' => "Sudah ada data dengan {field} / NIK yang sama"
            );
            $this->form_validation->set_rules('nip', 'NIP', 'required|trim|numeric|is_unique[tbl_guru.nip]', $errorMessage);
            $this->form_validation->set_rules('nama', 'Nama', 'required', $errorMessage);
            $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|alpha_spaces', $errorMessage);
            $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required', $errorMessage);
            $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required', $errorMessage);
            $this->form_validation->set_rules('jurusan', 'Jurusan', 'required', $errorMessage);
            $this->form_validation->set_rules('pendidikan_th', 'Tahun Lulus', 'required', $errorMessage);
            $this->form_validation->set_rules('jabatan', 'Jabatan', 'callback_jabatan_validate');
            $this->form_validation->set_rules('ket', 'Keterangan', 'callback_ket_validate');
            $this->form_validation->set_rules('gender', 'Gender', 'required', array('required' => '<small class="text-red text-sm">Gender/Jenis kelamin Wajib dipilih !!!</small>'));


            if ($this->form_validation->run() == false) {
                $this->template->load('template', 'guru/edit', $data);
            } else {
                ($this->Guru_model->update()) ?
                    $this->session->set_flashdata('pesan', msgSuccess('Data Guru berhasil diubah'))
                    : $this->session->set_flashdata('pesan', msgError('Gagal Mengubah data Guru'));
                redirect('guru');
            }
        } else {

            $this->template->load('template', 'guru/edit', $data);
        }
    }

    public function add_keterangan()
    {
        $data['keterangan'] = $this->Guru_model->get(null, null, null, 'Select * from tbl_guru_keterangan');
        if (isset($_POST['submit'])) {
            $object['keterangan'] = $this->input->post('keterangan', TRUE);
            $insert = $this->db->insert('tbl_guru_keterangan', $object);
            if ($insert) {
                # code...
                $this->session->set_flashdata('pesan', msgSuccess('Tambah Keterangan Berhasil'));
            } else {
                # code...
                $this->session->set_flashdata('pesan', msgError('Gagal menambahkan keterangan'));
            }
            redirect('guru/add_keterangan');
        } else {

            $this->template->load('template', 'guru/keterangan/add', $data);
        }
    }
}
