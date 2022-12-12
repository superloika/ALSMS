<?php

namespace App\Imports;

use App\Exports\SampleExport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Facades\Excel;

class SampleImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $collection[5][0] = 101;
        $collection[5][1] = 101;
        $collection[5][2] = 101;
        $collection[5][3] = 101;
        $collection[5][4] = 101;

        // dd($collection[5]);
        Excel::download(new SampleExport($collection),'download.xlsx');
    }
}
