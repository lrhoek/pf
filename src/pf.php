<?php

declare(strict_types=1);

namespace Lrhoek\pf;

use Crell\fp;

/**
 * Return callable for fp\iterate
 */
function iterate(callable $mapper) : callable {
    return fn($init) => fp\iterate($init, $mapper);
}

/**
 * Same as fp\ittake, but with offset
 */
function ittake(int $offset, int $count = 1) : callable {
    return static function (array|\Iterator $a) use ($offset, $count) : iterable {
        yield from \is_array($a)
            ? \array_slice($a, $offset, $count)
            : new \LimitIterator($a, $offset, $count);
    };
}

/**
 * Return unary callable for array_any
 */
function array_any(callable $c) : callable {
    return function (array $a) use ($c) : bool {
        return \array_any($a, $c);
    };
}

/**
 * Return unary callable for array_all
 */
function array_all(callable $c) : callable {
    return function (array $a) use ($c) : bool {
        return \array_all($a, $c);
    };
}

/**
 * Return unary callable for array_chunk
 */
function array_chunk(int $length, bool $preserve_keys = false) : callable {
    return function (array $a) use ($length, $preserve_keys) : array {
        return \array_chunk($a, $length, $preserve_keys);
    };
}

/**
 * Return unary callable for array_slice
 */
function array_slice(int $offset, ?int $length = null, bool $preserve_keys = false) : callable {
    return function (array $a) use ($offset, $length, $preserve_keys) : array {
        return \array_slice($a, $offset, $length, $preserve_keys);
    };
}

/**
 * Return unary callable for usort
 */
function usort(callable $c) : callable {
    return function (array $a) use ($c) : array {
        \usort($a, $c);
        return $a;
    };
}