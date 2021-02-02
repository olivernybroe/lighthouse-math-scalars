<?php

use OliverNybroe\LighthouseMathScalars\Scalars\BigIntegerString;

it('can serialize integer to string', function () {
    $value = 1_000_040;

    $serialized = (new BigIntegerString)->serialize($value);

    expect($serialized)->toBe((string) $value);
});

it('can serialize integer bigger than 2 pow 63', function () {
    $value = PHP_INT_MAX . "111";

    $serialized = (new BigIntegerString)->serialize($value);

    expect($serialized)->toBe($value);
});