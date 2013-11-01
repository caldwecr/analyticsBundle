<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/29/13
 * Time: 2:44 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvent;
use Cympel\Bundle\AnalyticsBundle\Entity\iEntity\iDynamicJSDomEvents;
use Cympel\Bundle\AnalyticsBundle\Services\CympelManager;
use Cympel\Bundle\AnalyticsBundle\Services\iServices\iDynamicJSDomEventsManager;
use Doctrine\Common\Collections\ArrayCollection;

class DynamicJSDomEventsManager extends CympelManager implements iDynamicJSDomEventsManager
{

    /**
     * @return string
     * This method must return a string with a unique representation of the object type that is implementing this interface
     */
    public function getType()
    {
        return 'DynamicJSDomEventsManager';
    }

    /**
     * @param array $eventsArray
     * @return iDynamicJSDomEvents
     */
    public function createFromArray($eventsArray)
    {
        $events = $this->creator->create('DynamicJSDomEvents');
        $eventsCollection = new ArrayCollection();
        foreach($eventsArray as $key => $value) {
            $eventsCollection[$key] = $this->creator->create('DynamicJSDomEvent');
            self::configEvent($eventsCollection[$key], $value, $events);
        }
        self::typedSetEvents($events, $eventsCollection);
        return $events;
    }

    private static function configEvent(iDynamicJSDomEvent &$event, $eventName, $parentEvents)
    {
        $event->setEventName($eventName);
        $event->setParentDynamicJDomEvents($parentEvents);
    }

    private static function typedSetEvents(iDynamicJSDomEvents &$events, ArrayCollection $eventsCollection)
    {
        $events->setEvents($eventsCollection);
    }
}