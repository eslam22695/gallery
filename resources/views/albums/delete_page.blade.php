@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Delete Album ({{$album->title}})</h2>
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

    <table class="table table-bordered mt-5">
        
        <tr>
            <th>Delete Album With All Images</th>
            <td>
                <form action="{{ route('albums.destroy',$album->id) }}" method="POST">

                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        <tr>
            <th>Delete Album & Transfer All Images To Another Album</th>
            <td>
                <form action="{{ route('albums.transfer_image',$album->id) }}" method="POST">
                    @csrf
        
                    <div>
                        <div class="form-group">
                            <strong>Albums:</strong>
                            <select class="form-contrpl" name="album_id">
                                @foreach ($another_albums as $another_album)
                                    <option value="{{$another_album->id}}">{{$another_album->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </td>
        </tr>
    </table>

@endsection