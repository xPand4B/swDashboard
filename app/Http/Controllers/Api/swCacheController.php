<?php

namespace App\Http\Controllers\Api;

use App\Helper\swVersionHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class swCacheController extends Controller
{
    /**
     * Clear sw caches.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function clear(Request $request): JsonResponse
    {
        Cache::forget(swVersionHelper::CACHE_KEY_SW_DOWNLOAD_LINKS.'_sw6');
        Cache::forget(swVersionHelper::CACHE_KEY_SW_DOWNLOAD_LINKS.'_sw5');

        return response()->json(
            'Cache successfully cleared!', 200
        );
    }

    /**
     * Re-generate sw caches.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function regenerate(Request $request): JsonResponse
    {
        swVersionHelper::RegenerateCache();

        return response()->json(
            'Cache successfully re-generated!', 200
        );
    }
}
