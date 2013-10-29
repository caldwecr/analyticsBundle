<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/29/13
 * Time: 2:14 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Services\DynamicJSSelectorManager;
use Cympel\Bundle\AnalyticsBundle\Services\TrackingToolManagerExtensionService;

class DynamicJSServiceExtension extends TrackingToolManagerExtensionService
{
    /**
     * @var DynamicJSSelectorsManager
     */
    protected $dynamicJsSelectorsManager;

    /**
     * @var DynamicJSSelectorManager
     */
    protected $dynamicJsSelectorManager;

    /**
     * @param DynamicJSSelectorsManager $dynamicJsSelectorsManager
     * @param DynamicJSSelectorManager $dynamicJsSelectorManager
     */
    public function __construct(DynamicJSSelectorsManager $dynamicJsSelectorsManager, DynamicJSSelectorManager $dynamicJsSelectorManager)
    {
        $this->dynamicJsSelectorsManager = $dynamicJsSelectorsManager;
        $this->dynamicJsSelectorManager = $dynamicJsSelectorManager;
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
     * @return DynamicJSSelectorsManager
     */
    public function getDynamicJSSelectorsManager() {
        return $this->dynamicJsSelectorsManager;
    }

    /**
     * @return DynamicJSSelectorManager
     */
    public function getDynamicJSSelectorManager()
    {
        return $this->dynamicJsSelectorManager;
    }
}