<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    const CHAIN_NAME='resa';
    const STREAM_NAME='booking';

    public static function kc_all(){
        $bookings=shell_exec('multichain-cli '.static::CHAIN_NAME.' liststreamitems '.static::STREAM_NAME);
        var_dump(json_decode($bookings));
    }
}
