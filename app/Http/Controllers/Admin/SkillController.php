<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Skill;

class SkillController extends AdminController
{
	public function __construct()
	{	
		parent::__construct();
		$this->skills = new Skill;
	}
    
    public function index()
    {
    	$data = $this->skills->getData();
    	return view('Admin.skills.index',compact('data'));
    }
    public function store(Request $request)
    {
    	$input = $request->all();
    	$validate = $this->validate($request,[
    		'skills' => 'required',
    	]);
			$this->skills->createData($input);
    	return redirect()->back()->with(['success' => 'Skills Successfully Added.']);
    }
    public function update(Request $request,$id)
    {
    	$input = $request->all();
    	$validate = $this->validate($request,[
    		'skills' => 'required',
    	]);
			$this->skills->updateData($id,$input);
    	return redirect()->back()->with(['success' => 'Skills Successfully Updated.']);
    }
    public function remove($id)
    {
    	$this->skills->deleteData($id);
    	return redirect()->back()->with(['success' => 'Skills Successfully Deleted.']);	
    }
}
