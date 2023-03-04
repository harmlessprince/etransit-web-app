<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\NewsletterSubscriber;

class NewsletterController extends Controller
{
    public function addSubscriber(Request $request) {
        $validator = Validator::make($request->all(), [
            "email" => "required|email|regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/",
        ]);

        if($validator->fails()){
            $response = array("status" => "failed", "message" => $validator->messages()->first());
            return Response::json($response);
        }

        $check = NewsletterSubscriber::where('email', $request->email)->first();

        if($check){
            $response = array("status" => "failed", "message" => "you have subscribed already!!");
            return Response::json($response);
        }

        $data = new NewsletterSubscriber();
        $data->email = $request->email;
        $data->status = 1;
        $data->save();

        $response = array("status" => "success", "message" => "Thanks for subscribing to our newsletter");
        return Response::json($response);
    }
}
