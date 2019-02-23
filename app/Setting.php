<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Setting;

class Setting extends Model
{

	protected $table = 'settings';

	protected $fillable = [
        'name', 'slug', 'value',
    ];

    public function getSettings()
    {
        $data = Setting::get()->toArray();
        $result = [];
        foreach ($data as $key => $value) {
            $result[$value['slug']] = $value;
        }
        return $result;
    }

    public function updateSettings($input)
    {
        foreach ($input as $key=>$value){
           Setting::where('slug',$key)->update(array('value'=>$value));  
        }
        return;
    }
}
