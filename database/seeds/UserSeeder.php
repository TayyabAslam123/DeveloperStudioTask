<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
            ##clear all users
            User::truncate();
            ##make admin 
    		$user = new User;
            $user->name = "Administrator";
    		$user->email = "admin@admin.com";
    		$user->password = \Hash::make('12345678');
            $user->isadmin=1;
    		$user->save();
    	
    }
}
