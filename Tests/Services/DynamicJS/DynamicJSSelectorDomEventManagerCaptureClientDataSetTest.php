<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/4/13
 * Time: 12:39 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicJSSelectorDomEventManagerCaptureClientDataSetTest extends ContainerAwareUnitTestCase
{
    public function testFindOrCreate()
    {
        $manager = $this->get('cympel_analytics.dynamic_js_selector_dom_event.manager');

        $creator = $this->get('cympel_analytics.generics.creator');
        $persister = $this->get('cympel_analytics.generics.persister');
        //$finder = $this->get('cympel_analytics.dynamic_js_selector_dom_event.finder');

        $selector = $creator->create('DynamicJSSelector');
        $selector->setSelection('#foobared');
        $domEvent = $creator->create('DynamicJSDomEvent');

        // Selector and DomEvent are not setup to receive cascaded persist operations from DynamicJSSelectorDomEvent objects
        $persister->persist($selector);
        $persister->persist($domEvent);

        $encodeMe = array(
            'clientX' => 50,
            'clientY' => 25,
            'classList' => null,
            'id' => 'number_three',
            'outerHTML' => '<div>somefoo</div>',
            'eventType' => 'click'
        );
        $json = json_encode($encodeMe);
        $dynamicJSSelectorDomEvent = $manager->captureClientDataSet($selector, $domEvent, $json, 'DynamicJSSelectorDomEvent');
        $this->assertNotNull($dynamicJSSelectorDomEvent);
        $this->assertNotNull($dynamicJSSelectorDomEvent->getId());
    }
}