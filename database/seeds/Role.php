<?php

use Illuminate\Database\Seeder;

class Role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name'          => 'master_admin',
            'display_name'  => 'Master Admin',
            'description'   => 'Master Admin Role',
            'created_at'    =>  \Carbon\Carbon::now(),
            'updated_at'    =>  \Carbon\Carbon::now()
        ]);

         DB::table('role_user')->insert([
	        'user_id'  => '1',
	        'role_id'  => '1'
       	]);
    }
}
