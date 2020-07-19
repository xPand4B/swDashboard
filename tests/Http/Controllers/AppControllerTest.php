<?php

namespace Tests\Http\Controllers;

use App\Http\Controllers\AppController;
use Tests\TestCase;

class AppControllerTest extends TestCase
{
    /** @test */
    public function test_app_controller_returns_correct_view(): void
    {
        $response = (new AppController())->index();

        self::assertNotNull($response->getName());
        self::assertStringContainsString(
            'pages.vue',
            $response->getName()
        );
    }
}
