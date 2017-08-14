<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Widget;
use AppBundle\Repository\WidgetRepository;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * @RouteResource("widget", pluralize=false)
 */
class WidgetController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Get a single Widget.
     *
     * @Annotations\Get(path="/widget/{id}")
     *
     * @param string           $id the Widget ID
     * @param WidgetRepository $widgetRepository
     *
     * @return View
     *
     * @Annotations\View(serializerGroups={
     *     "Default",
     *     "timestamps",
     *     "widget_all"
     * })
     *
     */
    public function getAction(string $id, WidgetRepository $widgetRepository)
    {
        $widget = $widgetRepository->findOneById($id);

        if ($widget === null) {
            return new View(null, Response::HTTP_NOT_FOUND);
        }

        return $widget;
    }

    /**
     * Gets a collection of Widgets
     *
     * @Annotations\Get(path="/widget")
     *
     * @Annotations\View(serializerGroups={
     *     "Default",
     *     "timestamps",
     *     "widget_all"
     * })
     *
     * @param WidgetRepository $widgetRepository
     *
     * @return array
     */
    public function cgetAction(
        WidgetRepository $widgetRepository
    )
    {
        return $widgetRepository->findAll();
    }
}
