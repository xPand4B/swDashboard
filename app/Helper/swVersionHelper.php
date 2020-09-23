<?php

namespace App\Helper;

use Goutte\Client;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

class swVersionHelper
{
    /** @var string  */
    public const CACHE_KEY_SW_DOWNLOAD_LINKS = 'swDownloadLinks';

    /** @var int  */
    public const CACHE_TTL_IN_SECONDS = 43200;

    /** @var string  */
    public const SCRAPING_LINK_SW6 = 'https://www.shopware.com/en/changelog/';

    /** @var string  */
    public const SCRAPING_LINK_SW5 = 'https://www.shopware.com/en/changelog-sw5/';

    /** @var string  */
    private const SCRAPING_FILTER = '.release-details--cta > a';

    /**
     * Get the crawler for the specified uri.
     *
     * @param string $uri
     * @param int $timeout
     * @return Crawler
     */
    private static function GetCrawlerFor(string $uri, int $timeout = 60): Crawler
    {
        $client = new Client(HttpClient::create(['timeout' => $timeout]));
        return $client->request('GET', $uri);
    }

    /**
     * Get all version download-links from the specified uri.
     *
     * @param string $uri
     * @param bool $keysOnly
     * @return array
     */
    private static function GetDownloadLinksFromWebsite(string $uri, bool $keysOnly = false): array
    {
        $cacheKey = null;

        if ($uri === self::SCRAPING_LINK_SW6) {
            $cacheKey = self::CACHE_KEY_SW_DOWNLOAD_LINKS.'_sw6';
        } elseif($uri === self::SCRAPING_LINK_SW5) {
            $cacheKey = self::CACHE_KEY_SW_DOWNLOAD_LINKS.'_sw5';
        }

        if (Cache::has($cacheKey)) {
            if ($keysOnly) {
                return array_keys(Cache::get($cacheKey));
            }

            return Cache::get($cacheKey);
        }

        $downloadLinks = [];

        self::GetCrawlerFor($uri)
            ->filter(self::SCRAPING_FILTER)
            ->each(function($node) use (&$downloadLinks) {
                if (strpos($node->text(), 'Install') === false) {
                    return;
                }

                $splittedDownloadLink = explode('/', $node->attr('href'));
                $fileName = $splittedDownloadLink[count($splittedDownloadLink) - 1];

                $version = explode('_', $fileName)[1];

                if ($version[0] === 'v') {
                    $version = substr($version, 1);
                }

                if ($version[0] === '4') {
                    return;
                }

                $downloadLinks[$version] = $node->attr('href');
            });

        Cache::rememberForever($cacheKey, function() use ($downloadLinks) {
            return $downloadLinks;
        });

        if ($keysOnly) {
            $downloadLinks = array_keys($downloadLinks);
        }

        return $downloadLinks;
    }

    /**
     * Re-generate caches.
     */
    public static function RegenerateCache(): void
    {
        Cache::forget(self::CACHE_KEY_SW_DOWNLOAD_LINKS.'_sw6');
        Cache::forget(self::CACHE_KEY_SW_DOWNLOAD_LINKS.'_sw5');

        self::GetDownloadLinksFromWebsite(self::SCRAPING_LINK_SW6);
        self::GetDownloadLinksFromWebsite(self::SCRAPING_LINK_SW5);
    }

    /**
     * Get all release versions.
     *
     * @param int|null $arrayPosition
     * @param string|null $majorVersion
     * @return array|string
     */
    public static function GetVersions(int $arrayPosition = null, string $majorVersion = null)
    {
        $versions = [];

        if (is_null($arrayPosition) && is_null($majorVersion)) {
            $versions += self::GetDownloadLinksFromWebsite(self::SCRAPING_LINK_SW6, true);
            $versions += self::GetDownloadLinksFromWebsite(self::SCRAPING_LINK_SW5, true);

            return $versions;
        }

        if (! is_null($majorVersion)) {
            if ($majorVersion[0] === '6') {
                $versions = self::GetDownloadLinksFromWebsite(self::SCRAPING_LINK_SW6, true);
            } elseif ($majorVersion[0] === '5') {
                $versions = self::GetDownloadLinksFromWebsite(self::SCRAPING_LINK_SW5, true);
            }
        }

        if (is_null($arrayPosition)) {
            return $versions;
        }

        if (count($versions) === 0) {
            $versions += self::GetDownloadLinksFromWebsite(self::SCRAPING_LINK_SW6, true);
            $versions += self::GetDownloadLinksFromWebsite(self::SCRAPING_LINK_SW5, true);
        }

        if (!array_key_exists($arrayPosition, $versions)) {
            return [];
        }

        return $versions[$arrayPosition];
    }

    /**
     * Get the link for the specified version.
     *
     * @param string $version
     * @return string|null
     */
    public static function GetLinkByVersion(string $version): ?string
    {
        $downloadLinks = [];

        if ($version[0] === '6') {
            $downloadLinks = self::GetDownloadLinksFromWebsite(self::SCRAPING_LINK_SW6);
        } elseif ($version[0] === '5') {
            $downloadLinks = self::GetDownloadLinksFromWebsite(self::SCRAPING_LINK_SW5);
        }

        if (!array_key_exists($version, $downloadLinks)) {
            return null;
        }

        return $downloadLinks[$version];
    }

    /**
     * Get all release links.
     *
     * @param int|null $arrayPosition
     * @return array|mixed
     */
    public static function GetLinks(int $arrayPosition = null)
    {
        $downloadLinks = [];

        $downloadLinks += self::GetDownloadLinksFromWebsite(self::SCRAPING_LINK_SW6);
        $downloadLinks += self::GetDownloadLinksFromWebsite(self::SCRAPING_LINK_SW5);
        $downloadLinks = array_values($downloadLinks);

        if (is_null($arrayPosition)) {
            return $downloadLinks;
        }

        if (!array_key_exists($arrayPosition, $downloadLinks)) {
            return null;
        }

        return $downloadLinks[$arrayPosition];
    }
}
