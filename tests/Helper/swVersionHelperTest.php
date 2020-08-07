<?php

namespace Tests\Helper;

use App\Helper\swVersionHelper;
use Tests\TestCase;

class swVersionHelperTest extends TestCase
{
    /**
     * @param string|null $major
     * @return string
     */
    private function getLatestLink(string $major = null): string
    {
        if (! $major) {
            $major = $this->getMajorVersions()[0];
        }

        return array_values(swVersionHelper::VERSIONS[$major])[0];
    }

    /** @test */
    public function test_version_helper_can_get_versions(): void
    {
        $response = swVersionHelper::GetVersions();

        foreach ($this->getMajorVersions() as $majorVersion) {
            foreach (swVersionHelper::VERSIONS[$majorVersion] as $version => $link) {
               self::assertContains($version, $response);
            }
        }
    }

    /** @test */
    public function test_version_helper_can_get_versions_with_array_position(): void
    {
        $response = swVersionHelper::GetVersions(0);

        self::assertSame(
            $this->getLatestVersion(), $response
        );

        $response = swVersionHelper::GetVersions(999999999);
        self::assertNull($response);
    }

    /** @test */
    public function test_version_helper_can_get_versions_with_major_version(): void
    {
        $response = swVersionHelper::GetVersions(0, $this->getMajorVersions()[0]);

        self::assertSame(
            $this->getLatestVersion(), $response
        );
    }

    /** @test */
    public function test_version_helper_can_get_link_by_version(): void
    {
        $sampleVersions = [
            '6.2.3'  => swVersionHelper::SW6_BASE_LINK.'install_6.2.3_1594641397.zip',
            '5.6.7'  => swVersionHelper::SW5_BASE_LINK.'install_5.6.7_8cec71ed6df4804610664944e3f67e5d3a61adea.zip',
            '5.5.10' => swVersionHelper::SW5_BASE_LINK.'install_5.5.10_edfcb8e82f331fa5a0935a6c6ff35fe4348bf262.zip',
            '4.3.7'  => swVersionHelper::SW5_BASE_LINK.'install_4.3.7_86f0ac9f4633586198cd12da1bd311130ac85de3.zip',
            '0.0.0' => null,
        ];

        foreach ($sampleVersions as $version => $expectedLink) {
            $response = swVersionHelper::GetLinkByVersion($version);

            self::assertSame($expectedLink, $response);
        }
    }

    /** @test */
    public function test_version_helper_can_get_links(): void
    {
        $response = swVersionHelper::GetLinks();

        foreach ($this->getMajorVersions() as $majorVersion) {
            foreach (swVersionHelper::VERSIONS[$majorVersion] as $version => $link) {
                self::assertContains($link, $response);
            }
        }
    }

    /** @test */
    public function test_version_helper_can_get_links_with_array_position(): void
    {
        $response = swVersionHelper::GetLinks(0);

        self::assertSame(
            swVersionHelper::SW6_BASE_LINK_NEW.$this->getLatestLink(), $response
        );

        $response = swVersionHelper::GetLinks(999999999);
        self::assertNull($response);
    }
}
