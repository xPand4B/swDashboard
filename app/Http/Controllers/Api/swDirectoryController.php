<?php

namespace App\Http\Controllers\Api;

use App\Helper\swDirectoryHelper;
use App\Helper\swVersionHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\swDirectories\swDirectoryCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ZipArchive;

class swDirectoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return swDirectoryCollection
     */
    public function index(Request $request): swDirectoryCollection
    {
        $swDirectories = swDirectoryHelper::GetInstances();

        return new swDirectoryCollection($swDirectories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $swVersion = request('swVersion');

        if (empty($swVersion)) {
            return response()->json(
                'The swVersion attribute should not be empty.', 500
            );
        }

        $majorDir = $this->getMajorFromVersion($swVersion);

        $downloadLink = swVersionHelper::GetLinkByVersion($swVersion);
        $filePath = storage_path('app/public/shopware/'.$majorDir.'/'.$swVersion);
        $fileName = $swVersion.'.zip';

        if (file_exists($filePath)) {
            return response()->json(
                'Shopware version "' . $swVersion . '" already exist.'
            );
        }

        File::makeDirectory($filePath);

        $this->downloadUrlToFile($downloadLink, $filePath.'/'.$fileName);

        if (! $this->unzipFile($filePath.'/'.$fileName, $filePath)) {
            return response()->json(
                'Shopware version "' . $swVersion . '" could not be downloaded.', 500
            );
        }

        File::delete($filePath.'/'.$fileName);

        if ($majorDir === 'sw6') {
            symlink($filePath.'/public', public_path(str_replace('.', '-', $swVersion)));
        } else {
            symlink($filePath, public_path(str_replace('.', '-', $swVersion)));
        }

        return response()->json(
            'Shopware version "' . $swVersion . '" successfully created.', 201
        );
    }

    private function getMajorFromVersion(string $version): string
    {
        $majorDir = '';

        switch ($version[0]){
            case '6':
                $majorDir = 'sw6';
                break;
            case '5':
                $majorDir = 'sw5';
                break;
            case '4':
                $majorDir = 'sw4';
                break;
        }

        return $majorDir;
    }

    private function downloadUrlToFile(string $url, string $outFileName): void
    {
        set_time_limit(0);
        $file = file_get_contents($url);
        file_put_contents($outFileName, $file);
    }

    private function unzipFile(string $file, string $extractTo): bool
    {
        $zipArchive = new ZipArchive();
        $result = $zipArchive->open($file);

        if ($result === FALSE) {
            return false;
        }

        $zipArchive->extractTo($extractTo);
        $zipArchive->close();

        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $swPathToDelete = request('swPathToDelete');

        if (empty($swPathToDelete)) {
            return response()->json(
                'The path to delete should not be empty.', 404
            );
        }

        if (!file_exists($swPathToDelete)) {
            return response()->json(
                'The path does not exist.', 404
            );
        }

        $swVersion = explode(DIRECTORY_SEPARATOR, $swPathToDelete);
        $swVersion = $swVersion[sizeof($swVersion) - 1];

        File::deleteDirectory($swPathToDelete);
        unlink(public_path(str_replace('.', '-', $swVersion)));

        return response()->json(
            'Directory has been deleted successfully.'
        );
    }
}
