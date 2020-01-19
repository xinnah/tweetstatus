<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\User::create([
      	'first_name' => 'super',
      	'last_name' => 'admin',
      	'phone' => '01832059065',
      	'email' => 'xinnah@techadea.com',
      	'password' => bcrypt('123456'),
      	'fk_role_id' => 1,
      	'status'    => 1
      ]);
    }
}
