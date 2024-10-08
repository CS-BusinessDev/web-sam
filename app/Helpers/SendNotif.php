<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class SendNotif
{

    public static function sendMessage($content, array $id)
    {
        $content = array(
            "en" => $content,
        );

        $fields = array(
            'app_id' => config('services.onesignal.app_id'),
            'include_player_ids' => $id,
            'large_icon' => '@drawable/msilogo',
            'small_icon' => '@drawable/msilogo',
            'contents' => $content
        );

        $fields = json_encode($fields);
        // print("\nJSON sent:\n");
        error_log($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        curl_exec($ch);
        curl_close($ch);

        // error_log($response);
    }
}
