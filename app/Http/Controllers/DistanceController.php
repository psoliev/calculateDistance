<?php

namespace App\Http\Controllers;

use App\Models\Distance;
use Illuminate\Http\Request;
use Location\Coordinate;
use Location\Distance\Vincenty;
use MoveMoveIo\DaData\Facades\DaDataAddress;

class DistanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $address1 = $request->input('address1');
        $address2 = $request->input('address2');

        if(!isset($address1) or !isset($address2)){
            return redirect('/');
        }

        $dadata1 = DaDataAddress::standardization($address1);
        $dadata2 = DaDataAddress::standardization($address2);

        if(!isset($dadata1[0]['geo_lat']) or !isset($dadata2[0]['geo_lat']) or !isset($dadata1[0]['geo_lon']) or !isset($dadata2[0]['geo_lon'])){
            return redirect('/');
        }
        $coordinate1 = new Coordinate($dadata1[0]['geo_lat'], $dadata1[0]['geo_lon']);
        $coordinate2 = new Coordinate($dadata2[0]['geo_lat'], $dadata2[0]['geo_lon']);

        $calculator = new Vincenty();

        $dist = $calculator->getDistance($coordinate1, $coordinate2);
        return view('welcome', compact(['address1', 'address2', 'dist']));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Distance  $distance
     * @return \Illuminate\Http\Response
     */
    public function show(Distance $distance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Distance  $distance
     * @return \Illuminate\Http\Response
     */
    public function edit(Distance $distance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Distance  $distance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distance $distance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Distance  $distance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distance $distance)
    {
        //
    }
}
