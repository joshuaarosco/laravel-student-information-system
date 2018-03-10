<?php

use App\Laravel\Models\User;
use Illuminate\Database\Seeder;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$existing_super_user = User::where('username', "admin")->first();
    	if(!$existing_super_user) {
	        User::create(['fname' => "Super",'lname' => "User",'contact' => "09222222222" ,'address' => "Makati City", 'type' => "super_user", 'username' => "admin", 'email' => "admin@highlysucceed.com", 'password' => bcrypt('admin')]);
    	}
    }
}
