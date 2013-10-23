<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 1:43 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

interface iTrackingTool extends iType
{
    /**
     * @param iTracker $tracker
     * @return bool
     */
    public function setTracker(iTracker $tracker);

    /**
     * @return iTracker
     */
    public function getTracker();

    /**
     * @param iTrackingTool $rightSide
     * @return bool
     */
    public function equals(iTrackingTool $rightSide);
}