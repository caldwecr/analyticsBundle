<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 2:41 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Entity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Entity\iType;

class TrackerManager implements iType
{

    /**
     * @param iTracker $tracker
     * @param iTrackingTool $tool
     * @return bool
     */
    public function addTrackingTool(iTracker $tracker, iTrackingTool $tool)
    {
        $tools = $tracker->getTrackingTools();
        $tools->add($tool);
        $tracker->setTrackingTools($tools);
        return true;
    }
    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'TrackerManager';
    }

}