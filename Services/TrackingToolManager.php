<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 12:01 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolManager;
use Cympel\Bundle\AnalyticsBundle\Entity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iPropertySet;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackerManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolManagerExtensionService;

abstract class TrackingToolManager extends CympelManager implements iTrackingToolManager
{
    /**
     * @var iTrackerManager
     */
    protected $trackerManager;
    /**
     * @return TrackerManager
     */
    protected function getTrackerManager()
    {
        $e = $this->getExtender();
        return self::getTrackerManagerCheckingExtenderType($e);
    }

    /**
     * @param iTrackingToolManagerExtensionService $extender
     * @return iTrackerManager
     */
    protected static final function getTrackerManagerCheckingExtenderType(iTrackingToolManagerExtensionService $extender)
    {
        return $extender->getTrackerManager();
    }



    /**
     * @param iTracker $tracker
     * @param iTrackingTool $tool
     * @return iTrackingTool
     */
    protected final function attachTracker(iTracker $tracker, iTrackingTool $tool)
    {
        $tool->setTracker($tracker);
        $this->getTrackerManager()->addTrackingTool($tracker, $tool);
        return $tool;
    }

    /**
     * @param iTrackingTool $tool
     * @param iPropertySet $properties
     * @return iTrackingTool
     */
    public function setProperties(iTrackingTool $tool, iPropertySet $properties)
    {
        return $properties->pushTo($tool);
    }

    /**
     * @param iTrackingTool $tool
     * @return iPropertySet
     *
     * This method must return all bindings on the tracking tool
     */
    public function getProperties(iTrackingTool $tool)
    {
        $p = $this->createPropertySet();
        return $p->pullFrom($tool);
    }

    /**
     * @return iPropertySet
     */
    abstract protected function createPropertySet();

    /**
     * @param string $classAlias
     * @param iTracker $tracker
     * @return iTrackingTool
     */
    public function createTrackingTool($classAlias, iTracker $tracker)
    {
        if(!$tracker) {
            $tracker = $this->getTrackerManager()->create();
        }
        $tt = $this->getCreator()->create($classAlias);
        return $this->attachTracker($tracker, $tt);
    }
}