<?php

namespace App\Http\Controllers;

use App\Bc\Booking;
use App\ChargingStation;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    /**
     * List of bookings
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index(){
        return response()->json(\App\Bc\Booking::allToJson());
    }

    /**
     * Create a new booking
     * @param Request $r
     */
    public function store(Request $r){
        $r->validate([
            'chargingStation' => 'required|integer',
            'timestamp' => 'required|integer|digits:10',
            'kms' => 'required|integer',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        auth()->once(['email'=>$r->email, 'password' => $r->password]);
        $bk=new Booking();
        $bk->setUser(auth()->user());
        $bk->setTimestamp($r->timestamp);
        $bk->setCharge($r->kms);
        $bk->setChargingStation(ChargingStation::find($r->chargingStation));
        $bk->save();
    }
}
