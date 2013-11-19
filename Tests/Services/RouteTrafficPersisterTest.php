<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 8/21/13
 * Time: 9:36 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class RouteTrafficPersisterTest extends ContainerAwareUnitTestCase
{
    public function testRouteTrafficPersister()
    {
        // Write the route using the RouteTrafficPersister
        $rtp = $this->get('ca.rtp');
        $mtime = microtime(true);
        $rn = 'testRouteTrafficPersister' . $mtime;
        $rtp->persist($rn);

        // Read the written route using Doctrine directly
        $rt = $this->get('doctrine')
            ->getRepository('CympelAnalyticsBundle:RouteTraffic', $rtp->getEntityManagerName())
            ->findOneByName($rn);
        $this->assertNotEquals(false, $rt);
        $this->assertEquals($rt->getName(), $rn);
    }
}