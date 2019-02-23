<?php

use Illuminate\Database\Seeder;

class AdminPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            [
                'permission_id'     => '1',
                'role_id'           => '1',
            ],
            [
                'permission_id'     => '2',
                'role_id'           => '1',
            ],
            [
                'permission_id'     => '3',
                'role_id'           => '1',
            ],
            [
                'permission_id'     => '4',
                'role_id'           => '1',
            ],
            [
                'permission_id'     => '5',
                'role_id'           => '1',
            ],
            [
                'permission_id'     => '6',
                'role_id'           => '1',
            ],
        ];

        foreach ($permission as $key => $value) {
        	 DB::table('permission_role')->insert($value);
        }
    }
}
