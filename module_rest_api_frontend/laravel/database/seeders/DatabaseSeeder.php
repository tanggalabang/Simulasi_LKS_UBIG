<?php

namespace Database\Seeders;

use Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Actor::factory()->create([
            'username' => 'Amri',
            'first_name' => 'Fatkhul',
            'last_name' => 'Amri',   
            // 'password' => Hash::make(12345),   
            'password' => md5(12345),   
        ]);
        \App\Models\Actor::factory()->create([
            'username' => 'novan',
            'first_name' => 'Novan',
            'last_name' => 'Andre',   
            // 'password' => Hash::make(12345),   
            'password' => md5(12345),   
        ]);
        \App\Models\Actor::factory()->create([
            'username' => 'tesar',
            'first_name' => 'Tesar',
            'last_name' => 'Rahmat',   
            // 'password' => Hash::make(12345),   
            'password' => md5(12345),   
        ]); 
        
        
    }
}
