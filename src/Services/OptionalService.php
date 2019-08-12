<?php

namespace App\Services;

trait OptionalService
{
    /** @var MySecondService */
    private $service;

    /**
     * @required
     * @param MySecondService $secondService
     *
     * @author Dzianis Den Kotau <kotau@us.ibm.com>
     */
    public function setSecondService(MySecondService $secondService): void
    {
        $this->service = $secondService;
    }
}
