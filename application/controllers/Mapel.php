<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mapel extends  CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mapel_model');
    }

    public function index()
    {
        $data = [
            'mapel'     => $this->Mapel_model->get()
        ];
        $this->template->load('template', 'mapel/view', $data);
    }

    public function add()
    {
        if (isset($_POST['submit'])) {

            $this->form_validation->set_rules('nama_mapel', 'Nama Mata Pelajaran', 'required');
            if ($this->form_validation->run() == false) {
                $this->template->load('template', 'mapel/add');
            } else {

                // ambil data tahun_akademik yang sama dengan dari $_post inputan tahun_akademik
                $mapel = $this->Mapel_model->get('nama_mapel', $_POST['nama_mapel']);

                if (sizeof($mapel) < 1) {
                    // data tidak ada
                    // data di save
                    $this->Mapel_model->save();
                    $this->session->set_flashdata('pesan', msgSuccess('Mata Pelajaran berhasil ditambahkan'));
                    redirect('mapel');
                }

                $this->session->set_flashdata('pesan', msgError('Mata Pelajaran Sudah Ada'));
                $this->template->load('template', 'mapel/add');
            }
        } else {
            // jika tidak ada aksi submit
            $this->template->load('template', 'mapel/add');
        }
    }

    public function edit()
    {
        if (isset($_POST['submit'])) {
            $this->Mapel_model->update();
            $this->session->set_flashdata('pesan', msgSuccess('Mata Pelajaran berhasil diubah'));
            redirect('mapel');
        } else {
            $idMapel = $this->uri->segment(3);
            $data = [
                'mapel' => $this->Mapel_model->get('kd_mapel', $idMapel)[0],
            ];
            $this->template->load('template', 'mapel/edit', $data);
        }
    }

    public function delete($id)
    {

        if (!empty($id)) {
            $this->Mapel_model->delete($id);
        }
        $this->session->set_flashdata('pesan', msgSuccess('Mata Pelajaran berhasil dihapus'));
        redirect('mapel');
    }
}
