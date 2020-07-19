<?php

namespace Tests\Http\Resources\swVersions;

use App\Helper\swVersionHelper;
use Tests\TestCase;

class swVersionCollectionTest extends TestCase
{
    const VERSION_INDEX_ROUTE = 'api.version.index';

    /** @test */
    public function test_version_collection_has_correct_format(): void
    {
        $response = $this
            ->getJson(
                route(self::VERSION_INDEX_ROUTE, '6-x')
            )
            ->assertStatus(200);

        self::assertArrayHasKey('data', $response);
        self::assertArrayHasKey('type', $response['data']);
        self::assertArrayHasKey('attributes', $response['data']);

        self::assertSame('swVersion', $response['data']['type']);

        self::assertSame(
            swVersionHelper::GetVersions(null, '6.x'),
            $response['data']['attributes']
        );
    }
}
