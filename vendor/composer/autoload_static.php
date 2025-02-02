<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb2803d7b28e181f38baecc33608b5cf7
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Inc\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb2803d7b28e181f38baecc33608b5cf7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb2803d7b28e181f38baecc33608b5cf7::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
