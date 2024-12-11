<?php

declare(strict_types=1);

namespace Lrhoek\pf;

use Closure;

/**
 * Returns a function that runs callable $c $count times over $init
 * Then $init is returned
 */
function iterate(int $count, callable $c): Closure {

    return static function (mixed $init) use ($c, $count): mixed {
        while ($count-- > 0) $init = $c($init);
        return $init;
    };
}

/**
 * Adds a number to the value at $array[ $key ]
 * Or sets it if it is null
 */
function addset(array $array, int|string $key, int $number) : array {
    $array[$key] ??= 0;
    $array[$key] += $number;
    return $array;
}
