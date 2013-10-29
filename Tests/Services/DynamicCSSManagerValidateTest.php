<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 3:26 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;
use Cympel\Bundle\AnalyticsBundle\Entity\Tracker;

class DynamicCSSManagerValidateTest extends ContainerAwareUnitTestCase
{
    public function testValidate()
    {
        $t = new Tracker();
        $dcm = $this->get('cympel_analytics.dynamic_css_manager');
        $dcss = $dcm->create('DynamicCSS', $t);
        $dcss->setCreated(-10);

        $this->assertFalse($dcm->validate($dcss));

        $dcss->setCreated(0);
        $this->assertTrue($dcm->validate($dcss));

        $dcss->setCreated(51);
        $this->assertTrue($dcm->validate($dcss));
    }
}