<?php

use OliverNybroe\LighthouseMathScalars\Scalars\BigIntegerDynamic;

it('can serialize integer to int when smaller than 2 pow 63', function () {
    $value = 1_000_040;

    $serialized = (new BigIntegerDynamic)->serialize($value);

    expect($serialized)->toBe($value);
});

it('can serialize integer bigger than 2 pow 63', function () {
    $value = PHP_INT_MAX . "111";

    $serialized = (new BigIntegerDynamic)->serialize($value);

    expect($serialized)->toBe($value);
});