<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SenderPhoneRequest;
use App\Http\Requests\RecipientPhoneRequest;
use App\Http\Requests\CostParamsRequest;
use App\Http\Requests\AllPackageRequest;
use App\Client;
use App\City;
use App\Category;
use App\Package;
use App\Status;
use App\Point;
use App\History_status;

class PackageController extends Controller
{
    public function getStartInfo(){
        
        return view('new_package', [
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

    public function addNewPackage(AllPackageRequest $req){
        // $recipient_phone = $req->input('phone_recipient');
        
        // DB::transaction(function(){
        //     global $req;
            $sender_phone = Client::where('phone', $req->input('phone_sender'))->first();
        if($sender_phone == null){
            $sender = new Client;
        } else {
            $sender = Client::where('phone', $req->input('phone_sender'))->first();
        }
            $sender->surname = $req->input('surname_sender');
            $sender->name = $req->input('name_sender');
            $sender->middle_name = $req->input('middle_name_sender');
            $sender->phone = $req->input('phone_sender');
            $sender->save();
        
        $recipient_phone = Client::where('phone', $req->input('phone_recipient'))->first();
        if($recipient_phone == null){
            $recipient = new Client;
        } else {
            $recipient = Client::where('phone', $req->input('phone_recipient'))->first();
        }
            $recipient->surname = $req->input('surname_recipient');
            $recipient->name = $req->input('name_recipient');
            $recipient->middle_name = $req->input('middle_name_recipient');
            $recipient->phone = $req->input('phone_recipient');
            $recipient->save();
            
            $package = new Package;
            $package->status_id = 1;
            $package->employee_id = 2;
            $package->sender_id = $sender->id;
            $package->receiver_id = $recipient->id;
            if($req->input('payer') == 'payer_sender'){
                $package->payment = 1;  
            } else {
                $package->payment = 0;  
            }
            $package->point_to = $req->input('point_recipient');
            $package->point_from = 1;
            $package->user_price = $req->input('pacckage_cost');
            $package->price = $req->input('pay_sum');
            $package->width = $req->input('pacckage_width');
            $package->heigth = $req->input('pacckage_heigth');
            $package->lenght = $req->input('pacckage_length');
            $package->weight = $req->input('pacckage_weight');
            $package->category_id = $req->input('package_category');
            if($req->input('non-receipt_action')){
                $package->returned = 1;
            } else {
                $package->returned = 0; 
            }
            $package->save();
            $history_status = new History_status;
            $history_status->package_id = $package->id;
            $history_status->date_change = $package->created_at;
            $history_status->status_id = $package->status_id;
            $history_status->employee_id = $package->employee_id;
            $history_status->save();
            return view('admin', [
                'res' => true
            ]);
    //     });
    //     return view('admin', [
    //         'res' => false
    //     ]);
    }
    // return redirect()->route('blog.index')
    //         ->with('success','Blog updated successfully');
    
}
