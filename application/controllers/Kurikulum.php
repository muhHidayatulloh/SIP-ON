<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kurikulum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kurikulum_model');
        $this->load->model('Jurusan_model');
        $this->load->model('KurikulumDetail_model');
    }

    public function index()
    {
        $data = [
            'kurikulum' => $this->Kurikulum_model->get()
        ];

        $this->template->load('template', 'kurikulum/view', $data);
    }

    public function add()
    {
        $data = [
            'kurikulum' => $this->Kurikulum_model->get()
        ];


        if (isset($_POST['submit'])) {

            // ambil data tahun_akademik yang sama dengan dari $_post inputan tahun_akademik
            $kurikulum = $this->Kurikulum_model->get('nama_kurikulum', $_POST['nama_kurikulum']);

            $this->form_validation->set_rules('nama_kurikulum', 'Nama Kurikulum', 'required');
            if ($this->form_validation->run() == false) {
                $this->template->load('template', 'kurikulum/add', $data);
            } else {
                // cek user pilih tahun dan is_aktif apa belum
                if ($_POST['is_aktif'] == '0') {
                    $this->session->set_flashdata('pesan', msgError('Kurikulum gagal ditambahkan, silahkan pilih opsi'));
                    $this->template->load('template', 'kurikulum/add', $data);
                } else {
                    // cek data ada atau belum ada

                    if (sizeof($kurikulum) < 1) {
                        // data tidak ada

                        if ($_POST['is_aktif'] == 'Y') {
                            // jika is_aktif Y maka semua Y pada field is_aktif pada database diganti dengan N
                            $this->db->where('is_aktif', 'Y');
                            $this->db->update('tbl_kurikulum', ['is_aktif' => 'N']);
                        }

                        // data di save
                        $this->Kurikulum_model->save();
                        $this->session->set_flashdata('pesan', msgSuccess('Kurikulum berhasil ditambahkan'));
                        redirect('Kurikulum');
                    } else {
                        // jika ada kembalikan kehalaman yang tadi dengan memberikan informasi bahwa data sudah ada
                        $this->session->set_flashdata('pesan', msgError('Tahun akademik sudah ada'));
                        $this->template->load('template', 'kurikulum/add', $data);
                    }
                }
            }
        } else {
            // jika tidak ada aksi submit
            $this->template->load('template', 'kurikulum/add', $data);
        }
    }

    public function edit()
    {
        if (isset($_POST['submit'])) {
            if ($_POST['is_aktif'] == 'Y') {
                // jika is_aktif Y maka semua Y pada field is_aktif pada database diganti dengan N
                $this->db->where('is_aktif', 'Y');
                $this->db->update('tbl_kurikulum', ['is_aktif' => 'N']);
            }
            $this->Kurikulum_model->update();
            $this->session->set_flashdata('pesan', msgSuccess('Kurikulum berhasil diubah'));
            redirect('kurikulum');
        } else {
            $idKurikulum = $this->uri->segment(3);
            $data = [
                'kurikulum' => $this->Kurikulum_model->get('id_Kurikulum', $idKurikulum)[0],
            ];
            $this->template->load('template', 'kurikulum/edit', $data);
        }
    }

    public function delete($id)
    {

        if (!empty($id)) {
            $this->Kurikulum_model->delete($id);
        }
        $this->session->set_flashdata('pesan', msgSuccess('Kurikulum berhasil dihapus'));
        redirect('kurikulum');
    }

    function aktifkan($id)
    {
        if (!empty($id)) {
            $this->Kurikulum_model->aktifkan($id);
            $this->session->set_flashdata('pesan', msgSuccess('Kurikulum berhasil diaktifkan'));
        } else {
            $this->session->set_flashdata('pesan', msgError('Kurikulum gagal diaktifkan'));
        }
        redirect('kurikulum');
    }

    public function detail()
    {


        $data['idDetail'] =  $this->uri->segment(3);
        $kd_jurusan = $this->input->post('kd_jurusan', TRUE);
        $kd_tingkatan = $this->input->post('kd_tingkatan', TRUE);
        if (isset($_POST['submit'])) {

            if ($kd_jurusan == 'null' || $kd_tingkatan == 'null') {
                $this->session->set_flashdata('pesan', msgError('Wajib Pilih semua opsi saat akan filter data'));
                $this->template->load('template', 'kurikulum/detail', $data);
            } else {
                $sql = "SELECT * FROM tbl_kurikulum_detail JOIN tbl_mapel ON tbl_kurikulum_detail.kd_mapel = tbl_mapel.kd_mapel WHERE tbl_kurikulum_detail.kd_jurusan = $kd_jurusan AND tbl_kurikulum_detail.kd_tingkatan = kd_tingkatan";

                $hasil = $this->db->query($sql);

                $data = [
                    'hasil' => $hasil->result(),
                    'kd_jurusan' => $kd_jurusan,
                    'kd_tingkatan' => $kd_tingkatan,
                    'idDetail' => $this->uri->segment(3)
                ];

                $this->template->load('template', 'kurikulum/detail', $data);
            }
        } else {
            $this->template->load('template', 'kurikulum/detail', $data);
        }
    }

    public function add_detail()
    {
        $id_kurikulum = $this->uri->segment(3);



        if (isset($_POST['submit'])) {

            if ($this->input->post('kd_mapel', TRUE) == 'null' || $this->input->post('kd_jurusan', TRUE) == 'null' || $this->input->post('kd_tingkatan', TRUE) == 'null') {
                $this->session->set_flashdata('pesan', msgError('Wajib pilih semua opsi yang ada'));
                redirect('kurikulum/add_detail/' . $id_kurikulum);
            } else {

                $this->KurikulumDetail_model->save();
                $this->session->set_flashdata('pesan', msgSuccess('Detail kurikulum berhasil disimpan'));
                redirect('kurikulum/detail/' . $id_kurikulum);
            }
        } else {
            $this->template->load('template', 'kurikulum/add_detail');
        }
    }
}
