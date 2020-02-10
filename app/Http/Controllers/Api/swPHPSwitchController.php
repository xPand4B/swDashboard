<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class swPHPSwitchController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'currentPhpVersion' => $this->getCurrentPhpVersion()
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function switch(Request $request): JsonResponse
    {
        if (!request('newPhpVersion')) {
            return response()->json(
                "Value 'newPhpVersion' has to be set!", 400
            );
        }

        $old = $this->getCurrentPhpVersion();
        $new = request('newPhpVersion');

        exec('sudo bash ./switchPhpVersion.sh '. $old . ' ' . $new);

        return response()->json([
//            'msg' => 'PHP Version successfully switched!',
        'msg' => "PHP Version currently can't be switched!",
//            'data' => [
//                'previousVersion' => $old,
//                'newVersion' => $new,
//            ]
        ]);
    }

    private function getCurrentPhpVersion(): string
    {
        $version = explode('.', phpversion());

        return $version[0].'.'.$version[1];
    }
}
