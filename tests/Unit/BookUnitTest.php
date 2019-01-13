<?php

namespace Tests\Unit\Books;


use App\Book;
use App\Repositories\BookRepository;
use Illuminate\Support\Collection;
use Tests\TestCase;

class BookUnitTest extends TestCase
{
    /** @test */
    public function it_can_show_all_the_books()
    {
        factory(Book::class, 3)->create();

        $bookRepo = new BookRepository(new Book);
        $list = $bookRepo->listBooks();

        $this->assertInstanceOf(Collection::class, $list);
        $this->assertCount(3, $list->all());
    }

    /** @test
     * @throws \Exception
     */
    public function it_can_delete_the_book()
    {
        $book = factory(Book::class)->create();

        $bookRepo = new BookRepository($book);
        $deleted = $bookRepo->deleteBook($book->id);

        $this->assertTrue($deleted);
    }

    /** @test
     * @throws \App\Exceptions\BookUpdateErrorException
     * @throws \App\Exceptions\BookNotFoundException
     */
    public function it_can_update_the_book()
    {
        $book = factory(Book::class)->create();

        $data = ['name' => 'Argentina'];

        $bookRepo = new BookRepository($book);
        $updated = $bookRepo->updateBook($data);

        $found = $bookRepo->findBookById($book->id);

        $this->assertTrue($updated);
        $this->assertEquals($data['name'], $found->name);
    }
    
    /** @test */
    public function it_can_show_the_book()
    {
        $book = factory(Book::class)->create();

        $bookRepo = new BookRepository(new Book);
        $found = $bookRepo->findBookById($book->id);

        $this->assertInstanceOf(Book::class, $found);
        $this->assertEquals($book->name, $found->name);
    }

    /** @test
     * @throws \App\Exceptions\BookCreateErrorException
     */
    public function it_can_create_a_book()
    {
        $data = ['name' => $this->faker->company];

        $bookRepo = new BookRepository(new Book);
        $book = $bookRepo->createBook($data);

        $this->assertInstanceOf(Book::class, $book);
        $this->assertEquals($data['name'], $book->name);
    }
}
