<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/25/13
 * Time: 10:12 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class TrackerManagerRemoveKeyConstraintViolationTest extends ContainerAwareUnitTestCase
{
    /**
     * @expectedException \Doctrine\DBAL\DBALException
     *
     * This test should throw an exception because of a constraint violation in the database that occurs
     */
    public function testRemovalViolation()
    {
        $trackerManager = $this->get('cympel_analytics.tracker_manager');
        $dynamicCSSManager = $this->get('cympel_analytics.dynamic_css_manager');

        $tracker = $trackerManager->create();
        $dynamicCSS = $dynamicCSSManager->create($tracker);
        $dynamicCSSManager->persist($dynamicCSS);

        $trackerManager->unsafeRemove($tracker);

    }
}