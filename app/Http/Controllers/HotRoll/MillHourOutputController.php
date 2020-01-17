<?php

namespace App\Http\Controllers\HotRoll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Laravue\JsonResponse;
use App\HotRoll\Dao\MesResultDao;
use App\HotRoll\Database\Manager;
use App\HotRoll\Bootstrap\Registry;

use App;
use DBMes;

class MillHourOutputController extends Controller
{
    public function showExample(Request $request) {

        $coilId = $request->query("coilId");

        // $db = App::make('mesdb');
        $data = DBMes::select("RHS_RESULT", [
            "ACTCOILID", "PRODSTART", "PRODEND", "ACTSLABID", "GRADENAME", "HEXIT"
        ], [
            "ACTCOILID[=]" => "H110188900",
        ]);

        dd($data);
        // $data = $dao->getDataByCoilId($coilId);

        return response()->json(
            new JsonResponse([
                'data' => $data, 
            ])
        );
        
    }
}
