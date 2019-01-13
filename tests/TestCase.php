<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Faker\Factory as Faker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $faker;
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->faker = Faker::create();
        $this->artisan("migrate");
        $this->artisan("db:seed");
        $this->user = User::where(["email"=>"admin@app.com"])->first();

    }

    public function tearDown()
    {
        $this->artisan('migrate:reset');
        parent::tearDown();
    }
}
