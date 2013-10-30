<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/30/13
 * Time: 12:33 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\iServices;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvents;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvent;

/**
 * Interface iDynamicJSDomEventFinder
 * @package Cympel\Bundle\AnalyticsBundle\Services\iServices
 */
interface iDynamicJSDomEventFinder extends iFinder
{
    /**
     * @param iDynamicJSDomEvents $domEvents
     * @param $eventName
     * @param $classAlias
     * @return iDynamicJSDomEvent
     */
    public function findOneEventByEventsAndEventName(iDynamicJSDomEvents $domEvents, $eventName, $classAlias);
}