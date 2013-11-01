<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/23/13
 * Time: 2:36 PM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Entity\Tracker;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicCSSManagerCreateTest extends ContainerAwareUnitTestCase
{
    public function testCreate()
    {
        $t = new Tracker();
        // Validate that there aren't any tools associated with the tracker
        $this->assertEquals(0, count($t->getTrackingTools()));

        $dcm = $this->get('cympel_analytics.dynamic_css_manager');
        $dcss = $dcm->createTrackingTool('DynamicCSS', $t);
        $this->assertTrue($dcss->getTracker()->equals($t));

        // Validate that there is one tool associated with the tracker and that it is $dcss
        $this->assertEquals(1, count($t->getTrackingTools()));
        $tools = $t->getTrackingTools();
        $this->assertTrue($tools[0]->equals($dcss));
    }
}