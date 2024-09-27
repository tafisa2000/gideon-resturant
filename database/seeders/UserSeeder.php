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
        //
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        $adminUser = User::create([
            'name' => 'Restorant Owner',
            'email' => 'massamugeorge@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $adminUser->assignRole($adminRole);
        
    }
}
