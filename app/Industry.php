<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
		protected $table='group_industrys';
	   	protected $fillable = ['industry_name','industry_desc'];

		public function createData($input)
		{
		return static::create(array_only($input,$this->fillable));
		}
		public function getdata()
		{
		return static::get();
		}

		public function selectIndustry($gid){
		$uid=auth()->guard('frontuser')->user()->id;	
        return static::select('group_industrys.industry_name','group_profiles.group_id','group_profiles.industry')
        ->join('group_profiles','group_profiles.industry','=','group_industrys.id')
        ->where('group_profiles.group_id',$gid)
        // ->where('group_profiles.user_id',$uid)
        ->get();
     	}

		//update
		public function edit($id)
		{
		return static::find($id);
		}
		public function updatedata($id,$input)
		{
		return static::find($id)->update(array_only($input,$this->fillable));
		}
		//delete
		public function deleteData($id)
		{
		$data = static::find($id);
		$data->delete();
		}
}
