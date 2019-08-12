<?php

namespace App\Services;

class MyService
{
    use OptionalService;

    public function __construct()
    {

    }

    public function doAction()
    {
        dump($this->service->doSomething2());
    }
}
