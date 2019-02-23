<?php

function notificationMsg($type, $message){
        \Session::put($type, $message);
}


function getImage($image,$prefix='') {
	if($prefix != '')
		$prefix	= $prefix.'-';
	$img = defaultImage($prefix);
	
	if(empty($image) && is_null($image)) 
		return $img;

	$data = unserialize($image);
	$path 	= $data['image_path'];
	$img_nm	= $data['image_name'];
	$newpath = str_replace(asset('/'),'',$path);

	if(Storage::disk('public')->exists($path.'/'.$prefix.$img_nm)) {
		$img = Storage::disk('public')->url($path.'/'.$prefix.$img_nm);		
	}	
	return $img;
}

function defaultImage($prefix=''){
	return asset('public/default/'.$prefix.'image-not-found.jpg');
}
function userDefaultImage(){
	return asset('public/default/user-icon.jpg');
}

function uploadImage($image,$upath='',$prefix='',$width=800,$height=800,$thumbsize=300) {
	$path = ($upath=='')?'images/'.date('Y').'/'.date('m'):$upath;
    $storepath = Storage::disk('public')->path($path);

	if (!is_dir($storepath)) {
        \File::makeDirectory($storepath,0777,true);
    }
    if (!empty($image)) {
        $imageName = $prefix.'-'.time().'-'.str_random(5).'.'.$image->getClientOriginalExtension();

        $upload_image = Image::make($image->getRealPath())->resize($width,$height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $upload_image->save($storepath.'/'.$imageName);

        $thumb = Image::make($storepath.'/'.$imageName)->fit($thumbsize,$thumbsize)->save($storepath.'/'.'thumb'.'-'.$imageName);

        $post_image = ['image_path' => $path.'/','image_name'=>$imageName];
        return serialize($post_image);
    } else {
        return 'null';
    }
}
function uploadCustomeImage($image,$upath='',$prefix='',$type='resize',$width=300,$height=300){
	$path = ($upath=='')?'images/'.date('Y').'/'.date('m'):$upath;
    $storepath = Storage::disk('public')->path($path);

	if (!is_dir($storepath)) {
        \File::makeDirectory($storepath,0777,true);
    }
    $imageName = $prefix.'-'.time().'-'.str_random(5).'.'.$image->getClientOriginalExtension();

    if($type=='crop'){
	    $upload_image = Image::make($image->getRealPath())->fit($width,$height, function ($constraint) {
	        $constraint->aspectRatio();
	    });
    }else{
    	$upload_image = Image::make($image->getRealPath())->resize($width,$height, function ($constraint) {
	        $constraint->aspectRatio();
	    });
    }
    $upload_image->save($storepath.'/'.$imageName);
    $post_image = ['image_path' => $path.'/','image_name'=>$imageName];
    return serialize($post_image);
}


function image_delete($img) {
	$data = unserialize($img);
	$path = $data['image_path'];
	$image = $data['image_name'];	
	if(Storage::disk('public')->exists($path.$image)){
		Storage::disk('public')->delete($path.$image);
	}
	if(Storage::disk('public')->exists($path.'thumb-'.$image)){
		Storage::disk('public')->delete($path.'thumb-'.$image);
	}
	return true;
}


/* ================================================================= */
/* SITE DATA FUNCTION */
/* ================================================================= */
function frommail() {
	$emaills = env('COMPANY_EMAIL', 'alphanso.dev@gmail.com');
	return $emaills;
}
function forcompany(){
	$company = env('COMPANY_NAME', 'PRO-Network');
	return $company;
}
function for_logo(){
	return $logo = asset('public/img/logo.png');
}

function status($val){
	if($val == 1):
		echo $active = '<span class="label label-success">Active</span>';
	else:
		echo $deactive = '<span class="label label-danger">Deactive</span>';
	endif;
}

function frontuser_alert($val){
	$output = array();
	if($val == 1):
		$output['class'] 	= 'alert alert-success';
		$output['message']	= 'Active';
	elseif($val == 2):
		$output['class'] 	= 'alert alert-warning';
		$output['message']	= 'Close';		
	elseif($val == 3):
		$output['class'] 	= 'alert alert-danger';
		$output['message']	= 'Ban';
	else:
		$output['class'] 	= 'alert alert-info';
		$output['message']	= 'Not Active';
	endif;
	return $object = (object) $output;	
}

function gender($data) {
	if($data == 0):
		return 'Male';
	else:
		return 'Female';
	endif;
}
/* ================================================================= */

/* ================================================================= */
/* FRONT USER DATA */
/* ================================================================= */
function chackeAuth(){
	return \Auth::guard('frontuser')->check()?TRUE:FALSE;
}
function chackeAuthUser(){
	return \Auth::guard('frontuser')->check()?\Auth::guard('frontuser')->user()->id:'';
}
function usernames() {
	$fnm = auth()->guard('frontuser')->user()->firstname;
	$lnm = auth()->guard('frontuser')->user()->lastname;
	$uid = auth()->guard('frontuser')->user()->unique_id;
	$uiid = strtolower($fnm).'_'.strtolower($lnm).'-'.$uid;
	return $uiid;
}

function uniquequ_id() {
	return $uid = auth()->guard('frontuser')->user()->unique_id;
}

function fusername(){
	if(auth()->guard('frontuser')->check()):
		$fullname = auth()->guard('frontuser')->user()->firstname.' '.auth()->guard('frontuser')->user()->lastname;
	else:
		$fullname = '';
	endif;
	return $fullname;
}
function fuserEmail(){
	if(auth()->guard('frontuser')->check()):
		$userEmail = auth()->guard('frontuser')->user()->email;
	else:
		$userEmail = '';
	endif;
	return $userEmail;
}
function userProPic(){
	if(auth()->guard('frontuser')->check()):
		$uproPic = auth()->guard('frontuser')->user()->profile_pic;
		$userproPic = profile_pic($uproPic);
	else:
		$userproPic = userDefaultImage();
	endif;
	return $userproPic;
}

function profile_pic($image,$prefix='') {
	$img = userDefaultImage();
	if($prefix != '')
		$prefix	= $prefix.'-';

	if(empty($image) && is_null($image)) 
		return $img;

	$data = unserialize($image);
	$path 	= $data['image_path'];
	$img_nm	= $data['image_name'];	

	if(Storage::disk('public')->exists($path.'/'.$prefix.$img_nm)) {
		$img = Storage::disk('public')->url($path.$prefix.$img_nm);		
	}	
	return $img;
}
function cover_image($image,$prefix='') {	
	$img = asset('public/default/cover-pic.jpg');
	if($prefix != '')
		$prefix	= $prefix.'-';

	if(empty($image) && is_null($image)) 
		return $img;

	$data = unserialize($image);
	$path 	= $data['image_path'];
	$img_nm	= $data['image_name'];	

	if(Storage::disk('public')->exists($path.'/'.$prefix.$img_nm)) {
		$img = Storage::disk('public')->url($path.'/'.$prefix.$img_nm);
	}	
	return $img;
}

function user_data($user_id) {

	$output = array();
	$userData 	= \DB::table('frontusers')->where('id', $user_id)->first();
    if($userData == null){
	 	$data1 	= \DB::table('frontusers')->where('unique_id', $user_id)->first();
    	$data2 	= \DB::table('frontusers')->where('email', $user_id)->first();
    	$userData = is_null($data1)?$data2:$data1;
    }

	if($userData != null){
		$output['id']			= $userData->id;
		$output['Name'] 		= $userData->firstname." ".$userData->lastname;
		$output['Email']		= $userData->email;
		$output['ProPic']		= profile_pic($userData->profile_pic);
		$output['CoverPic']		= cover_image($userData->cover_pic);
		$output['unique_id'] 	= $userData->unique_id; 
		$output['city'] 		= $userData->city; 
		$output['gender'] 		= $userData->gender; 
		$output['state'] 		= $userData->state; 
		$output['country'] 		= $userData->country; 
		$output['cellphone'] 	= $userData->cellphone; 
		$output['website'] 		= $userData->website;
		$output['token'] 		= $userData->remember_token;
		$output['user_id']		= strtolower($userData->firstname).'_'.strtolower($userData->lastname).'-'.$userData->unique_id;
		return $object = (object) $output;
	} else {
		$output['Name'] 		= null;
		$output['Email']		= null;
		$output['ProPic']		= null;
		$output['CoverPic']		= null;
		$output['unique_id'] 	= null;
		$output['city'] 		= null;
		$output['gender'] 		= null;
		$output['state'] 		= null;
		$output['country'] 		= null;
		$output['cellphone'] 	= null;
		$output['website'] 		= null;
		$output['user_id']		= null;
		return $object = (object) $output;
	}
}
function user_uniqueid_data($user_unique_id) {

	$userData = \DB::table('frontusers')->where('unique_id', $user_unique_id)->first();
	$output = array();
	if($userData != null){
		$output['id'] 		= $userData->id; 
		$output['Name'] 	= $userData->firstname." ".$userData->lastname;
		$output['Email']	= $userData->email;
		$output['ProPic']	= profile_pic($userData->profile_pic);
		$output['user_id']	= strtolower($userData->firstname).'_'.strtolower($userData->lastname).'-'.$userData->unique_id;
		return $object = (object) $output;
	}else{
		$output['id'] 		= null;
		$output['Name'] 	= null;
		$output['Email']	= null;
		$output['ProPic']	= null;
		$output['user_id']	= null;
		return $object = (object) $output;
	}
}

// function user_email($user_email) {
// 	$userData = \DB::table('frontusers')->where('email', $user_email)->first();
// 	$output = array();
// 	if($userData != null){
// 		$output['id'] 		= $userData->id; 
// 		$output['Name'] 	= $userData->firstname." ".$userData->lastname;
// 		$output['Email']	= $userData->email;
// 		$output['ProPic']	= profile_pic($userData->profile_pic);
// 		$output['user_id']	= strtolower($userData->firstname).'_'.strtolower($userData->lastname).'-'.$userData->unique_id;
// 		return $object = (object) $output;
// 	}else{
// 		$output['id'] 		= null;
// 		$output['Name'] 	= null;
// 		$output['Email']	= null;
// 		$output['ProPic']	= null;
// 		$output['user_id']	= null;
// 		return $object = (object) $output;
// 	}
// }

/* ================================================================= */

/* ================================================================= */
/* ADMIN USER DATA */
/* ================================================================= */
function adminUserData($user_id){
	$userData = \DB::table('users')->where('id', $user_id)->first();
	$output['Name'] 	= $userData->first_name." ".$userData->last_name;
	$output['Email']	= $userData->email;
	$output['ProPic']	= profile_pic($userData->profile_pic, 'thumb');
	return $object = (object) $output;
}


/* ================================================================= */
/* ================================================================= */
/* ================================================================= */
/* ================================================================= */


/* ================================================================= */
/* ================================================================= */


// function setImage($image){
// 	if(!isset($image) && is_null($image) || isset($image) && $image == '') 
// 		return $img = '/upload/default/user.png';
// 	$data = unserialize($image);
// 	$path = $data['image_path'];
// 	$img_nm = $data['image_name'];
// 	return $pic_data = asset($path).'/'.$img_nm;
// }

// function setThumbnail($image){
// 	if(!isset($image) && is_null($image) || isset($image) && $image == '') 
// 		return $img = '/upload/default/user.png';
// 	$data = unserialize($image);
// 	$path = $data['image_path'];
// 	$img_nm = $data['image_thumbnail'];
// 	$newpath = str_replace(asset('/'),'',$path);
// 	if(! \File::exists($newpath.$img_nm)) {
// 		$img = '/upload/default/user.png';
// 		return $img;
// 	}	
// 	return $pic_data = asset($path).'/'.$img_nm;
// }

// function save_image($path,$image_name) {
// 	$profile_pic = ['image_path' => $path.'/','image_name'=>$image_name,'image_thumbnail' => 'thumb-'.$image_name];
// 	return $img = serialize($profile_pic);
// }
