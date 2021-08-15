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
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
// use Illuminate\Support\Facades\Auth;
use Hesto\MultiAuth\Traits\LogsoutGuard;


class PackageController extends Controller
{
    public function getStartInfo(){
        if(Auth::guard('admin')->check()){
            return view('new_package', [
                'cities' => City::all(),
                'categories' => Category::all()
                ]);
        } else{
            return redirect('admin/login');
        }
        

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
    }
    public function getCity(){
        
        return view('points', [
            'cities' => City::all()
            ]);

    }

    public function getPackageCalculateInfo(){
        
        return view('calculate', [
            'cities' => City::all(),
            'categories' => Category::all()
            ]);
    }

    public function getInfoPackageByNumber(Request $req){

        $number = $req->input('number');
        $package = Package::find($number);
        $package_info["status"] = Status::find($package->status_id)->name;
        $date = $package->created_at;
        $package_info["date"] = date("d-m-Y", strtotime($date.'+ 1 days'));
        
        return response()->json($package_info);
    }

    public function getUserPackages(Request $req){

        $individual = $req->individual;
        
        $userId = Auth::guard('vendor')->user()->id;
        $packages = DB::table('packages as p' )
        ->join( 'clients as  ' . $individual, DB::raw('p. '.$individual.'_id'), '=', DB::raw( $individual.'.id'))
        ->join( 'points as pt', DB::raw('p.point_to'), '=', DB::raw('pt.id'))
        ->join( 'cities as ct', DB::raw('pt.city_id'), '=', DB::raw('ct.id'))
        ->join( 'points as pf', DB::raw('p.point_from'), '=', DB::raw('pf.id'))
        ->join( 'cities as cf', DB::raw('pf.city_id'), '=', DB::raw('cf.id'))
        ->join( 'categories as cat', DB::raw('p.category_id'), '=', DB::raw('cat.id'))
        ->join( 'statuses as st', DB::raw('p.status_id'), '=', DB::raw('st.id'))
        ->select( DB::raw( 'p.id as package_number,'.
        $individual.'.name as sender_name,'.
        $individual.'.surname as sender_surname,'.
        $individual.'.middle_name sender_middle_name,'.
        $individual.'.phone as sender_phone,
        pt.adress as adress_to,
        ct.name as city_to,
        pf.adress as adress_from,
        cf.name as city_from,
        p.weight as weight,
        p.created_at as created_at,
        p.price as price,
        cat.name as category,
        st.name as status'))
        ->where(DB::raw('p.sender_id'), '=', $userId);

        if($req->is_active == 1) {
            $packages->whereNotIn(DB::raw('p.status_id'), [4, 10]);
        }
        
        return response()->json($packages->get());
    }
    
}
