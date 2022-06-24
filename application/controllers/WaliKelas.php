<?php 

class WaliKelas extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model('user_model');
        $this->load->model('walikelas_model');
        $this->load->model('kelas_model');
        $this->load->model('guru_model');
    }

    public function index()
    {
        $walikelas = $this->walikelas_model->get()->result();
        $id_level_user = $this->db->get_where('tbl_level_user', ['nama_level' => 'wali kelas'])->row_object()->id_level_user;

        $guru = $this->guru_model->get('id_level_user not like', $id_level_user);

        $data = [
            'walikelas' => $walikelas,
            'user' => $this->user_model->get(),
            'kelas' => $this->kelas_model->get(),
            'guru' => $guru
        ];

        if (isset($_POST['save_walikelas'])) {
            $id_kelas = $this->input->post('id_kelas', TRUE);
            $id_guru = $this->input->post('id_guru', TRUE);
            $id_tahun_akademik = get_tahun_akademik('id_tahun_akademik');
               
            $insert = [
                'id_guru' => $id_guru,
                'id_kelas' => $id_kelas,
                'id_tahun_akademik' => $id_tahun_akademik
            ];
            
            $this->db->insert('tbl_walikelas', $insert);
            $this->db->update('tbl_guru', ['id_level_user' => $id_level_user], ['id' => $id_guru]);
            
            $this->session->set_flashdata('pesan', msgSuccess('Data Wali Kelas berhasil ditambahkan'));
            redirect('walikelas');
            
        } else {

            $this->template->load('template', 'walikelas/view', $data);
        }

    }

}
