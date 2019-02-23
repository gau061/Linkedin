<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $table = 'friend_request';

    protected $fillable = ['sender_id','reciver_id'];

    public function createData($input)
    {
    	return static::create(array_only($input,$this->fillable));
    }

    public function checkRequest($input)
    {
    	return static::where('sender_id',$input['sender_id'])
    				 ->where('reciver_id',$input['reciver_id'])
    				 ->Orwhere('sender_id',$input['reciver_id'])
    				 ->where('reciver_id',$input['sender_id'])
    				 ->first();
    }

    public function checkRequestFof()
    {
        return static::where('sender_id',chackeAuthUser())
                     ->where('request_status','Pending')
                     // ->get()
                     ->pluck('reciver_id')
                     ->toArray();
    }


    public function ReqCancel($input)
    {
        return static::where('sender_id',$input['sender_id'])
                     ->where('reciver_id',$input['reciver_id'])
                     ->Orwhere('sender_id',$input['reciver_id'])
                     ->where('reciver_id',$input['sender_id'])
                     ->delete();
    }

    public function accept($sender_id,$reciver_id)
    {
        return static::where('sender_id',$sender_id)
                     ->where('reciver_id',$reciver_id)
                     ->update(['request_status' => 'Connected']);
    }

    public function ignore($sender_id,$reciver_id)
    {
        return static::where('sender_id',$sender_id)
                     ->where('reciver_id',$reciver_id)
                     ->delete();
    }
}
