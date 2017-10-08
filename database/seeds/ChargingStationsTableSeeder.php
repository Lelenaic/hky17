<?php

use Illuminate\Database\Seeder;

class ChargingStationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //load the CSV document from a file path
        $csv = \League\Csv\Reader::createFromPath(base_path().'/data.csv');

        $smt=new \League\Csv\Statement();
        $records=$smt->process($csv);

        foreach ($records as $record) {
            $station=new \App\ChargingStation();
            $station->station_id=$record[0];
            $station->address=$record[1];
            $station->city=$record[2];
            $station->zip=$record[3];
            $station->latitude=$record[4];
            $station->longitude=$record[5];
            $station->owner=$record[6];
            $station->rechargeType=$record[7];
            $station->rechargePoint=$record[8];
            $station->connectorType=$record[9];
            $station->save();
        }
    }
}
