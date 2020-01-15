<?php

namespace App\Imports;

use App\HotRoll\Models\PiecesAnHour;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PiecesAnHoursImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PiecesAnHour([
            'line' => $row['line'],
            'steel_grade_catego' => $row['steel_grade_catego'],
            'thk_gte' => $row['thk_gte'],
            'thk_lt' => $row['thk_lt'],
            'wid_gte' => $row['wid_gte'],
            'wid_lt' => $row['wid_lt'],
            'pieces_an_hour' => $row['pieces_an_hour'],
        ]);
    }
}
