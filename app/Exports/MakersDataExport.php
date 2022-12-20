<?php

namespace App\Exports;

use App\Models\Maker;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MakersDataExport implements FromCollection
{


    public function collection()
    {
        // TODO: Implement collection() method.
        return Maker::all();
    }
}
