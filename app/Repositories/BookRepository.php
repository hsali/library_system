<?php

namespace App\Repositories;


use App\Book;
use App\Exceptions\BookCreateErrorException;
use App\Exceptions\BookNotFoundException;
use App\Exceptions\BookUpdateErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Jsdecena\Baserepo\BaseRepository;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{


    /**
     * BookRepository constructor.
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        /** @var Book $book */
        parent::__construct($book);
        $this->model = $book;
    }

    /**
     * List all the products
     *
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     * @return Collection
     */
    public function listBooks($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc') : Collection
    {
        return $this->all($columns, $orderBy, $sortBy);
    }

    /**
     * @param $id
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     * @return Collection
     */
    public function listBooksByRackId($id, $columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc'): Collection{
        return $this->model->where(["rack_id"=>$id])->orderBy($orderBy, $sortBy)->get($columns);
    }

    /**
     * Create the product
     *
     * @param array $data
     *
     * @return Book
     * @throws BookCreateErrorException
     */
    public function createBook(array $data) : Book
    {
        try {
            return $this->create($data);
        } catch (QueryException $e) {
            throw new BookCreateErrorException($e);
        }
    }

    /**
     * Update the product
     *
     * @param array $data
     *
     * @return bool
     * @throws BookUpdateErrorException
     */
    public function updateBook(array $data) : bool
    {
        $filtered = collect($data)->except('image')->all();

        try {
            return $this->model->where('id', $this->model->id)->update($filtered);
        } catch (QueryException $e) {
            throw new BookUpdateErrorException($e);
        }
    }

    /**
     * Find the product by ID
     *
     * @param int $id
     *
     * @return Book
     * @throws BookNotFoundException
     */
    public function findBookById(int $id) : Book
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new BookNotFoundException($e);
        }
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function deleteBook() : bool
    {
        return $this->delete();
    }

    /**
     * @param string $text
     * @return mixed
     */
    public function searchBook(string $text) : Collection
    {
        if (!empty($text)) {
            return $this->model->searchBook($text);
        } else {
            return $this->listBooks();
        }
    }

}
