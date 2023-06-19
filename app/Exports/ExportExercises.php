<?php

namespace App\Exports;

use App\Models\exercises;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportExercises implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return exercises::all();
    }
}
