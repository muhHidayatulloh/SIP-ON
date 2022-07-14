<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bot extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // is_logged_in();
    }

    function index()
    {

        $TOKEN = "5525121168:AAG5bL1PyyxUSuCL-grYd0T62S2xy73RyC8";
        $apiURL = "https://api.telegram.org/bot$TOKEN";
        $update = json_decode(file_get_contents("php://input"), TRUE);
        $chatID = $update["message"]["chat"]["id"];
        $username = $update['message']['chat']['username'];
        $message = $update["message"]["text"];
        $id_user = "0";
        $linkKonfirmasi = base_url() . 'bot/konfirmasi/' . $chatID;


        // var_dump($linkKonfirmasi); die;


        $token2 = "1631320877:AAEWzHc9iVhGj74OLHEwCAU6F725Bm3B3oU"; // token bot

        $data = [
            'text' => "Selamat datang. Anda sudah terdaftar dalam sistem kami, selanjutnya jika ada pemberitahuan mengenai kehadiran, akan ada informasi dari sistem yang dikirimkan melalui pesan singkat Telegram ini, sistem ini hanyalah sebuah robot pengirim pesan singkat secara otomatis, jadi tidak akan ada balasan apapun jika anda mengirim pesan ke sini. Terimakasi atas perhatiannya. Untuk Konfirmasi berhasil silahkan wajib klik link ini " . $linkKonfirmasi,
            'chat_id' => $chatID
        ];



        if (strpos($message, "/start") === 0) {

            $this->load->model('user_model');
            $user = $this->user_model->get();
            $id_user = $user->id_orang_tua;

            $sql = "SELECT * FROM tbl_telegram where chat_id = $chatID";

            $result = $this->db->query($sql)->num_rows();

            $insert = [
                'id_user' => $id_user,
                'username' => $username,
                'chat_id' => $chatID
            ];

            if ($result < 1) {
                // jika data chat id belum ditemukan dalam database
                if (!$this->db->insert('tbl_telegram', $insert)) {
                    // jika query error
                    $error = 'Gagal Menyimpan data';
                    file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=Your ID : $chatID. Username : $username. gagal! error code : $error. &parse_mode=HTML");
                } else {
                    // jika query insert berhasil
                    file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=Your ID : $chatID. Username : $username. User Id : $id_user. Berhasil di daftarkan. &parse_mode=HTML");
                    file_get_contents("https://api.telegram.org/bot$token2/sendMessage?" . http_build_query($data));
                }
            } else {
                // jika data chat_id sudah ditemukan dalam database
                file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=Your ID : $chatID. Username : $username. User Id : $id_user. Sudah ada dalam daftar.&parse_mode=HTML");
            }
        }
    }

    function sendmessage()
    {
        $TOKEN = "5525121168:AAG5bL1PyyxUSuCL-grYd0T62S2xy73RyC8";
        $apiURL = "https://api.telegram.org/bot$TOKEN";
        $update = json_decode(file_get_contents("php://input"), TRUE);
        $chatID = $update["message"]["chat"]["id"];
        $username = $update['message']["chat"]['username'];
        $message = $update["message"]["text"];

        if (strpos($message, "/start") === 0) {

            file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=Your ID : $chatID \r &username : $username, &parse_mode=HTML");
        }
    }

    function konfirmasi($chat_id)
    {
        
        if ($chat_id) {
            $this->load->model('user_model');
            $user = $this->user_model->get();
            // var_dump($user);
            $id_orang_tua = $user->id_orang_tua;

            if ($id_orang_tua) {

                $res = $this->db->get_where('tbl_telegram', ['id_user' => $id_orang_tua]);

                if ($res->num_rows() < 1) {
                    $data = [
                        'id_user' => $id_orang_tua,
                        'chat_id' => $chat_id
                    ];
                    $this->db->insert('tbl_telegram', $data);
                    $this->session->set_flashdata('pesan', msgInfo('Chat Id Berhasil Terkonfirmasi'));
                } else {
                    $this->session->set_flashdata('pesan', msgInfo('Chat Id Sudah Terdaftar'));
                    redirect('welcome');
                }
            } else {
                redirect('error');
            }
        } else {
            redirect('error');
        }

        // $this->db->insert('tbl_telegram')
    }
}
