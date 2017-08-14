<?php

namespace AppBundle\Repository;

use Psr\Log\LoggerInterface;

/**
 * Class WidgetRepository
 * @package AppBundle\Entity\Repository
 */
class WidgetRepository
{
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var \AppBundle\Entity\Repository\WidgetRepository
     */
    private $doctrineWidgetRepo;

    public function __construct(
        LoggerInterface $logger,
        \AppBundle\Entity\Repository\WidgetRepository $doctrineWidgetRepo
    )
    {
        $this->logger = $logger;
        $this->doctrineWidgetRepo = $doctrineWidgetRepo;
    }

    public function findOneById(string $id)
    {
        try {

            return $this->doctrineWidgetRepo->createFindOneByIdQuery($id)->getSingleResult();

        } catch (\Exception $e) {

            $this->logger->error(
                'WidgetRepository::findOneById',
                [
                    'error' => [
                        'msg'  => $e->getMessage(),
                        'code' => $e->getCode()
                    ]
                ]
            );

            return null;

        }
    }

    public function findAll()
    {
        try {

            return $this->doctrineWidgetRepo->createFindAllQuery();

        } catch (\Exception $e) {

            $this->logger->error(
                'WidgetRepository::findAll',
                [
                    'error' => [
                        'msg'  => $e->getMessage(),
                        'code' => $e->getCode()
                    ]
                ]
            );

            return null;

        }
    }
}
