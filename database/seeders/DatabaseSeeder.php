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
        $user = User::where('email', 'admin@tallinntriplevip.ee')->first();

if ($user) {
    // Find or create the "admin" role
    $adminRole = Role::firstOrCreate(['name' => 'admin']);

    // Assign the "admin" role to the user
    $user->assignRole($adminRole);

    // Optional: Output a success message
    echo 'The user with email "admin@a.com" has been assigned the "admin" role.';
} else {
    // Optional: Output an error message if the user is not found
    echo 'User not found with the email "admin@a.com".';
}
    }
}
