<?php

namespace Tests;

use Database\Seeders\TestsSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;

    protected $seed = true;
    protected $seeder = TestsSeeder::class;

}
