<?php

namespace IceCreamPipeline\Tests\Stubs;

class TimesTwo {

    public function customHandle(int $number) {
        return $number * 2;
    }

    public function handle(int $number) {
        return $number * 2;
    }
}
