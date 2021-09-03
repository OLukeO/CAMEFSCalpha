<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Howmanypeople;
use App\Models\Attraction;


class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('peoples.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'logtime' => 'required',
            'aid' => 'required',
        ]);

        $date0 = $request->get('logtime');
        $date = date('Y-m-d', strtotime($date0));
        $date1=date('Y-m-d',strtotime("$date+1 day"));
        $position = $request->get('aid');
        $peoples = Howmanypeople::where('aid', $position,)
            ->where('logtime','>=',$date)
            ->where('logtime','<',$date1)
            ->get();
        
        $positions = Attraction::where('id', $position,)
            ->select('viewname')
            ->get();

        return view('peoples.index', compact('peoples', 'positions'));
    }

    public function index()
    {   
        $peoples = Howmanypeople::all('aid');
        
        $positions =Attraction::all('id');
            
        return view('peoples.index', compact('peoples', 'positions'));
    }
    
}
