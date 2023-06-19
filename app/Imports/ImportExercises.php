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
                'inventory' => $row['inventory'] ?? 'пусто',
                'base' => $row['base'] ?? 'пусто',
                'insulating' => $row['insulating'] ?? 'пусто',
                'masses' => $row['masses'] ?? 'пусто',
                'relief' => $row['relief'] ?? 'пусто',
                'muscle_group' => $row['muscle_group'] ?? 'пусто',
                'back_pain' => $row['back_pain'] ?? 'пусто',
                'varicose' => $row['varicose'] ?? 'пусто',
                'diastasis' => $row['diastasis'] ?? 'пусто',
                'knee_pain' => $row['knee_pain'] ?? 'пусто',
                'high_pressure' => $row['high_pressure'] ?? 'пусто',
            ]
        );
    }
}
