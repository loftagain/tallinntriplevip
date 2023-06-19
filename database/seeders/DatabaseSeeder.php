<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $adminUser = User::where('email', 'admin@tallinntriplevip.ee')->first();

        if ($adminRole && $adminUser) {
            $adminUser->assignRole($adminRole);
        }
    }
}
