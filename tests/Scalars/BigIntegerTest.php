<?php

use Brick\Math\Exception\IntegerOverflowException;
use OliverNybroe\LighthouseMathScalars\Scalars\BigInteger;

it('can serialize integer to integer', function () {
    $value = 1_000_040;

    $serialized = (new BigInteger)->serialize($value);

    expect($serialized)->toBe($value);
});

it('fail when integer is bigger than 2 pow 63', function () {
    $value = PHP_INT_MAX . "111";

    $serialized = (new BigInteger)->serialize($value);
})->throws(IntegerOverflowException::class);