<?php

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminUser::class);
        $this->call(Role::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(AdminPermission::class);
        $this->call(PrivacyPolicy::class);
        $this->call(FrontUser::class);
    }
}
