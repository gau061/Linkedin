<?php

namespace App\Http\Controllers\OAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Frontuser;
use Socialite;
use Auth;
use Exception;

class SocialController extends Controller
{
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }


    public function redirect($provieder)
    {
        return Socialite::driver($provieder)->redirect();

    }

    public function callback($provieder)
    {           
            $user = Socialite::driver($provieder)->user();
            if (isset($user)) {
                $social = $this->createUser($user,$provieder);
                return redirect()->route('profile.fill','location');
            }
            return redirect()->route('user.signup');

    }


    public function createUser($data,$provieder)
    {
        $udata = Frontuser::where('email',$data->email)->first();

        if (! is_null($udata)) {
            Frontuser::where('email',$data->email)->update(['social_id' => $data->token]);
        } else {
            if ($provieder == 'google') {
                $socail = [
                    'unique_id' => str_shuffle(time()),
                    'firstname' => $data->user['name']['givenName'],
                    'lastname' => $data->user['name']['familyName'],
                    'status' => 1,
                    'email' => $data->email,
                    'social_id' => $data->token,
                ];
            } else {
                $socail = [
                    'unique_id' => str_shuffle(time()),
                    'firstname' => $data->user['firstName'],
                    'lastname' => $data->user['lastName'],
                    'status' => 1,
                    'email' => $data->email,
                    'social_id' => $data->token,
                ];
            }

            $gdata = Frontuser::create($socail);
        }
        $authType = is_null($udata)?$gdata:$udata;
        Auth::guard('frontuser')->login($authType);
        return $udata;
    }
}
