<?php

namespace Tests\Http\Resources\swDirectories;

use Tests\TestCase;

class swDirectoryCollectionTest extends TestCase
{
    const DIRECTORY_INDEX_ROUTE = 'api.directory.index';

    /** @test */
    public function test_directory_collection_has_correct_format(): void
    {
        $response = $this
            ->getJson(
                route(self::DIRECTORY_INDEX_ROUTE)
            )
            ->assertStatus(200);

        self::assertArrayHasKey('data', $response);
        self::assertArrayHasKey('type', $response['data']);
        self::assertArrayHasKey('attributes', $response['data']);

        self::assertSame('swDirectory', $response['data']['type']);

        self::assertArrayHasKey('6.x', $response['data']['attributes']);
        self::assertArrayHasKey('5.x', $response['data']['attributes']);
        self::assertArrayHasKey('4.x', $response['data']['attributes']);
    }
}
