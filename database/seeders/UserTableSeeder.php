<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create([
        'name'=>'admin',
        'username'=>'admin',
        'email'=>'projectlaravel57@gmail.com',
        'password'=>bcrypt('admin002'),
        'gender'=>'male',
        'image'=>'',
        'user_type'=>'admin',
        'status'=>1
       ]);
    }
}
