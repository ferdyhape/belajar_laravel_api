<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ferdy H P',
            'email' => 'ferdy@hape.com',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'name' => 'Joko',
            'email' => 'joko@hape.com',
            'password' => bcrypt('password'),
        ]);
    }
}
