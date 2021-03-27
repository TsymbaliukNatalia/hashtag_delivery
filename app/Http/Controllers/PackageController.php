<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SenderPhoneRequest;
use App\Http\Requests\RecipientPhoneRequest;
use App\Http\Requests\CostParamsRequest;
use App\Client;
use App\City;
use App\Category;

class PackageController extends Controller
{
    public function getStartInfo(){
        
        return view('admin', [
            'cities' => City::all(),
            'categories' => Category::all()
            ]);

    }
    public function getSenderInfo(SenderPhoneRequest $req){

        $sender_phone = $req->input('phone_sender');
        $sender = Client::where('phone',$sender_phone)->first();
        
        return response()->json($sender);

    }
    public function getRecipientInfo(RecipientPhoneRequest $req){

        $recipient_phone = $req->input('phone_recipient');
        $recipient = Client::where('phone', $recipient_phone)->first();
        
        return response()->json($recipient);
    }
    public function getCityPoints(Request $req){

        $city_name = $req->input('city');
        $city = City::where('name', $city_name)->first();
        $points = $city->points;

        return response()->json($points);

    }

    public function getPackageCost(CostParamsRequest $req){

        $width = $req->input('width');
        $length = $req->input('length');
        $heigth = $req->input('heigth');
        $weight = $req->input('weight');
        $cost = $req->input('cost');
        
        $sum = ($width*$length*$heigth*$weight*200)/1000000+$cost*0.02;
        if($sum < 25){
            $sum = 25;
        }
        
        return $sum;
    }

    

    
}
