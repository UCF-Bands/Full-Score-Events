<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3990b3323c5449493c54a6b266d90ba7
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Full_Score_Events\\' => 18,
        ),
        'D' => 
        array (
            'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => 55,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Full_Score_Events\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => 
        array (
            0 => __DIR__ . '/..' . '/dealerdirect/phpcodesniffer-composer-installer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3990b3323c5449493c54a6b266d90ba7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3990b3323c5449493c54a6b266d90ba7::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
