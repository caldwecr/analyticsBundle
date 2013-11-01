<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 1:14 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

interface iTrackingToolManagerExtensionService extends iExtender
{
    /**
     * @return iTrackerManager
     */
    public function getTrackerManager();
}