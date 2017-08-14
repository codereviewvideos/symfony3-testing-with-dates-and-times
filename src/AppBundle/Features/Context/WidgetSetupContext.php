<?php

namespace AppBundle\Features\Context;

use AppBundle\Entity\Widget;
use AppBundle\Factory\WidgetFactory;
use AppBundle\Model\Clock;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;

class WidgetSetupContext implements Context
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;
    /**
     * @var Clock
     */
    private $clock;
    /**
     * @var WidgetFactory
     */
    private $widgetFactory;

    /**
     * WidgetSetupContext constructor.
     *
     * @param EntityManagerInterface $em
     * @param Clock                  $clock
     */
    public function __construct(
        EntityManagerInterface $em,
        Clock $clock,
        WidgetFactory $widgetFactory
    )
    {
        $this->em = $em;
        $this->clock = $clock;
        $this->widgetFactory = $widgetFactory;
    }

    /**
     * @Given there are Widgets with the following details:
     */
    public function thereAreWidgetsWithTheFollowingDetails(TableNode $widgets)
    {
        foreach ($widgets->getColumnsHash() as $key => $val) {

            $widget = $this->widgetFactory->create()
                ->setName($val['name'])
                ->setCreatedAt(
                    $this->clock->now()->modify($val['created_at'])
                )
                ->setUpdatedAt(
                    $this->clock->now()->modify($val['updated_at'])
                )
            ;

            $this->em->persist($widget);
            $this->em->flush();
        }
    }
}