<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/29/13
 * Time: 3:41 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicJSServiceExtensionConfigTest extends ContainerAwareUnitTestCase
{
    public function testConfig()
    {
        $se = $this->get('ca.djs.extender');
        $this->assertEquals('DynamicJSServiceExtension', $se->getType());
        $selectorsManager = $se->getDynamicJSelectorsManager();
        $this->assertEquals('DynamicJSSelectorsManager', $selectorsManager->getType());
        $eventsManager = $se->getDynamicJDomEventsManager();
        $this->assertEquals('DynamicJSDomEventsManager', $eventsManager->getType());

    }
}