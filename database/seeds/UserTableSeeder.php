<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'=>'giri_adhittana01',
            'email'=>'girput01@icloud.com',
            'password'=>Hash::make('Gpa010301')
        ]);

        $user->assignRole('admin');
    }
}
