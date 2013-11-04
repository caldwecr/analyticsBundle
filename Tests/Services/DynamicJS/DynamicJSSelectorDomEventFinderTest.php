<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/4/13
 * Time: 10:25 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicJSSelectorDomEventFinderTest extends ContainerAwareUnitTestCase
{
    public function testFind()
    {


        $creator = $this->get('cympel_analytics.generics.creator');
        $persister = $this->get('cympel_analytics.generics.persister');
        $finder = $this->get('cympel_analytics.dynamic_js_selector_dom_event.finder');

        $selector = $creator->create('DynamicJSSelector');
        $selector->setSelection('#foobared');
        $domEvent = $creator->create('DynamicJSDomEvent');
        $dataSets = $creator->create('DynamicJSSelectorDomEventClientDataSets');

        $dynamicJSSelectorDomEvent = $creator->create('DynamicJSSelectorDomEvent');

        $dynamicJSSelectorDomEvent->setClientDataSets($dataSets);
        $dynamicJSSelectorDomEvent->setSelector($selector);
        $dynamicJSSelectorDomEvent->setDomEvent($domEvent);
        // Selector and DomEvent are not setup to receive cascaded persist operations from DynamicJSSelectorDomEvent objects
        $persister->persist($selector);
        $persister->persist($domEvent);
        $persister->persist($dynamicJSSelectorDomEvent);

        $dynamicJSSelectorDomEvent2 = $finder->findOneBySelectorAndDomEvent($selector, $domEvent, 'DynamicJSSelectorDomEvent');
        $this->assertNotNull($dynamicJSSelectorDomEvent2);
    }
}