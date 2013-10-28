<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 1:41 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services\DynamicJSSelectors;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicJSSelectorsCreatorTest extends ContainerAwareUnitTestCase
{
    public function testCreate()
    {
        $creator = $this->get('cympel_analytics.dynamic_js_selectors.creator');
        $dynamicJSSelectors = $creator->create();

        $this->assertEquals('DynamicJSSelectors', $dynamicJSSelectors->getType());
    }
}