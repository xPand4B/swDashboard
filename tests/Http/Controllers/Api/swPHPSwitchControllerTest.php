<?php

namespace Tests\Http\Controllers\Api;

use Tests\TestCase;

class swPHPSwitchControllerTest extends TestCase
{
    const INDEX_ROUTE = 'api.version.php.index';
    const SWITCH_ROUTE = 'api.version.php.switch';

    /**
     * @return string
     */
    private function getCurrentPhpVersion(): string
    {
        $version = explode('.', phpversion());

        return $version[0].'.'.$version[1];
    }

    /** @test */
    public function test_php_switch_controller_index(): void
    {
        $response = $this
            ->get(route(self::INDEX_ROUTE))
            ->assertStatus(200);

        self::assertSame([
            'currentPhpVersion' => $this->getCurrentPhpVersion()
        ], json_decode($response->getContent(), true));
    }

    /** @test */
    public function test_php_switch_controller_switch(): void
    {
        // TODO: Complete Test
    }
}
