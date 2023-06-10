<?php

use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

function get_local_lang()
{
    return app()->getLocale();
}

function get_local_dir()
{
    return app()->getLocale() == 'ar' ? 'rtl' : 'ltr';
}

function change_trans ()
{
    return app()->getLocale() == 'ar' ? 'rtl.' : '';
}
function getLocalTrans()
{
    return LaravelLocalization::getCurrentLocale() === 'ar';
}

function uploadImage($image, $directory)
{
    $image_name = time() + rand(1, 1000000000) . '.' . $image->getClientOriginalExtension();
    $path = 'uploads/images/' . $directory . '/' . $image_name;
    Storage::disk('public')->put($path, file_get_contents($image));
    return $path;
}


function fcmPushToAll($topicName,$title ,$message)
{
//return $type[0];

    try {
        $headers = [
            'Authorization: key=' . env("FireBaseKey", 'AAAAl7j_tv8:APA91bF7cRdgtbZBYEr4c7msmFfCaNlbQoZnDPDIpcVnytCfWcRqqwXZgOFPlQ12uillsjYrjaJzwiB-ttC1EWJlXf4tfRaMsDBQ50a9MQQ1wtgw6McybR8BjFeZ_aoVGTlngfbtsmls'),
            'Content-Type: application/json'
        ];
        $notification = [
            "to" => '/topics/' . $topicName,

            "notification" => [
                'type' => "notify",
                'title' => $title,
                'target_id' => '55', // order_id or user_id
                'msgType' => '55',//1=>order , 2=>msg
                'body' => $message,
                'icon' => 'ic_launcher',//Default Icon
                'sound' => 'mySound',//Default sound
                'badge' => 1,
                "click_action" => 'FLUTTER_NOTIFICATION_CLICK',

            ]
        ];
        //return $notification;
        // return json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notification));

        $result = curl_exec($ch);
        curl_close($ch);
        //return json_decode($result, true);
        //  return back()->with('success','Edit SuccessFully');
    } catch (\Exception $ex) {
        return $ex->getMessage();
    }
}


function sendNotificationToUsers($tokens, $target_id, $message , $user_id = null , $user_name = null , $user_image = null,$msgType="1", ){
    try {
        $headers = [
            'Authorization: key='.env("FireBaseKey"),
            'Content-Type: application/json'
        ];

        if(!empty($tokens)) {
            $data= [
                "registration_ids" => $tokens,
                "data" => [
                    'body' => $message,
                    'type' => "notify",
                    'title' => 'Alemo',
                    'target_id' => $target_id, // order_id or user_id
                    'msgType' => $msgType,//1=>service , 2=>chat ,3=>ads app
                    'user_id'=> $user_id,
                    'user_name'=> $user_name,
                    'user_image'=> $user_image,
                    'badge' => 1,
                    "click_action" => 'FLUTTER_NOTIFICATION_CLICK',
                    'icon' => 'myicon',//Default Icon
                    'sound' => 'mySound'//Default sound
                ],
                "notification" => [
                    'body' => $message,
                    'type' => "notify",
                    'title' => 'Alemo',
                    'target_id' => $target_id, // order_id or user_id
                    'msgType' => $msgType,//1=>order , 2=>msg
                    'user_id'=> $user_id,
                    'user_name'=> $user_name,
                    'user_image'=> $user_image,
                    'badge' => 1,
                    "click_action" => 'FLUTTER_NOTIFICATION_CLICK',
                    'icon' => 'myicon',//Default Icon
                    'sound' => 'mySound'//Default sound
                ]
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            $result = curl_exec($ch);
            curl_close($ch);
            // $resultOfPushToIOS = "Done";
            //   return $result; // to check does the notification sent or not
        }

    } catch (\Exception $ex) {
        return $ex->getMessage();
    }


}

function paginate($object)
{
    return [
        'current_page' => $object->currentPage(),
        //'items' => $object->items(),
        'first_page_url' => $object->url(1),
        'from' => $object->firstItem(),
        'last_page' => $object->lastPage(),
        'last_page_url' => $object->url($object->lastPage()),
        'next_page_url' => $object->nextPageUrl(),
        'per_page' => $object->perPage(),
        'prev_page_url' => $object->previousPageUrl(),
        'to' => $object->lastItem(),
        'total' => $object->total(),
    ];
}
