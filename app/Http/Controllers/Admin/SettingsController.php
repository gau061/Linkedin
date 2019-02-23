<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Setting;

class SettingsController extends AdminController
{
	public function __construct()
    {
    	parent::__construct();
    	$this->settings = new Setting;
    }   

    public function index()
    {
    	$settings = $this->settings->getSettings();
    	return view('Admin.settings.index',compact('settings'));
    }

    public function update(Request $request)
    {
    	$input = $request->all();

        $this->validate($request,[
            'site-logo' => 'mimes:jpeg,jpg,png|image',
            'site-title' => 'required',
            'site-country' => 'required',
            'site-time-zone' => 'required',
            'site-email' => 'required',
            'site-mail-port' => 'required',
            'site-mail-driver' => 'required',
            'site-mail-username' => 'required',
            'site-mail-host' => 'required',
            'site-mail-password' => 'required',
        ]);

        if (!empty($input['site-logo'])) {
            	
            $logo = uploadCustomeImage($input['site-logo'],'sitedata','site','',270,50);
            $input['site-logo'] = $logo;

            if (!empty($input['image_old'])) {
                image_delete($input['image_old']);
            }
        }else{
            $input['site-logo'] = $input['image_old'];
        }


         if (!empty($input['site-favicon'])) {
                
            $logo = uploadCustomeImage($input['site-favicon'],'sitedata','site','',50,50);
            $input['site-favicon'] = $logo;

            if (!empty($input['favicon_old'])) {
                image_delete($input['favicon_old']);
            }
        }else{
            $input['site-favicon'] = $input['favicon_old'];
        }


        $this->settings->updateSettings($input);
        return redirect()->back()->with('success','Site Settings is Updated.');
    }
}	
