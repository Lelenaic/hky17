<?php

namespace App\Bc;

use Illuminate\Database\Eloquent\Model;

class Booking
{
    private $_id;
    private $_chargeStation;
    private $_timestamp;
    private $_car;

    const CHAIN_NAME = 'resa';
    const STREAM_NAME = 'booking';

    public static function kc_all()
    {
        $bookings = shell_exec('multichain-cli ' . static::CHAIN_NAME . ' liststreamitems ' . static::STREAM_NAME);
        var_dump(json_decode($bookings));
    }

    public function getFromKc()
    {
        if (isset($this->id)) {
            $bookings = shell_exec('multichain-cli ' . static::CHAIN_NAME . ' liststreamkeyitems ' . static::STREAM_NAME . ' ' . $this->id);
            return json_decode($bookings)[0];
        } else {
            throw new \Exception('Unknown bookibg!');
        }

    }
}
