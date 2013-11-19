<?php
/**
 * Created by JetBrains PhpStorm.
 * User: caldwecr
 * Date: 10/22/13
 * Time: 11:58 AM
 * Copyright Cympel Inc
 */
namespace Cympel\Bundle\AnalyticsBundle\Tests\Services;

use Cympel\Bundle\AnalyticsBundle\Tests\ContainerAwareUnitTestCase;

class DynamicCSSManagerConstructTest extends ContainerAwareUnitTestCase
{
    public function testDynamicCSSManagerConstruct()
    {
        $dcm = $this->get('ca.dcss.manager');
        $this->assertEquals('DynamicCSSManager', $dcm->getType());
    }
}