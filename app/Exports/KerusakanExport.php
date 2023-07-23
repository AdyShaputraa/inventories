<?php

namespace App\Exports;

use App\Models\Kerusakan;
use Maatwebsite\Excel\Concerns\FromCollection;

class KerusakanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return view('kerusakan.exportexcel', [
            'kerusakan' => Kerusakan::all()
        ]);
    }
}
