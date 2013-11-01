<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/29/13
 * Time: 2:14 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorsManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackerManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolValidator;
use Cympel\Bundle\AnalyticsBundle\Services\TrackingToolManagerExtensionService;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSDomEventsManager;

class DynamicJSServiceExtension extends TrackingToolManagerExtensionService
{
    /**
     * @var iDynamicJSSelectorsManager
     */
    protected $dynamicJSelectorsManager;

    /**
     * @var iDynamicJSDomEventsManager
     */
    protected $dynamicJDomEventsManager;

    /**
     * @var Object - the doctrine service
     */
    protected $doctrine;

    /**
     * @var iTrackingToolValidator
     */
    protected $trackingToolValidator;

    /**
     * @var Object - the router service
     */
    protected $router;

    /**
     * @var iTrackerManager
     */
    protected $trackerManager;

    /**
     * @var string
     */
    protected $entityManagerName;

    /**
     * @param iDynamicJSSelectorsManager $dynamicJSelectorsManager
     * @param iDynamicJSDomEventsManager $dynamicJDomEventsManager
     * @param $doctrine
     * @param iTrackingToolValidator $trackingToolValidator
     * @param $router
     * @param iTrackerManager $trackerManager
     * @param $entityManagerName
     */
    public function __construct(iDynamicJSSelectorsManager $dynamicJSelectorsManager, iDynamicJSDomEventsManager $dynamicJDomEventsManager, $doctrine, iTrackingToolValidator $trackingToolValidator, $router, iTrackerManager $trackerManager, $entityManagerName)
    {
        $this->dynamicJSelectorsManager = $dynamicJSelectorsManager;
        $this->dynamicJDomEventsManager = $dynamicJDomEventsManager;
        $this->doctrine = $doctrine;
        $this->trackingToolValidator = $trackingToolValidator;
        $this->router = $router;
        $this->trackerManager = $trackerManager;
        $this->entityManagerName = $entityManagerName;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSServiceExtension';
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSDomEventsManager
     */
    public function getDynamicJDomEventsManager()
    {
        return $this->dynamicJDomEventsManager;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSSelectorsManager
     */
    public function getDynamicJSelectorsManager()
    {
        return $this->dynamicJSelectorsManager;
    }

    /**
     * @return Object
     */
    public function getDoctrine()
    {
        return $this->doctrine;
    }

    /**
     * @return string
     */
    public function getEntityManagerName()
    {
        return $this->entityManagerName;
    }

    /**
     * @return Object
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackerManager
     */
    public function getTrackerManager()
    {
        return $this->trackerManager;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolValidator
     */
    public function getTrackingToolValidator()
    {
        return $this->trackingToolValidator;
    }


}