<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::create([
            'name' => 'Restorant Owner',
            'email' => 'massamugeorge@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $managerUser = User::create([
            'name' => 'Manager User',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $cashierUser = User::create([
            'name' => 'Cashier User',
            'email' => 'cashier@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $kitchenUser = User::create([
            'name' => 'Kitchen Staff',
            'email' => 'kitchen@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $waiterUser = User::create([
            'name' => 'Waiter User',
            'email' => 'waiter@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $adminUser->assignRole('admin');
        $managerUser->assignRole('manager');
        $cashierUser->assignRole('cashier');
        $kitchenUser->assignRole('kitchen');
        $waiterUser->assignRole('waiter');
        
    }
}
