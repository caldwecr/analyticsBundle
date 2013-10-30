<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/29/13
 * Time: 4:34 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJS;
use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSDomEvent;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;
use Doctrine\Common\Collections\ArrayCollection;

class DynamicJSDomEventManagerCreatePersistFindDeleteTest extends ContainerAwareUnitTestCase
{
    public function testCreatePersistFindDelete()
    {
        $eventsManager = $this->get('cympel_analytics.dynamic_js_dom_events.manager');
        $events = $eventsManager->getCreator()->create('DynamicJSDomEvents');

        // Add two events
            $event1 = new DynamicJSDomEvent();
            $event1->setEntityManagerName('cympelanalytics');
            $event1->setRepositoryName('CympelAnalyticsBundle:DynamicJSDomEvent');
            $event1->setEventName('TestCPFD1');
            $event1->setParentDynamicJDomEvents($events);

            $event2 = new DynamicJSDomEvent();
            $event2->setEntityManagerName('cympelanalytics');
            $event2->setRepositoryName('CympelAnalyticsBundle:DynamicJSDomEvent');
            $event2->setEventName('TestCPFD2');
            $event2->setParentDynamicJDomEvents($events);

        $events->setEvents(new ArrayCollection(array($event1, $event2)));

        $events->setEntityManagerName('cympelanalytics');
        $events->setRepositoryName('CympelAnalyticsBundle:DynamicJSDomEvents');

        $dj = new DynamicJS();
        $dj->setRepositoryName('CympelAnalyticsBundle:DynamicJS');
        $dj->setEntityManagerName('cympelanalytics');
        $dj->setEvents($events);
        $dj->setRendered(0);
        $events->setDynamicJ($dj);

        //Validate that the event1 and event2 object have null id's
        $this->assertNull($event1->getId());
        $this->assertNull($event2->getId());

        //Validate that the $dj entity has a null id
        $this->assertNull($dj->getId());

        $persister = $eventsManager->getPersister();
        $persister->persist($events);

        $id = $events->getId();
        //Validate persistence of the $events object
        $finder = $eventsManager->getFinder();
        //Validate events can be found in the database
        $events2 = $finder->findOneByIdAndClassAlias($id, 'DynamicJSDomEvents');
        $this->assertTrue($events->equals($events2));
        //Validate persistence of the $event1 and $event2 objects
        $this->assertNotNull($event1->getId());
        $this->assertNotNull($event2->getId());
        //Validate persistence of the $jd entity
        $this->assertNotNull($dj->getId());
        //Capture event1 and event2 object ids
        $event1Id = $event1->getId();
        $event2Id = $event2->getId();


        $remover = $eventsManager->getRemover();
        $remover->remove($events);
        // Validate $events cannot be found in the database
        $events3 = $finder->findOneByIdAndClassAlias($id, 'DynamicJSDomEvents');
        $this->assertNull($events3);
        // Validate that event1 and event2 were removed via a cascaded remove
        $eventRepository = $this->get('doctrine')->getRepository('CympelAnalyticsBundle:DynamicJSDomEvent', 'cympelanalytics');
        $event3 = $eventRepository->findOneById($event1Id);
        $event4 = $eventRepository->findOneById($event2Id);
        $this->assertNull($event3);
        $this->assertNull($event4);
    }
}