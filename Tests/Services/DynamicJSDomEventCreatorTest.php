<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 7:47 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicJSDomEventCreatorTest extends ContainerAwareUnitTestCase
{
    public function testCreate()
    {
        $creator = $this->get('cympel_analytics.dynamic_js_dom_event.creator');
        $dynamicJSDomEvent = $creator->create();
        $this->assertEquals('DynamicJSDomEvent', $dynamicJSDomEvent->getType());
    }
}