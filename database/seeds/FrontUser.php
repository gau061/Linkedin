<?php

use Illuminate\Database\Seeder;

class FrontUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('frontusers')->insert([
	       	'unique_id'			=>str_shuffle(time()),
	       	'firstname'			=>'Alphanso',
	       	'lastname'			=>'Developer',	       	
	       	'status'			=>'1',
	       	'gender'			=>'1',
	       	'email'				=>'alphanso.dev@gmail.com',
	       	'password'			=>bcrypt('123456'),
	       	'remember_token'	=>str_random(60),
	       	'country'			=>'India',
	       	'state'				=>'Gujarat',
	       	'city'				=>'Rajkot',
	       	'postalcode'		=>'360002',
	        'created_at'		=>date('Y-m-d h:i:s'),
	        'updated_at'		=>date('Y-m-d h:i:s')
       	]);
    }
}
