<?php

class Siswa extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->model('Kelas_model');
        $this->load->model('OrangTua_model');
    }

    public function index()
    {
        $data['siswa'] = $this->Siswa_model->get();
        $data['title'] = "Data Siswa";

        $this->template->load('template', 'siswa/view', $data);
    }

    public function add()
    {
        $data['kelas'] = $this->Kelas_model->get();
        $data['nis'] = $this->Siswa_model->nis_auto();
        $data['id_orang_tua'] = $this->OrangTua_model->max_id();
        $data['orang_tua'] = $this->OrangTua_model->get();
        $data['kelas'] = $this->Kelas_model->get();
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
        $this->template->load('template', 'siswa/profile');
    }
}
