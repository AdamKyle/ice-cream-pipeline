<?php

namespace IceCreamPipeline\Tests\Stubs;

class AddOne {

    public function customHandle(int $number) {
        return $number + 1;
    }

    public function handle(int $number) {
        return $number + 1;
    }
}
