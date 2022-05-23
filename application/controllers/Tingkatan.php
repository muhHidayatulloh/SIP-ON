<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tingkatan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Tingkatan_model');
    }

    public function index()
    {
        $data['tingkatan'] = $this->Tingkatan_model->get();
        $this->template->load('template', 'tingkatan/view', $data);
    }

    public function add()
    {

        if (isset($_POST['submit'])) {
            // post submit tru

            // cek validasi form
            $this->form_validation->set_rules('nama_tingkatan', 'Nama Tingkatan', 'required');
            $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
            if ($this->form_validation->run() == false) {
                // falidasi false
                $this->template->load('template', 'tingkatan/add');
            } else {
                // falidasi true
                if ($this->Tingkatan_model->save()) {
                    //insert berhasil
                    $this->session->set_flashdata('pesan', msgSuccess('Berhasil menambahkan tingkatan kelas'));
                    redirect('tingkatan');
                } else {
                    // insert gagal
                    $this->session->set_flashdata('pesan', msgError('Gagal menambahkan tingkatan kelas'));
                    redirect('tingkatan');
                }
            }
        }
        // jika tidak terdeteksi post submit
        $this->template->load('template', 'tingkatan/add');
    }

    public function edit($id = null)
    {
        if (isset($_POST['submit'])) {
            // $_post submit found

            // rule falidasi
            $this->form_validation->set_rules('nama_tingkatan', 'Nama Tingkatan', 'required');
            $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

            if ($this->form_validation->run() == false) {
                // falidasi false
                $data = [
                    'tingkatan' => $this->Tingkatan_model->get('kd_tingkatan', $id)[0],
                ];
                $this->template->load('template', 'tingkatan/edit', $data);
            } else {
                // falidasi true
                if ($this->Tingkatan_model->update()) {
                    // update true
                    $this->session->set_flashdata('pesan', msgSuccess('Tingkat Kelas berhasil diubah'));
                    redirect('tingkatan');
                } else {
                    // update false
                    $this->session->set_flashdata('pesan', msgError('Tingkat Kelas gagal diubah'));
                    redirect('tingkatan');
                }
            }
        } else {
            // $_post submit not found
            $data = [
                'tingkatan' => $this->Tingkatan_model->get('kd_tingkatan', $id)[0],
            ];
            $this->template->load('template', 'tingkatan/edit', $data);
        }
    }

    public function delete($id)
    {
        if ($id != null) {
            // id pada url ada

            if ($this->Tingkatan_model->delete($id)) {
                $this->session->set_flashdata('pesan', msgSuccess('Tingkatan Kelas berhasil dihapus'));
                redirect('tingkatan');
            } else {
                $this->session->set_flashdata('pesan', msgError('Tingkatan Kelas Gagal DIhapus'));
                redirect('tingkatan');
            }
        } else {
            // id di url tidak ada
            redirect('tingkatan');
        }
    }
}
