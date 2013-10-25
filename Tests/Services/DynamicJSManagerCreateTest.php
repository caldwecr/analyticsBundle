<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/25/13
 * Time: 10:01 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicJSManagerCreateTest extends ContainerAwareUnitTestCase
{
    public function testCreate()
    {
        $djm = $this->get('cympel_analytics.dynamic_js_manager');
        $dj = $djm->create();
        $this->assertEquals('DynamicJS', $dj->getType());
    }
}