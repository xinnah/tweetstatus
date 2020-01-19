<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\Models\Role::create([
      	'role_name' => 'super admin',
      	'status'    => 1
      ],[
      	'role_name' => 'admin',
      	'status'    => 1
      ],[
      	'role_name' => 'service',
      	'status'    => 1
      ],[
      	'role_name' => 'user',
      	'status'    => 1
      ]);
    }
}
