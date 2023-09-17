@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Album</h2>
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

<form action="{{ route('albums.update',$album->id) }}" method="POST" enctype="multipart/form-data"> 
    @csrf
    @method('PUT')
 
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>title:</strong>
                <input type="text" name="title" value="{{ old('title',$album->title) }}" class="form-control" placeholder="title">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
 
</form>
@endsection