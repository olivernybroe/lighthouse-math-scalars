<?php

namespace OliverNybroe\LighthouseMathScalars\Scalars;

use Brick\Math\Exception\IntegerOverflowException;
use GraphQL\Type\Definition\ScalarType;

/**
 * Read more about scalars here http://webonyx.github.io/graphql-php/type-system/scalar-types/
 */
class BigIntegerDynamic extends ScalarType
{
    public $description = <<<TXT
        The `BigIntegerDynamic` scalar type represents non-fractional signed whole numeric values. BigIntegerDynamic has no max size.
        
        If the value is smaller than (2^63) then it is represented as a integer.
        In case the value is bigger than (2^63) it is represented as a string.
        TXT;

    /**
     * Serializes an internal value to include in a response.
     *
     * @param  mixed  $value
     * @return string|int
     */
    public function serialize($value)
    {
        $value = \Brick\Math\BigInteger::of($value);

        try {
            return $value->toInt();
        } catch (IntegerOverflowException $exception) {
            return (string) $value;
        }
    }

    /**
     * Parses an externally provided value (query variable) to use as an input
     *
     * @param  mixed  $value
     */
    public function parseValue($value): \Brick\Math\BigInteger
    {
        return \Brick\Math\BigInteger::of($value);
    }

    /**
     * Parses an externally provided literal value (hardcoded in GraphQL query) to use as an input.
     *
     * E.g.
     * {
     *   user(email: "user@example.com")
     * }
     *
     * @param  \GraphQL\Language\AST\Node  $valueNode
     * @param  mixed[]|null  $variables
     */
    public function parseLiteral($valueNode, ?array $variables = null): \Brick\Math\BigInteger
    {
        return \Brick\Math\BigInteger::of($valueNode->value);
    }
}
