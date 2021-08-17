<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Client;
use App\Point;
use App\City;
use App\Vendor;

class ClientController extends Controller {

    public function getClientStartInfo() {

        $user_id = Auth::guard('vendor')->user()->id;
        $vendor = Vendor::where('id', $user_id)->first();
        $client = Client::where('phone', $vendor->phone)->first();
        $points = City::with('points')->get();
        $point_default_id = $client->point_default_id;
        if(isset($point_default_id)) {
            $city_id = Point::find($point_default_id)->city_id;
        } else {
            $city_id = NULL;
        }
        $response['user_info'] = $client;
        $response['points'] = $points;
        $response['city_id'] = $city_id;

        return response()->json($response);
    }

}
