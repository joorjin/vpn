<?php

namespace App\Http\Controllers;

use App\Mail\infoMail;
use App\Models\api_key;
use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

class UserController extends Controller
{

    public function all()
    {
        $user= User::all();
        return Response()->json([
            $user
        ]);
    }

    public function get(Request $request,$email)
    {
        $valid = ['email'=>$email];
        $validator = Validator::make($valid, [
            'email' => 'email',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors();
            return Response()->json([
                "err"=>$message,
            ],400);
        }

            $user= User::where('email',$email)->get();

        return Response()->json([
            $user
        ]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:200',
            'email'=> 'required|email|max:250',
            'password'=>'required|min:8'
        ]);

        if ($validator->fails()) {
            $message = $validator->errors();
            return Response()->json([
                "err"=>$message,
            ],400);
        }


                    // rand
                    $seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                    .'abcdefghijklmnopqrstuvwxyz'
                    .'*/-!@#$%^&*+=-'
                    .'0123456789');
                    shuffle($seed);
                    $rand ='';
                    foreach (array_rand($seed, 53) as $k){
                        $rand .= $seed[$k];
                    }

                if (User::where('email',$request->email)->count()) {
                    return Response()->json([
                        "status"=>"Email already available",
                    ],400);
                    exit(1);
                }

        $emailCode=rand(10000,99999);
        $user = new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->email_status=$emailCode;
        $user->password=sha1($request->password);
        $user->remember_token=$rand;
        $user->save();

        $emailData=[
            $request->email,
            $emailCode
        ];
        Mail::send(new infoMail($emailData));

        return Response()->json([
            "status"=>"successful",
            "user_id"=>$user->id,
        ]);
    }
    public function emailCheckCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userId' => 'required|integer',
            'code'=>'required|integer'
        ]);

        if ($validator->fails()) {
            $message = $validator->errors();
            return Response()->json([
                "err"=>$message,
            ],400);
        }

        $user = User::where('id',$request->userId)->get();
        if($user->count()){

            if ($user[0]->email_status==$request->code) {
                User::where('id',$request->userId)->update(['email_status' => 'confirmed']);
                return Response()->json([
                    "status"=>"successful",
                ],200);
            }else{
                return Response()->json([
                    "status"=>"Incorrect code",
                ],400);
            }

        }else{
            return Response()->json([
                "status"=>"No user",
            ],400);
        }
    }
}
