<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc9214da31943bab73c99c1fcd594c2f6
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc9214da31943bab73c99c1fcd594c2f6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc9214da31943bab73c99c1fcd594c2f6::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
