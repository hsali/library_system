@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route("books.index")}}">Books </a>
                        > Creating New Book
                    </div>

                    <div class="card-body">
                        @include("layouts.alert")
                        @include("layouts.error")
                        <form action="{{route("books.store")}}" method="post">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="title">Book Name</label>
                                <input
                                    type="text"
                                    class="form-control" name="title" id="title"
                                    placeholder="Enter Rack Name" aria-describedby="title">
                                <small id="title" class="text-muted">Book Name</small>
                            </div>

                            <div class="form-group">
                                <label for="author">Author</label>
                                <input
                                    type="text"
                                    name="author" id="author" class="form-control" placeholder="Author Name" aria-describedby="author">
                                <small id="author" class="text-muted">Author Name</small>
                            </div>

                            <div class="form-group">
                                <label for="published_year">Published Year</label>
                                <input
                                    type="text"
                                    name="published_year" id="published_year" class="form-control" placeholder="Published Year 4 digit number" aria-describedby="published_year">
                                <small id="published_year" class="text-muted">4 digit year number</small>
                            </div>

                            <div class="form-group">
                                <label for="rack_id"></label>
                                <select class="form-control" name="rack_id" id="rack_id">
                                    @foreach($racks as $rack)
                                        <option value="{{$rack->id}}">{{$rack->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    Create
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
