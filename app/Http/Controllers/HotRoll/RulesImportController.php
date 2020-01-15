<?php

namespace App\Http\Controllers\HotRoll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\HotRoll\Models\SteelGradeCatego;
use App\HotRoll\Models\PiecesAnHour;

use App\Imports\SteelGradeCategosImport;
use App\Imports\PiecesAnHoursImport;

use Maatwebsite\Excel\Facades\Excel;

class RulesImportController extends Controller
{
    public function importRules()
    {
        SteelGradeCatego::truncate();
        Excel::import(new SteelGradeCategosImport, 'rules/steel_grade_categos.xlsx');

        PiecesAnHour::truncate();
        Excel::import(new PiecesAnHoursImport, 'rules/pieces_an_hour.xlsx');

        return redirect('/')->with('success', 'All good!');
    }
}
