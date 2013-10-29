<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/29/13
 * Time: 3:24 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicJSDomEventManagerCreateTest extends ContainerAwareUnitTestCase
{
    public function testCreate()
    {
        $djm = $this->get('cympel_analytics.dynamic_js_dom_event.manager');
        $djEvent = $djm->getCreator()->create('DynamicJSDomEvent');
        $this->assertEquals('DynamicJSDomEvent', $djEvent->getType());
    }
}