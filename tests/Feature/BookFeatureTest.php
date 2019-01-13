<?php

namespace Tests\Feature\Admin\Racks;

use App\Book;
use App\Rack;
use Tests\TestCase;

class BookFeatureTest extends TestCase
{
    /** @test */
    public function it_can_delete_the_book()
    {
        $book = factory(Book::class)->create();

        $this->actingAs($this->user, "web")
            ->delete(route('books.destroy', $book->id), [])
            ->assertStatus(302)
            ->assertRedirect(route('books.index'))
            ->assertSessionHas(['message' => "Delete $book->name successful!"]);
    }
    
    /** @test */
    public function it_can_update_the_book()
    {
        $book = factory(Book::class)->create();

        $data = ['name' => 'Hello Panda!'];

        $this->actingAs($this->user, "web")
            ->put(route('books.update', $book->id), $data)
            ->assertStatus(302)
            ->assertRedirect(route('books.edit', $book->id))
            ->assertSessionHas(['message' => 'Update successful!']);
    }
    
    /** @test */
    public function it_can_show_the_edit_book_form()
    {
        $book = factory(Book::class)->create();

        $this->actingAs($this->user, 'web')
            ->get(route('books.edit', $book->id))
            ->assertStatus(200)
            ->assertSee($book->name);
    }
    
    /** @test */
    public function it_can_list_all_the_books()
    {
        $book = factory(Book::class)->create();

        $this->actingAs($this->user, 'web')
            ->get(route('books.index'))
            ->assertStatus(200)
            ->assertSee(htmlentities($book->name, ENT_QUOTES));
    }
    
    /** @test */
    public function it_can_create_the_book()
    {
        $params = [
            'title' => $this->faker->title,
            'author' => $this->faker->name,
            'published_year' => $this->faker->year,
            'rack_id' => 1
        ];
        $this->actingAs($this->user, "web")
            ->post(route('books.store'), $params)
            ->assertStatus(302)
            ->assertRedirect(route('books.index'))
            ->assertSessionHas(['message' => 'Create Books successful!']);
    }
    
    /** @test */
    public function it_can_see_the_book_create_form()
    {
        $this
            ->actingAs($this->user, "web")
            ->get(route('books.create'))
            ->assertSee('name')
            ->assertSee('Create')
            ->assertStatus(200);
    }
}
