<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            'user management',
            'menu management',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(['user management', 'menu management']);

        $managerRole = Role::create(['name' => 'manager']);
        $managerRole->givePermissionTo('');

        $cashierRole = Role::create(['name' => 'cashier']);
        $cashierRole->givePermissionTo('');

        $kitchenRole = Role::create(['name' => 'kitchen']);
        $kitchenRole->givePermissionTo('');

        $waiterRole = Role::create(['name' => 'waiter']);
        $waiterRole->givePermissionTo('');

    }

}
