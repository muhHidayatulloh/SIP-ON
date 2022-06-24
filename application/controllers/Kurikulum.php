<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kurikulum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Kurikulum_model');
        $this->load->model('Jurusan_model');
        $this->load->model('user_model');
        $this->load->model('KurikulumDetail_model');
    }

    public function index()
    {
        $data['user'] = $this->user_model->get();
        $data = [
            'kurikulum' => $this->Kurikulum_model->get()
        ];

        $this->template->load('template', 'kurikulum/view', $data);
    }

    public function add()
    {
        $data['user'] = $this->user_model->get();
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
        $data['user'] = $this->user_model->get();
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
        $data['user'] = $this->user_model->get();
        $data['idKurikulum'] =  $this->uri->segment(3);
        $this->template->load('template', 'kurikulum/detail', $data);
    }

    // untuk filter data yang ditampilkan ke table pada halaman kurikulum detail
    public function filter()
    {
        $kur = $this->uri->segment(3);
        $jur = $this->uri->segment(4);
        $ting = $this->uri->segment(5);
        $data['user'] = $this->user_model->get();
        // var_dump($kur . $jur . $ting);

        $this->db->select('*');
        $this->db->from('tbl_kurikulum_detail');
        $this->db->join('tbl_mapel', 'tbl_mapel.kd_mapel = tbl_kurikulum_detail.kd_mapel');
        $array = array('id_kurikulum' => $kur, 'kd_jurusan' => $jur, 'kd_tingkatan' => $ting);
        $this->db->where($array);
        $query = $this->db->get()->result();

        if (sizeof($query) != 0) {
            $data['mapel'] = $query;
            $this->load->view('kurikulum/result_filter', $data);
        } else {
            $this->load->view('attention/no_data');
        }

        // var_dump($data);
        // die;

    }

    public function add_detail()
    {
        $id_kurikulum = $this->uri->segment(3);
        $data['user'] = $this->user_model->get();


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
            $this->template->load('template', 'kurikulum/add_detail', $data);
        }
    }

    public function queryjson()
    {
        $idJurusan = $this->input->post('kdJurusan', TRUE);
        $idTingkatan = $this->input->post('kdTingkatan', TRUE);
    }
}
