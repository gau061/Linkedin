<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\User;
use DB;
use Carbon\Carbon;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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

    public function password_reset_form($token)
    {
        if(isset($token) && $token)
        {   
             $data = $this->user->checkValid($token);

            if(is_null($data)){
                return redirect()->route('login')->with('error','This Link is expired.');
            } else {
                return view('Admin.login.pwdresetform',compact('token'));
            }
        }
        
    }

    public function updatePassword(Request $request)
    {
        $input = $request->all();
        $token = $request->token;
        $password = $request->password;
        
        $this->validate($request,[
            'email'=>'required|exists:users,email',
            'password' => 'required|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        $pwd = bcrypt($password);
        $data = $this->user->updateData($token,$pwd);


        $tok = str_random(60);
        $datas = $this->user->upDatetoken($request->email,$tok);


        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $tok,
            'created_at' => Carbon::now()
        ]);
        return redirect()->route('login')->with('success','Password Reset Successfully.');
    }
}
