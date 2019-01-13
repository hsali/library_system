<?php

namespace Tests\Feature\Admin\Racks;

use App\Rack;
use Tests\TestCase;

class RackFeatureTest extends TestCase
{
    /** @test */
    public function it_can_delete_the_rack()
    {
        $rack = factory(Rack::class)->create();

        $this->actingAs($this->user, 'web')
            ->delete(route('racks.destroy', $rack->id), [])
            ->assertStatus(302)
            ->assertRedirect(route('racks.index'))
            ->assertSessionHas(['message' => 'Delete successful!']);
    }
    
    /** @test */
    public function it_can_update_the_rack()
    {
        $rack = factory(Rack::class)->create();

        $data = ['name' => 'Hello Panda!'];

        $this->actingAs($this->user, 'web')
            ->put(route('racks.update', $rack->id), $data)
            ->assertStatus(302)
            ->assertRedirect(route('racks.edit', $rack->id))
            ->assertSessionHas(['message' => 'Update successful!']);
    }
    
    /** @test */
    public function it_can_show_the_edit_rack_form()
    {
        $rack = factory(Rack::class)->create();

        $this->actingAs($this->user, 'web')
            ->get(route('racks.edit', $rack->id))
            ->assertStatus(200)
            ->assertSee($rack->name);
    }
    
    /** @test */
    public function it_can_list_all_the_racks()
    {
        $rack = factory(Rack::class)->create();

        $this->actingAs($this->user, 'web')
            ->get(route('racks.index'))
            ->assertStatus(200)
            ->assertSee(htmlentities($rack->name, ENT_QUOTES));
    }
    
    /** @test */
    public function it_can_create_the_rack()
    {
        $this->actingAs($this->user, 'web')
            ->post(route('racks.store'), ['name' => $this->faker->company])
            ->assertStatus(302)
            ->assertRedirect(route('racks.index'))
            ->assertSessionHas(['message' => 'Create rack successful!']);
    }
    
    /** @test */
    public function it_can_see_the_rack_create_form()
    {
        $this
            ->actingAs($this->user, 'web')
            ->get(route('racks.create'))
            ->assertSee('Name')
            ->assertSee('Create')
            ->assertSee('Back')
            ->assertStatus(200);
    }
}
