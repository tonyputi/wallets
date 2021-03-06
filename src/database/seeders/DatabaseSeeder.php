<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->admin()->create([
            'name' => 'Admin user',
            'email' => 'admin@runitonce.com'
        ]);

        $user = User::factory()->create([
            'name' => 'Standard user',
            'email' => 'user@runitonce.com'
        ]);
        Wallet::factory(3)->for($user)->create();


        Wallet::factory(30)->create();
    }
}
