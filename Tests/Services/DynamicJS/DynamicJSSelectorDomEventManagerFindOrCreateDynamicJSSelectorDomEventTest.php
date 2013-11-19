<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/4/13
 * Time: 11:05 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Services\Exception\UnpersistedFindByException;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicJSSelectorDomEventManagerFindOrCreateDynamicJSSelectorDomEventTest extends ContainerAwareUnitTestCase
{
    public function testFindOrCreate()
    {
        $manager = $this->get('ca.djs.sde.manager');

        $creator = $this->get('cympel_analytics.generics.creator');
        $persister = $this->get('cympel_analytics.generics.persister');
        $finder = $this->get('ca.djs.sde.finder');

        $selector = $creator->create('DynamicJSSelector');
        $selector->setSelection('#foobared');
        $domEvent = $creator->create('DynamicJSDomEvent');
        $dataSets = $creator->create('DynamicJSSelectorDomEventClientDataSets');
        // As neither the selector nor the domEvent have been persisted this call should throw an UnpersistedFindByException
        $e = null;
        try {
            $dynamicJSSelectorDomEvent = $manager->findOrCreateDynamicJSSelectorDomEvent($selector, $domEvent, 'DynamicJSSelectorDomEvent');
        } catch (UnpersistedFindByException $e) {

        }
        $this->assertNotNull($e);

        $dynamicJSSelectorDomEvent = $creator->create('DynamicJSSelectorDomEvent');

        $dynamicJSSelectorDomEvent->setClientDataSets($dataSets);
        $dynamicJSSelectorDomEvent->setSelector($selector);
        $dynamicJSSelectorDomEvent->setDomEvent($domEvent);
        // Selector and DomEvent are not setup to receive cascaded persist operations from DynamicJSSelectorDomEvent objects
        $persister->persist($selector);
        $persister->persist($domEvent);

        // As the dynamicJSSelectorDomEvent has not been persisted the find below should return a brand new DynamicJSSelectorDomEvent with no id but with the selector and domEvent
        //  already set
        $dynamicJSSelectorDomEvent2 = $manager->findOrCreateDynamicJSSelectorDomEvent($selector, $domEvent, 'DynamicJSSelectorDomEvent');
        $this->assertNotNull($dynamicJSSelectorDomEvent2);
        $this->assertNull($dynamicJSSelectorDomEvent2->getId());
        $this->assertEquals($dynamicJSSelectorDomEvent->getSelector()->getId(), $dynamicJSSelectorDomEvent2->getSelector()->getId());
        $this->assertEquals($dynamicJSSelectorDomEvent->getDomEvent()->getId(), $dynamicJSSelectorDomEvent2->getDomEvent()->getId());

        $persister->persist($dynamicJSSelectorDomEvent);
        // Now a valid DynamicJSSelectorDomEvent object should be found
        $dynamicJSSelectorDomEvent3 = $manager->findOrCreateDynamicJSSelectorDomEvent($selector, $domEvent, 'DynamicJSSelectorDomEvent');
        $this->assertNotNull($dynamicJSSelectorDomEvent3);
        $this->assertEquals('DynamicJSSelectorDomEvent', $dynamicJSSelectorDomEvent3->getType());
        $this->assertNotNull($dynamicJSSelectorDomEvent3->getId());

    }
}