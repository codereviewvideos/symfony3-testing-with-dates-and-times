<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSSerializer;

/**
 * @ORM\Entity()
 * @ORM\Table(name="widget")
 * @ORM\HasLifecycleCallbacks()
 * @JMSSerializer\ExclusionPolicy("all")
 */
class Widget
{
    use TimestampableTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMSSerializer\Expose
     * @JMSSerializer\Groups({"widget_all", "widget_summary"})
     */
    private $id;

    /**
     * @ORM\column(type="string")
     * @JMSSerializer\Expose
     * @JMSSerializer\Groups({"widget_all", "widget_summary"})
     */
    private $name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return Widget
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}