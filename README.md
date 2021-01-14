# Lighthouse Math Scalars
A collection of custom scalar types for usage with [Lighthouse](https://lighthouse-php.com/).

## Installation
```bash
composer require olivernybroe/lighthouse-math-scalars
```

## Usage
You can use the provided scalars just like any other type in your schema definition.  
The scalars are automatically registered in Lighthouse.

````graphql
type Battle {
  id: ID!
  attacker: User!
  defender: User!
  gold_stolen_ratio: Percentage!
  gold_stolen: BigInteger!
}
````

## Scalars

### BigInteger
This scalar represents an integer with a size up to `2^63` whereas the built-in `Int` type is limited to `2^31`.
The value is represented as an integer, not a string when returned.

### BigIntegerString
This scalar represents an integer with unlimited size. It is always returning the value as a string.  
`BigInteger` will always return an integer, but is limited to `2^63`, however `BigIntegerString` is great for
the cases where bigger values than that is required. 

### BigIntegerDynamic
This scalar represents an integer which is bigger than the built-in `Int` type.  
The built-in type is limited to `2^31`, however this type has unlimited size as it can use strings to represent it.  

It will return the result from you query as an integer, as long as your integer is smaller than `2^63`.
If your integer is bigger than that, it will be returned as a string instead.

### Percentage
Converts an integer value to a percentage.  

Normally many of us stores percentages as an integer value and divide it by 100 to get it as a percentage.  
This Scalar will do this conversion for you. If used as an input type, it will do the same conversion.  

This scalar is useful for quickly identify for the users of your API, that the type is a percentage.

## Casts
A set of casts which can be used in a Laravel model to cast attributes.

### BigInteger (`OliverNybroe\LighthouseMathScalars\Casts\BigInteger`)
When dealing with integers of bigger than `2^63`, a class is needed for doing all the mathematical calculations.  
For doing that, this package relies on `\Brick\Math\BigInteger` underneath.  
This cast will cast a value into the `BigInteger` class for you.

```php
use OliverNybroe\LighthouseMathScalars\Casts\BigInteger as BigIntegerCast;
use Brick\Math\BigInteger;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property BigInteger $gold
 */
class User extends Authenticatable
{
    protected $casts = [
        'gold' => BigIntegerCast::class,
    ];
```