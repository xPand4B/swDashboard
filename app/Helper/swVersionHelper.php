<?php

namespace App\Helper;

class swVersionHelper
{
    /**
     * @var string
     */
    private const SW6_BASE_LINK = "https://releases.shopware.com/sw6/";

    /**
     * @var string
     */
    private const SW5_BASE_LINK = "https://releases.shopware.com/";

    /**
     * @var array
     */
    private const VERSIONS = [
        "6.x" => [
            "6.2.2" => "install_6.2.2_1592398977.zip",
            "6.2.1" => "install_6.2.1_1592219982.zip",
            "6.2.0" => "install_6.2.0_1589874223.zip",
            "6.2.0 (RC1)" => "install_6.2.0-RC1_1587999999.zip",
            "6.1.5" => "install_6.1.5_1585830011.zip",
            "6.1.4" => "install_6.1.4_1584369563.zip",
            "6.1.3" => "install_6.1.3_1582123990.zip",
            "6.1.2" => "install_6.1.2_1581958492.zip",
            "6.1.1" => "install_6.1.1_1580132211.zip",
            "6.1.0" => "install_6.1.0_1578903315.zip",
            "6.1.0 (RC4)" => "install_6.1.0-rc4_1578385963.zip",
            "6.1.0 (RC3)" => "install_6.1.0-rc3_1576509709.zip",
            "6.1.0 (RC2)" => "install_6.1.0-rc2_1575987114.zip",
            "6.1.0 (RC1)" => "install_6.1.0-rc1_1575898588.zip",
            "6.0.0 (EA2)" => "install_6.0.0_ea2_1571125323.zip",
            "6.0.0 (EA1.1)" => "install_6.0.0_ea1.1_1566459663.zip",
            "6.0.0 (EA1)" => "install_6.0.0_ea1_1563354247.zip"
        ],

        "5.6.x" => [
            "5.6.7" => "install_5.6.7_8cec71ed6df4804610664944e3f67e5d3a61adea.zip",
            "5.6.6" => "install_5.6.6_f8cbea93398b121a4471c35795ce1a8822176d32.zip",
            "5.6.5" => "install_5.6.5_482a9c1c64e67f009c47b25ebbf97a7f9f06066a.zip",
            "5.6.4" => "install_5.6.4_3540d53b7727442cde5287b669c7d3b94f8a07c7.zip",
            "5.6.3" => "install_5.6.3_fec7645a72a0393f8a39f48ddd6c27e138f44513.zip",
            "5.6.2" => "install_5.6.2_6cadc5c14bad4ea8839395461ea42dbc359e9666.zip",
            "5.6.1" => "install_5.6.1_51a886fad0d2ba1b956f68f06436bf4a988207f4.zip",
            "5.6.0" => "install_5.6.0_3e81c54e1c57c6925e4d05336283ad18de9b10bb.zip",
        ],
        "5.5.x" => [
            "5.5.10" => "install_5.5.10_edfcb8e82f331fa5a0935a6c6ff35fe4348bf262.zip",
            "5.5.9" => "install_5.5.9_402d088c6bc5a8c6f94cd785b046f081d664b3f8.zip",
            "5.5.8" => "install_5.5.8_d5bf50630eeaacc6679683e0ab0dcba89498be6d.zip",
            "5.5.7" => "install_5.5.7_f785facc70e39f2ca4292e78739457417f19fbcf.zip",
            "5.5.6" => "install_5.5.6_9cb9f7b8f22ef979df1acd99b0e8071a6fbaf785.zip",
            "5.5.5" => "install_5.5.5_ffa6b751fe12625c09a85ce6a8ecb0e9e20b09f1.zip",
            "5.5.4" => "install_5.5.4_231a4a743f5bbe89057ddba7a0afad2faf9093c2.zip",
            "5.5.3" => "install_5.5.3_02e65ded0aa40b5a2a8b75c80042e8de487dc4c8.zip",
            "5.5.2" => "install_5.5.2_92d78ee09d388d29f49cec3c82167ce803ee51b8.zip",
            "5.5.1" => "install_5.5.1_4a48054b7c53187c807d6a6d82ec88ffb72b5e6a.zip",
            "5.5.0" => "install_5.5.0_0ed612e1cfef1dc9fd30cd99ea45a22e031d031b.zip",
        ],
        "5.4.x" => [
            "5.4.6" => "install_5.4.6_f667f6471a77bb5af0c115f3e243594e6353747e.zip",
            "5.4.5" => "install_5.4.5_6847c0845f0f97230aa05c7294fa726a96dda3ff.zip",
            "5.4.4" => "install_5.4.4_212c6fa7dfe799de813cd57129bd78f41ee76f2c.zip",
            "5.4.3" => "install_5.4.3_2cc37d9929992efe320de811902bb445bab0de5a.zip",
            "5.4.2" => "install_5.4.2_2463755ef7e8f738a6b1089e5d936dc27284a40a.zip",
            "5.4.1" => "install_5.4.1_00a0b805318ebc649726675b82db56d7bd308bd2.zip",
            "5.4.0" => "install_5.4.0_65d1aa5dd15f9b05922f21d4c1dd1066dd8eef38.zip",
        ],
        "5.3.x" => [
            "5.3.7" => "install_5.3.7_741ae9fb77ecb227dc6be9c1028ded1e957c0e14.zip",
            "5.3.6" => "install_5.3.6_c3d6cecc4dcbd0480a289006fdd4c643bfddb49c.zip",
            "5.3.5" => "install_5.3.5_233d40b70fe2198b48d68793af3cf1421568b345.zip",
            "5.3.4" => "install_5.3.4_05cdb056b32446d2bb555aa00f85aac06ec72060.zip",
            "5.3.3" => "install_5.3.3_0e50204087219ada9cdd9a74cd17cbb264e8c0a4.zip",
            "5.3.2" => "install_5.3.2_5ab7c48a261445eaeb25273cb34c1a6ae3102741.zip",
            "5.3.1" => "install_5.3.1_e42b3bfc041e6115ae04948dccbd1cd91d5c0564.zip",
            "5.3.0" => "install_5.3.0_51914cdfbd690d51f3dbe4049705b033ff98811f.zip",
        ],
        "5.2.x" => [
            "5.2.27" => "install_5.2.27_56d5aabc56c2e48d84084d0381a72a3897d5263f.zip",
            "5.2.26" => "install_5.2.26_2437513ecb3e6d0340bab707cf4b680666d38ed5.zip",
            "5.2.25" => "install_5.2.25_54d4a3c78efa09f63fc71077537ea409696dfeca.zip",
            "5.2.24" => "install_5.2.24_2056ea7f0d0363e0d4c0678a4a68fc35db547965.zip",
            "5.2.23" => "install_5.2.23_21d35d62918428c401b967c69fe73ff38a1f00a2.zip",
            "5.2.22" => "install_5.2.22_0010210a2d8f7c275ca9bbed06b0f213cbb4b048.zip",
            "5.2.21" => "install_5.2.21_2164cff64b62f5d7aa68c0ae8a231ce750430e65.zip",
            "5.2.20" => "install_5.2.20_99580d1ac8d442f18721399a14e042ea610fd1a0.zip",
            "5.2.19" => "install_5.2.19_4db5d68242f44778ceee816f958e6ec9dfa731b8.zip",
            "5.2.18" => "install_5.2.18_40832027120b85c9620e6651b4a9b32290e10a22.zip",
            "5.2.17" => "install_5.2.17_582842251fc465c404e74b622e2638233d353d71.zip",
            "5.2.16" => "install_5.2.16_361b837b2dba5bbc5fb7064a718ebf57cfac5cad.zip",
            "5.2.15" => "install_5.2.15_f78c4fd1b3d68d7c3542a7aad2ac33d90726f8db.zip",
            "5.2.14" => "install_5.2.14_8ead8335c085d4677a4e7ad7d3399b094c1bb26e.zip",
            "5.2.13" => "install_5.2.13_dbca3b24f22f8f52512975133374b9b85a39a123.zip",
            "5.2.12" => "install_5.2.12_8c8f67d848ef15aafaac6fed5f0eef062644250f.zip",
            "5.2.11" => "install_5.2.11_c2c89cba1e16f554ff7239574a2865254a6b97a2.zip",
            "5.2.10" => "install_5.2.10_81bb8855627da325b797a477602189377b411bcf.zip",
            "5.2.9" => "install_5.2.9_29c0a379c74f8fd89911f31dd671a0c7d28f18fe.zip",
            "5.2.8" => "install_5.2.8_b41bb9f24d00b3d8a0bf880361ec06fc5e2e67d5.zip",
            "5.2.7" => "install_5.2.7_b2081fd410306d74001ae1a2ce725b003c3e0259.zip",
            "5.2.6" => "install_5.2.6_ecdfff604b1fa93a3b50606d378f9e2bf681890f.zip",
            "5.2.5" => "install_5.2.5_cc3b6e432af2144fdd4c5e8e1b28cda0398ef7f4.zip",
            "5.2.4" => "install_5.2.4_b1a52d04c9c8cd60205c181eb7d51aa5a516bff0.zip",
            "5.2.3" => "install_5.2.3_3066bee006dc8fa082b6691a6af186810b3e4f05.zip",
            "5.2.2" => "install_5.2.2_fec9a405e4d6043625058bc5bf3badecd9197333.zip",
            "5.2.1" => "install_5.2.1_b87844ddbd0b61f85b78764983daf220662fd273.zip",
            "5.2.0" => "install_5.2.0_b9d72b7ea4f2ad7092d761ebb4f38373f2b3ff43.zip",
        ],
        "5.1.x" => [
            "5.1.6" => "install_5.1.6_04ec396ac8d2fa8c1e088bc2bd2c8132ab56c270.zip",
            "5.1.5" => "install_5.1.5_ca9dc97e4751d0cd22d08548c7efe4edc6124f39.zip",
            "5.1.4" => "install_5.1.4_2a6c1d025af042525558ba10d738eeb19ed75ff4.zip",
            "5.1.3" => "install_5.1.3_f089bf38b9a0041b80b24c56a03954dccea5e117.zip",
            "5.1.2" => "install_5.1.2_5d9a9f30821d7ac1be1d5bc7c21d7132e979e38e.zip",
            "5.1.1" => "install_5.1.1_3ad625236466a973e6d569d5699f1b7094121298.zip",
            "5.1.0" => "install_5.1.0_550a2758edda9e488a6d092839a72bff9fc617ca.zip",
        ],
        "5.0.x" => [
            "5.0.4" => "install_5.0.4_5b69a44ab451eced9f970bc7732d2a4cc7176e45.zip",
            "5.0.3" => "install_5.0.3_64a91b5fae65b7970a9e02b2a13f1733a4c5c6cb.zip",
            "5.0.2" => "install_5.0.2_f003e4550105c830fc6ca87b340ffa0aba1ae969.zip",
            "5.0.1" => "install_5.0.1_2ec5c1c8427afdc5654aec88bf51a80db93304ef.zip",
            "5.0.0" => "install_5.0.0_c122de4b3eba2d45f1085cc8df74ff96804179ec.zip",
        ],
        "4.3.x" => [
            "4.3.7" => "install_4.3.7_86f0ac9f4633586198cd12da1bd311130ac85de3.zip",
        ]
    ];

    /**
     * Get all release versions.
     *
     * @param int|null $arrayPosition
     * @return array|mixed
     */
    public static function GetVersions(int $arrayPosition = null, string $majorVersion = null)
    {
        $versions = [];

        foreach (self::VERSIONS as $major => $releases){
            if (is_null($majorVersion)) {
                foreach ($releases as $version => $link){
                    array_push($versions, $version);
                }

            } else {
                if ($majorVersion[0] === $major[0]) {
                    foreach ($releases as $version => $link){
                        array_push($versions, $version);
                    }
                }
            }
        }

        if (is_null($arrayPosition)){
            return $versions;
        }

        if (!array_key_exists($arrayPosition, $versions)){
            return null;
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
        if (!in_array($version, self::GetVersions())){
            return null;
        }

        $arrayPosition = array_search($version, self::GetVersions());

        return self::GetLinks($arrayPosition);
    }

    /**
     * Get all release links.
     *
     * @param int|null $arrayPosition
     * @return array|mixed
     */
    public static function GetLinks(int $arrayPosition = null)
    {
        $links = [];

        foreach (self::VERSIONS as $major => $releases){
            foreach ($releases as $version => $link){
                array_push($links, $link);
            }
        }

        if (is_null($arrayPosition)){
            return $links;
        }

        if (!array_key_exists($arrayPosition, $links)){
            return null;
        }

        if (strpos($links[$arrayPosition], 'install_6') !== false) {
            return self::SW6_BASE_LINK.$links[$arrayPosition];
        }else{
            return self::SW5_BASE_LINK.$links[$arrayPosition];
        }
    }
}
