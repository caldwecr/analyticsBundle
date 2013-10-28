<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/28/13
 * Time: 10:45 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicJSSelectorCreatorTest extends ContainerAwareUnitTestCase
{
    public function testCreate()
    {
        $djsc = $this->get('cympel_analytics.dynamic_js_selector_creator');
        $djss = $djsc->create();
        $this->assertEquals('DynamicJSSelector', $djss->getType());
    }
}