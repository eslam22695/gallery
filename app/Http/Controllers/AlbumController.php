<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::orderByDesc('id')->paginate(5);
        
        return view('albums.index',compact('albums'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        Album::create([
            'title' => $request->title
        ]);

        return redirect()->route('albums.index')->with('success','Album created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        $images = $album->images()->paginate(5);
        return view('albums.show', compact('album','images'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        return view('albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $album->update([
            'title' => $request->title
        ]);

        return redirect()->route('albums.index')->with('success','Album Updated successfully.');
    }

    /**
     * Delete Page to get the main action
     */
    public function delete_page(Album $album)
    {
        $another_albums = Album::where('id', '!=', $album->id)->get();
        return view('albums.delete_page', compact('album','another_albums'));
    }

    /**
     * Transfer Image To Another Album
     */
    function transfer_image(Request $request, Album $album)
    {
        $request->validate([
            'album_id' => 'required|exists:albums,id',
        ]);

        
        $album->images()->update([
            'album_id' => $request->album_id
        ]);

        $album->delete();

        return redirect()->route('albums.index')->with('success','Album Delete & Images Transfered successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        foreach($album->images as $image)
        {
            unlink('images/'.$image->image);
            $image->delete();
        }

        $album->delete();

        return redirect()->route('albums.index')->with('success','Album Delete successfully.');
    }
}
