<?php
defined('BASEPATH') or exit('No direct script access allowed');
class TahunAkademik extends Ci_Controller
{

    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('TahunAkademik_model');
    }
    public function index()
    {
        $data = [
            'title'     => 'Tahun Akademik',
            'tahunAkademik' => $this->TahunAkademik_model->get()
        ];

        $this->template->load('template', 'tahunAkademik/view', $data);
    }

    public function add()
    {
        $data = [
            'tahunAkademik' => $this->TahunAkademik_model->get()
        ];


        if (isset($_POST['submit'])) {
            // ambil data tahun_akademik yang sama dengan dari $_post inputan tahun_akademik
            $tahunAkademik = $this->TahunAkademik_model->get('tahun_akademik', $_POST['tahun_akademik']);

            // cek user pilih tahun dan is_aktif apa belum
            if ($_POST['tahun_akademik'] == 0 && $_POST['is_aktif'] == 0) {
                $this->session->set_flashdata('pesan', msgError('Tahun akademik gagal ditambahkan, silahkan pilih opsi'));
                $this->template->load('template', 'tahunAkademik/add', $data);
            } else {
                // cek data ada atau belum ada
                if (sizeof($tahunAkademik) < 1) {
                    // data tidak ada

                    if ($_POST['is_aktif'] == 'Y') {
                        // jika is_aktif Y maka semua Y pada field is_aktif pada database diganti dengan N
                        $this->db->where('is_aktif', 'Y');
                        $this->db->update('tbl_tahun_akademik', ['is_aktif' => 'N']);
                    }

                    // data di save
                    $this->TahunAkademik_model->save();
                    $this->session->set_flashdata('pesan', msgSuccess('Tahun akademik berhasil ditambahkan'));
                    redirect('tahunAkademik');
                } else {
                    // jika ada kembalikan kehalaman yang tadi dengan memberikan informasi bahwa data sudah ada
                    $this->session->set_flashdata('pesan', msgError('Tahun akademik sudah ada'));
                    $this->template->load('template', 'tahunAkademik/add', $data);
                }
            }
        } else {
            $this->template->load('template', 'tahunAkademik/add', $data);
        }
    }

    public function edit()
    {
        if (isset($_POST['submit'])) {
            $this->TahunAkademik_model->update();
            $this->session->set_flashdata('pesan', msgSuccess('Tahun Akademik berhasil diubah'));
            redirect('tahunAkademik');
        } else {
            $idTahunAkademik = $this->uri->segment(3);
            $data = [
                'tahun_akademik' => $this->TahunAkademik_model->get('id_tahun_akademik', $idTahunAkademik)[0],
            ];
            $this->template->load('template', 'tahunAkademik/edit', $data);
        }
    }

    public function delete($id)
    {

        if (!empty($id)) {
            $this->TahunAkademik_model->delete($id);
        }
        $this->session->set_flashdata('pesan', msgSuccess('Tahun akademik berhasil dihapus'));
        redirect('tahunAkademik');
    }

    function aktifkan($id)
    {
        if (!empty($id)) {
            $this->TahunAkademik_model->aktifkan($id);
            $this->session->set_flashdata('pesan', msgSuccess('Tahun akademik berhasil diaktifkan'));
        } else {
            $this->session->set_flashdata('pesan', msgError('Tahun akademik gagal diaktifkan'));
        }
        redirect('tahunakademik');
    }
}
