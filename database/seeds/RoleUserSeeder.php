<?php

use Illuminate\Database\Seeder;
use App\UserRole;
class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        UserRole::create([
        		'user_id' => 1,
        		'role_id' => 1
        ]);
        UserRole::create([
        		'user_id' => 2,
        		'role_id' => 2
        ]);
        UserRole::create([
                'user_id' => 3,
                'role_id' => 3
        ]);
        UserRole::create([
                'user_id' => 4,
                'role_id' => 4
        ]);
        UserRole::create([
                'user_id' => 5,
                'role_id' => 5
        ]);
    }
}
