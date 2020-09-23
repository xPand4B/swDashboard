<?php

namespace Tests\Http\Controllers\Api;

use App\Helper\swVersionHelper;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class swCacheControllerTest extends TestCase
{
    /** @var string  */
    public const CLEAR_ROUTE = 'api.cache.clear';

    /** @var string  */
    public const REGENERATE_ROUTE = 'api.cache.regenerate';

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
    public function test_cache_controller_can_clear_cache(): void
    {
        Cache::add(self::CACHE_KEY_SW6, 'Test', 30);
        Cache::add(self::CACHE_KEY_SW5, 'Test', 30);

        $response = $this
            ->get(route(self::CLEAR_ROUTE))
            ->assertStatus(200);

        $response = json_decode($response->getContent(), true);

        self::assertSame('Cache successfully cleared!', $response);
        self::assertFalse(Cache::has(self::CACHE_KEY_SW6));
        self::assertFalse(Cache::has(self::CACHE_KEY_SW5));
    }

    /** @test */
    public function test_cache_controller_can_regenerate_cache(): void
    {
        Cache::add(self::CACHE_KEY_SW6, 'Test', 30);
        Cache::add(self::CACHE_KEY_SW5, 'Test', 30);

        $response = $this
            ->get(route(self::REGENERATE_ROUTE))
            ->assertStatus(200);

        $response = json_decode($response->getContent(), true);

        self::assertSame('Cache successfully re-generated!', $response);
        self::assertTrue(Cache::has(self::CACHE_KEY_SW6));
        self::assertTrue(Cache::has(self::CACHE_KEY_SW5));

        self::assertNotSame('Test', Cache::get(self::CACHE_KEY_SW6));
        self::assertNotSame('Test', Cache::get(self::CACHE_KEY_SW5));
    }
}
