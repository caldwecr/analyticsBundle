<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/29/13
 * Time: 9:37 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicJSSelectorDomEventManager extends ContainerAwareUnitTestCase
{
    public function testCreate()
    {
        $manager = $this->get('cympel_analytics.dynamic_js_selector_dom_event.manager');
        $selectorDomEvent = $manager->getCreator()->create('DynamicJSSelectorDomEvent');
        $this->assertEquals('DynamicJSSelectorDomEvent', $selectorDomEvent->getType());
    }
}