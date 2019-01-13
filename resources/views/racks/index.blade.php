@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Racks</div>

                    <div class="card-body">
                        @include("layouts.alert")
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>name</th>
                                        <th>total</th>
                                        <th>created at</th>
                                        <th>updated at</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($racks as $rack)
                                        <tr>
                                            <td scope="row">{{$rack->id}}</td>
                                            <td><a href="{{route("racks.show",["id"=>$rack->id])}}">{{$rack->name}}</a></td>
                                            <td>{{$rack->books_count}}</td>
                                            <td>{{$rack->created_at}}</td>
                                            <td>{{$rack->updated_at}}</td>
                                            <td>
                                                <form action="{{ route('racks.destroy', $rack->id) }}" method="post" class="form-horizontal">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="delete">
                                                    <div class="btn-group">
                                                        <a href="{{ route('racks.show', $rack->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>View Books</a>
                                                        @if(Auth::user()->hasPermission('update-racks'))<a href="{{ route('racks.edit', $rack->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>@endif
                                                        @if(Auth::user()->hasPermission('delete-racks'))<button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</button>@endif
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$racks->links()}}
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
