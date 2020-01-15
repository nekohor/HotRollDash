<?php

namespace App\Http\Controllers\HotRoll;

use App\Http\Controllers\Controller;
use App\Laravue\JsonResponse;
use Illuminate\Http\Request;
use App\HotRoll\Logics\YieldShiftLogic;

class ProductionController extends Controller
{
    public function yieldShift(Request $request)
    {
        $line = $request->input("line");
        $inputData = $request->input("inputData");
        // $inputData = json_decode($request->query("inputData"), true);
        // dd($inputData);

        $bll = new YieldShiftLogic();
        $bll->setLine($line);
        $bll->setData($inputData);

        // $catego  = $bll->getSteelGradeCatego($inputData[0]["steelGrade"]);
        // $pieceAnHour = $bll->getPiecesAnHour($inputData[0]);
        // $secondsPerPiece = $bll->getSecondsPerPiece($pieceAnHour);

        $resultData = $bll->getResult();
        $resultHeader = $bll->getResultHeader();

        return response()->json(
            new JsonResponse([
                'line' => $line, 
                'resultData'=> $resultData,
                'resultHeader' => $resultHeader,
                'count' => count($inputData),
            ])
        );
    }
}
