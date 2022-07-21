<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','title','body','img'
    ];

    public static function send($title,$body,$img){
        $comment = new PushNotification();
        $comment->title = $title;
        $comment->body = $body;
        $comment->img = $img;
        $comment->save();
        $url = 'https://fcm.googleapis.com/fcm/send';
        $dataArr = array('click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'id' => $comment->id,'status'=>"done");
        $notification = array('title' =>$title, 'text' => $body, 'image'=> $img, 'sound' => 'default', 'badge' => '1',);
        $arrayToSend = array('to' => "/topics/all", 'notification' => $notification, 'data' => $dataArr, 'priority'=>'high');
        $fields = json_encode ($arrayToSend);
        $headers = array (
            'Authorization: key=' . "AAAA-YkUECU:APA91bE70OcBy2XkLLsuFhb3a-oT6wE9AsaCD0yu2G9h2j49sDJl20ZENtyYHkJ8LkffgbTvQEhEcMa0hOpc2SfOIblirmUszN03D7JAhDC2qI4KSA7D-nWBjTgv_GY4iSHeTv7jFkPD",
            'Content-Type: application/json'
        );
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        $result = curl_exec ( $ch );
        //var_dump($result);
        curl_close ( $ch );
        return true;
    }
}
