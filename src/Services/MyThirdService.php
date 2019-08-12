<?php

namespace App\Services;

class MyThirdService
{
    public $my;

    public $logger;

    public function doAction()
    {
        dump($this->my, $this->logger);
    }
}
