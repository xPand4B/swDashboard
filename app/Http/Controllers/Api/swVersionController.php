<?php

namespace App\Http\Controllers\Api;

use App\Helper\swVersionHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class swVersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $swVersions = swVersionHelper::GetVersions();

        return response()->json([
            'swVersions' => $swVersions
        ]);
    }
}
