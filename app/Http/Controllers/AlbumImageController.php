<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumImage;
use Illuminate\Http\Request;

class AlbumImageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Album $album)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $input = $request->all();
    
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        $album->images()->create($input);

        return redirect()->back()->with('success','Album Image created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AlbumImage $image)
    {
        unlink('images/'.$image->image);
        $image->delete();

        return redirect()->back()->with('success','Album Image deleted successfully.');
    }
}
