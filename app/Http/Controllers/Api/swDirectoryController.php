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
     * @return swDirectoryCollection
     */
    public function index(): swDirectoryCollection
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
        $swVersion = $request->get('swVersion');
        $request->validate([
            'swVersion' => 'string|min:5|max:9'
        ]);

        if (empty($swVersion)) {
            return response()->json(
                'The "swVersion" attribute should not be empty.', 500
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

        if (! $this->downloadUrlToFile($downloadLink, $filePath.'/'.$fileName)) {
            File::deleteDirectory($filePath);

            return response()->json(
                'Shopware version "' . $swVersion . '" could not be downloaded.'
            );
        }

        if (! $this->unzipFile($filePath.'/'.$fileName, $filePath)) {
            File::deleteDirectory($filePath);

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

    /**
     * Returns the major version for a given sw version.
     *
     * @param string $version
     * @return string
     */
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

    /**
     * Downloads a file from a given url.
     *
     * @param string $url
     * @param string $outFileName
     * @return bool
     */
    private function downloadUrlToFile(string $url, string $outFileName): bool
    {
        set_time_limit(0);

        if ($file = file_get_contents($url)) {
            file_put_contents($outFileName, $file);
            return true;
        }

        return false;
    }

    /**
     * Unzips a file to a given path.
     *
     * @param string $file
     * @param string $extractTo
     * @return bool
     */
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
        $swPathToDelete = $request->get('swPathToDelete');
        $request->validate([
            'swPathToDelete' => 'string'
        ]);

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
