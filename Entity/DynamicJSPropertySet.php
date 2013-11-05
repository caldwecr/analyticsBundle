<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 12:26 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvents;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSSelectors;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iPropertySet;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iTracker;

class DynamicJSPropertySet extends CympelType implements iPropertySet
{
    /**
     * @var iTracker
     */
    protected $tracker;

    /**
     * @var int
     */
    protected $rendered;

    /**
     * @var DynamicJSSelectors
     */
    protected $dynamicJSelectors;

    /**
     * @var DynamicJSDomEvents
     */
    protected $events;

    /**
     * @param iTrackingTool $tool
     * @return iTrackingTool
     */
    public function pushTo(iTrackingTool $tool)
    {
        return $this->pushToDynamicJS($tool);
    }

    /**
     * @param DynamicJS $tool
     * @return DynamicJS
     */
    private function pushToDynamicJS(DynamicJS $tool)
    {
        $tool->setTracker($this->tracker);
        $tool->setRendered($this->rendered);
        $tool->setDynamicJSelectors($this->dynamicJSelectors);
        $this->dynamicJSelectors->setDynamicJ($tool);
        $tool->setEvents($this->events);
        $this->events->setDynamicJ($tool);
        return $tool;
    }

    /**
     * @param iTrackingTool $tool
     * @return iPropertySet
     */
    public function pullFrom(iTrackingTool $tool)
    {
        return $this->pullFromDynamicJS($tool);
    }

    /**
     * @param DynamicJS $tool
     * @return DynamicJSPropertySet $this
     */
    private function pullFromDynamicJS(DynamicJS $tool)
    {
        $this->tracker = $tool->getTracker();
        $this->rendered = $tool->getRendered();
        $this->dynamicJSelectors = $tool->getDynamicJSelectors();
        $this->events = $tool->getEvents();
        return $this;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSPropertySet';
    }

    /**
     * @param iType $rightSide
     * @return bool
     *
     * Note that the object type passed into this method will always match the class type where this method is implemented.
     */
    protected function typedEquals(iType $rightSide)
    {
        self::areEqual($this, $rightSide);
    }

    /**
     * @param iDynamicJSSelectors $dynamicJSelectors
     */
    public function setDynamicJSelectors(iDynamicJSSelectors $dynamicJSelectors)
    {
        $this->dynamicJSelectors = $dynamicJSelectors;
    }

    /**
     * @return DynamicJSSelectors
     */
    public function getDynamicJSelectors()
    {
        return $this->dynamicJSelectors;
    }

    /**
     * @param iDynamicJSDomEvents $events
     */
    public function setEvents(iDynamicJSDomEvents $events)
    {
        $this->events = $events;
    }

    /**
     * @return DynamicJSDomEvents
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param int $rendered
     */
    public function setRendered($rendered)
    {
        $this->rendered = $rendered;
    }

    /**
     * @return int
     */
    public function getRendered()
    {
        return $this->rendered;
    }

    /**
     * @param \Cympel\Bundle\AnalyticsBundle\Entity\Tracker $tracker
     */
    public function setTracker($tracker)
    {
        $this->tracker = $tracker;
    }

    /**
     * @return \Cympel\Bundle\AnalyticsBundle\Entity\Tracker
     */
    public function getTracker()
    {
        return $this->tracker;
    }

}