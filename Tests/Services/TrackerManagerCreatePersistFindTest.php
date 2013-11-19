<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/25/13
 * Time: 10:23 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class TrackerManagerCreatePersistFindTest extends ContainerAwareUnitTestCase
{
    public function testCreatePersistFind()
    {
        $trackerManager = $this->get('ca.tracker.manager');
        $tracker = $trackerManager->create();
        $trackerManager->persist($tracker);
        $tracker2 = $trackerManager->findOneById($tracker->getId());
        $this->assertTrue($tracker->equals($tracker2));
        $this->assertTrue($tracker2->equals($tracker));
    }
}