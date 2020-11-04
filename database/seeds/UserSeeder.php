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
        $manager = User::create([
            'name' =>'Trung 1',
            'email'=> 'manager@gmail.com',
            'password' => bcrypt('123'),
            'gender' => 'Female',
            'phone' => '0123456789',
            'address' => 'Da Nang'
        ]);
        $administration = User::create([
            'name' =>'Trung 2',
            'email'=> 'administration@gmail.com',
            'password' => bcrypt('123'),
            'gender' => 'Female',
            'phone' => '0123456789',
            'address' => 'Da Nang'
        ]);
        $accountant = User::create([
            'name' =>'Trung 3',
            'email'=> 'accountant@gmail.com',
            'password' => bcrypt('123'),
            'gender' => 'Female',
            'phone' => '0123456789',
            'address' => 'Da Nang'
        ]);
        $receptionist = User::create([
            'name' =>'Trung 4',
            'email'=> 'receptionist@gmail.com',
            'password' => bcrypt('123'),
            'gender' => 'Female',
            'phone' => '0123456789',
            'address' => 'Da Nang'
        ]);
        $housekeeping = User::create([
            'name' =>'Trung 5',
            'email'=> 'housekeeping@gmail.com',
            'password' => bcrypt('123'),
            'gender' => 'Female',
            'phone' => '0123456789',
            'address' => 'Da Nang'
        ]);
       
    }
}
