<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\RackRequest;
use App\Rack;
use App\Repositories\BookRepositoryInterface;
use App\Repositories\RackRepository;
use App\Repositories\RackRepositoryInterface;
use Illuminate\Http\Request;

class RackController extends Controller
{

    private $bookRepo = null;
    private $rackRepo = null;

    public function __construct(RackRepositoryInterface $rackRepository, BookRepositoryInterface $bookRepository)
    {
        $this->rackRepo = $rackRepository;
        $this->bookRepo = $bookRepository;

        $this->middleware(['permission:create-racks'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:update-racks'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-racks'], ['only' => ['destroy']]);
        $this->middleware(['permission:read-racks'], ['only' => ['index', 'show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->rackRepo->listRacks();
        $racks = $list->map(function (Rack $item) {
            return $item;
        })->all();
        $paginated_racks = $this->rackRepo->paginateArrayResults($racks, 10);
        return view("racks.index", ["racks" => $paginated_racks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("racks.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \App\Exceptions\CreateRackErrorException
     */
    public function store(RackRequest $request)
    {
        $this->rackRepo->createRack($request->all());

        return redirect()->route('racks.index')->with(["status"=>"success", 'message'=>'Create Racks successful!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rack  $rack
     * @return \Illuminate\Http\Response
     */
    public function show(Rack $rack)
    {
        $list = $this->bookRepo->listBooksByRackId($rack->id);

        $books = $list->map(function (Book $item) {
            return $item;
        })->all();
        $paginated_books = $this->bookRepo->paginateArrayResults($books, 5);
        return view("racks.show", ["books" => $paginated_books, "rack"=>$rack]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rack  $rack
     * @return \Illuminate\Http\Response
     */
    public function edit(Rack $rack)
    {
        return view('racks.edit', ['rack' => $rack]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Rack $rack
     * @return \Illuminate\Http\Response
     * @throws \App\Exceptions\UpdateRackErrorException
     */
    public function update(Request $request, Rack $rack)
    {
        $rackRepo = new RackRepository($rack);
        $rackRepo->updateRack($request->all());

        return redirect()->route('racks.edit', $rack)->with(["status"=>"success", 'message'=>'Update Racks successful!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rack $rack
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Rack $rack)
    {

        $rackRepo = new RackRepository($rack);
        try{

            $rackRepo->deleteRack();
            $status = "success";
            $message = "Delete $rack->name successful!";
        }catch (\Exception $exception){
            $message = "$rack->name has books";
            $status = "danger";
        }

        return redirect()->route('racks.index')->with(["status"=>$status, 'message'=>$message]);
    }
}
