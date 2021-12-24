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

            // $emailData=[
            //     'mmaz13841384@gmail.com',
            //     'hello orak'
            // ];
            // Mail::send(new infoMail($emailData));
    }
}
