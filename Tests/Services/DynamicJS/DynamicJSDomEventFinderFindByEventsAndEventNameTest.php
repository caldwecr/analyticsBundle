<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/30/13
 * Time: 12:59 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJS;
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSDomEvent;
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSDomEvents;
use Cympel\Bundle\AnalyticsBundle\Entity\Tracker;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;
use Doctrine\Common\Collections\ArrayCollection;

class DynamicJSDomEventFinderFindByEventsAndEventNameTest extends ContainerAwareUnitTestCase
{
    public function testFind()
    {
        $eventName = 'click';
        $classAlias = 'DynamicJSDomEvent';

        $finder = $this->get('ca.djs.dom_event.finder');
        $persister = $this->get('ca.generics.persister');
        $events = new DynamicJSDomEvents();
        $dynamicJ = new DynamicJS();
        $dynamicJ->setEvents($events);
        $dynamicJ->setRendered(0);
        $dynamicJ->setEntityManagerName('cympelanalytics');
        $dynamicJ->setRepositoryName('CympelAnalyticsBundle:DynamicJS');
        $t = new Tracker();
        $dynamicJ->setTracker($t);
        $events->setDynamicJ($dynamicJ);
        $events->setRepositoryName('CympelAnalyticsBundle:DynamicJSDomEvents');
        $events->setEntityManagerName('cympelanalytics');
        $event = new DynamicJSDomEvent();
        $event->setEntityManagerName('cympelanalytics');
        $event->setRepositoryName('CympelAnalyticsBundle:DynamicJSDomEvent');
        $event->setEventName($eventName);
        $event->setParentDynamicJDomEvents($events);
        $events->setEvents(new ArrayCollection(array($event)));

        // now persist events ...
        $persister->persist($events);

        // Now try to retrieve the event using the findOneEventByEventsAndEventName method

        $event2 = $finder->findOneEventByEventsAndEventName($events, $eventName, $classAlias);

        $this->assertTrue($event->equals($event2));
    }
}