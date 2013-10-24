<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 12:48 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;

abstract class RoutedTrackingToolManager extends TrackingToolManager
{
    /**
     * @param $doctrine
     * @param $validator
     * @param $router
     * @param TrackerManager $trackerManager
     * @param $entityManagerName
     * @param iTrackingToolManagerExtensionService $extensionService
     */
    abstract public function __construct($doctrine, $validator, $router, TrackerManager $trackerManager, $entityManagerName, iTrackingToolManagerExtensionService $extensionService = null);

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