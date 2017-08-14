<?php

namespace AppBundle\Features\Context;

use AppBundle\Entity\Widget;
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
     * WidgetSetupContext constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->em = $em;
    }

    /**
     * @Given there are Widgets with the following details:
     */
    public function thereAreWidgetsWithTheFollowingDetails(TableNode $widgets)
    {
        foreach ($widgets->getColumnsHash() as $key => $val) {

            $widget = (new Widget())
                ->setName($val['name'])
            ;

            $this->em->persist($widget);
            $this->em->flush();
        }
    }
}