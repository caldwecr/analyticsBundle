<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 1:46 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iTrackingTool;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iPropertySet;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iType;
use Cympel\Bundle\ToolsBundle\Entity\iEntity\iNamespace;

interface iTrackingToolManager extends iType, iValidate, iPersist, iFind, iRemove, iCreate, iHaveNamespacer
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
     * @param $classAlias
     * @param iTracker $tracker
     * @param string $namespaceName
     * @return iTrackingTool
     */
    public function createTrackingTool($classAlias, iTracker $tracker, $namespaceName = '_blank');

    /**
     * @return iTrackerManager
     */
    public function getTrackerManager();
}