<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class SampleExport implements FromCollection
{
    public function __construct($data) {
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // dd($this->data);
        return $this->data;
    }
}
