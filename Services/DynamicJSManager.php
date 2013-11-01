<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 11:52 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSPropertySet;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iPropertySet;
use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJS;
use Cympel\Bundle\AnalyticsBundle\Entity\iTracker;

class DynamicJSManager extends RoutedTrackingToolManager
{
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
     * @param $classAlias
     * @param $selectors
     * @param $events
     * @param iTracker $tracker
     * @return string
     */
    public function generateOneTimeJavascript($classAlias, $selectors, $events, iTracker $tracker=null)
    {
        if(!$tracker) $tracker = $this->trackerManager->create();
        $properties = new DynamicJSPropertySet();
        // @todo implement and test the createFromArray method
        $properties->setEvents($this->extender->getDynamicJDomEventsManager()->createFromArray($events));
        // @todo create tests for this createFromArray method
        $properties->setDynamicJSelectors($this->extender->getDynamicJSelectorsManager()->createFromArray($selectors));
        $properties->setRendered(0);
        $properties->setTracker($tracker);
        return $this->generate($classAlias, $properties, $tracker);
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
    protected function finalizeProperties(iPropertySet $properties, iTrackingTool $tool)
    {
        return $properties;
    }


    /**
     * @return string
     */
    protected function getRouteName()
    {
        return 'dynamicJS';
    }

    /**
     * @param iTrackingTool $tool
     * @return array
     */
    protected function getRoutingArray(iTrackingTool $tool)
    {
        return array(
            'key' => $tool->getId(),
        );
    }

    public function getDynamicJSelectors(DynamicJS $dynamicJS)
    {
        return $dynamicJS->getDynamicJSelectors()->toArray();
    }

    public function getDynamicJDomEvents(DynamicJS $dynamicJS)
    {
        return $dynamicJS->getEvents()->toArray();
    }
}