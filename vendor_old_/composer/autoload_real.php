<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit5bf8fa0c717021c0a41a2b296b7d92a0
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit5bf8fa0c717021c0a41a2b296b7d92a0', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit5bf8fa0c717021c0a41a2b296b7d92a0', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit5bf8fa0c717021c0a41a2b296b7d92a0::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}