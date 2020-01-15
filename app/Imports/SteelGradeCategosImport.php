<?php

namespace App\Imports;

use App\HotRoll\Models\SteelGradeCatego;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SteelGradeCategosImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SteelGradeCatego([
            'steel_grade' => $row['steel_grade'],
            'catego1' => $row['catego1'],
            'catego2' => $row['catego2'],
        ]);
    }
}
