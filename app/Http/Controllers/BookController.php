<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\BookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Repositories\BookRepository;
use App\Repositories\BookRepositoryInterface;
use App\Repositories\RackRepositoryInterface;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $bookRepo = null;

    private $rackRepo = null;
    public function __construct(BookRepositoryInterface $bookRepository, RackRepositoryInterface $rackRepository)
    {
        $this->bookRepo = $bookRepository;
        $this->rackRepo = $rackRepository;

        $this->middleware(['permission:create-books'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:update-books'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-books'], ['only' => ['destroy']]);
        $this->middleware(['permission:read-books'], ['only' => ['index', 'show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $list = $this->bookRepo->listBooks();
        if (request()->has('q') && request()->input('q') != '') {
            $list = $this->bookRepo->searchBook(request()->input('q'));
        }

        $books = $list->map(function (Book $item) {
            return $item;
        })->all();
        $paginated_books = $this->bookRepo->paginateArrayResults($books, 10);
        return view("books.index", ["books" => $paginated_books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $racks = $this->rackRepo->listRacks();
        return view("books.create", ["racks" => $racks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {

        $this->bookRepo->createBook($request->all());

        return redirect()->route('books.index')->with(["status"=>"success", 'message'=>'Create Books successful!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
//        $list = $this->bookRepo->listBooksByRackId($book->id);
//
//        $books = $list->map(function (Book $item) {
//            return $item;
//        })->all();
//        $paginated_books = $this->bookRepo->paginateArrayResults($books, 5);
//        return view("racks.show", ["books" => $paginated_books, "rack"=>$rack]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit', ['book' => $book, "racks" => $this->rackRepo->listRacks()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Book $book
     * @return \Illuminate\Http\Response
     * @throws \App\Exceptions\BookUpdateErrorException
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $bookRepo = new BookRepository($book);
        $bookRepo->updateBook($request->except("_token","_method"));

        return redirect()->route('books.edit', $book)->with(["status"=>"success", 'message'=>'Update Books successful!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $bookRepo = new BookRepository($book);
        try{

            $bookRepo->deleteBook();
            $status = "success";
            $message = "Delete $book->name successful!";
        }catch (\Exception $exception){
            $message = $exception->getMessage();
            $status = "danger";
        }

        return redirect()->route('books.index')->with(["status"=>$status, 'message'=>$message]);
    }
}
