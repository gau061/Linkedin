<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
     protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = new User;
        $this->middleware('guest')->except('logout');
    }

    public function show_form() {

       if(auth()->check())
       {
          return redirect()->route('admin.index');
       }
       else
       {
           return view('Admin.login.login');
       }
    }

    public function login_post(Request $request)
    {
        $input = $request->all();

        $this->validate($request,[
            'email'=>'required',
            'password'=>'required',
        ]);

        if (Auth::attempt(['email' => $input['email'],'password' => $input['password'],'status' => 1])) {
                $id = auth()->user()->id;

                $cur_login = Carbon::now(); 

                $this->user->setLoginTime($id,$cur_login);

                $data = User::where('id',$id)->first();

                if($data['last_login'] == NULL)
                {
                    $this->user->updateLast_time($id,$cur_login);
                }
            return redirect()->route('admin.index');
        } else {
            $data = User::where('email',$input['email'])->first();
            if (isset($data->status) && $data->status == 0) {
                return redirect()->route('login')->with('error','Your Account is not Active. Please Contact Admin.');
            } else {
                return redirect()->route('login')->with('error','Email and Passwors are Wrong.');
            }
        }
    }
    public function logout()
    {
        $id = auth()->user()->id;
        $cur_login = Carbon::now(); 
        $this->user->updateLast_time($id,$cur_login);
        Auth::logout();        
        return redirect()->route('login');
    }
}
