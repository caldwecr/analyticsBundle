<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 4:31 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

use Cympel\Bundle\AnalyticsBundle\Entity\iTrackingTool;

interface iPropertySet extends iType
{
    /**
     * @param iTrackingTool $tool
     * @return iTrackingTool
     */
    public function pushTo(iTrackingTool $tool);

    /**
     * @param iTrackingTool $tool
     * @return iPropertySet
     */
    public function pullFrom(iTrackingTool $tool);

}