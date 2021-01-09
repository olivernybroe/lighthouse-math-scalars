<?php

namespace OliverNybroe\LighthouseMathScalars;

use Illuminate\Support\ServiceProvider;
use Nuwave\Lighthouse\Schema\TypeRegistry;

class MathScalarServiceProvider extends ServiceProvider
{
    public function boot(TypeRegistry $registry)
    {
        $registry->register(new BigInteger());
        $registry->register(new Percentage());
    }
}