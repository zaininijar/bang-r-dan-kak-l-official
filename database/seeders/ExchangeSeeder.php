<?php

namespace Database\Seeders;

use App\Models\Exchange;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $exchanges = [
            // RBX
            [
                'exchange_type' => 'RBX',
                'point' => 25,
                'exchanged_to' => '25'
            ],
            [
                'exchange_type' => 'RBX',
                'point' => 50,
                'exchanged_to' => '50'
            ],
            [
                'exchange_type' => 'RBX',
                'point' => 75,
                'exchanged_to' => '75'
            ],
            [
                'exchange_type' => 'RBX',
                'point' => 100,
                'exchanged_to' => '100'
            ],
            // E-WALLET
            [
                'exchange_type' => 'E-WALLET',
                'point' => 25,
                'exchanged_to' => 'RP2.000'
            ],
            [
                'exchange_type' => 'E-WALLET',
                'point' => 50,
                'exchanged_to' => 'RP4.000'
            ],
            [
                'exchange_type' => 'E-WALLET',
                'point' => 75,
                'exchanged_to' => 'RP6.000'
            ],
            [
                'exchange_type' => 'E-WALLET',
                'point' => 100,
                'exchanged_to' => 'RP8.000'
            ],
            // ML
            [
                'exchange_type' => 'ML',
                'point' => 40,
                'exchanged_to' => '10'
            ],
            [
                'exchange_type' => 'ML',
                'point' => 100,
                'exchanged_to' => '36'
            ],
            [
                'exchange_type' => 'ML',
                'point' => 300,
                'exchanged_to' => 'Weekly Diamond Pass ML'
            ],
            // FF
            [
                'exchange_type' => 'FF',
                'point' => 25,
                'exchanged_to' => '20'
            ],
            [
                'exchange_type' => 'FF',
                'point' => 75,
                'exchanged_to' => '55'
            ],
            [
                'exchange_type' => 'FF',
                'point' => 100,
                'exchanged_to' => '80'
            ],
        ];

        Exchange::insert($exchanges);
    }
}
