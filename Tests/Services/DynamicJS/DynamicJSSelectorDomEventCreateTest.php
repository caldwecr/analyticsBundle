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

class DynamicJSSelectorDomEventCreateTest extends ContainerAwareUnitTestCase
{
    public function testCreate()
    {
        $manager = $this->get('cympel_analytics.generics.manager');
        $selectorDomEvent = $manager->getCreator()->create('DynamicJSSelectorDomEvent');
        $this->assertEquals('DynamicJSSelectorDomEvent', $selectorDomEvent->getType());
    }
}