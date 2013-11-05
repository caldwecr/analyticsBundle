<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 1:43 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iPersistable;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iTracker;

interface iTrackingTool extends iType, iPersistable
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
     * @return bool
     *
     * This method must return true if the tool has validation constraints that should be checked, otherwise false
     */
    public function hasValidationConstraints();

    /**
     * @return mixed
     */
    public function getId();
}