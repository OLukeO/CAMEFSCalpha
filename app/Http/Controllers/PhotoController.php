<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();

        return view('photo.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('photo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048',
        ]);
        // * 讀取 upload file
        $image = $request->file('photo');
        // * 存檔 image
        $new_name = 'place_'.now()->format('YmdHis').rand().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        // * 更新對應欄位
        $place = new Photo([
            'photo_path' => $new_name,
        ]);

        $place->save();

        return redirect('/photos')->with('success', '景點OK！');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        $place = Photo::find($id);

        return view('photo.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Photo::find($id);

        $place->delete();

        return redirect('/photos')->with('success', 'photo deleted!');
    }
}
