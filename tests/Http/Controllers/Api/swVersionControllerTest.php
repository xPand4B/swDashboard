<?php

namespace Tests\Http\Controllers\Api;

use App\Helper\swVersionHelper;
use Tests\TestCase;

class swVersionControllerTest extends TestCase
{
    const INDEX_ROUTE = 'api.version.index';

    /** @test */
    public function test_version_controller_index(): void
    {
        $response = $this
            ->get(
                route(self::INDEX_ROUTE, $this->getMajorVersions()[0])
            )
            ->assertStatus(200);

        $response = json_decode($response->getContent(), true);

        self::assertSame([
            'data' => [
                'type' => 'swVersion',
                'attributes' => swVersionHelper::GetVersions(null, $this->getMajorVersions()[0])
            ]
        ], $response);
    }
}
