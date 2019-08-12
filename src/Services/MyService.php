<?php

namespace App\Services;

class MyService
{
    public function __construct($param1, $adminEmail, $globalParam)
    {
        dump($param1, $adminEmail, $globalParam);
    }
}
