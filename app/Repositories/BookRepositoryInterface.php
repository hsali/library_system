<?php

namespace App\Repositories;

use App\Book;
use Illuminate\Support\Collection;
use Jsdecena\Baserepo\BaseRepositoryInterface;

interface BookRepositoryInterface extends BaseRepositoryInterface
{
    public function createBook(array $data): Book;

    public function findBookById(int $id) : Book;

    public function updateBook(array $data) : bool;

    public function deleteBook() : bool;

    public function listBooks($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc') : Collection;

    public function searchBook(string $text) : Collection;

    public function listBooksByRackId($id, $columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc'): Collection;

}
