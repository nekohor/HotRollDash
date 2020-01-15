<?php

namespace App\Http\Controllers\HotRoll;

use App\Http\Controllers\Controller;
use App\Laravue\JsonResponse;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    public function yieldShift(Request $request)
    {
        $line = $request->input("line");
        $inputData = $request->input("inputData");

        return response()->json(new JsonResponse(['line' => $line, 'result'=> $inputData]));
    }
}
