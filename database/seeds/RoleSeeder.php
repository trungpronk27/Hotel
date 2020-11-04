<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $manager = Role::create([
            'name' => 'Manager',
            'slug' => 'manager',
            'permissions' => json_encode([
                // Bộ phận quản lý điều hành
                'act-user'=> true, 
                 // Bộ phận hành chính
                'act-administration'=> true,
                // Bộ phận kế toán
                'act-accountant'=> true,
                // Bộ phận lễ tân    
                'act-receptionist'=> true,
                // Bộ phận buồng phòng
                'act-housekeeping'=> true,
            ])
        ]);
  
        $administration = Role::create([
            'name' => 'Administration',
            'slug' => 'administration',
            'permissions' => json_encode([
                // Bộ phận hành chính
                'act-administration'=> true,
                // Bộ phận kế toán
                'act-accountant'=> true,
                // Bộ phận lễ tân    
                'act-receptionist'=> true,
                // Bộ phận buồng phòng
                'act-housekeeping'=> true,
            ])
        ]);        

        $accountant = Role::create([
            'name' => 'Accountant',
            'slug' => 'accountant',
            'permissions' => json_encode([
                // Bộ phận kế toán
                'act-accountant'=> true,
                // Bộ phận lễ tân    
                'act-receptionist'=> true,
                // Bộ phận buồng phòng
                'act-housekeeping'=> true,
            ])

        ]);

        $receptionist = Role::create([
            'name' => 'Receptionist',
            'slug' => 'receptionist',
            'permissions' => json_encode([
                // Bộ phận lễ tân    
                'act-receptionist'=> true,
                // Bộ phận buồng phòng
                'act-housekeeping'=> true,
            ])
        ]);
        $housekeeping = Role::create([
            'name' => 'Housekeeping',
            'slug' => 'housekeeping',
            'permissions' => json_encode([
                // Bộ phận buồng phòng
                'act-housekeeping'=> true
            ])
        ]);
    }
}
