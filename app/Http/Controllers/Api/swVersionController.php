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
     * @return swVersionCollection
     */
    public function index(Request $request)
    {
        $swVersions = swVersionHelper::GetVersions();

        return new swVersionCollection($swVersions);
    }
}
