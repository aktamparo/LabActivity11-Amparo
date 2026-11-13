<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Lola Amparo',
            'email' => 'lola.amparo@bulletin.test',
            'password' => 'bulletin2026',
        ]);

        User::factory()->create([
            'name' => 'Kagawad Althea Amparo',
            'email' => 'kagawad.amparo@bulletin.test',
            'password' => 'bulletin2026',
        ]);

        User::factory()->count(8)->create();
    }
}
