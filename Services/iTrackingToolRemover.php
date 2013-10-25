<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/25/13
 * Time: 11:46 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\iTracker;
use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;

interface iTrackingToolRemover extends iType
{
    /**
     * @param iTracker $tracker
     */
    public function removeToolsFromTracker(iTracker $tracker);

    /**
     * @param iTrackingTool $tool
     * @param bool $doFlush
     * @return void
     */
    public function remove(iTrackingTool $tool, $doFlush = true);
}