<?php

namespace Tests\Http\Controllers\Api;

use App\Helper\swDirectoryHelper;
use Tests\TestCase;

class swDirectoryControllerTest extends TestCase
{
    const INDEX_ROUTE = 'api.directory.index';
    const STORE_ROUTE = 'api.directory.store';
    const DESTROY_ROUTE = 'api.directory.destroy';

    /** @test */
    public function test_directory_controller_index(): void
    {
        $response = $this
            ->get(route(self::INDEX_ROUTE))
            ->assertStatus(200);

        self::assertArrayHasKey('data', $response);
        self::assertArrayHasKey('type', $response['data']);
        self::assertArrayHasKey('attributes', $response['data']);

        self::assertSame('swDirectory', $response['data']['type']);

        self::assertSame([
            'data' => [
                'type' => 'swDirectory',
                'attributes' => swDirectoryHelper::GetInstances()
            ]
        ], json_decode($response->getContent(), true));
    }

    /** @test */
    public function test_directory_controller_store(): void
    {
        // TODO: Complete Test
    }

    /** @test */
    public function test_directory_controller_destroy(): void
    {
        // TODO: Complete Test
    }
}
