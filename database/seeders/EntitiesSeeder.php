<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntitiesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entities')->insert([
            [
                'uuid' => '9d53fc3d-cd8f-46bd-9510-4eb574834449',
                'uuid_club' => null,
                'type' => 'PLAYER',
                'name' => 'Sergio',
                'surname' => 'Ramos',
                'email' => 'sergioramos@test.com',
                'phone' => '+00 000000000',
                'salary' => 23000000
            ],
            [
                'uuid' => '41013ae3-bab3-476b-97c3-4ebf685ca063',
                'uuid_club' => null,
                'type' => 'PLAYER',
                'name' => 'Toni',
                'surname' => 'Kroos',
                'email' => 'tonikroos@test.com',
                'phone' => '+00 000000000',
                'salary' => 11700000
            ],
            [
                'uuid' => 'e3f1d33e-be47-4440-a823-cd30a2242cc9',
                'uuid_club' => null,
                'type' => 'PLAYER',
                'name' => 'Gerard',
                'surname' => 'Piqué',
                'email' => 'gerardpique@test.com',
                'phone' => '+00 000000000',
                'salary' => 8500000
            ],
            [
                'uuid' => '01960700-18b9-4feb-983f-df4fcee67fd3',
                'uuid_club' => null,
                'type' => 'PLAYER',
                'name' => 'Luis',
                'surname' => 'Suárez',
                'email' => 'luissuarez@test.com',
                'phone' => '+00 000000000',
                'salary' => 15000000
            ],
            [
                'uuid' => '32cd896b-69a0-4103-abfe-962db4794c22',
                'uuid_club' => null,
                'type' => 'PLAYER',
                'name' => 'Philippe',
                'surname' => 'Coutinho',
                'email' => 'philippecoutinho@test.com',
                'phone' => '+00 000000000',
                'salary' => 13500000
            ],
            [
                'uuid' => '84f12fd5-e72b-4b1e-b5bf-fe17615095c9',
                'uuid_club' => null,
                'type' => 'PLAYER',
                'name' => 'Gareth',
                'surname' => 'Bale',
                'email' => 'garethbale@test.com',
                'phone' => '+00 000000000',
                'salary' => 15000000
            ],
            [
                'uuid' => 'd47b86b7-711c-4e13-8a2e-5ccf17c0c860',
                'uuid_club' => null,
                'type' => 'PLAYER',
                'name' => 'Antoine',
                'surname' => 'Griezmann',
                'email' => 'antoinegriezmann@test.com',
                'phone' => '+00 000000000',
                'salary' => 8500000
            ],
            [
                'uuid' => '846fda00-8ed2-4b0b-be43-5ebf7fabea71',
                'uuid_club' => null,
                'type' => 'PLAYER',
                'name' => 'Leo',
                'surname' => 'Messi',
                'email' => 'leomessi@test.com',
                'phone' => '+00 000000000',
                'salary' => 63500000
            ],
            [
                'uuid' => '492944e2-04a4-4098-a3d6-5e538423dcf1',
                'uuid_club' => null,
                'type' => 'TRAINER',
                'name' => 'Diego Pablo',
                'surname' => 'Simeone',
                'email' => 'diegosimeone@test.com',
                'phone' => '+00 000000000',
                'salary' => 43200000
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
            ],
            [
                'uuid' => 'a9a0f69a-9917-4cd0-8fa8-c5d67a2cd96e',
                'uuid_club' => null,
                'type' => 'TRAINER',
                'name' => 'Jurgen',
                'surname' => 'Klopp',
                'email' => 'jurgenklopp@test.com',
                'phone' => '+00 000000000',
                'salary' => 17520000
            ],
            [
                'uuid' => '37884ae0-36d2-49fc-b415-ed4c943377b0',
                'uuid_club' => null,
                'type' => 'TRAINER',
                'name' => 'Jose',
                'surname' => 'Mourinho',
                'email' => 'josemourinho@test.com',
                'phone' => '+00 000000000',
                'salary' => 17520000
            ],
            [
                'uuid' => '683ea680-1f8b-4c54-8112-d77fcefcadba',
                'uuid_club' => null,
                'type' => 'TRAINER',
                'name' => 'Zinedine',
                'surname' => 'Zidane',
                'email' => 'zinedinezidane@test.com',
                'phone' => '+00 000000000',
                'salary' => 16800000
            ],
            [
                'uuid' => 'c3c03f88-52df-419c-913c-c88f1ed2f435',
                'uuid_club' => null,
                'type' => 'TRAINER',
                'name' => 'Antonio',
                'surname' => 'Conte',
                'email' => 'antonioconte@test.com',
                'phone' => '+00 000000000',
                'salary' => 16800000
            ],
            [
                'uuid' => '11dd31b1-4808-48e1-9b91-eb853dba1c7d',
                'uuid_club' => null,
                'type' => 'TRAINER',
                'name' => 'Favio',
                'surname' => 'Cannavaro',
                'email' => 'faviocannavaro@test.com',
                'phone' => '+00 000000000',
                'salary' => 13930000
            ],
            [
                'uuid' => '323ccba0-b9a9-4883-8904-ab9b3fb656e8',
                'uuid_club' => null,
                'type' => 'TRAINER',
                'name' => 'Carlo',
                'surname' => 'Ancellotti',
                'email' => 'carloancellotti@test.com',
                'phone' => '+00 000000000',
                'salary' => 12800000
            ]
        ]);
    }
}
