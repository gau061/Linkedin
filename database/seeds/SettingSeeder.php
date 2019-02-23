<?php

use Illuminate\Database\Seeder;
use App\Setting;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $frontsetting = [
        	[
        		'name'    => 'Site Title',
        		'slug'    => 'site-title',
        		'value'   => 'Linked In',
        	],[
        		'name'    => 'Site Logo',
        		'slug'    => 'site-logo',
        		'value'   =>  NULL,
        	],[
        		'name'    => 'Site Favicon',
        		'slug'    => 'site-favicon',
        		'value'   =>  NULL,
        	],[
        		'name'    => 'Site Country',
        		'slug'    => 'site-country',
        		'value'   => 'IN',
        	],[
        		'name'    => 'Site Time-Zone',
        		'slug'    => 'site-time-zone',
        		'value'   => 'Asia/Kolkata',
        	],[
        		'name'    => 'Site Mail',
        		'slug'    => 'site-email',
        		'value'   => 'example@mail.com',
        	],[
        		'name'    => 'Site Mail Driver',
        		'slug'    => 'site-mail-driver',
        		'value'   => 'smtp',
        	],[
        		'name'    => 'Site Mail Host',
        		'slug'    => 'site-mail-host',
        		'value'   => 'smtp.gmail.com',
        	],[
        		'name'    => 'Site Mail Port',
        		'slug'    => 'site-mail-port',
        		'value'   => '587',
        	],[
        		'name'    => 'Site Mail Username',
        		'slug'    => 'site-mail-username',
        		'value'   => 'example@mail.com',
        	],[
        		'name'    => 'Site Mail Password',
        		'slug'    => 'site-mail-password',
        		'value'   => 'Password',
        	],[
                'name'  => 'Page Title',
                'slug'  => 'contact-page-title',
                'value' =>'Contact Us',
            ],[
                'name'  => 'Location',
                'slug'  => 'contact-page-location',
                'value' => NULL,
            ],[
                'name'  => 'Address',
                'slug'  => 'contact-page-address',
                'value' => NULL,
            ],[
                'name'  => 'Phone',
                'slug'  => 'contact-page-phone',
                'value' => NULL,
            ],[
                'name'  => 'Email',
                'slug'  => 'contact-page-email',
                'value' => NULL,
            ],[
                'name'  => 'CopyRight Text',
                'slug'  => 'copyright-footer-text',
                'value' => 'Copyright © 2018 Pro-Network All rights reserved.',
            ]
        ];

        foreach ($frontsetting as $key => $value) {
        	Setting::create($value);
        }
    }
}
