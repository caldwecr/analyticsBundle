<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 12:48 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iPropertySet;
use Cympel\Bundle\AnalyticsBundle\Entity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Entity\RoutedTrackingTool;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Entity\RenderableTrackingTool;

abstract class RoutedTrackingToolManager extends TrackingToolManager
{
    /**
     * @param $doctrine
     * @param iTrackingToolValidator $trackingToolValidator
     * @param $router
     * @param TrackerManager $trackerManager
     * @param $entityManagerName
     * @param iTrackingToolManagerExtensionService $extensionService
     */
    abstract public function __construct($doctrine, iTrackingToolValidator $trackingToolValidator, $router, TrackerManager $trackerManager, $entityManagerName, iTrackingToolManagerExtensionService $extensionService = null);

    /**
     * @param iTrackingTool $tool
     * @param bool $type
     * @return string
     */
    public function generateUrl(iTrackingTool $tool, $type = URLGeneratorInterface::ABSOLUTE_PATH)
    {
        return $this->getRouter()->generate($this->getRouteName(),
            $this->getRoutingArray($tool),
            $type
        );
    }

    /**
     * @param iPropertySet $properties
     * @param iTracker $tracker
     * @return string
     */
    public function generate(iPropertySet $properties, iTracker $tracker = null)
    {
        if(!$tracker) $tracker = $this->getTrackerManager()->create();
        $tool = $this->create($tracker);
        $fProperties = $this->finalizeProperties($properties, $tool);
        $this->setProperties($tool, $fProperties);
        $this->persist($tool);
        return $this->generateUrl($tool, UrlGeneratorInterface::ABSOLUTE_PATH);
    }

    /**
     * @param $id
     * @return mixed
     *
     * This method is invoked by the Default Controller to render a DynamicCSS
     */
    public function renderById($id)
    {
        $toReturn = RoutedTrackingTool::cast($this->findOneById($id));
        $toReturn->setRendered(time());
        $em = $this->getDoctrine()->getManager($this->getEntityManagerName());
        $em->persist($toReturn);
        $em->flush();
        return $toReturn;
    }

    /**
     * @param iPropertySet $properties
     * @param iTrackingTool $tool
     * @return iPropertySet
     *
     * The purpose of this method is to allow changes to the properties based on the tool's initialization
     * that would have otherwise been impossible prior to the tool's initialization
     * This is necessary for DynamicCSS tools so that the DomIds can be bound to the tool
     */
    abstract protected function finalizeProperties(iPropertySet $properties, iTrackingTool $tool);

    /**
     * @return string
     */
    abstract protected function getRouteName();

    /**
     * @param iTrackingTool $tool
     * @return array
     */
    abstract protected function getRoutingArray(iTrackingTool $tool);

    /**
     * @return Object -- the router service
     */
    abstract protected function getRouter();

    /**
     * @param $router
     * @return void
     */
    abstract protected function setRouter($router);
}