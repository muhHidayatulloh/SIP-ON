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
}
