<?php

namespace App\Imports;

use App\Models\exercises;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportExercises implements ToModel, WithHeadingRow
{
    /**
     * @param  array  $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new exercises(
            [
                'name' => $row['name'] ?? 'пусто',
                'type' => $row['type'] ?? 'пусто',
                'type_train' => $row['type_train'] ?? 'пусто',
                'apparatus' => $row['apparatus'] ?? 'пусто',
                'experience' => $row['experience'] ?? 'пусто',
                'room' => $row['room'] ?? 'пусто',
            ]
        );
    }
}
