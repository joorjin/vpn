<?php

namespace App\Http\Controllers;

use App\Mail\infoMail;
use App\Models\api_key;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function test()
    {

            $emailData=[
                'joorjin2@gmail.com',
                '11111'
            ];
            Mail::send(new infoMail($emailData));
    }
}
