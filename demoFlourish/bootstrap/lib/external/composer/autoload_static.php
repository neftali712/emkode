<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitadb46786488e29b468e17876824d36e6
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '667aeda72477189d0494fecd327c3641' => __DIR__ . '/..' . '/symfony/var-dumper/Resources/functions/dump.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\VarDumper\\' => 28,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
        ),
        'D' => 
        array (
            'Dotenv\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Component\\VarDumper\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/var-dumper',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/phpdotenv/src',
        ),
    );

    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/..' . '/phug/ast/src',
        1 => __DIR__ . '/..' . '/phug/compiler/src',
        2 => __DIR__ . '/..' . '/phug/dependency-injection/src',
        3 => __DIR__ . '/..' . '/phug/event/src',
        4 => __DIR__ . '/..' . '/phug/formatter/src',
        5 => __DIR__ . '/..' . '/phug/lexer/src',
        6 => __DIR__ . '/..' . '/phug/parser/src',
        7 => __DIR__ . '/..' . '/phug/phug/src',
        8 => __DIR__ . '/..' . '/phug/reader/src',
        9 => __DIR__ . '/..' . '/phug/renderer/src',
        10 => __DIR__ . '/..' . '/phug/util/src',
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Phug' => 
            array (
                0 => __DIR__ . '/..' . '/phug/phug/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitadb46786488e29b468e17876824d36e6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitadb46786488e29b468e17876824d36e6::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInitadb46786488e29b468e17876824d36e6::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitadb46786488e29b468e17876824d36e6::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
