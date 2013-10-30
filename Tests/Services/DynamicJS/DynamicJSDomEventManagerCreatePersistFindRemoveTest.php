<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/29/13
 * Time: 4:10 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Entity\DynamicJSDomEvents;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;
use Doctrine\Common\Collections\ArrayCollection;

class DynamicJSDomEventManagerCreatePersistFindRemoveTest extends ContainerAwareUnitTestCase
{
    public function testCreatePersistFindRemove()
    {
        // setup
        $domEvents = new DynamicJSDomEvents();
        $domEvents->setEntityManagerName('cympelanalytics');
        $domEvents->setRepositoryName('CympelAnalyticsBundle:DynamicJSDomEvents');



        $djm = $this->get('cympel_analytics.dynamic_js_dom_event.manager');
        $djEvent = $djm->getCreator()->create('DynamicJSDomEvent');
        $djEvent->setEventName('DynamicCPFRTest');

        $domEvents->setEvents(new ArrayCollection(array($djEvent)));
        $djEvent->setParentDynamicJDomEvents($domEvents);
        $persister = $djm->getPersister();

        $persister->persist($djEvent);

        $id = $djEvent->getId();

        $this->assertGreaterThan(0, $id);
        //This next assertion validates that persist operations are cascading from the DynamicJSDomEvent to its parent DynamicJSDomEvents
        $parentId = $djEvent->getParentDynamicJDomEvents()->getId();
        $this->assertNotNull($parentId);

        $finder = $djm->getFinder();

        $djEvent2 = $finder->findOneByIdAndClassAlias($id, 'DynamicJSDomEvent');

        $this->assertTrue($djEvent->equals($djEvent2));

        $remover = $djm->getRemover();
        $remover->remove($djEvent);

        $djEvent3 = $finder->findOneByIdAndClassAlias($id, 'DynamicJSDomEvent');
        // This next assertion validates that the record was deleted from the database
        $this->assertNull($djEvent3);

        $eventsRepository = $this->get('doctrine')->getRepository('CympelAnalyticsBundle:DynamicJSDomEvents', 'cympelanalytics');
        $parent = $eventsRepository->findOneById($parentId);
        //This next assertion verifies that removal is not cascaded upwards to the parent Events
        $this->assertNotNull($parent);
    }
}