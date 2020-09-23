<?php

namespace Tests\Http\Controllers\Api;

use App\Helper\swVersionHelper;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class swVersionControllerTest extends TestCase
{
    /** @var string  */
    const INDEX_ROUTE = 'api.version.index';

    /** @var string  */
    private const CACHE_KEY_SW6 = swVersionHelper::CACHE_KEY_SW_DOWNLOAD_LINKS.'_sw6';

    /** @var string  */
    private const CACHE_KEY_SW5 = swVersionHelper::CACHE_KEY_SW_DOWNLOAD_LINKS.'_sw5';

    public function setUp(): void
    {
        parent::setUp();

        Cache::forget(self::CACHE_KEY_SW6);
        Cache::forget(self::CACHE_KEY_SW5);

        self::assertFalse(Cache::has(self::CACHE_KEY_SW6));
        self::assertFalse(Cache::has(self::CACHE_KEY_SW5));
    }

    /** @test */
    public function test_version_controller_index(): void
    {
        $response = $this
            ->get(
                route(self::INDEX_ROUTE, '6.x')
            )
            ->assertStatus(200);

        $response = json_decode($response->getContent(), true);

        self::assertSame([
            'data' => [
                'type' => 'swVersion',
                'attributes' => swVersionHelper::GetVersions(null, '6.x')
            ]
        ], $response);
    }
}
