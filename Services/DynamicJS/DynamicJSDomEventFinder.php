<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/30/13
 * Time: 12:37 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvent;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvents;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSDomEventFinder;
use Cympel\Bundle\AnalyticsBundle\Services\CympelFinder;

class DynamicJSDomEventFinder extends CympelFinder implements iDynamicJSDomEventFinder
{
    /**
     * @param iDynamicJSDomEvents $domEvents
     * @param $eventName
     * @param $classAlias
     * @return iDynamicJSDomEvent
     */
    public function findOneEventByEventsAndEventName(iDynamicJSDomEvents $domEvents, $eventName, $classAlias)
    {
        $findable = $this->creator->create($classAlias);
        $repository = $this->doctrine->getRepository($findable->getRepositoryName(), $findable->getEntityManagerName());
        $found = $repository->findOneBy(array(
            'parentDynamicJDomEvents' => $domEvents,
            'eventName' => $eventName,
        ));
        return $found;
    }

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSDomEventFinder';
    }
}