<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user = new User();
        $user->first_name = 'Admin';
        $user->email = 'admin@gmail.com';
        $user->mobile_number = '1234567890';
        $user->isActive = 1;
        $user->password = bcrypt('123456789');
        $user->type = "admin";
        $user->userdetail_id=0;
        // $user->status=0;
        $user->save();
    }
}
