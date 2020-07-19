<?php

namespace Tests\Http\Controllers\Api;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class swCommentControllerTest extends TestCase
{
    const STORE_ROUTE   = 'api.comment.store';
    const SHOW_ROUTE    = 'api.comment.show';
    const DESTROY_ROUTE = 'api.comment.destroy';

    /**
     * @param string $major
     * @return string
     */
    private function getCommentFile(string $major = 'sw6'): string
    {
        return File::get(storage_path('app/public/shopware/'.$major.'/swComments.txt'));
    }

    /**
     * @param string $major
     */
    private function createSampleCommentFile(string $major = 'sw6'): void
    {
        Storage::disk('local')
            ->put(
                'public/shopware/'.$major.'/'.self::SAMPLE_VERSION.'/swComments.txt',
                self::SAMPLE_COMMENT
            );
    }

    /** @test */
    public function test_comment_controller_store(): void
    {
        $this->deleteSampleVersion();
        $this->createSampleVersion();

        $response = $this
            ->post(
                route(self::STORE_ROUTE, self::SAMPLE_VERSION)
            )
            ->assertStatus(422);
        self::assertSame(
            'No comments set.',
            json_decode($response->getContent())
        );

        // TODO: Complete Test

        $this->deleteSampleVersion();
    }

    /** @test */
    public function test_comment_controller_show(): void
    {
        $this->deleteSampleVersion();
        $this->createSampleVersion();

        $this
            ->get(
                route(self::SHOW_ROUTE, 'blabliblue')
            )
            ->assertStatus(404);

        $response = $this
            ->get(
                route(self::SHOW_ROUTE, self::SAMPLE_VERSION)
            )
            ->assertStatus(200);

        self::assertSame(
            "Version '".self::SAMPLE_VERSION."' has no comments yet.",
            json_decode($response->getContent())
        );

        $this->createSampleCommentFile();

        $response = $this
            ->get(
                route(self::SHOW_ROUTE, self::SAMPLE_VERSION)
            )
            ->assertStatus(200);

        self::assertSame([
            'comments' => [
                0 => self::SAMPLE_COMMENT,
            ]
        ], json_decode($response->getContent(), true));

        $this->deleteSampleVersion();
    }

    /** @test */
    public function test_comment_controller_destroy(): void
    {
        $this->deleteSampleVersion();
        $this->createSampleVersion();
        $this->createSampleCommentFile();

        $this
            ->post(
                route(self::DESTROY_ROUTE, self::SAMPLE_VERSION)
            )
            ->assertStatus(422);

        // TODO: Complete Test

        $this->deleteSampleVersion();
    }
}
