<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function loginForm(){
        return view('auth.login');
    }
    public function postLogin(Request $request){
        $request->validate(
            [
                'email' => [
                    "required",
                    "email",
                    function($attribute, $value, $fail){
                        if(!strpos($value, "@fpt.edu.vn")){
                            $fail("$attribute phải là đuôi @fpt.edu.vn");
                        }
                    }
                ],
                'password' => "required"
            ],
            [
                'email.required' => "Hãy nhập email",
                'email.email' => "Không đúng định dạng email",
                'password.required' => "Hãy nhập mật khẩu",
            ]
        );

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect(route('plane.index'));
        }else {
            return redirect()->back()->with('msg', 'Tài khoản/mật khẩu không chính xác');
        }
    }

}
