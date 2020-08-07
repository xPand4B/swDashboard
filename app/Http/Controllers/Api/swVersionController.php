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
     * @param string $major
     * @return mixed
     */
    public function index(string $major)
    {
        $swVersions = swVersionHelper::GetVersions(null, $major);

        return new swVersionCollection($swVersions);
    }
}
