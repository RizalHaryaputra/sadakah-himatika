<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // --- Permissions ---
        $permissions = [
            'manage users',
            'manage padukuhan',
            'manage waste categories',
            'manage rewards',
            'manage products',
            'manage articles',
            'manage bank sampah locations',
            'create waste transactions',
            'view waste transactions',
            'request point redemption',
            'approve point redemption',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // --- Roles ---

        // Super Admin
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $superAdminRole->syncPermissions(Permission::all());

        // Operator Padukuhan
        $operatorRole = Role::firstOrCreate(['name' => 'Operator Padukuhan']);
        $operatorRole->syncPermissions([
            'create waste transactions',
            'view waste transactions',
        ]);

        // Nasabah
        $nasabahRole = Role::firstOrCreate(['name' => 'Nasabah']);
        $nasabahRole->syncPermissions([
            'request point redemption',
        ]);
    }
}
