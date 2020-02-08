<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Users')->insert([
            'name' => 'admin    ',
            'surname' => 'admin',
            'email' => 'admin@gmail.com',
            'description' => 'admin',
            'image' => '123456789',
            'role' => 'admin',
            'email_verified_at' =>carbon::now()->format('y-m-d H:i:s'),
            'password'=>'active',
            'remember_token'=>'Y',
            'created_at'=>carbon::now()->format('y-m-d H:i:s')
        ]);  
       


    }
}
