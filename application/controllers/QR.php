<?php

class QR extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['token'] = $this->db->get('tbl_qr')->result()[0];

        $this->load->view('qr/view', $data);
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
