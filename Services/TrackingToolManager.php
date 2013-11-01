<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 12:01 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iFindable;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolManager;
use Cympel\Bundle\AnalyticsBundle\Entity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Entity\Exception\InvalidTrackingToolException;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iPropertySet;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolValidator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iTrackingToolRemover;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iCreator;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iFinder;

abstract class TrackingToolManager extends CympelManager implements iTrackingToolManager
{
    /**
     * @return TrackerManager
     */
    abstract protected function getTrackerManager();

    /**
     * @param TrackerManager $trackerManager
     * @return void
     */
    abstract protected function setTrackerManager(TrackerManager $trackerManager);


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