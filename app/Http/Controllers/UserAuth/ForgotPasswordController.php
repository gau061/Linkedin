<?php

namespace App\Http\Controllers\UserAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Mail;
use App\Frontuser;
class ForgotPasswordController extends HomeController
{
    
    public function __construct()
	{
		parent::__construct();
		$this->frontuser = new Frontuser;
	}

    public function emailForm()
    {
    	return view('reset.email');
    }

     public function token_gen(Request $request)
    {

        $this->validate($request,[
            'email'=>'required|email|exists:frontusers,email',
        ]);

       $email = $request->email;
       $data = $this->frontuser->checkmail($email);
       $token = $data->remember_token;
       $mail = array($request->email);

        Mail::send('reset.mail',['test'=>$token],function($message) use ($mail)
        {
            $message->from(frommail(), forcompany())->subject("Reset Password");
            $message->to($mail);
        });

        return redirect()->route('user.login')->with('success','Reset link send in ' .$email);
    }
}
