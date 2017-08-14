<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Widget;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * Class DoctrineWidgetRepository
 * @package AppBundle\Entity\Repository
 */
class DoctrineWidgetRepository
{
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

    public function __construct(LoggerInterface $logger, ManagerRegistry $managerRegistry)
    {
        $this->logger = $logger;
        $this->managerRegistry = $managerRegistry;
    }

    public function createFindOneByIdQuery(string $id)
    {
        try {

            return $this
                ->getManager()
                ->createQuery(
                    "
                    SELECT c
                    FROM AppBundle\Entity\Widget w
                    WHERE w.id = :id
                    "
                )
                ->setParameter('id', $id)
            ;

        } catch (\Exception $e) {

            $this->logger->error(
                'WidgetRepository::createFindOneByIdQuery',
                [
                    'error' => [
                        'msg'  => $e->getMessage(),
                        'code' => $e->getCode()
                    ]
                ]
            );

            throw $e;

        }
    }

    public function createFindAllQuery()
    {
        try {

            return $this
                ->getManager()
                ->createQuery(
                    "
                    SELECT w
                    FROM AppBundle\Entity\Widget w
                    "
                )
            ;

        } catch (\Exception $e) {

            $this->logger->error(
                'WidgetRepository::createFindAllQuery',
                [
                    'error' => [
                        'msg'  => $e->getMessage(),
                        'code' => $e->getCode()
                    ]
                ]
            );

            throw $e;

        }
    }

    protected function getManager()
    {
        return $this->managerRegistry->getManagerForClass(Widget::class);
    }
}
