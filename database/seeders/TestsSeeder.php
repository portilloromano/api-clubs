<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestsSeeder extends Seeder
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
                'expense' => 23000000
            ],
            [
                'uuid' => 'a1f66830-07af-4100-83e1-a4aeef6dad09',
                'name' => 'Sevilla FC',
                'budget' => 2004000000,
                'expense' => 0
            ]
        ]);

        DB::table('entities')->insert([
            [
                'uuid' => '9d53fc3d-cd8f-46bd-9510-4eb574834449',
                'uuid_club' => '3c14727c-8aeb-4b9f-9952-a44b76c9a0fd',
                'type' => 'PLAYER',
                'name' => 'Sergio',
                'surname' => 'Ramos',
                'email' => 'sergioramos@test.com',
                'phone' => '+00 000000000',
                'salary' => 23000000
            ],
            [
                'uuid' => '0acca494-870b-4459-b6c3-eef6f1109441',
                'uuid_club' => null,
                'type' => 'TRAINER',
                'name' => 'Pep',
                'surname' => 'Guardiola',
                'email' => 'pepguardiola@test.com',
                'phone' => '+00 000000000',
                'salary' => 23280000
            ]
        ]);
    }
}
