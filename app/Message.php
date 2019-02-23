<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * Fields that are mass assignable
     *
     * @var array
     */

    protected $table = 'messages';
    
    protected $fillable = ['sender_id','reciver_id','chatbox_id','message','read'];

    public function createData($input)
    {
        return static::create(array_only($input,$this->fillable));
    }


    public function getMessaged($u_id) {

        $GLOBALS['u_id'] = $u_id;
        $data = Message::where(function($query){
                $query->where('reciver_id',  $GLOBALS['u_id'])
                      ->where('sender_id', uniquequ_id())
                      ->where('chatbox_id', 'R_'. $GLOBALS['u_id']);
            })
            ->Orwhere(function($query){
                $query->where('sender_id',  $GLOBALS['u_id'])
                      ->where('reciver_id', uniquequ_id())
                      ->where('chatbox_id', 'S_'. $GLOBALS['u_id']);
            })
            ->orderBy('created_at', 'ASC')
            ->get();

        return $data;

    }

    public function deleteMsg($unique_id)
    {
        $GLOBALS['u_id'] = $unique_id;
        
        $data = Message::where(function($query){
                $query->where('sender_id', uniquequ_id())
                      ->where('reciver_id',$GLOBALS['u_id'])
                      ->where('chatbox_id','R_'.$GLOBALS['u_id']);
            })
            ->Orwhere(function($query){
                $query->where('sender_id',$GLOBALS['u_id'])
                      ->where('reciver_id',uniquequ_id())
                      ->where('chatbox_id','S_'.$GLOBALS['u_id']);
            })
            ->delete();
      return $data;
    }


    public function getMsgNoti()
    {
      return static::where('reciver_id',uniquequ_id())
                    ->where('chatbox_id','R_'.uniquequ_id())
                    ->where('read',0)
                    ->count();
    }

    public function getMesgList()
    {
      return static::where('reciver_id',uniquequ_id())
                  ->where('chatbox_id','R_'.uniquequ_id())
                  ->where('read',0)
                  ->groupBy('sender_id')
                  ->pluck('sender_id')
                  ->toArray();
    }
    public function getMesgRead()
    {
      return static::where('sender_id',uniquequ_id())
                  ->where('chatbox_id','S_'.uniquequ_id())
                  ->where('read',1)
                  ->groupBy('reciver_id')
                  ->pluck('reciver_id')
                  ->toArray();
    }
}
