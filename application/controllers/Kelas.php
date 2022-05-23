<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kelas extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Kelas_model');
        $this->load->model('Jurusan_model');
        $this->load->model('Tingkatan_model');
    }

    public function index()
    {
        $data = [
            'kelas'      => $this->Kelas_model->get(),
            'kelasX'     => $this->Kelas_model->get('nama_tingkatan', 'X'),
            'kelasXI'    => $this->Kelas_model->get('nama_tingkatan', 'XI'),
            'kelasXII'   => $this->Kelas_model->get('nama_tingkatan', 'XII'),
            'count'      => $this->Kelas_model->count(),
            'countX'     => $this->Kelas_model->count('nama_tingkatan', 'X'),
            'countXI'    => $this->Kelas_model->count('nama_tingkatan', 'XI'),
            'countXII'   => $this->Kelas_model->count('nama_tingkatan', 'XII')
        ];
        $this->template->load('template', 'kelas/view', $data);
    }

    public function add()
    {
        $data = [
            'jurusan'               => $this->Jurusan_model->get(),
            'tingkatan_kelas'       => $this->Tingkatan_model->get(),

        ];
        if (isset($_POST['submit'])) {
            $save = $this->Kelas_model->save();
            if ($save) {
                $this->session->set_flashdata('pesan', msgSuccess('Menu berhasil ditambahkan'));
                redirect('kelas');
            } else {
                $this->session->set_flashdata('pesan', msgInfo('Nama kelas sudah ada'));
                $this->template->load('template', 'kelas/add', $data);
            }
        } else {
            $this->template->load('template', 'kelas/add', $data);
        }
    }

    function delete($id = null)
    {
        if ($id != null) {
            // id pada url ada

            if ($this->Kelas_model->delete($id)) {
                $this->session->set_flashdata('pesan', msgSuccess('Kelas berhasil dihapus'));
                redirect('kelas');
            } else {
                $this->session->set_flashdata('pesan', msgError('Kelas Gagal DIhapus'));
                redirect('kelas');
            }
        } else {
            // id di url tidak ada
            redirect('kelas');
        }
    }

    function edit($id = null)
    {
        if (isset($_POST['submit'])) {
            // $_post submit found
            // proses update
            if ($this->Kelas_model->update()) {
                // update true
                $this->session->set_flashdata('pesan', msgSuccess('Kelas berhasil diubah'));
                redirect('kelas');
            } else {
                // update false
                $this->session->set_flashdata('pesan', msgError('Kelas gagal diubah'));
                redirect('kelas');
            }
        } else {
            // $_post submit not found
            $data = [
                'kelas'                 => $this->Kelas_model->get('id', $id)[0],
                'jurusan'               => $this->Jurusan_model->get(),
                'tingkatan_kelas'       => $this->Tingkatan_model->get(),
            ];
            $this->template->load('template', 'kelas/edit', $data);
        }
    }
}
