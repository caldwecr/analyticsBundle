<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/25/13
 * Time: 11:25 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iType;
use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;

interface iTrackingToolValidator extends iType
{
    /**
     * @param iTrackingTool $tool
     * @return bool
     */
    public function validate(iTrackingTool $tool);
}