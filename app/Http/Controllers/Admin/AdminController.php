<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Userlogin;

class AdminController extends Controller
{
	public function __construct()
	{
		view()->share('AdminTheme','AdminTheme.master');
		$this->userlogin = new Userlogin;
	}
    public function dashboard()
    {
    	$data = $this->userlogin->getData();

        $chartData = array();
    	foreach ($data as $key => $value) {
    		$chartData[$key]['y']		= $value->current_login;
    		$chartData[$key]['Users']	= $value->no_user;
    	}
    	//dd($chartData);

    	return view('Admin.dashboard.dashboard',compact('chartData'));
    }
}
