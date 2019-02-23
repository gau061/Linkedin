<?php

use Illuminate\Database\Seeder;

class AdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
       	'username'        =>env('ADMIN_USER_NAME', 'admin'),
       	'first_name'      =>env('ADMIN_FIRST_NAME', 'Alphanso'),
       	'last_name'       =>env('ADMIN_LAST_NAME', 'Developer'),
       	'gender'          =>'0',
       	'contacts'        =>'',
       	'profile_pic'     =>NUll,
       	'status'          =>'1',
       	'email'           =>env('ADMIN_EMAIL', 'admin@gmail.com'),
       	'password'        =>bcrypt(env('ADMIN_PASSWORD', '123456')),
       	'remember_token'  =>str_random(60),
        'created_at'      =>date('Y-m-d h:i:s'),
        'updated_at'      =>date('Y-m-d h:i:s')
       ]);
    }
}
