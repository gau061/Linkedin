<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	protected $table = 'menus';

	protected $fillable = ['menu_type','menu_link','menu_order'];
	
    public function createData($input)
    {
    	return static::create(array_only($input,$this->fillable));
    }
    public function getData()
    {	
		return static::select('menus.*','pages.*')
			->join('pages','pages.id','=','menus.menu_link')
			->where('menus.menu_type','header')
			->where('pages.page_status','1')
			->orderBy('menus.menu_order','ASC')
			->get();
    }
}
