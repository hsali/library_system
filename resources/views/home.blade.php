@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @include("layouts.alert")
                    <a href="{{route("racks.index")}}">Racks</a>
                    <br>
                    <a href="{{route("books.index")}}">Books</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
