<?php

use AcmeWidgetCo\Core\Container;

if (!function_exists('resolve')) {
    /**
     * Global helper function to resolve dependencies using the DI container.
     *
     * @template T of object
     * @param class-string<T> $class The fully-qualified class name.
     * @return T An instance of the requested class.
     */
    function resolve(string $class) {
        static $container = null;

        if ($container === null) {
            $container = new Container();
        }

        return $container->resolve($class);
    }
}
