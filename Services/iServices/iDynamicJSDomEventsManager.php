<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/29/13
 * Time: 2:42 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvents;

interface iDynamicJSDomEventsManager extends iCreate, iFind, iPersist, iRemove
{
    /**
     * @param array $eventsArray
     * @return iDynamicJSDomEvents
     */
    public function createFromArray($eventsArray);
}