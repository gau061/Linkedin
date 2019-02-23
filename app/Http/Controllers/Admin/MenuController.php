<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Page;
use App\Menu;
class MenuController extends AdminController
{
    public function __construct()
    {
    	parent::__construct();
    	$this->menu = new Menu;
    }

    public function index()
    {		
    	$data           = Page::get();
        $menu           = Menu::where('menu_type','header')->pluck('menu_link','menu_link')->all();
    	$menu_order     = Menu::where('menu_type','header')->get()->toArray();

        $menu_fotaer    = Menu::where('menu_type','footer')->pluck('menu_link','menu_link')->all();
        $menu_fooder    = Menu::where('menu_type','footer')->get()->toArray();

        $mnord = array();
        foreach ($menu_order as $key => $value) {
            $mnord[$value['menu_link']] = $value['menu_order'];
        }

        $mford = array();
        foreach ($menu_fooder as $key => $value) {
            $mford[$value['menu_link']] = $value['menu_order'];
        }

    	return view('Admin.menus.index',compact('data','menu','mnord','menu_fotaer','mford'));
    }

    public function store($slug, Request $request)
    {	
    	$input = $request->all();	

    	$input['order'] = isset($input['order'])? $input['order'] : '' ;

        if ($slug == 'header' && !empty($input)) {

                $data = Menu::where('menu_type','header')->delete();
                $msg = 'Header';
                if (empty($input['page'])) {
                    return redirect()->back()->with(['success' => 'Header Menu Settings Updated.']);
                }

        }else{

            $data = Menu::where('menu_type','footer')->delete();
            $msg = 'Footer';
            if (empty($input['page'])) {
                return redirect()->back()->with(['success' => 'Footer Menu Settings Updated.']);
            }

        }
        
        foreach ($input['page'] as $key => $value) {
            $data = [];
            $data['menu_type'] = $slug;
            $data['menu_link'] = $value;
            $data['menu_order'] = $input['order'][$key];
            $this->menu->createData($data);
        }

        return redirect()->back()->with(['success' => $msg.' '.'Menu Settings Updated.']);
    }
    
        
}
