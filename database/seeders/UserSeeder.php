<?php
 
namespace Database\Seeders;
 
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
 
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin Demo',
            'email'    => 'admin@demo.com',
            'password' => Hash::make('password123'),
        ]);
 
        User::create([
            'name'     => 'User Test',
            'email'    => 'user@demo.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
