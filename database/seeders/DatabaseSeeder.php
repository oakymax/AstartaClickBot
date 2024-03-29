<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Создатель',
            'telegram_id' => 107042339,
            'role' => UserRole::Root,
            'gender' => 1,
            'birthday' => '1981-07-11',
        ]);

        User::factory()->create([
            'name' => 'Ваше Высочество',
            'telegram_id' => 194795532,
            'role' => UserRole::Master,
            'gender' => 0,
        ]);

        User::factory()->create([
            'name' => 'Председатель',
            'telegram_id' => 76890479,
            'role' => UserRole::Master,
            'gender' => 1,
        ]);
    }
}
