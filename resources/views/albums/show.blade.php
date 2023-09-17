@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show Album ({{$album->title}})</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('albums.index') }}"> Back</a>
            </div>
        </div>
    </div>
        
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
        
    <form action="{{ route('album.image.store', $album->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>title:</strong>
                    <input type="text" name="title" value="{{old('title')}}" required class="form-control" placeholder="title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="image" class="form-control" placeholder="image">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        
    </form>
     
    <table class="table table-bordered mt-5">
        <tr>
            <th>title</th>
            <th>Image</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($images as $image)
        <tr>
            <td>{{$image->title}}</td>
            <td>
                <img 
                alt="gallery" 
                class="img-responsive" 
                src="/images/{{ $image->image }}" width="250">    
            </td>
            <td>
                <form action="{{ route('album.image.destroy',$image->id) }}" method="POST">

                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $images->links() !!}
@endsection