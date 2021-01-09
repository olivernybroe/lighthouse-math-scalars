<?php

namespace OliverNybroe\LighthouseMathScalars;

use Brick\Math\Exception\IntegerOverflowException;
use GraphQL\Type\Definition\ScalarType;

/**
 * Read more about scalars here http://webonyx.github.io/graphql-php/type-system/scalar-types/
 */
class BigInteger extends ScalarType
{
    public $description = <<<TXT
        The `BigInteger` scalar type represents non-fractional signed whole numeric values. BigInteger has no max size.
        
        If the value is smaller than (2^63) then it is represented as a integer.
        In case the value is higher than (2^63) it is represented as a string.
        TXT;

    /**
     * Serializes an internal value to include in a response.
     *
     * @param  mixed  $value
     * @return mixed
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
     * @return mixed
     */
    public function parseValue($value)
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
     * @return mixed
     */
    public function parseLiteral($valueNode, ?array $variables = null)
    {
        return \Brick\Math\BigInteger::of($valueNode->value);
    }
}
