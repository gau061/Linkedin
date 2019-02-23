<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\User;
use App\Role;
use App\RoleUser;
use Mail;

class UsersController extends AdminController
{
    public function __construct()
	{
		parent::__construct();
		$this->user = new User;
        $this->roles = new Role;
		$this->roleuser = new RoleUser;
	}
    public function index()
    {
    	$data = $this->user->getData();
    	return view('Admin.user.index',compact('data'));
    }
    public function create()
    {	
    	$data = $this->roles->getRole();
    	return view('Admin.user.create',compact('data'));
    }
    public function store(Request $request)
    {	
    	$input = $request->all();
    	$this->validate($request,[
    		'first_name'=>'required',
    		'last_name'=>'required',
    		'role_id'=>'required',
            'contacts'=>'required',
    		'email'=>'required|email|unique:users,email',
    	]);

        $date = date('d', strtotime($input['brith_date']));
 
        $input['username'] = $input['first_name'].'_'.$date;
    	$input['password'] = str_random(8);

       $mail = array($request->email);

        Mail::send('Admin.mail.pwdmail',['password'=>$input['password'],'username'=>$input['email']],function($message) use ($mail)
        {
            $message->from(frommail(),forcompany())->subject("Login Id or Password");
            $message->to($mail);
        });

        $input['password'] = bcrypt($input['password']);
        $input['remember_token'] = str_random(60);

        $user = $this->user->createData($input);


            $roleId = $this->roles->getRoleId($input['role_id']);

            $roleData = [];
            $roleData['user_id'] = $user->id;
            $roleData['role_id'] = $roleId->id;
            
            $role = $this->roleuser->addRoleUser($roleData);

    	return redirect()->route('users.index')->with('success','Admin Created Successfully');
    }
    public function edit($id)
    {
        $data = $this->user->findsData($id);
    	$listrole = $this->roles->getRole();
        $roleslists = $this->roleuser->getRoleUser($data->id);

    	return view('Admin.user.edit',compact('data','listrole','roleslists'));
    }
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'brith_date'=>'required',
            'role_id'=>'required',
            'contacts'=>'required',
        ]);
        $data = $this->user->updateUserData($input,$id);
        $this->roleuser->updateRoleUser($id,$input['role_id']);
        return redirect()->route('users.index')->with('success','User Update Successfully');
    }
    
    public function show($id)
    {
        $show = User::find($id);
        return view('Admin.user.model',compact('show'));
    }

    public function destroy($id)
    {
        $this->user->deleteData($id);
        return redirect()->route('users.index')->with('success','User Delete Successfully');
    }
}
