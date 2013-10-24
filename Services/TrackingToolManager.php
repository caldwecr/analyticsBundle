<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 12:01 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingToolManager;
use Cympel\Bundle\AnalyticsBundle\Entity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;

abstract class TrackingToolManager implements iTrackingToolManager
{
    /**
     * @var TrackerManager
     */
    protected $trackerManager;

    /**
     * @param iTracker $tracker
     * @return iTrackingTool
     *
     * This method creates a brand new tracking tool that is a child to the first argument
     */
    public final function create(iTracker $tracker)
    {
        $tt = $this->createTrackingTool($tracker);

        $tt->setTracker($tracker);
        $this->trackerManager->addTrackingTool($tracker, $tt);
        return $tt;
    }

    /**
     * @return iTrackingTool
     */
    abstract protected function createTrackingTool();
}