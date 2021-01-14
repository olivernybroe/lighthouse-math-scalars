<?php

namespace OliverNybroe\LighthouseMathScalars\Scalars;

use Brick\Math\Exception\IntegerOverflowException;
use GraphQL\Type\Definition\ScalarType;

/**
 * Read more about scalars here http://webonyx.github.io/graphql-php/type-system/scalar-types/
 * @internal
 */
class BigIntegerString extends ScalarType
{
    public $description = <<<TXT
        The `BigIntegerString` scalar type represents non-fractional signed whole numeric values.
        The value is always represented as a string and has no max size.
        TXT;

    /**
     * Serializes an internal value to include in a response.
     *
     * @param  mixed  $value
     */
    public function serialize($value): string
    {
        $value = \Brick\Math\BigInteger::of($value);

        return (string) $value;
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
