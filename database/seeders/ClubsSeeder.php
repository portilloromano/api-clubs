<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClubsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clubs')->insert([
            [
                'uuid' => '3c14727c-8aeb-4b9f-9952-a44b76c9a0fd',
                'name' => 'Real Madrid',
                'budget' => 739160000,
                'expense' => 0
            ],
            [
                'uuid' => 'a1f66830-07af-4100-83e1-a4aeef6dad09',
                'name' => 'Sevilla FC',
                'budget' => 2004000000,
                'expense' => 0
            ],
            [
                'uuid' => '2b8f0026-fb20-4d1f-95df-9987b1ad1716',
                'name' => 'Atlético de Madrid',
                'budget' => 171610000,
                'expense' => 0
            ],
            [
                'uuid' => '5d7832f0-dee0-4ec2-8091-8120b5919230',
                'name' => 'Athletic Club',
                'budget' => 111820000,
                'expense' => 0
            ],
            [
                'uuid' => '02ee0905-bc5e-4f08-a964-88a8070aa563',
                'name' => 'FC Barcelona',
                'budget' => 97940000,
                'expense' => 0
            ]
        ]);
    }
}
