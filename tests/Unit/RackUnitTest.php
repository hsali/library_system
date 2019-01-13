<?php

namespace Tests\Unit;

use App\Rack;
use App\Repositories\RackRepository;
use Illuminate\Support\Collection;
use Tests\TestCase;

class RackUnitTest extends TestCase
{
    /** @test */
    public function it_can_show_all_the_racks()
    {
        factory(Rack::class, 3)->create();

        $rackRepo = new RackRepository(new Rack);
        $list = $rackRepo->listRacks();

        $this->assertInstanceOf(Collection::class, $list);
        $this->assertCount(3, $list->all());
    }

    /** @test
     * @throws \Exception
     */
    public function it_can_delete_the_rack()
    {
        $rack = factory(Rack::class)->create();

        $rackRepo = new RackRepository($rack);
        $deleted = $rackRepo->deleteRack($rack->id);

        $this->assertTrue($deleted);
    }

    /** @test
     * @throws \App\Exceptions\UpdateRackErrorException
     * @throws \App\Exceptions\RackNotFoundErrorException
     */
    public function it_can_update_the_rack()
    {
        $rack = factory(Rack::class)->create();

        $data = ['name' => 'Argentina'];

        $rackRepo = new RackRepository($rack);
        $updated = $rackRepo->updateRack($data);

        $found = $rackRepo->findRackById($rack->id);

        $this->assertTrue($updated);
        $this->assertEquals($data['name'], $found->name);
    }

    /** @test
     * @throws \App\Exceptions\RackNotFoundErrorException
     */
    public function it_can_show_the_rack()
    {
        $rack = factory(Rack::class)->create();

        $rackRepo = new RackRepository(new Rack);
        $found = $rackRepo->findRackById($rack->id);

        $this->assertInstanceOf(Rack::class, $found);
        $this->assertEquals($rack->name, $found->name);
    }

    /** @test
     * @throws \App\Exceptions\CreateRackErrorException
     */
    public function it_can_create_a_rack()
    {
        $data = ['name' => $this->faker->sentence];

        $rackRepo = new RackRepository(new Rack);
        $rack = $rackRepo->createRack($data);

        $this->assertInstanceOf(Rack::class, $rack);
        $this->assertEquals($data['name'], $rack->name);
    }
}
