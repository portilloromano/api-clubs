<?php
declare(strict_types=1);

namespace Tests\Feature\ClubsAdmin\Presentation\REST\Entity;


use Illuminate\Http\Response;
use Tests\TestCase;

class EntityTest extends TestCase
{

    /* @test */
    public function testEntityCreate()
    {
        $payload = [
            'uuid_club' => null,
            'type' => 'PLAYER',
            'name' => 'Player',
            'surname' => 'Test',
            'email' => 'testplayer@test.com',
            'phone' => '999999999',
            'salary' => 200000000,
        ];

        $this->json('POST', '/api/v1/entity', $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson(
                ['data' =>
                    [
                        'uuid_club' => null,
                        'type' => 'PLAYER',
                        'name' => 'Player',
                        'surname' => 'Test',
                        'email' => 'testplayer@test.com',
                        'phone' => '999999999',
                        'salary' => 200000000,
                    ]
                ]
            );
    }


    /* @test */
    public function testEntitySearchAll()
    {
        $this->json('GET', '/api/v1/entity')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                ['data' =>
                    [
                        [
                            'uuid',
                            'uuid_club',
                            'type',
                            'name',
                            'surname',
                            'email',
                            'phone',
                            'salary',
                            'created_at',
                            'updated_at',
                        ]
                    ]
                ]
            );
    }


    /* @test */
    public function testEntitySearch()
    {
        $this->json('GET', '/api/v1/entity/' . '9d53fc3d-cd8f-46bd-9510-4eb574834449')
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(
                ['data' =>
                    [
                        'uuid' => '9d53fc3d-cd8f-46bd-9510-4eb574834449',
                        'uuid_club' => '3c14727c-8aeb-4b9f-9952-a44b76c9a0fd',
                        'type' => 'PLAYER',
                        'name' => 'Sergio',
                        'surname' => 'Ramos',
                        'email' => 'sergioramos@test.com',
                        'phone' => '+00 000000000',
                        'salary' => 23000000,
                    ]
                ]
            );
    }

    /* @test */
    public function testEntitySearchAllByClub()
    {
        $this->json('GET', '/api/v1/entity/club/' . '3c14727c-8aeb-4b9f-9952-a44b76c9a0fd')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        'current_page',
                        'data' => [],
                        'first_page_url',
                        'from',
                        'last_page',
                        'last_page_url',
                        'links' => [
                            [
                                'url',
                                'label',
                                'active'
                            ],
                            [
                                'url',
                                'label',
                                'active'
                            ],
                            [
                                'url',
                                'label',
                                'active'
                            ]
                        ],
                        'next_page_url',
                        'path',
                        'per_page',
                        'prev_page_url',
                        'to',
                        'total'
                    ]
                ]
            );
    }

    /* @test */
    public function testEntityAssociate()
    {
        $this->json('PATCH', '/api/v1/entity/associate/' . '0acca494-870b-4459-b6c3-eef6f1109441', ['uuid_club' => 'a1f66830-07af-4100-83e1-a4aeef6dad09'])
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(
                ['data' =>
                    [
                        'uuid' => '0acca494-870b-4459-b6c3-eef6f1109441',
                        'uuid_club' => 'a1f66830-07af-4100-83e1-a4aeef6dad09',
                        'type' => 'TRAINER',
                        'name' => 'Pep',
                        'surname' => 'Guardiola',
                        'email' => 'pepguardiola@test.com',
                        'phone' => '+00 000000000',
                        'salary' => 23280000,
                    ]
                ]
            );

        $this->result = $this->json('GET', '/api/v1/club/' . 'a1f66830-07af-4100-83e1-a4aeef6dad09')
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(
                ['data' =>
                    [
                        'uuid' => 'a1f66830-07af-4100-83e1-a4aeef6dad09',
                        'name' => 'Sevilla FC',
                        'budget' => 2004000000,
                        'expense' => 23280000,
                    ]
                ]
            );
    }


    /* @test */
    public function testEntityDisassociate()
    {
        $this->json('PATCH', '/api/v1/entity/disassociate/' . '9d53fc3d-cd8f-46bd-9510-4eb574834449')
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(
                ['data' =>
                    [
                        'uuid' => '9d53fc3d-cd8f-46bd-9510-4eb574834449',
                        'uuid_club' => '3c14727c-8aeb-4b9f-9952-a44b76c9a0fd',
                        'type' => 'PLAYER',
                        'name' => 'Sergio',
                        'surname' => 'Ramos',
                        'email' => 'sergioramos@test.com',
                        'phone' => '+00 000000000',
                        'salary' => 23000000,
                    ]
                ]
            );

        $this->result = $this->json('GET', '/api/v1/club/' . '3c14727c-8aeb-4b9f-9952-a44b76c9a0fd')
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(
                ['data' =>
                    [
                        'uuid' => '3c14727c-8aeb-4b9f-9952-a44b76c9a0fd',
                        'name' => 'Real Madrid',
                        'budget' => 739160000,
                        'expense' => 0,
                    ]
                ]
            );
    }

}
