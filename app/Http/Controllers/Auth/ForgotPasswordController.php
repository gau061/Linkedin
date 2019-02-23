<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Mail;
use App\User;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->user = new User;
    }

    public function pwd_form()
    {
       return view('Admin.login.reset');
    }



    public function token_gen(Request $request)
    {

        $this->validate($request,[
            'email'=>'required|email|exists:users,email',
        ]);

       $email = $request->email;
       $data = $this->user->findData($email);
       $token = $data->remember_token;
       $mail = array($request->email);

        Mail::send('Admin.login.mail',['test'=>$token],function($message) use ($mail)
        {
            $message->from(frommail(), forcompany())->subject("Reset Password");
            $message->to($mail);
        });

        return redirect()->route('login')->with('success','Reset link send in ' .$email);

    }
}
