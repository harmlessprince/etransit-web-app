<?php

namespace App\Http\new_Controllers;

use Illuminate\Http\Request;

class WhatsAppApi extends Controller
{
    public function sendWhatsAppMessage()
    {
       $api = "https://api.whatsapp.com/send?phone=85264318721&text=Hello%20how%20u%20dey";
    }
}
