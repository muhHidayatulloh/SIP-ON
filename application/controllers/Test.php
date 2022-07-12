<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $data['token'] = $this->db->get('tbl_qr')->result()[0];
        $this->load->view('test/coba', $data);
    }

    public function coba2()
    {
        $data['token'] = $this->db->get('tbl_qr')->result()[0];
        $this->load->view('test/coba2', $data);
    }

    public function generate_qrcode()
    {

        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
        $string = '';
        $date = date('YmdHis');

        for ($i = 0; $i < 10; $i++) {
            $pos = rand(0, strlen($karakter) - 1);
            $string .= $karakter[$pos];
        }

        $data['token'] = $string . $date;

        $this->db->where('id', 1);
        $this->db->update('tbl_qr', $data);

        echo json_encode($data);
    }

    public function aes()
    {

        $this->load->library('EasyAESCrypt');
        // $nama = "Muhamad Hidyatulloh";
        $encrypt = '';



        $k = 'abcdefghijuklmno0123456789012345'; // ini adalah key yang dipakai
        $encrypt = '';
        $aesE = new EasyAESCrypt($k);

        $enkripsi = $aesE->encrypt('22230004');
        $dekripsi = $aesE->decrypt($enkripsi);

        if (isset($_POST['encrypt'])) {
            $input = $this->input->post('aes', TRUE);
            $encrypt = $aesE->encrypt($input);

            $decrypt = $aesE->decrypt($encrypt);
            $this->session->set_flashdata('message', $encrypt);
            $this->session->set_flashdata('decrypt', $decrypt);

            redirect('test/aes');
        }

        $nis = $this->db->get_where('record_kehadiran', ['nis' => $enkripsi])->row_object()->nis;






        $data = [
            'enkripsi' => $enkripsi,
            'dekripsi' => $dekripsi,
            'return' => $encrypt,
            'nis' => $nis,
            'nisDecrypt' => $aesE->decrypt($nis)
        ];

        $this->load->view('test/aes', $data);
    }

    public function qr_print()
    {

        $this->load->library('dompdfimage');
        $html = $this->load->view('test/qr_print', [], true);
        $this->dompdf->createPDF($html, 'Cetak Qr', true, 'A4', 'potrait');
    }
}
