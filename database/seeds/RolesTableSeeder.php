<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$roles = array(
		   [
            'name' => 'admin',
            'display_name' => 'admin',
            'description' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        	],[
            'name' => 'user',
            'display_name' => 'user',
            'description' => 'user',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        	]
		);

        DB::table('roles')->insert($roles);
    }
}