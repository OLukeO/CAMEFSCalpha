<?php

namespace App\Http\Controllers;

use App\Models\Attraction;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Attraction::all();

        return view('places.index', compact('places'));

        $places = Attraction::all();

        return view('places.userview', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('places.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'peoplenumber' => 'required',
            'beaconid' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'viewname' => 'required',
            'note' => 'required',
            'image' => 'required',
            'url' => 'required',
        ]);

        // * 更新對應欄位
        $place = new Attraction([
            'peoplenumber' => $request->get('peoplenumber'),
            'beaconid' => $request->get('beaconid'),
            'lat' => $request->get('lat'),
            'lng' => $request->get('lng'),
            'viewname' => $request->get('viewname'),
            'note' => $request->get('note'),
            'image' => $request->get('image'),
            'url' => $request->get('url'),
        ]);

        $place->save();

        return redirect('/places')->with('success', '景點OK！');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place = Attraction::find($id);

        return view('places.edit', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'peoplenumber' => 'required',
            'beaconid' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'viewname' => 'required',
            'image' => 'required',
            'note' => 'required',
            'url' => 'required',
        ]);
        $place = Attraction::find($id);
        $place->peoplenumber = $request->get('peoplenumber');
        $place->beaconid = $request->get('beaconid');
        $place->lat = $request->get('lat');
        $place->lng = $request->get('lng');
        $place->viewname = $request->get('viewname');
        $place->note = $request->get('note');
        $place->url = $request->get('url');
        $place->image = $request->get('image');
        $place->save();

        return redirect('/places')->with('success', '更新OK！');
        $this->authorize('update', $place);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Attraction::find($id);

        $place->delete();

        return redirect('/places')->with('success', 'place deleted!');
    }
}
