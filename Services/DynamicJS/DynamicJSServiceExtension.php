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
use Cympel\Bundle\AnalyticsBundle\Services\TrackingToolManagerExtensionService;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSDomEventsManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iRouter;

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
     * @var iRouter
     */
    protected $router;

    /**
     * @var iTrackerManager
     */
    protected $trackerManager;


    /**
     * @param iDynamicJSSelectorsManager $dynamicJSelectorsManager
     * @param iDynamicJSDomEventsManager $dynamicJDomEventsManager
     * @param iRouter $router
     * @param iTrackerManager $trackerManager
     */
    public function __construct(iDynamicJSSelectorsManager $dynamicJSelectorsManager, iDynamicJSDomEventsManager $dynamicJDomEventsManager, iRouter $router, iTrackerManager $trackerManager)
    {
        $this->dynamicJSelectorsManager = $dynamicJSelectorsManager;
        $this->dynamicJDomEventsManager = $dynamicJDomEventsManager;
        $this->router = $router;
        $this->trackerManager = $trackerManager;
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
     * @return \Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackerManager
     */
    public function getTrackerManager()
    {
        return $this->trackerManager;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Services\iServices\iRouter
     */
    public function getRouter()
    {
        return $this->router;
    }
}