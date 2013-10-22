<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 3:09 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicCSSDomIdManagerCreateTest extends ContainerAwareUnitTestCase
{
    public function testCreate()
    {
        $dcdim = $this->get('cympel_analytics.dynamic_css_dom_id_manager');
        $dcssdi = $dcdim->create();
        $this->assertEquals('DynamicCSSDomId', $dcssdi->getType());
    }
}