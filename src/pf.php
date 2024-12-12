<?php

declare(strict_types=1);

namespace Lrhoek\pf;

use Closure;
use Crell\fp;
use Iterator;
use LimitIterator;

/**
 * Return callable for fp\iterate
 */
function iterate(callable $mapper) : callable {
    return fn($init) => fp\iterate($init, $mapper);
}

/**
 * Same as fp\ittake, but with offset
 */
function ittake(int $offset, int $count = 1) : Closure {
    return static function (array|Iterator $a) use ($offset, $count) : iterable {
        yield from is_array($a)
            ? array_slice($a, $offset, $count)
            : new LimitIterator($a, $offset, $count);
    };
}

/**
 * Adds a number to the value at $array[ $key ]
 * Or sets it if it is null
 */
function add(array $array, int|string $key, int $number) : array {
    $array[$key] ??= 0;
    $array[$key] += $number;
    return $array;
}