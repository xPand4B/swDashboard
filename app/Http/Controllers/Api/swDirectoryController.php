<?php

namespace App\Http\Controllers\Api;

use App\Helper\swDirectoryHelper;
use App\Helper\swVersionHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class swDirectoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $swDirectories = swDirectoryHelper::GetInstances();

        return $swDirectories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $swVersion = request('swVersion');
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
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        $swPathToDelete = request('swPathToDelete');
        $swVersionToDelete = request('swVersionToDelete');

        if (empty($swPathToDelete)) {
            return response()->json(
                'The path to delete should not be empty.', 500
            );
        }

        if (empty($swVersionToDelete)) {
            return response()->json(
                'The version to delete should not be empty.', 500
            );
        }

        if (!file_exists($swPathToDelete)) {
            return response()->json(
                'The path does not exist.', 500
            );
        }

        File::deleteDirectory($swPathToDelete);

        return response()->json(
            'Directory has been deleted successfully.'
        );
    }
}
