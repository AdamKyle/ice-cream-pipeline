<?php
use IceCreamPipeline\Container;

use IceCreamPipeline\Tests\Stubs\AddOne;
use IceCreamPipeline\Tests\Stubs\TimesTwo;
use IceCreamPipeline\Tests\Stubs\MissingMethods;
use IceCreamPipeline\Pipeline;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase {

    public function testPipeLineShouldWorkWithCustomHandleMethod() {
        $response = (new Pipeline())
            ->pass(10)
            ->through([
                new AddOne,
                new TimesTwo,
            ])
            ->withMethod('customHandle')
            ->process()
            ->getResponse();

        $this->assertEquals(22, $response);
    }

    public function testPipeLineShouldWorkWithOutCustomHandleMethod() {
        $response = (new Pipeline())
            ->pass(10)
            ->through([
                new AddOne,
                new TimesTwo,
            ])
            ->process()
            ->getResponse();

        $this->assertEquals(22, $response);
    }

    public function testWithThenFunctionCall() {
        $response = (new Pipeline())
            ->pass(10)
            ->through([
                new AddOne,
                new TimesTwo,
            ])
            ->process()
            ->then(function($response) {
                $response *= 10;

                $this->assertEquals(220, $response);
            });
    }

    /**
     * @expectedException Exception
     */
    public function testNoMethodsOnTheClass() {
        (new Pipeline())
            ->pass(10)
            ->through([
                new MissingMethods
            ])
            ->process();
    }
}
