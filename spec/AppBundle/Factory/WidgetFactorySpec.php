<?php

namespace spec\AppBundle\Factory;

use AppBundle\Factory\WidgetFactory;
use AppBundle\Model\Clock;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WidgetFactorySpec extends ObjectBehavior
{
    /**
     * @var Clock
     */
    private $clock;

    function let(
        Clock $clock
    )
    {
        $this->beConstructedWith($clock);

        $this->clock = $clock;
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(WidgetFactory::class);
    }

    function it_can_create_a_widget()
    {
        $now = new \DateTimeImmutable('now');

        $this->clock->now()->willReturn($now);

        $widget = $this->create();

        $widget->getCreatedAt()->shouldEqual($now);
    }
}
