<?php

namespace App\Http\Controllers;

use App\Bc\Booking;
use App\ChargingStation;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return \App\Booking::all();
    }

    public function store(Request $r){
        $r->validate([
            'chargingStation' => 'required|integer',
            'timestamp' => 'required|integer|digits:10'
        ]);
        $bk=new Booking();
        $bk->setUser(auth()->user());
        $bk->setTimestamp($r->timestamp);
        $bk->setChargingStation(ChargingStation::find($r->chargingStation));
        $bk->save();
    }

    public function isAvailable(){

    }
}
