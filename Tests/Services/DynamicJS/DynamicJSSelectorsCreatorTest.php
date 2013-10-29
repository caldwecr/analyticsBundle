<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 1:41 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services\DynamicJS;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicJSSelectorsCreatorTest extends ContainerAwareUnitTestCase
{
    public function testCreate()
    {
        $creator = $this->get('cympel_analytics.generics.creator');
        $dynamicJSSelectors = $creator->create('DynamicJSSelectors');

        $this->assertEquals('DynamicJSSelectors', $dynamicJSSelectors->getType());
    }
}