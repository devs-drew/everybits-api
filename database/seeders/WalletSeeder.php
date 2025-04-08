<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wallet::create([
            'user_id' => User::first()->id,
            'name' => 'Gcash',
            'type' => 'digital',
            'balance' => 1000,
            'credit_limit' => 0,
            'include_in_total' => true,
        ]);
        Wallet::create([
            'user_id' => User::first()->id,
            'name' => 'Paymaya',
            'type' => 'digital',
            'balance' => 5000.02,
            'credit_limit' => 0,
            'include_in_total' => true,
        ]);
        Wallet::create([
            'user_id' => User::first()->id,
            'name' => 'Cash',
            'type' => 'cash',
            'balance' => 500.01,
            'credit_limit' => 0,
            'include_in_total' => true,
        ]);
        Wallet::create([
            'user_id' => User::first()->id,
            'name' => 'Union Bank',
            'type' => 'bank',
            'balance' => 25000.23,
            'credit_limit' => 0,
            'include_in_total' => true,
        ]);
        Wallet::create([
            'user_id' => User::first()->id,
            'name' => 'BPI',
            'type' => 'bank',
            'balance' => 0,
            'credit_limit' => 0,
            'include_in_total' => true,
        ]);
        Wallet::create([
            'user_id' => User::first()->id,
            'name' => 'BPI Credit Card',
            'type' => 'credit_card',
            'balance' => 0,
            'credit_limit' => 100000,
            'include_in_total' => false,
        ]);
        Wallet::create([
            'user_id' => User::first()->id,
            'name' => 'UB Credit Card',
            'type' => 'credit_card',
            'balance' => 0,
            'credit_limit' => 50200.30,
            'include_in_total' => false,
        ]);
    }
}
