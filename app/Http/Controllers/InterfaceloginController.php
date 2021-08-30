<?php

namespace App\Http\Controllers;

use App\Models\Attraction;
use Illuminate\Http\Request;

class InterfaceloginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attraction = Attraction::all();

        return view('attract.index', compact('attraction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('attraction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'beaconid' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'viewname' => 'required',
            'note' => 'required',
            'image' => 'required',
            'url' => 'required',
            'peoplenumber' => 'required',
        ]);

        $attraction = new Attraction([
            'beaconid' => $required->get('beaconid'),
            'lat' => $required->get('lat'),
            'lng' => $required->get('lng'),
            'viewname' => $required->get('viewname'),
            'note' => $required->get('note'),
            'image' => $required->get('image'),
            'url' => $required->get('url'),
            'peoplenumber' => $required->get('peoplenumber'),
        ]);

        $attraction->save();

        return redirect('/attraction')->with('success', '景點ok');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Voting $voting
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Voting $voting
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attraction = Attraction::find($id);

        return view('edit', compact('attraction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\Voting $voting
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'beaconid' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'viewname' => 'required',
            'note' => 'required',
            'image' => 'required',
            'url' => 'required',
            'peoplenumber' => 'required',
        ]);
        $attraction = Attraction::fing($id);
        $attraction->beaconid = $request->get('beaconid');
        $attraction->lat = $request->get('lat');
        $attraction->lng = $request->get('lng');
        $attraction->viewname = $request->get('viewname');
        $attraction->note = $request->get('note');
        $attraction->image = $request->get('image');
        $attraction->url = $request->get('url');
        $attraction->peoplenumber = $request->get('peoplenumber');
        $attraction->save();

        return redirect('/attraction')->with('success', '更新ok');
        $this->authorize('update', $attraction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Voting $voting
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voting $voting)
    {
        $attraction = Attraction::find($id);

        $attraction->delete();

        return redirect('/attraction')->with('success', 'attraction deleted');
    }
}
