<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 1:46 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iFindable;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iPropertySet;
use Cympel\Bundle\AnalyticsBundle\Entity\iType;

interface iTrackingToolManager extends iType, iValidate, iPersist, iFind, iRemove, iCreate
{
    /**
     * @param iTrackingTool $tool
     * @param iPropertySet $properties
     * @return iTrackingTool
     */
    public function setProperties(iTrackingTool $tool, iPropertySet $properties);

    /**
     * @param iTrackingTool $tool
     * @return iPropertySet
     *
     * This method must return all bindings on the tracking tool
     */
    public function getProperties(iTrackingTool $tool);

    /**
     * @param string $classAlias
     * @param iTracker $tracker
     * @return iTrackingTool
     */
    public function createTrackingTool($classAlias, iTracker $tracker);

    /**
     * @return iTrackerManager
     */
    public function getTrackerManager();
}