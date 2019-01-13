@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route("racks.index")}}">Racks </a>
                        > Creating New Rack
                    </div>

                    <div class="card-body">
                        @include("layouts.alert")
                        @include("layouts.error")
                            <form action="{{route("racks.store")}}" method="post">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label for="name">Rack Name</label>
                                    <input
                                        type="text"
                                        class="form-control" name="name" id="name"
                                        placeholder="Enter Rack Name">
                                </div>
                                <button type="submit" class="btn btn-success">
                                    Create
                                </button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
