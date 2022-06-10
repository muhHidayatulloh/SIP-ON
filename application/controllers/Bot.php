<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bot extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
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
}
