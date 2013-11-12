<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 11/11/13
 * Time: 10:43 PM
 * Copyright Cympel Inc
 */

namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;


use Cympel\Bundle\AnalyticsBundle\Services\CympelResourceServer;

class CympelResourceServerConstructTest extends \PHPUnit_Framework_TestCase {
    public function testConstruct()
    {
        $c = new CympelResourceServer();
        $resources = $c->getResources();
        $this->assertNotNull($resources);
        $this->assertTrue(is_array($resources));
        $this->assertGreaterThan(0, count($resources));
    }
}
 