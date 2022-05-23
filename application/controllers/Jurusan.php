<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Jurusan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jurusan_model');
    }

    public function index()
    {
        $data = [
            'jurusan'   => $this->Jurusan_model->get(),
        ];

        $this->template->load('template', 'jurusan/view', $data);
    }

    public function add()
    {

        if (isset($_POST['submit'])) {

            // jika di $_post terdeteksi name submit = true

            // cek falidasi form
            $this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'required');
            $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

            if ($this->form_validation->run() == false) {

                // falidasi tidak terpenuhi kembali ke halaman jurusan add
                $this->template->load('template', 'jurusan/add');
            } else {
                // falidasi true

                // save
                $query = $this->Jurusan_model->save();

                if ($query) {

                    // query true
                    // tampilkan pesan berhasil
                    $this->session->set_flashdata('pesan', msgSuccess('Jurusan berhasil ditambahkan'));

                    if ($this->uri->segment(1) == "kelas") {
                        // jika terdeteksi di url index ke 1 kelas maka arahkan ke halaman kelas add
                        redirect('kelas/add');
                    } else {

                        // jika di url tidak terdeteksi index ke 1 = kelas arahkan ke halaman jurusan
                        redirect('jurusan');
                    }
                } else {
                    // query false

                    // set pesan gagal ke halaman jurusan add
                    $this->session->set_flashdata('pesan', msgError('Gagal menambahkan Jurusan'));
                    $this->template->load('template', 'jurusan/add');
                }
            }
        } else {
            // jika di $_post tidak terdeteksi submit
            $this->template->load('template', 'jurusan/add');
        }
    }

    function delete($id = null)
    {
        if ($id != null) {
            // id pada url ada

            if ($this->Jurusan_model->delete($id)) {
                $this->session->set_flashdata('pesan', msgSuccess('Jurusan berhasil dihapus'));
                redirect('jurusan');
            } else {
                $this->session->set_flashdata('pesan', msgError('Jurusan Gagal DIhapus'));
                redirect('jurusan');
            }
        } else {
            // id di url tidak ada
            redirect('jurusan');
        }
    }

    function edit($id)
    {
        if (isset($_POST['submit'])) {
            // $_post submit found

            // rule falidasi
            $this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'required');
            $this->form_validation->set_rules('deskripsi', 'Kepanjangan', 'required');

            if ($this->form_validation->run() == false) {
                // falidasi false
                $data = [
                    'jurusan' => $this->Jurusan_model->get('kd_jurusan', $id)[0],
                ];
                $this->template->load('template', 'jurusan/edit', $data);
            } else {
                // falidasi true
                if ($this->Jurusan_model->update()) {
                    // update true
                    $this->session->set_flashdata('pesan', msgSuccess('Jurusan berhasil diubah'));
                    redirect('jurusan');
                } else {
                    // update false
                    $this->session->set_flashdata('pesan', msgError('Jurusan gagal diubah'));
                    redirect('jurusan');
                }
            }
        } else {
            // $_post submit not found
            $data = [
                'jurusan' => $this->Jurusan_model->get('kd_jurusan', $id)[0],
            ];
            $this->template->load('template', 'jurusan/edit', $data);
        }
    }
}
