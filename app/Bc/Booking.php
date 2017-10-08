<?php

namespace App\Bc;

use App\Car;
use App\ChargingStation;
use App\User;
use App\Utils;

class Booking
{

    const CHAIN_NAME = 'resa';
    const STREAM_NAME = 'booking';

    private $_id;
    private $_chargingStation;
    private $_timestamp;
    private $_user;
    /**
     * @var \App\Booking
     */
    private $_relatedBooking;


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
     * @return Booking[]
     */
    public static function all(): array
    {
        $bookings = shell_exec('multichain-cli ' . static::CHAIN_NAME . ' liststreamitems ' . static::STREAM_NAME);
        $bookings = json_decode($bookings);
        $array = array();
        foreach ($bookings as $booking) {
            $bk = static::newFromHex($booking->data);
            $array[] = $bk;
        }
        return $array;
    }

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

    private static function newFromHex(String $hexa): Booking
    {
        $metadata = json_decode(Utils::hexToStr($hexa));
        $bk = new Booking();
        $bk->setId($metadata->id);
        $bk->setRelatedBooking(\App\Booking::find($metadata->id));
        $bk->setUser(User::find($metadata->user));
        $bk->setChargingStation(ChargingStation::find($metadata->chargingStation));
        $bk->setTimestamp($metadata->timestamp);
        return $bk;
    }

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
                'timestamp' => $this->_timestamp
            ];
            $data = Utils::strToHex(json_encode($toEncode, JSON_UNESCAPED_UNICODE));
            exec('multichain-cli ' . static::CHAIN_NAME . ' publish ' . static::STREAM_NAME . ' ' . $bk->id . ' ' . $data);
            return true;
        }
    }
}
