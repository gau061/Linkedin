<?php

namespace App\Http\Controllers\UserAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Frontuser;
use App\Userlogin;
use Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct() {
        view()->share('theme','theme.layout.master');
        $this->middleware('guest', ['except' => 'logout']);
        $this->userlogin = new Userlogin;
    }

    public function login_form() {

    	if(Auth::guard('frontuser')->check()){
    		return redirect()->route('feeds');
    	}else{
        	return view('theme.user.login');
    	}
    }

    public function login(Request $request)
    {
    	$input	= $request->all();

        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);

    	if (Auth::guard('frontuser')->attempt(['email' => $input['email'], 'password' => $input['password'],'status' => 1])){

             $userData['current_login'] = \Carbon\Carbon::today()->toDateString();

             $logindata = $this->userlogin->increase_user($userData['current_login']);
             
             if ($logindata == 0) {
                $this->userlogin->createDate($userData['current_login']);    
                $this->userlogin->increase_user($userData['current_login']);
             }

            return redirect()->route('feeds');
        }else{
                $data = Frontuser::where('email',$input['email'])->first();
                if (isset($data->status) && $data->status == 2) {
                    if (!is_null($data->reason)) {
                        return back()->with('errorsa','Your Account is already closed. If you want to active your Account, Contact Admin'. frommail());
                    }
                }elseif(isset($data->status) && $data->status == 0)
                {
                    return back()->with('error','You are Not Active User.');
                }
                elseif(isset($data->status) && $data->status == 3)
                {
                    $mail = '<a href="mailto:'.frommail().'">' . frommail() .'</a>';
                    return back()->with('error','Your accoutn is ban by Admin, Please contact admin '. frommail());
                }
                else{
                    return redirect()->route('user.login')->with('error','Email and Passwors are Wrong.');
                }
        }
    }
    
    public function logout()
    {
    	Auth::guard('frontuser')->logout();

            $userData['current_login'] = \Carbon\Carbon::today()->toDateString();
            $this->userlogin->descrse_user($userData['current_login']);

    	return redirect()->route('index');
    }
}
