<?php

namespace App\Classes;

class SmsGateWayTrigger
{

    public static function  triggerSms($phone_number , $message)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->post(
            'https://www.bulksmsnigeria.com/api/v1/sms/create',
            [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'query' => [
                    'api_token'=> env('SMS_SENDER_API_KEYS'),
                    'to'=> $phone_number,
                    'from'=> env("APP_NAME"),
                    'body'=> $message,
                    'gateway'=> '0',
                    'append_sender'=> '0',
                ],
            ]
        );
        
        $body = $response->getBody();

        return  $body;

//        print_r(json_decode((string) $body));
    }
}
