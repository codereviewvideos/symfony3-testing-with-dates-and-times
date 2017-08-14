<?php

namespace AppBundle\Factory;

use AppBundle\Entity\Widget;
use AppBundle\Model\Clock;

class WidgetFactory
{
    /**
     * @var Clock
     */
    private $clock;

    public function __construct(
        Clock $clock
    )
    {
        $this->clock = $clock;
    }

    /**
     * @return Widget
     */
    public function create()
    {
        return (new Widget())
            ->setCreatedAt(
                $this->clock->now()
            );
    }
}
