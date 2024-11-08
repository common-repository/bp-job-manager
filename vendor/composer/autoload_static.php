<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitebe7fb96a1d28c61deb3194f0eb7786c
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'HardG\\BuddyPress120URLPolyfills\\' => 32,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'HardG\\BuddyPress120URLPolyfills\\' => 
        array (
            0 => __DIR__ . '/..' . '/hard-g/buddypress-12.0-url-polyfills/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitebe7fb96a1d28c61deb3194f0eb7786c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitebe7fb96a1d28c61deb3194f0eb7786c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitebe7fb96a1d28c61deb3194f0eb7786c::$classMap;

        }, null, ClassLoader::class);
    }
}
