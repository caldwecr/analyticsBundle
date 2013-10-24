<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 11:52 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJS;
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSPropertySet;
use Cympel\Bundle\AnalyticsBundle\Entity\iPropertySet;
use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;

class DynamicJSManager extends RoutedTrackingToolManager
{
    /**
     * @var string
     */
    protected $repositoryName;

    /**
     * @var Object - the doctrine service
     */
    protected $doctrine;

    /**
     * @var Object -- the validator service
     */
    protected $validator;

    /**
     * @var string
     */
    protected $emName;

    /**
     * @var TrackerManager
     */
    protected $trackerManager;

    /**
     * @var Object -- the router service
     */
    protected $router;

    /**
     * @param $doctrine
     * @param $validator
     * @param $router
     * @param TrackerManager $trackerManager
     * @param $entityManagerName
     * @param iTrackingToolManagerExtensionService $extensionService
     */
    public function __construct($doctrine, $validator, $router, TrackerManager $trackerManager, $entityManagerName, iTrackingToolManagerExtensionService $extensionService = null)
    {
        $this->doctrine = $doctrine;
        $this->validator = $validator;
        $this->router = $router;
        $this->trackerManager = $trackerManager;
        $this->emName = $entityManagerName;
        $this->repositoryName = 'CympelAnalyticsBundle:DynamicJS';
    }

    /**
     * @return iTrackingTool
     */
    protected function createTrackingTool()
    {
        return new DynamicJS();
    }

    /**
     * @return string
     */
    protected function getRepositoryName()
    {
        return $this->repositoryName;
    }

    /**
     * @return iPropertySet
     */
    protected function createPropertySet()
    {
        return new DynamicJSPropertySet();
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSManager';
    }

    /**
     * @return TrackerManager
     */
    protected function getTrackerManager()
    {
        return $this->trackerManager;
    }

    /**
     * @param TrackerManager $trackerManager
     * @return void
     */
    protected function setTrackerManager(TrackerManager $trackerManager)
    {
        $this->trackerManager = $trackerManager;
    }

    /**
     * @return Object - the doctrine service
     */
    protected function getDoctrine()
    {
        return $this->doctrine;
    }

    /**
     * @param $doctrine
     * @return void
     */
    protected function setDoctrine($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @return string
     */
    protected function getEmName()
    {
        return $this->emName;
    }

    /**
     * @param string $emName
     * @return void
     */
    protected function setEmName($emName)
    {
        $this->emName = $emName;
    }

    /**
     * @return Object - the validator service
     */
    protected function getValidator()
    {
        return $this->validator;
    }

    /**
     * @param $validator
     * @return void
     */
    protected function setValidator($validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param iPropertySet $properties
     * @param iTrackingTool $tool
     * @return iPropertySet
     */
    protected function finalizeProperties(iPropertySet $properties, iTrackingTool $tool)
    {
        // TODO: Implement finalizeProperties() method.
    }

    /**
     * @return string
     */
    protected function getRouteName()
    {
        // TODO: Implement getRouteName() method.
    }

    /**
     * @param iTrackingTool $tool
     * @return array
     */
    protected function getRoutingArray(iTrackingTool $tool)
    {
        // TODO: Implement getRoutingArray() method.
    }

    /**
     * @return Object -- the router service
     */
    protected function getRouter()
    {
        // TODO: Implement getRouter() method.
    }

    /**
     * @param $router
     * @return void
     */
    protected function setRouter($router)
    {
        // TODO: Implement setRouter() method.
    }


}