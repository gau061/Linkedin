<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Page;
use App\Setting;

class PageController extends AdminController
{
	public function __construct()
	{
        parent::__construct();
        new HomeController;
        $this->page = new Page;
        $this->settings = new Setting;
	}

	public function page_index()
	{
		return view('Admin.pages.create');
	}

	public function page_create(Request $request)
	{
		$input = $request->all();

		$this->validate($request,[
			'page_title'	=>	'required',
			'page_desc'		=>	'required',
		]);

		if($request->has('page_image')){
            $path = 'page/'.date('Y').'/'.date('m'); 
            $input['page_image'] = uploadImage($request->file('page_image'),$path,'page-image',1200);
        }

        $input['page_slug'] = str_slug($input['page_title']);
		$this->page->createData($input);
		return redirect()->back()->with(['success' => 'Page Create Successfully.']);
	}

    public function pages($slug)
    {
    	$settings = Page::where('page_slug',$slug)->first();
    	return view('Admin.pages.pages',compact('settings'));
    }
    public function pages_update(Request $request,$slug)
    {
    	$input = $request->all();
    	$this->validate($request,[
    		'page_title'	=>	'required',
			'page_desc'		=>	'required',
    	]);

    	if($request->has('page_image')){
            $path = 'page/'.date('Y').'/'.date('m'); 
            $input['page_image'] = uploadImage($request->file('page_image'),$path,'page-image',1200);
            	if(!empty($input['old_image'])){
            		image_delete($input['old_image']);
            	}
        }
     	$this->page->updateData($slug,$input);
		return redirect()->back()->with(['success' => 'Page Updated Successfully.']);   
    }

    public function delete_pages($id)
    {
        $data = Page::where('id',$id)->first();
        if(!empty($data['page_image'])){
              image_delete($data['page_image']);
        }
        $data->delete();
        return redirect()->route('page.index')->with(['success' => 'Page Deleted Successfully.']);   
    }

    public function dynamic_page($slug){
        $data  = Page::where('page_slug',$slug)->where('page_status',1)->first();

        if(is_null($data))
        {
            \App::abort(404,'Sorry, Page Not Found !!!');
        }        
        
        return view('theme.pages.index',compact('data'));
    }

    public function contact_index()
    {
        $settings = $this->settings->getSettings();
        return view('Admin.pages.contact',compact('settings'));
    }
    public function contact_update(Request $request)
    {   
        $input = $request->all();
        $this->validate($request,[
            'contact-page-title' => 'required',
            'contact-page-location' => 'required',
            'contact-page-address' => 'required',
            'contact-page-phone' => 'required',
            'contact-page-email' => 'required',
        ]);

        $this->settings->updateSettings($input);
        return redirect()->back()->with('success','Contact Page Updated.');
    }
}




