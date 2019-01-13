@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route("racks.index")}}">Racks </a>
                        >{{$rack->name}}
                    </div>

                    <div class="card-body">
                        @include("layouts.alert")

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Year</th>
                                        <th>Rack</th>
                                        <th>created at</th>
                                        <th>updated at</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($books as $book)
                                    <tr>
                                        <td scope="row">{{$book->id}}</td>
                                        <td>{{$book->title}}</td>
                                        <td>{{$book->author}}</td>
                                        <td>{{$book->published_year}}</td>
                                        <td>{{$book->rack->name}}</td>
                                        <td>{{$book->created_at}}</td>
                                        <td>{{$book->updated_at}}</td>
                                        <td>
                                            <form action="{{ route('books.destroy', $book->id) }}" method="post" class="form-horizontal">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="delete">
                                                <div class="btn-group">
                                                    @if(Auth::user()->hasPermission('update-books'))<a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>@endif
                                                    @if(Auth::user()->hasPermission('delete-books'))<button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</button>@endif
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$books->links()}}
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
