<?php

namespace Tests\Helper;

use App\Helper\swVersionHelper;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class swVersionHelperTest extends TestCase
{
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

    /**
     * @param string|null $major
     * @return string
     */
    private function getLatestLink(string $major = null): string
    {
        //
    }

    /** @test */
    public function test_version_helper_can_get_versions(): void
    {
        $response = swVersionHelper::GetVersions();

        self::assertIsArray($response);
        self::assertNotNull($response);

        self::assertTrue(Cache::has(self::CACHE_KEY_SW6));
        self::assertTrue(Cache::has(self::CACHE_KEY_SW5));
    }

    /** @test */
    public function test_version_helper_can_get_versions_with_array_position(): void
    {
        $response = swVersionHelper::GetVersions(0);

        self::assertNotNull($response);
        self::assertIsString($response);
        self::assertSame('6', $response[0]);
        self::assertTrue(Cache::has(self::CACHE_KEY_SW6));
        self::assertTrue(Cache::has(self::CACHE_KEY_SW5));

        $response = swVersionHelper::GetVersions(99999999);

        self::assertNotNull($response);
        self::assertIsArray($response);
        self::assertCount(0, $response);
        self::assertTrue(Cache::has(self::CACHE_KEY_SW6));
        self::assertTrue(Cache::has(self::CACHE_KEY_SW5));
    }

    /** @test */
    public function test_version_helper_can_get_versions_with_major_version(): void
    {
        $response = swVersionHelper::GetVersions(null, '6.x');

        self::assertNotNull($response);
        self::assertIsArray($response);
        self::assertGreaterThan(18, count($response));
        self::assertTrue(Cache::has(self::CACHE_KEY_SW6));

        $response = swVersionHelper::GetVersions(null, '5.x');

        self::assertNotNull($response);
        self::assertIsArray($response);
        self::assertCount(75, $response);
        self::assertTrue(Cache::has(self::CACHE_KEY_SW5));
    }

    /** @test */
    public function test_version_helper_does_check_if_cache_exists(): void
    {
        Cache::add(self::CACHE_KEY_SW6, [
            '6.6.6.6.6' => 'someRandomLink'
        ], 30);

        $response = swVersionHelper::GetLinkByVersion('6.6.6.6.6');

        self::assertTrue(Cache::has(self::CACHE_KEY_SW6));
        self::assertFalse(Cache::has(self::CACHE_KEY_SW5));
        self::assertIsString($response);
        self::assertSame('someRandomLink', $response);
    }

    /** @test */
    public function test_version_helper_can_regenerate_cache(): void
    {
        Cache::add(self::CACHE_KEY_SW6, [
            '6.6.6.6.6' => 'someRandomLink'
        ], 30);
        Cache::add(self::CACHE_KEY_SW6, [
            '5.5.5.5.5' => 'someRandomLink'
        ], 30);

        swVersionHelper::RegenerateCache();

        self::assertTrue(Cache::has(self::CACHE_KEY_SW6));
        self::assertTrue(Cache::has(self::CACHE_KEY_SW5));

        self::assertNotSame('6.6.6.6.6', Cache::get(self::CACHE_KEY_SW6));
        self::assertNotSame('5.5.5.5.5', Cache::get(self::CACHE_KEY_SW5));

        self::assertIsArray(Cache::get(self::CACHE_KEY_SW6));
        self::assertIsArray(Cache::get(self::CACHE_KEY_SW5));

        self::assertGreaterThan(18, Cache::get(self::CACHE_KEY_SW6));
        self::assertGreaterThan(74, Cache::get(self::CACHE_KEY_SW5));
    }

    /** @test */
    public function test_version_helper_can_get_link_by_version(): void
    {
        $sw6BaseLink = 'https://www.shopware.com/en/Download/redirect/version/sw6/file/';
        $sw5BaseLink = 'https://www.shopware.com/en/Download/redirect/version/sw5/file/';

        $sampleVersions = [
            '6.2.3'  => $sw6BaseLink.'install_6.2.3_1594641397.zip',
            '5.6.7'  => $sw5BaseLink.'install_5.6.7_8cec71ed6df4804610664944e3f67e5d3a61adea.zip',
            '5.5.10' => $sw5BaseLink.'install_5.5.10_edfcb8e82f331fa5a0935a6c6ff35fe4348bf262.zip',
            '0.0.0' => null,
        ];

        foreach ($sampleVersions as $version => $expectedLink) {
            $response = swVersionHelper::GetLinkByVersion($version);

            self::assertSame($expectedLink, $response);
        }
    }

    /** @test */
    public function test_version_helper_can_get_links(): void
    {
        $response = swVersionHelper::GetLinks();

        self::assertNotNull($response);
        self::assertIsArray($response);
        self::assertGreaterThan(92, $response);
        self::assertSame(
            'https://www.shopware.com/en/Download/redirect/version/sw5/file/install_5.0.0_c122de4b3eba2d45f1085cc8df74ff96804179ec.zip',
            $response[count($response) - 1]
        );

    }

    /** @test */
    public function test_version_helper_can_get_links_with_array_position(): void
    {
        $response = swVersionHelper::GetLinks(0);

        self::assertNotNull($response);
        self::assertIsString($response);

        $response = swVersionHelper::GetLinks(9999999);

        self::assertNull($response);
    }
}
