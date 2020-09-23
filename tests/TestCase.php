<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\File;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    const SAMPLE_VERSION = '6.sample';
    const SAMPLE_COMMENT = 'Sample Comment';

    /**
     * @param string $major
     */
    public function createSampleVersion(string $major = 'sw6'): void
    {
        $filePath = storage_path('app/public/shopware/'.$major.'/'.self::SAMPLE_VERSION);

        if (! file_exists($filePath)) {
            File::makeDirectory(
                storage_path('app/public/shopware/'.$major.'/'.self::SAMPLE_VERSION)
            );
        }
    }

    /**
     * @param string $major
     */
    public function deleteSampleVersion(string $major = 'sw6'): void
    {
        $filePath = storage_path('app/public/shopware/'.$major.'/'.self::SAMPLE_VERSION);

        if (file_exists($filePath)) {
            File::deleteDirectory(
                storage_path('app/public/shopware/' . $major . '/' . self::SAMPLE_VERSION)
            );
        }
    }
}
