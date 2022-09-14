<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc0f229225b57dcd75535fb8568653423
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Facebook\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Facebook\\' => 
        array (
            0 => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc0f229225b57dcd75535fb8568653423::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc0f229225b57dcd75535fb8568653423::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc0f229225b57dcd75535fb8568653423::$classMap;

        }, null, ClassLoader::class);
    }
}
