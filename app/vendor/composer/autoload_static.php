<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9258e67412c2df8c2d0c0accba6b98c6
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Smalot\\PdfParser\\' => 
            array (
                0 => __DIR__ . '/..' . '/smalot/pdfparser/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9258e67412c2df8c2d0c0accba6b98c6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9258e67412c2df8c2d0c0accba6b98c6::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit9258e67412c2df8c2d0c0accba6b98c6::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit9258e67412c2df8c2d0c0accba6b98c6::$classMap;

        }, null, ClassLoader::class);
    }
}
