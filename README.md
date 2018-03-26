# Ice Cream Pipeline

[![Build Status](https://travis-ci.org/AdamKyle/ice-cream-pipeline.svg?branch=master)](https://travis-ci.org/AdamKyle/ice-cream-pipeline)
[![Packagist](https://img.shields.io/packagist/v/ice-cream/pipeline.svg)](https://packagist.org/packages/ice-cream/pipeline)
[![Maintenance](https://img.shields.io/maintenance/yes/2018.svg)]()
[![Made With Love](https://img.shields.io/badge/Made%20With-Love-green.svg)]()

This is a basic implementation of the pipeline pattern, wherein something is
passed through a series of classes and the end result is passed out.

- Requires PHP 7.2
- Is standalone

## Purpose

I wanted to build this for the Ice cream framework, it would be useful in passing object in through a pipeline and manipulating them.

I also built this to learn the pipeline pattern and how it is used and how other frameworks use the pattern when manipulating objects.

## Install

`composer require ice-cream/pipeline`

## Documentation

You can see the full documentation for the project [here](https://github.com/AdamKyle/ice-cream-pipeline/blob/master/docs/ApiIndex.md)

## How to use?

```php
class AddOne {

    public function customHandle(int $number) {
        return $number + 1;
    }

    public function handle(int $number) {
        return $number + 1;
    }
}

class TimesTwo {

    public function customHandle(int $number) {
        return $number * 2;
    }

    public function handle(int $number) {
        return $number * 2;
    }
}

$response = (new Pipeline())
    ->pass(10)
    ->through([
        new AddOne,
        new TimesTwo,
    ])
    ->withMethod('customHandle')
    ->process()
    ->getResponse();

var_dump($response); // => 22

```

What you will notice here is that we have a set of classes, the value 10 is passed through
both of these and then returned in the `getResponse()`, the reason we do not do this, returning the response
in `process`, is because you might want to call a new method: `then()` which takes a closure, as you will see in the examples below.

### `then(\Closure $func)`

Building on the above example, lets assume you want to do something after you process the value, or object passed in:

```php
(new Pipeline())
    ->pass(10)
    ->through([
        new AddOne,
        new TimesTwo,
    ])
    ->withMethod('customHandle')
    ->process()
    ->then(function($response) {
        $response *= 10;

        var_dump($response); // => 220
    });
```

You cannot call `getResponse` because this is a closure, and anonymous function.

### What if I don't have a custom method?

```php
(new Pipeline())
    ->pass(10)
    ->through([
        new AddOne,
        new TimesTwo,
    ])
    ->process()
    ->then(function($response) {
        $response *= 10;

        var_dump($response); // => 220
    });
```

Building on the above, we see that the classes, `AddOne` and `TimesTwo` implement a `handle()` method. If you do not
define a `withMethod(String $string)` then we default to the `handle` method that must be implemented or you get an `\Exception`
thrown telling you which class failed to implement the method in question.
