<?php

namespace Database\Seeders;

use App\Models\Purpose;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $purposes = [

            // Expense
            [
                'name' => 'Fish Purchase',
                'slug' => 'fish_purchase',
                'is_system' => 1,
            ],

            [
                'name' => 'Feed Purchase',
                'slug' => 'feed_purchase',
                'is_system' => 1,
            ],

            [
                'name' => 'Medicine',
                'slug' => 'medicine',
                'is_system' => 1,
            ],

            [
                'name' => 'Labour Cost',
                'slug' => 'labour_cost',
                'is_system' => 1,
            ],

            [
                'name' => 'Lease Cost',
                'slug' => 'lease_cost',
                'is_system' => 1,
            ],

            [
                'name' => 'Transport Cost',
                'slug' => 'transport_cost',
                'is_system' => 1,
            ],

            [
                'name' => 'Electricity Cost',
                'slug' => 'electricity_cost',
                'is_system' => 1,
            ],

            [
                'name' => 'Misc Expense',
                'slug' => 'misc_expense',
                'is_system' => 1,
            ],

            // Investment
            [
                'name' => 'Partner Investment',
                'slug' => 'partner_investment',
                'is_system' => 1,
            ],

            [
                'name' => 'Partner Withdraw',
                'slug' => 'partner_withdraw',
                'is_system' => 1,
            ],

            // Income
            [
                'name' => 'Fish Sale',
                'slug' => 'fish_sale',
                'is_system' => 1,
            ],
        ];

        foreach ($purposes as $purpose) {

            Purpose::updateOrCreate(
                ['slug' => $purpose['slug']],
                $purpose
            );
        }
    }
}