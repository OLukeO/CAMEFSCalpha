<?php

namespace App\Http\Controllers;

use App\Models\IbeaconLocation;
use Illuminate\Http\Request;

class IbeaconController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beacons = IbeaconLocation::all();

        return view('beacons.index', compact('beacons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('beacons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'major' => 'required',
            'minor' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'uuid' => 'required',
        ]);

        // * 更新對應欄位
        $beacons = new IbeaconLocation([
            'major' => $request->get('major'),
            'minor' => $request->get('minor'),
            'lat' => $request->get('lat'),
            'lng' => $request->get('lng'),
            'uuid' => $request->get('uuid'),
        ]);

        $beacons->save();

        return redirect('/beacons')->with('success', 'beacon OK！');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $beacons = IbeaconLocation::find($id);

        return view('beacons.edit', compact('beacons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'major' => 'required',
            'minor' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'uuid' => 'required',
        ]);
        $beacons = IbeaconLocation::find($id);
        $beacons->major = $request->get('major');
        $beacons->minor = $request->get('minor');
        $beacons->lat = $request->get('lat');
        $beacons->lng = $request->get('lng');
        $beacons->uuid = $request->get('uuid');
        $beacons->save();

        return redirect('/beacons')->with('success', '更新OK！');
        $this->authorize('update', $beacons);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $beacons = IbeaconLocation::find($id);

        $beacons->delete();

        return redirect('/beacons')->with('success', 'beacon deleted!');
    }
}
