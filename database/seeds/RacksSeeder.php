<?php

use Illuminate\Database\Seeder;

class RacksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Rack::class,3)->create()->each(function (\App\Rack $rack){
            factory(\App\Book::class,10)->create(["rack_id" => $rack->id]);
        });
    }
}
