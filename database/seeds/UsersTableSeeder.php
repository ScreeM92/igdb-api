<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\User;
use App\Models\OauthClient;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add user
        $newUser = [
	        'username' => 'admin',
	        'name' => 'Admin',
	        'email' => 'mihailnikov23@gmail.com',
	        'password' => bcrypt('qwerty'),
	        'created_at' => date('Y-m-d H:i:s'),
	        'updated_at' => date('Y-m-d H:i:s')
    	];

        User::insert($newUser);

        // Add role
        $adminRole = Role::where('name','=','admin')->first();
        $user = User::where('username','=','admin')->first();
        $user->attachRole($adminRole);

        // Add user as client
        $newClient = [
            'user_id' => $user->id,
            'name' => 'admin',
            'secret' => 'ljyfiJMhyYHU5XxTM97wBHX764za0jskUlWPD63P',
            'redirect' => 'http://localhost/auth/callback',
            'personal_access_client' => false,
            'password_client' => true,
            'revoked' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        OauthClient::insert($newClient);
    }
}