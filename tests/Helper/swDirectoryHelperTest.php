<?php

namespace Tests\Helper;

use App\Helper\swDirectoryHelper;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class swDirectoryHelperTest extends TestCase
{
    private function createSampleDirectories(): void
    {
        File::makeDirectory(storage_path('app/public/shopware/sw5/sample'));
        File::makeDirectory(storage_path('app/public/shopware/sw6/sample'));
    }

    private function deleteSampleDirectories(): void
    {
        File::deleteDirectory(storage_path('app/public/shopware/sw5/sample'));
        File::deleteDirectory(storage_path('app/public/shopware/sw6/sample'));
    }

    /** @test */
    public function test_directory_helper_can_get_instances(): void
    {
        $this->createSampleDirectories();

        $response = swDirectoryHelper::GetInstances();

        $this->deleteSampleDirectories();

        $versions = [
            '6.x' => 'sw6',
            '5.x' => 'sw5',
        ];

        foreach ($versions as $major => $swVersion) {
            self::assertArrayHasKey($major, $response);

            $sampleEntry = $response[$major][0];

            self::assertArrayHasKey('version', $sampleEntry);
            self::assertArrayHasKey('path', $sampleEntry);
            self::assertSame('sample', $sampleEntry['version']);
            self::assertStringContainsString(
                '/storage/app/public/shopware/'.$swVersion.'/sample', $sampleEntry['path']
            );
        }
    }

    /** @test */
    public function test_directory_helper_can_get_base_dir_from_version(): void
    {
        $versions = [
            '6.0.0' => 'sw6',
            '5.0.0' => 'sw5',
        ];

        foreach ($versions as $version => $expectedVersion) {
            $response = swDirectoryHelper::GetBaseDirFromVersion($version);

            self::assertStringContainsString(
                'storage/app/public/shopware/'.$expectedVersion, $response
            );
        }

        $response = swDirectoryHelper::GetBaseDirFromVersion('blabliblub');
        self::assertSame('', $response);

    }
}
