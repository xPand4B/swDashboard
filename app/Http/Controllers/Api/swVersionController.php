<?php

namespace App\Http\Controllers\Api;

use App\Helper\swVersionHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\swVersions\swVersionCollection;
use Illuminate\Http\Request;

class swVersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        if (! request('major')) {
            return response()->json([
                'Could not find major version in request.', 404
            ]);
        }

        $major = request('major');
        $swVersions = swVersionHelper::GetVersions(null, $major);

        return new swVersionCollection($swVersions);
    }
}
