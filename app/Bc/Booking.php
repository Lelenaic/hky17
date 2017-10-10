<?php

namespace App\Bc;

use App\Car;
use App\ChargingStation;
use App\User;
use App\Utils;
use Carbon\Carbon;

class Booking
{
    // THe blockahin name
    const CHAIN_NAME = 'book';
    // The stream name. A stream is a set of data (like a collection in mongo).
    const STREAM_NAME = 'booking';

    private $_id;
    private $_chargingStation;
    private $_timestamp;
    private $_user;
    /**
     * @var integer
     */
    private $_charge;
    /**
     * @var \App\Booking
     */
    private $_relatedBooking;


    /**
     * @return int
     */
    public function getCharge(): int
    {
        return $this->_charge;
    }

    /**
     * @param int $charge
     */
    public function setCharge(int $charge)
    {
        $this->_charge = $charge;
    }

    /**
     * @return \App\Booking
     */
    public function getRelatedBooking(): \App\Booking
    {
        return $this->_relatedBooking;
    }

    /**
     * @param \App\Booking $relatedBooking
     */
    public function setRelatedBooking(\App\Booking $relatedBooking)
    {
        $this->_relatedBooking = $relatedBooking;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getChargingStation()
    {
        return $this->_chargingStation;
    }

    /**
     * @param mixed $chargingStation
     */
    public function setChargingStation($chargingStation)
    {
        $this->_chargingStation = $chargingStation;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->_timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->_timestamp = $timestamp;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->_user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->_user = $user;
    }


    /**
     * Get all bookings from blockchain
     * @return Booking[]
     */
    public static function all(): array
    {
        $bookings = shell_exec('multichain-cli ' . static::CHAIN_NAME . ' liststreamitems ' . static::STREAM_NAME);
        $bookings = json_decode($bookings);
        $array = array();
        foreach ($bookings as $booking) {
            if ($booking->key != 1) {
                $bk = static::newFromHex($booking->data);
                $array[] = $bk;
            }
        }
        return $array;
    }

    public static function allToJson(){
        $bookings=static::all();
        $a=array();
        foreach ($bookings as $booking) {
            $a[]=['title'=>$booking->getChargingStation()->id, 'start'=>$booking->getStartFormatted(), 'end'=>$booking->getEndFormatted()];
        }
        return $a;
    }

    // Find and get a booking by ID
    public static function find(int $id): Booking
    {
        $bookings = shell_exec('multichain-cli ' . static::CHAIN_NAME . ' liststreamkeyitems ' . static::STREAM_NAME . ' ' . $id);
        $bk = json_decode($bookings);
        if (isset($bk[0])) {
            return static::newFromHex($bk[0]->data);
        } else {
            return null;
        }
    }

    /**
     * Create a Booking from hexadecimal data.
     * @param String $hexa
     * @return Booking
     */
    private static function newFromHex(String $hexa): Booking
    {
        $metadata = json_decode(Utils::hexToStr($hexa));
        $bk = new Booking();
        $bk->setId($metadata->id);
        $bk->setRelatedBooking(\App\Booking::find($metadata->id));
        $bk->setUser(User::find($metadata->user));
        $bk->setChargingStation(ChargingStation::find($metadata->chargingStation));
        $bk->setTimestamp($metadata->timestamp);
        $bk->setCharge($metadata->charge);
        return $bk;
    }

    /**
     * Save a new booking in the database.
     * Only new bookings are allowed. Cannot modify or delete.
     * @return bool
     * @throws \Exception
     */
    public function save(): bool
    {
        if (isset($this->_id)) {
            throw new \Exception('Cannot update an existing Booking!');
        } else {
            $bk = new \App\Booking();
            $bk->save();
            $this->setRelatedBooking($bk);
            $this->_id = $bk->id;
            $toEncode = [
                'id' => $this->_id,
                'chargingStation' => $this->_chargingStation->id,
                'user' => $this->_user->id,
                'timestamp' => $this->_timestamp,
                'charge' => $this->_charge
            ];
            $data = Utils::strToHex(json_encode($toEncode, JSON_UNESCAPED_UNICODE));
            exec('multichain-cli ' . static::CHAIN_NAME . ' publish ' . static::STREAM_NAME . ' ' . $bk->id . ' ' . $data);
            return true;
        }
    }

    public function getStartFormatted()
    {
        return substr(\Carbon\Carbon::createFromTimestamp($this->_timestamp)->toW3cstring(), 0, 19);
    }

    public function getEndFormatted()
    {
        $duration = rand(3600, (3600 * 5));
        return substr(\Carbon\Carbon::createFromTimestamp($this->_timestamp + $duration)
            ->toW3cstring(), 0, 19);
    }
}
