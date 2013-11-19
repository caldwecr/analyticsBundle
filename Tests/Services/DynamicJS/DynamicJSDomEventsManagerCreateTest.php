<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/29/13
 * Time: 3:34 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicJSDomEventsManagerCreateTest extends ContainerAwareUnitTestCase
{
    public function testCreate()
    {
        $djm = $this->get('ca.djs.dom_events.manager');
        $djEvents = $djm->getCreator()->create('DynamicJSDomEvents');
        $this->assertEquals('DynamicJSDomEvents', $djEvents->getType());
    }
}