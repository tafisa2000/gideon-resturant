<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        $adminUser = User::create([
            'first_name' => 'Michael',
            'last_name' => 'Ngowi',
            'name' => 'Restorant Owner',
            'email' => 'massamugeorge@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $managerUser = User::create([
            'first_name' => 'Johnson',
            'last_name' => 'Mawi',
            'name' => 'Manager User',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $cashierUser = User::create([
            'first_name' => 'Samson',
            'last_name' => 'Fredson',
            'name' => 'Cashier User',
            'email' => 'cashier@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $kitchenUser = User::create([
            'first_name' => 'Angel',
            'last_name' => 'Mawi',
            'name' => 'Kitchen Staff',
            'email' => 'kitchen@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $waiterUser = User::create([
            'first_name' => 'Agatha',
            'last_name' => 'Rally',
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
