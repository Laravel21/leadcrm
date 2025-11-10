<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;


class LocationController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('name')->get();
        return view('leads.create',compact('countries'));
    }

    public function getStates(Request $request)
    {
        $states = State::where('countryId',$request->country_id)->orderBy('name')->get();
        return response()->json($states);
    }
    public function getCities(Request $request)
    {
        $cities = City::where('stateId',$request->state_id)->orderBy('name')->get();
        return response()->json($cities);
    }
}
