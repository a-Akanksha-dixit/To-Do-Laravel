<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use app\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory()->create([
            'role' => 'admin',
            'name' => 'admin']
        );
    }
}
