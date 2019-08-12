<?php

namespace App\Services;

class MySecondService
{
    public function __construct()
    {
        dump('from second service');
        dump($this->doSomething());
    }

    public function doSomething(): string
    {
        return 'doSomething';
    }

    public function doSomething2(): string
    {
        return 'doSomething2';
    }
}
