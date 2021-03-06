<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit78374b3f3257a5d202a2c75050c91379
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Workerman\\MySQL\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Workerman\\MySQL\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit78374b3f3257a5d202a2c75050c91379::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit78374b3f3257a5d202a2c75050c91379::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
