<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Account;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(500)->create();
        Account::factory(400)->create();
        Product::factory(300)->create();
        $accounts = Account::all();
        User::all()->each(function ($user) use ($accounts) {
            $user->accounts()->attach($accounts->random(rand(1, 4))->pluck('id')->toArray());
        });
        Product::all()->each(function ($Product) use ($accounts) {
            $val = rand(1, 4);

            if($val == 3) {
                $Product->accounts()->attach($accounts->random(rand(1, 40))->pluck('id')->toArray(), ['expiration_date' => date('Y-m-d', strtotime('+'.mt_rand(0, 30).' days'))]);
            } else {
                $Product->accounts()->attach($accounts->random(rand(1, 40))->pluck('id')->toArray());
            }
        });
    }
}
