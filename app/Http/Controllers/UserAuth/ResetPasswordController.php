<?php

namespace App\Http\Controllers\UserAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Frontuser;
class ResetPasswordController extends HomeController
{

	public function __construct()
	{
		parent::__construct();
		$this->frontuser = new Frontuser;
	}

    public function password_reset_form($token)
    {
        if(isset($token) && $token)
        {   
             $data = $this->frontuser->avtivation($token);

            if(is_null($data)){
                return redirect()->route('user.login')->with('error','This Link is expired.');
            } else {
                return view('reset.resetform',compact('token'));
            }
        }
        
    }

    public function updatePassword(Request $request)
    {
        $input = $request->all();
        $token = $request->token;
        $password = $request->password;
        
        $this->validate($request,[
            'email'=>'required|exists:frontusers,email',
            'password' => 'required|same:confirm_password',
            'confirm_password' => 'required',
        ]);
        
        $pwd = bcrypt($password);
        $data = $this->frontuser->password_update($token,$pwd);


        $tok = str_random(60);
        $datas = $this->frontuser->tokeUpdate($request->email,$tok);
        
        return redirect()->route('user.login')->with('success','Password Reset Successfully.');
    }
}
