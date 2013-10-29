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
     * @param iDynamicJSSelectorsManager $dynamicJSelectorsManager
     * @param iDynamicJSDomEventsManager $dynamicJDomEventsManager
     */
    public function __construct(iDynamicJSSelectorsManager $dynamicJSelectorsManager, iDynamicJSDomEventsManager $dynamicJDomEventsManager)
    {
        $this->dynamicJSelectorsManager = $dynamicJSelectorsManager;
        $this->dynamicJDomEventsManager = $dynamicJDomEventsManager;
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


}