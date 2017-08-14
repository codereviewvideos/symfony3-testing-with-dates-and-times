<?php

namespace AppBundle\Features\Context;

use AppBundle\Model\Clock;
use AppBundle\Model\TestClock;
use Behat\Behat\Context\Context;

class TimeContext implements Context
{
    /**
     * @var TestClock
     */
    private $clock;

    public function __construct(
        TestClock $clock
    )
    {
        $this->clock = $clock;
    }

    /**
     * @Given the system time at the start of this test is :strDate
     */
    public function theSystemTimeAtTheStartOfThisTestIs($strDate)
    {
        $this->clock->setTime(
            $strDate
        );
    }
}