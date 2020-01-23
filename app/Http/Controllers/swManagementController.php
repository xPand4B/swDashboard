<?php

namespace App\Http\Controllers;

use App\Helper\swDirectoryHelper;
use App\Helper\swVersionHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class swManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $swDirectories = swDirectoryHelper::GetInstances();
        $swVersions = swVersionHelper::GetVersions();

        return view('pages.management.index', compact([
            'swDirectories', 'swVersions'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $swVersion = request('swVersion2');
        $swDirectory = request('swDirectory');

        $downloadLink = swVersionHelper::GetLinkByVersion($swVersion);
        $downloadDir = swDirectoryHelper::GetBaseDirFromVersion($swVersion);

//        file_put_contents($downloadDir, fopen($downloadLink, 'r'));

        return response()->json(
//            'Shopware instance has been created successfully!'
            [$downloadDir, $downloadLink]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $name
     * @return \Illuminate\Http\Response
     */
    public function destroy($name)
    {
        //
    }
}
