<?php
/**
 * Created by PhpStorm.
 * User: caldwecr
 * Date: 10/24/13
 * Time: 1:21 PM
 * Copyright Cympel Inc
 */

namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;


use Cympel\Bundle\AnalyticsBundle\Services\TrackerManager;
use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;
use Cympel\Bundle\AnalyticsBundle\Services\DynamicCSSManager;

class DynamicCSSManagerTest extends ContainerAwareUnitTestCase
{
    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testConstructorManager()
    {
        // This test validates that the service extension argument of the constructor is required for the DynamicCSSManager
        $d = new DynamicCSSManager($this->get('doctrine'), $this->get('validator'), $this->get('router'), new TrackerManager(), 'foobar');
    }
}
 