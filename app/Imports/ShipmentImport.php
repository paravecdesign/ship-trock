<?php

namespace App\Imports;

use App\Models\Rate;
use App\Models\Shipments;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ShipmentImport implements ToModel, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    function is_decimal($n)
        {
            // Note that floor returns a float
            return is_numeric($n) && floor($n) != $n;
        }
        public function model(array $row)
    {


            if ($this->is_decimal($row['wgt'])) {

                $freight = Rate::first();

            } else {
                $rate = $row['wgt'];
                $freight = Rate::where('weight', intval($rate))->first();
            }
            return new Shipments([

                'customer_id'  => $row['code'],
                'weight' => $row['wgt'],
                'awb' => $row['awb'],
                'status_id' => 2,
                'description'    => $row['package_detail'],
                'carrier'    => $row['vendor'],
                'tracking_number'    => $row['tracking'],
                'freight'    => $freight->cost ?? 0,
            ]);

    }
}
