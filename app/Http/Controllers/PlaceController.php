<?php

namespace App\Http\Controllers;

use App\Models\Attraction;
use App\Models\IbeaconLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $beacons = IbeaconLocation::all();

        return view('places.index', compact('places', 'beacons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $places = Attraction::all();
        $beacons = IbeaconLocation::all();

        return view('places.create', compact('places', 'beacons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Major = $request->get('major');
        $ALL = str_split($Major, 5);
        $Major = (int) $ALL[0];
        $Minor = (int) $ALL[1];
        $BeaconIDdata = DB::select("select * from ibeacon_location where major =$Major and minor =$Minor");
        $Beaconstring = implode(' ', array_column($BeaconIDdata, 'id'));

        $request->validate([
            'major' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'viewname' => 'required',
            'note' => 'required',
            'image' => 'required',
            'url' => 'required',
        ]);

        // * 更新對應欄位
        $place = new Attraction([
            'beaconid' => $Beaconstring,
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

        $placebeacon = DB::select("select beaconid from attractions where id=$id");

        $placebeacon = implode(' ', array_column($placebeacon, 'beaconid'));

        $placemajor = DB::select("select major from ibeacon_location where id=$placebeacon");

        $placemajor = implode(' ', array_column($placemajor, 'major'));

        $placeminor = DB::select("select minor from ibeacon_location where id=$placebeacon");

        $placeminor = implode(' ', array_column($placeminor, 'minor'));

        $beacons = DB::select("select * from ibeacon_location where not id=$placebeacon");

        return view('places.edit', compact('place', 'beacons', 'placemajor', 'placeminor'));
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
        $Major = $request->get('major');
        $ALL = str_split($Major, 5);
        $Major = (int) $ALL[0];
        $Minor = (int) $ALL[1];
        $BeaconIDdata = DB::select("select * from ibeacon_location where major =$Major and minor =$Minor");
        $Beaconstring = implode(' ', array_column($BeaconIDdata, 'id'));

        $request->validate([
            'major' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'viewname' => 'required',
            'image' => 'required',
            'note' => 'required',
            'url' => 'required',
        ]);
        $place = Attraction::find($id);
        $place->beaconid = $Beaconstring;
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
