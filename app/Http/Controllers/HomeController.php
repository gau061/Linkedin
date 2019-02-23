<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Mail;

class HomeController extends Controller
{
    public function __construct()
    {
        view()->share('theme','theme.layout.master');
        view()->share('grouptheme','theme.layout.groupmaster');
        $this->settings = new Setting;
    }
    public function index()
    {
        return view('theme.home');
    }

    public function operationMsg($type, $module)
	{
		switch ($type) {
			case 'success':
				return $module . ' created successfully';
				break;
			case 'error':
				return $module . ' deleted successfully';
				break;
			case 'update':
				return $module . ' Update Successfully.';
				break;
			case 'custom':
				return $module . '';
				break;
			
			default:
				# code...
				break;
		}
	}
}
