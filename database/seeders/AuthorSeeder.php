<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'user_id' => User::where('email', 'kagawad.amparo@bulletin.test')->firstOrFail()->id,
            'name' => 'Kagawad Althea Amparo',
            'position' => 'Kagawad',
            'email' => 'kagawad.amparo@bulletin.test',
        ]);

        Author::factory()->count(4)->create();
    }
}
