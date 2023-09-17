@extends('layouts.app')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Albums</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('albums.create') }}"> Create Album</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
     
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($albums as $album)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $album->title }}</td>
            <td>
                <a class="btn btn-primary" href="{{ route('albums.edit',$album->id) }}">Edit</a>
                <a class="btn btn-info" href="{{ route('albums.show',$album->id) }}">Show</a>
                <a class="btn btn-danger" href="{{ route('albums.delete_page',$album->id) }}">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
    
    {!! $albums->links() !!}
        
@endsection