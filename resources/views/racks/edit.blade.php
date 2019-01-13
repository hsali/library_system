@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> <a href="{{route("racks.index")}}">Racks </a>
                        >{{$rack->name}}</div>

                    <div class="card-body">
                        @include("layouts.alert")
                        @include("layouts.error")
                        <form action="{{route("racks.update", $rack)}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">

                            <div class="form-group">
                                <label for="name">Rack Name</label>
                                <input
                                    type="text"
                                    class="form-control" name="name" id="name" value="{{$rack->name}}"
                                    placeholder="Enter Rack Name">

                                <button type="submit" class="btn btn-success">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
