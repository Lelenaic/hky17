<?php

namespace App\Http\Controllers;

use App\Bc\Booking;
use App\ChargingStation;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Only authenticated users can access here ...
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List of bookings
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index(){
        return \App\Booking::all();
    }

    /**
     * Create a new booking
     * @param Request $r
     */
    public function store(Request $r){
        $r->validate([
            'chargingStation' => 'required|integer',
            'timestamp' => 'required|integer|digits:10',
            'kms' => 'required|integer'
        ]);
        auth()->loginUsingId(1);
        $bk=new Booking();
        $bk->setUser(auth()->user());
        $bk->setTimestamp($r->timestamp);
        $bk->setCharge($r->kms);
        $bk->setChargingStation(ChargingStation::find($r->chargingStation));
        $bk->save();
    }
}
