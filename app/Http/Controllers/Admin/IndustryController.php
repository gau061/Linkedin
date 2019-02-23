<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Industry;

class IndustryController extends AdminController
{
   public function __construct()
	{
        parent::__construct();
        new HomeController;
       $this->industry  = new Industry;
       
	}
	public function industry_index()
	{
		return view('Admin.industry.createindustry');
	}

	public function industry_insert(Request $request)
    {
    	$input = $request->all();

    	$this->validate($request,[
    		'industry_name' => 'required',
    		'industry_desc'=>'required',
    	]);
        $this->industry->createData($input);
        return redirect()->route('industry.display')->with('success','Insert data Successfully.');
    }

    //select data in admin side
    public function industry_display()
	{
		$data = $this->industry->getdata();
		return view('Admin.industry.industryindex',compact('data'));
	}
    
    //update 
        public function editIndustry($id)
    {
        $data = $this->industry->edit($id);
        return view('Admin.industry.updateindustry',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->industry->updateData($id,$input);
        return redirect()->route('industry.display')->with('success','Update Data Successfully.');
    }

    //delete data
       public function show($id)
    {
        $this->industry->deleteData($id);
        return redirect()->route('industry.display')->with('success','Delete Data Successfully.');
    }
}
