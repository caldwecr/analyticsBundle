<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 2:47 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Entity\iEntity;

interface iDynamicJSDomEvent extends iDomEvent, iPersistable, iCreatable, iRemovable, iFindable, iValidatable
{
    /**
     * @param string $eventName
     * @return void
     */
    public function setEventName($eventName);

    /**
     * @param iDynamicJSDomEvents $parentDynamicJDomEvents
     * @return void
     */
    public function setParentDynamicJDomEvents(iDynamicJSDomEvents $parentDynamicJDomEvents);
}