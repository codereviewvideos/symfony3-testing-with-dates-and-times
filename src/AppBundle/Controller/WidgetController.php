<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Widget;
use AppBundle\Form\Type\WidgetType;
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


    /**
     * Create new Widget from the submitted data
     *
     * @Annotations\Post(path="/widget")
     */
    public function postAction(Request $request)
    {
        // creates a Widget with the `createdAt` property already set
        $widget = $this->get('crv.factory.widget')->create();

        $form = $this->createForm(WidgetType::class, $widget, [
            'csrf_protection' => false,
        ]);

        $form->submit($request->request->all(), false);

        if (!$form->isValid()) {
            return $form;
        }

        $widget = $form->getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($widget);
        $em->flush();

        $routeOptions = [
            'id'      => $widget->getId(),
            '_format' => $request->get('_format'),
        ];

        return $this->routeRedirectView('get_widget', $routeOptions, Response::HTTP_CREATED);
    }

    /**
     * Update existing Widget from the submitted data
     *
     * @Annotations\Put(path="/widget/{id}")
     */
    public function putAction(Request $request, int $id)
    {
        // getRepo() being a private method to return
        // whatever repo we have configured
        $widget = $this->getRepo()->find($id);

        $form = $this->createForm(WidgetType::class, $widget, [
            'csrf_protection' => false,
        ]);

        $form->submit($request->request->all(), false);

        if (!$form->isValid()) {
            return $form;
        }

        $widget = $form->getData();

        // a manual process
        $widget->setUpdatedAt();

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $routeOptions = [
            'id'      => $widget->getId(),
            '_format' => $request->get('_format'),
        ];

        return $this->routeRedirectView('get_widget', $routeOptions, Response::HTTP_NO_CONTENT);
    }

}
