<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@douwyn.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('phimhaydouwyn@'),
                'is_verified' => 1,
            ]
        );

        if ($admin->wasRecentlyCreated) {
            $this->command->info('Admin account created successfully.');
        } else {
            $this->command->info('Admin account already exists.');
        }

        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);

        if (!$admin->hasRole('super_admin')) {
            $admin->assignRole($superAdminRole);
            $this->command->info('Assigned Super Admin role to admin. Please write down "admin" to continue!');
        } else {
            $this->command->info('Admin already has Super Admin role.');
        }

        Artisan::call('shield:generate', [
            '--all' => true,
        ]);
        $this->command->info('Permissions and roles generated successfully.');
    }
}
