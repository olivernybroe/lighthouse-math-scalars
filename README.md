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
This scalar represents an integer which is bigger than the built-in `Int` type.  
The built-in type is limited to `2^31`, however this type has unlimited size as it can use strings to represent it.  

It will return the result from you query as an integer, as long as your integer is smaller than `2^63`.
If your integer is bigger than that, it will be returned as a string instead.

### Percentage
Converts an integer value to a percentage.  

Normally many of us stores percentages as an integer value and divide it by 100 to get it as a percentage.  
This Scalar will do this conversion for you. If used as an input type, it will do the same conversion.  

This scalar is useful for quickly identify for the users of your API, that the type is a percentage.