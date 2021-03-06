<?php

namespace OliverNybroe\LighthouseMathScalars\Scalars;

use GraphQL\Error\Error;
use GraphQL\Language\AST\IntValueNode;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Utils\Utils;

/**
 * Read more about scalars here http://webonyx.github.io/graphql-php/type-system/scalar-types/
 * @internal
 */
class Percentage extends ScalarType
{
    public $description = <<<TXT
        The `Percentage` scalar type represents a percentage as a decimal number.
        
        When used as input, the value is input as an integer. Meaning 80% is in input as 80.
        When used as a return type, the value is shown as a decimal number. Meaning 80% will become 0.8
        TXT;

    /**
     * Serializes an internal value to include in a response.
     *
     * @param  mixed  $value
     * @return mixed
     */
    public function serialize($value)
    {
        if (!is_int($value)) {
            return null;
        }

        return $value / 100;
    }

    /**
     * Parses an externally provided value (query variable) to use as an input
     *
     * @param  mixed  $value
     * @return mixed
     */
    public function parseValue($value)
    {
        if (!is_int($value)) {
            throw new Error("Cannot represent following value as percentage: ". Utils::printSafeJson($value));
        }

        return $value / 100;
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
        if (!$valueNode instanceof IntValueNode) {
            throw new Error("Query error: Can only parse int got: " . $valueNode->kind, [$valueNode]);
        }

        return $valueNode->value / 100;
    }
}
