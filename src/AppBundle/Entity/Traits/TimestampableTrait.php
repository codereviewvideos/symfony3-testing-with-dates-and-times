<?php

namespace AppBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSSerializer;

/**
 * Class TimestampableTrait
 * @package AppBundle\Entity\Traits
 */
trait TimestampableTrait
{
    /**
     * @var \DateTimeImmutable $createdAt Created at
     *
     * @ORM\Column(type="datetime_immutable", name="created_at")
     * @JMSSerializer\Expose
     * @JMSSerializer\Groups({"timestamps"})
     */
    protected $createdAt;

    /**
     * @var \DateTimeImmutable $updatedAt Updated at
     *
     * @ORM\Column(type="datetime_immutable", name="updated_at")
     * @JMSSerializer\Expose
     * @JMSSerializer\Groups({"timestamps"})
     */
    protected $updatedAt;

    /**
     * Get created at
     *
     * @return \DateTimeImmutable Created at
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set created at
     *
     * @param \DateTimeImmutable $dateTime
     *
     * @return $this
     */
    public function setCreatedAt(\DateTimeImmutable $dateTime = null)
    {
        if (null === $dateTime) {
            $dateTime = new \DateTimeImmutable('now');
        }

        $this->createdAt = $dateTime;
        $this->updatedAt = $dateTime;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     * @return $this
     */
    public function setCreatedAtViaPrePersist()
    {
        return $this->setCreatedAt();
    }

    /**
     * Get updated at
     *
     * @return \DateTimeImmutable Updated at
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set updated at
     *
     * @param \DateTimeImmutable $dateTime
     *
     * @return $this
     */
    public function setUpdatedAt(\DateTimeImmutable $dateTime = null)
    {
        if (null === $dateTime) {
            $dateTime = new \DateTimeImmutable('now');
        }

        $this->updatedAt = $dateTime;

        return $this;
    }
}