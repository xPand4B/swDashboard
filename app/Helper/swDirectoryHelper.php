<?php

namespace App\Helper;

use Illuminate\Support\Facades\File;

class swDirectoryHelper
{
    /**
     * @var string
     */
    private const DIRECTORY = 'app/public/shopware';

    /**
     * Get all available shopware instance directories.
     *
     * @return array
     */
    public static function GetInstances(): array
    {
        $path = storage_path(self::DIRECTORY);

        $sw6_directories = [];
        $sw5_directories = [];
        $sw4_directories = [];

        foreach (File::directories($path) as $dir){
            switch(File::basename($dir)){
                case 'sw4':
                    $sw4_directories = File::directories($dir);
                    break;

                case 'sw5':
                    $sw5_directories = File::directories($dir);
                    break;

                case 'sw6':
                    $sw6_directories = File::directories($dir);
                    break;
            }
        }

        $sw4_directories = self::Format($sw4_directories);
        $sw5_directories = self::Format($sw5_directories);
        $sw6_directories = self::Format($sw6_directories);


        return [
            '6.x' => $sw6_directories,
            '5.x' => $sw5_directories,
            '4.x' => $sw4_directories,
        ];
    }

    private static function Format(array $directories): array
    {
        $tmp = [];

        foreach ($directories as $key => $dir){
            $splittedPath = explode('/', $dir);
            $tmp[$key]['version'] = $splittedPath[sizeof($splittedPath) - 1];
            $tmp[$key]['path'] = $dir;
        }

        return array_reverse($tmp);
    }

    /**
     * Get the base dir for the specified version.
     *
     * @param string $version
     * @return string
     */
    public static function GetBaseDirFromVersion(string $version): string
    {
        $baseDir = '';

        switch ($version[0]){
            case '4':
                $baseDir = storage_path(self::DIRECTORY.'/sw4');
                break;
            case '5':
                $baseDir = storage_path(self::DIRECTORY.'/sw5');
                break;
            case '6':
                $baseDir = storage_path(self::DIRECTORY.'/sw6');
                break;
        }

        return $baseDir;
    }
}
