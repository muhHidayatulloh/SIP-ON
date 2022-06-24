<?php 

class Anu {
public function get_chat_id()
{
    $url = "https://api.telegram.org/bot1631320877:AAEWzHc9iVhGj74OLHEwCAU6F725Bm3B3oU/getUpdates";

    $get_content = file_get_contents($url);
    $data = json_decode($get_content)->result;

    $update_id = [];

    foreach ($data as $d) :
        $update_id[] = $d->message->message_id;
    endforeach;

    $now = sizeof($update_id);

    echo $now - 1;
    $chat_id = $data[$now - 1]->message->chat->id;
    $username = $data[$now - 1]->message->chat->username;

    $data['chat_id'] = $chat_id;
    $data['username'] = $username;


    var_dump($username);


    $token = "1631320877:AAEWzHc9iVhGj74OLHEwCAU6F725Bm3B3oU"; // token bot

    $data = [
        'text' => $chat_id . " " . $username,
        'chat_id' => $chat_id
    ];

    file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data));

    // var_dump($data[$now - 1]->message->chat->id);

    // mengambil chat id
    // foreach ($data as $d) :
    //     echo $d->message->chat->id . "<br>";
    // endforeach;
}
}