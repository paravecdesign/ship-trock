<?php

namespace App\Exports;

use App\Models\Shipments;
use Maatwebsite\Excel\Concerns\FromCollection;

class ManifestExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Shipments::all();
    }
}
