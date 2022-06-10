<?php
declare(strict_types=1);

namespace Tests\Feature\ClubsAdmin\Presentation\REST\Club;


use Illuminate\Http\Response;
use Tests\TestCase;

class ClubTest extends TestCase
{

    /* @test */
    public function testClubCreate()
    {
        $payload = [
            'name' => 'testName',
            'budget' => 100000000,
            'expense' => 0,
        ];

        $this->json('POST', '/api/v1/club', $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson(
                ['data' =>
                    [
                        'name' => 'testName',
                        'budget' => 100000000,
                        'expense' => 0,
                    ]
                ]
            );
    }

    /* @test */
    public function testClubSearchAll()
    {
        $this->json('GET', '/api/v1/club')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                ['data' =>
                    [
                        [
                            'uuid',
                            'name',
                            'budget',
                            'expense',
                            'created_at',
                            'updated_at'
                        ]
                    ]
                ]
            );
    }

    /* @test */
    public function testClubSearch()
    {
        $this->json('GET', '/api/v1/club/' . '3c14727c-8aeb-4b9f-9952-a44b76c9a0fd')
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(
                ['data' =>
                    [
                        'uuid' => '3c14727c-8aeb-4b9f-9952-a44b76c9a0fd',
                        'name' => 'Real Madrid',
                        'budget' => 739160000,
                        'expense' => 23000000,
                    ]
                ]
            );
    }

    /* @test */
    public function testClubUpdateBudget()
    {
        $this->json('PATCH', '/api/v1/club/budget/' . 'a1f66830-07af-4100-83e1-a4aeef6dad09', ['budget' => 150000000])
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(
                ['data' =>
                    [
                        'uuid' => 'a1f66830-07af-4100-83e1-a4aeef6dad09',
                        'name' => 'Sevilla FC',
                        'budget' => 150000000,
                        'expense' => 0,
                    ]
                ]
            );
    }
}
