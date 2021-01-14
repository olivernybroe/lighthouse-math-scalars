<?php

namespace OliverNybroe\LighthouseMathScalars;

use Illuminate\Support\ServiceProvider;
use Nuwave\Lighthouse\Schema\TypeRegistry;
use OliverNybroe\LighthouseMathScalars\Scalars\BigInteger;
use OliverNybroe\LighthouseMathScalars\Scalars\BigIntegerDynamic;
use OliverNybroe\LighthouseMathScalars\Scalars\Percentage;

class MathScalarServiceProvider extends ServiceProvider
{
    public function boot(TypeRegistry $registry)
    {
        $registry->register(new BigIntegerDynamic);
        $registry->register(new BigInteger);
        $registry->register(new Percentage);
    }
}